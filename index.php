<?php

require_once('./connection.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <?php

    $searchTerm = $_GET['search'] ?? '';


    $stmt = $pdo->prepare('SELECT * FROM books WHERE is_deleted <> 1 AND title LIKE :searchTerm');
    $stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);

    ?>
    <form action="index.php" method="get">
        <input type="text" name="search" placeholder="Otsi raamatut">
        <input type="submit" value="Otsi">
    </form>

    <?php
    $id = $_POST['id'];
    if (!empty($_POST['first_name']) && !empty($_POST['last_name'])) {


        $stmtAuthor = $pdo->prepare('INSERT INTO authors (first_name, last_name) VALUES (:firstName, :lastName)');
        $stmtAuthor->execute(['firstName' => $_POST['first_name'], 'lastName' => $_POST['last_name']]);
    }
    ?>

    <form action="index.php" method="post">
        <input type="text" name="first_name" placeholder="Autori eesnimi">
        <input type="text" name="last_name" placeholder="Autori perekonnanimi">
        <input type="submit" value="Lisa autor">
    </form>


    <ul>
        <?php

        while ($row = $stmt->fetch()) {
        ?>


            <li>
                <a href="./book.php?id=<?= $row['id']; ?>">
                    <?= $row['title']; ?>
                </a>
            </li>

        <?php
        }

        ?>

    </ul>
</body>

</html>