<?php 

require_once "../vendor/autoload.php";

$client = new Predis\Client(getenv('REDIS_PORT_6379_TCP'));
$client->set('foo', 'true');

?>
Deployment Works!<br>
IP: <?= $_SERVER['SERVER_ADDR'] ?><br>
<br>
Redis: <?= getenv('REDIS_PORT_6379_TCP') ?><br>
Redis Test: true = <?= $client->get('foo'); ?><br>
<?php phpinfo();
