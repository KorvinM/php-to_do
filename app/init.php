<?php

session_start();

$_SESSION['user_id'] = 1; //fake as login

$db = new PDO ('mysql:host=localhost;dbname=todo', 'root', 'root');

//$db = mysqli_connect('localhost', 'root','root', 'todo');

//this should be done differently

if (!isset($_SESSION['user_id'])) {
  die('Not signed in.');
}

