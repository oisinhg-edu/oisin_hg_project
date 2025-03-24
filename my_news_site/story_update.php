<?php
require_once 'etc/global.php';
require_once 'etc/config.php';

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method");
    }
    if (!array_key_exists("id", $_POST)) {
        throw new Exception("Invalid request parameters");
    }

    $id = $_POST["id"];
    $story = Story::findById($id);

    if ($story === null) {
        throw new Exception("Story not found");
    }

    $validator = new StoryFormValidator($_POST);
    $valid = $validator->validate();

    if ($valid) {
        $data = $validator->data();

        $story->headline = $data["headline"];
        $story->short_headline = $data["short_headline"];
        $story->article = $data["article"];
        $story->img_url = $data["img_url"];
        $story->author_id = $data["author_id"];
        $story->category_id = $data["category_id"];
        $story->location_id = $data["location_id"];

        $story->save();

        redirect('index_edit.php');
    } else {
        $errors = $validator->errors();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['form-data'] = $_POST;
        $_SESSION['form-errors'] = $errors;

        redirect("story_edit.php?id=$id");
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>