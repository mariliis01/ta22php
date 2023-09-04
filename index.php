<?php

require_once('./connection.php');

$stmt = $pdo->query('SELECT * FROM books');

$stmt = $pdo->query('SELECT * FROM books WHERE is_deleted<>1');

echo "<ul>";
while ($row = $stmt->fetch())


{
?>
<li>
    <a href="./book.php?id=<?= $row['id'];?>">
    <?= $row['title'] . "<br>"; ?>
    </a>
    </li>

<?php
}


echo "</ul>";
?>