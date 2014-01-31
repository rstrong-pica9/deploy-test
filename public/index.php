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

} catch (Exception $e) {
    echo "Could not connect to postgresql<br>";
}

?>
Deployment Works!<br>
IP: <?= $_SERVER['SERVER_ADDR'] ?><br>
<br>
Redis: <?= getenv('REDIS_PORT_6379_TCP') ?><br>
Redis Test: true = <?= $client->get('foo'); ?><br>
<?php phpinfo();
