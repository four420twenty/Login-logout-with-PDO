<?php

session_start();

if (empty($_SESSION['username'])) {
    die('You have to be logged in to visit this page!');
}

echo 'Welcome, ' . $_SESSION['username'] . '!<br />';
echo '<a href="logout.php">Logout</a>';
