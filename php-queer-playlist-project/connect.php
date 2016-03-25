<?php
$pdo = new PDO('mysql: host=localhost;dbname=sys;port=3306','root','azul');
sleep(5);
$stmt = $pdo->prepare('SELECT * FROM playlist_queer');
$stmt->execute();
$pdo->query('SELECT pg_terminate_backend(pg_backend_pid());');
$pdo = null;
sleep(60);
?>