<?php
header('Content-type:text/html;charset=UTF-8');
require_once('database.php');
$pdo = new cPDO(); //instance connection PDO
$ipaddr = filter_input(INPUT_SERVER, 'REMOTE_ADDR'); //filter var $_SERVER['remote_addr']
$fields = array('id' => 'null', 'ip' => $ipaddr);
$table = 'ips';
$pdo->insertdata($fields, $table); //insert ip of guest in the table ips
$pdo->endC();
?>
<html>
    <head></head>
    <body>
    <center>
        <h1>Example PDO connection</h1>
        <h2>Your ip is registered</h2>
    </center>
</body>
</html>
