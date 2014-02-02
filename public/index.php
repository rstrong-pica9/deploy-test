<?php
require_once "../vendor/autoload.php";

//redis test
$client = new Predis\Client(getenv('REDIS_PORT_6379_TCP'));
$client->set('foo', 'true');

//postgres test
try {
    $pdo = new PDO(
        'pgsql:dbname=docker;host=' . getenv('DB_PORT_5432_TCP_ADDR') . ';port=5432;',
        'docker',
        'docker'
    );

        $pdo->query('CREATE TABLE access_log (id serial NOT NULL, created_at timestamp without time zone NOT NULL)');

} catch (Exception $e) {
    echo "Could not connect to postgresql<br>" . $e->getMessage() . "<br>";
}

$pdo->query("INSERT INTO access_log (created_at) VALUES ('" . date('r') . "')");
?>
<b>Deployment Works!</b><br>
IP: <?= $_SERVER['SERVER_ADDR'] ?><br>
<br>
Redis: <?= getenv('REDIS_PORT_6379_TCP') ?><br>
Redis Test: true = <?= $client->get('foo'); ?><br>
<br>
PostgreSQL Test:<br>
&nbsp;&nbsp;Last 5 Access Log Entries<br>
<?php $sth = $pdo->query('SELECT * FROM access_log ORDER BY id DESC LIMIT 5');
$sth->setFetchMode(PDO::FETCH_ASSOC);
foreach ($sth->fetchAll() as $row) { ?>
    &nbsp;&nbsp;<?= $row['created_at']; ?><br>
    <?php
}
phpinfo();
