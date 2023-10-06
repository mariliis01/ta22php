<?php

require_once('./connection.php');

$id = $_GET['id'] ?? $_POST['id'];

//Fetch the book details
$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

//$stmt = $pdo->prepare('SELECT * FROM book_authors ba LEFT JOIN authors a ON a.id=ba.author_id WHERE book_id=:book_id;');
//$stmt->execute(['book_id' => $id]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>

<body>
    <h1>Muuda raamatut: <?= $book['title']; ?> </h1>

    Pealkiri:
    <form action="update_field.php" method="post">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="hidden" name="field" value="title">
        <input type="text" name="value" value="<?= $book['title']; ?>">
        <input type="submit" value="Uuenda">
    </form>

    Ilmumisaasta:
    <form action="update_field.php" method="post">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="hidden" name="field" value="release_date">
        <input type="text" pattern="\d{4}" title="Enter a valid year" name="value" value="<?= $book['release_date']; ?>">
        <input type="submit" value="Uuenda">
    </form>

    Keel:
    <form action="update_field.php" method="post">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="hidden" name="field" value="language">
        <input type="text" name="value" value="<?= $book['language']; ?>">
        <input type="submit" value="Uuenda">
    </form>

    Pages:
    <form action="update_field.php" method="post">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="hidden" name="field" value="pages">
        <input type="number" name="value" value="<?= $book['pages']; ?>">
        <input type="submit" value="Uuenda">
    </form>
    <h2>Current Authors: </h2>
    <ul>
        <?php
        $authorsStmt = $pdo->prepare('SELECT * FROM book_authors ba LEFT JOIN authors a ON a.id=ba.author_id WHERE book_id=:book_id');
        $authorsStmt->execute(['book_id' => $id]);
        while ($author = $authorsStmt->fetch()) {
        ?>

            <li>
                <?= $author['first_name']; ?> <?= $author['last_name']; ?>
                <form action="remove_author.php" method="post" style="display: inline;">
                    <input type="hidden" name="book_id" value="<?= $id; ?>">
                    <input type="hidden" name="author_id" value="<?= $author['id']; ?>">
                    <input type="submit" value="Eemalda">
                </form>
            </li>

        <?php
        }
        ?>
    </ul>

    <h2>Add Author: </h2>
    <form action="add_author.php" method="post">
        <input type="hidden" name="book_id" value="<?= $id; ?>">
        <select name="author_id">
            <?php
            $allAuthorsStmt = $pdo->query('SELECT * FROM authors');
            while ($author = $allAuthorsStmt->fetch()) {
            ?>
                <option value="<?= $author['id']; ?>"><?= $author['first_name']; ?> <?= $author['last_name']; ?></option>
            <?php
            }
            ?>
        </select>
        <input type="submit" value="Add">
    </form>
    <form action="book.php" method="get">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="submit" value="Tagasi raamatu juurde">
    </form>


</body>

</html>