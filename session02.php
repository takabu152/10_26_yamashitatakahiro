<?php
session_start();

echo $_SESSION['num'];

$_SESSION['num'] += 1;

echo $_SESSION['num'];
