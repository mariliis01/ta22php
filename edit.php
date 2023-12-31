<?php

require_once('./connection.php');

if($_POST) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $release_date = $_POST['release_date'];
    $language = $_POST['language'];
    $page = $_POST['page'];
    $type = $_POST['type'];

    $stmt = $pdo->prepare('UPDATE books SET title = :title, release_date = :release_date, language = :language, page = :page, type = :type WHERE id =:id');
    $stmt->execute([
        'id' => $id, 
        'title' => $title, 
        'release_date' => $release_date, 
        'language' => $language, 
        'page' => $page, 
        'type' => $type
    ]);

    header('Location:book.php?id=' . $id);
}

?>