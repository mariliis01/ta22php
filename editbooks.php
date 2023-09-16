<?php

require_once('./connection.php');

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

$stmt = $pdo->prepare('SELECT * FROM book_authors ba LEFT JOIN authors a ON a.id=ba.author_id WHERE book_id=:book_id;');
$stmt->execute(['book_id' => $id]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $book['title'] ?></title>
</head>

<body>
    <h1>Raamatu info muutmine</h1>

    <form id="edit" action="edit.php">
        <p>Pealkiri</p>
        <input type="text" value="<?= $book['title'] ?>">
        <p>Hind</p>
        <input type="number" value="<?= round($book['price'], 2) ?>">
        <p>Lehekülgede arv</p>
        <input type="numer" value="<?= $book['pages'] ?>">
        <p>Laoseis</p>
        <input type="number" value="<?= $book['stock_saldo'] ?>">
    </form>
    <button form="edit">Salvesta muudatused</button>
</body>

</html>