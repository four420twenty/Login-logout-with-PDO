<?php

session_start();

$data = $_POST;

if (empty($data['username']) || empty($data['password'])) {
    die('Username or password are required!');
}

$username = $data['username'];
$password = $data['password'];

$sql = 'SELECT * FROM users;';

$dsn = 'mysql:dbname=phplogin;host=localhost';
$dbUser = 'root';
$dbPassword = '';

try {
    $connection = new PDO($dsn, $dbUser, $dbPassword);
} catch (\PDOException $exception) {
    die('Connection failed: ' . $exception->getMessage());
}

$statement = $connection->prepare('SELECT * FROM users WHERE username = :username');
$statement->execute([':username' => $username]);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

if (empty($result)) {
    die('No such user with the username!');
}

$user = array_shift($result);

if ($user['username'] === $username && $user['password'] === $password) {
    echo 'You have been successfully logged in! <br />';
    echo '<a href="account.php"> Go to my account. </a>';

    $_SESSION['username'] = $user['username'];
} else {
    die('Incorrect username or password');
}
