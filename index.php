<?php

require_once('./connection');

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$stmt = $pdo->query('SELECT * FROM books');

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
