<?php 

require_once "../vendor/autoload.php";

//redis test
$client = new Predis\Client(getenv('REDIS_PORT_6379_TCP'));
$client->set('foo', 'true');

//postgres test
try {
    $pdo = new PDO(
        'pgsql:dbname=docker;host=' .
        getenv('DB_PORT_6379_TCP_ADDR') . ';user=docker;password=docker;port=5432;'
    );

    //try to create testing DB
    try {
        $testing = new PDO(
            'pgsql:dbname=testing;host=' .
            getenv('DB_PORT_6379_TCP_ADDR') . ';user=docker;password=docker;port=5432;'
        );
    } catch (Exception $e) {
        //DB doesn't exist, create it
        $pdo->query('CREATE DATABASE testing OWNER=docker;');
        $testing = new PDO(
            'pgsql:dbname=testing;host=' .
            getenv('DB_PORT_6379_TCP_ADDR') . ';user=docker;password=docker;port=5432;'
        );
        $testing->query('CREATE TABLE access_log (id serial NOT NULL, created_at timestamp without time zone NOT NULL)');
    }

} catch (Exception $e) {
    echo "Could not connect to postgresql<br>";
}

?>
Deployment Works!<br>
IP: <?= $_SERVER['SERVER_ADDR'] ?><br>
<br>
Redis: <?= getenv('REDIS_PORT_6379_TCP') ?><br>
Redis Test: true = <?= $client->get('foo'); ?><br>
<br>
PostgreSQL Test:<br>
&nbsp;&nbsp;Access Log Entries
<?php foreach ($testing->query('SELECT * FROM access_log') as $row) { ?>
    &nbsp;&nbsp;<?= $row['created_at']; ?><br>
<?php } ?>
<?php phpinfo();
