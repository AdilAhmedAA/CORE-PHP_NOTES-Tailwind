<?php

$notes = $db->query('select * from notes');
$users = $db->query('select * from users');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['FormAction'] == 'add-note') {
    $note = $_POST;

    $query = 'INSERT INTO notes (body, user_id) VALUES (:body, :user_id)';
    $params = [
        'body' => $note['body'],
        'user_id' => $note['user']
    ];

    if ($db->executenow($query, $params)) {
        $_SESSION['msg'] = "Note Added successfully";
        header('Location: /');
        exit;
    } else {
        $_SESSION['er'] = "Error adding note.";
        echo "Error adding note.";
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['FormAction'] == 'delete-note') {
    $noteId = $_POST['note_id'];
    $query = 'DELETE FROM notes WHERE id = :id';
    $params = ['id' => $noteId];

    try {
        if ($db->executenow($query, $params)) {
            $_SESSION['msg'] = "Note Deleted successfully";
            header('Location: /');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['er'] = "Error deleting note.";
        header('Location: /');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['FormAction'] == 'edit-note') {
    $note = $_POST;

    $query = 'UPDATE notes SET body = :body, user_id = :user_id WHERE id = :id';
    $params = [
        'body' => $note['body'],
        'user_id' => $note['user'],
        'id' => $note['note_id']
    ];


    if ($db->executenow($query, $params)) {
        $_SESSION['msg'] = "Note Edited successfully";
        header('Location: /');
        exit;
    } else {
        $_SESSION['er'] = "Error updating note.";
        echo "Error updating note.";
    }
}

require('views/app-view.php');
