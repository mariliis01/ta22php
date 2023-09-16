<?php

require_once('./connection.php');

$id = $_POST['id'];

$stmt = $pdo->prepare('UPDATE books SET title=? WHERE id = :id');
$stmt->execute(['title' => $title]);

header('Location: book.php');
