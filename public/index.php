<?php 

require_once "../vendor/autoload.php";

$client = new Predis\Client(getenv('REDIS_PORT_6379_TCP'));
$client->set('foo', 'bar');

?>
Deployment Works!<br>
IP: <?= $_SERVER['SERVER_ADDR'] ?><br>
Redis: <?= getenv('REDIS_PORT_6379_TCP') ?><br>
Redis Test:<br>
&nbsp;&nbsp;&nbsp;&nbsp;These should be equal: bar = <?= $client->get('foo'); ?><br>
<?php phpinfo();
