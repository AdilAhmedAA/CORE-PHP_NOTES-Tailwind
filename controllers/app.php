<?php

$notes = $db->query('select * from notes');
$users = $db->query('select * from users');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['FormAction'] == 'add-note') {
    $note = $_POST;

    $query = 'INSERT INTO notes (body, user_id) VALUES (:body, :user_id)';
    $params = [
        'body' => $note['body'],
        'user_id' => $note['user']
    ];

    if ($db->executenow($query, $params)) {
        header('Location: /');
        exit;
    } else {
        echo "Error adding note.";
    }
}
if ( $_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['FormAction'] == 'delete-note' ) {
    $noteId = $_POST['note_id']; 
    $query = 'DELETE FROM notes WHERE id = :id';
    $params = ['id' => $noteId];

    if ($db->executenow($query, $params)) {
        header('Location: /');
        exit;
    } else {
        echo "Error deleting note.";
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
        header('Location: /');
        exit;
    } else {
        echo "Error updating note.";
    }
}

require('views/app-view.php');