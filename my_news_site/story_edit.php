<?php
require_once "./etc/config.php";
require_once "./etc/global.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    if ($_SERVER["REQUEST_METHOD"] !== "GET") {
        throw new Exception("Invalid request method");
    }
    if (!array_key_exists("id", $_GET)) {
        throw new Exception("Invalid request parameters");
    }

    $id = $_GET["id"];
    $story = Story::findById($id);

    if ($story === null) {
        throw new Exception("Story not found");
    }

    $authors = Author::findAll();
    $locations = Location::findAll();
} catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/story_create.css">
    <link rel="stylesheet" href="css/navbar.css">

    <script defer src="script/myScript.js"></script>

    <title>Story Edit</title>
</head>

<body>
    <?php require_once "etc/navbar.php"; ?>

    <div class="container">
        <div class="content width-12">
            <h2>Story Edit Form</h2>
            <form action="story_update.php" method="POST">
                <input type="hidden" name="id" value="<?= $story->id ?>">
                <p>
                    Headline:
                    <input type="text" name="headline" value="<?= old('headline', $story->headline) ?>">
                </p>
                <span class="error"><?= error('headline') ?></span>

                <p>
                    Short Headline:
                    <input type="text" name="short_headline"
                        value="<?= old('short_headline', $story->short_headline) ?>">
                </p>
                <span class="error"><?= error('short_headline') ?></span>

                <p id="articleText">
                    Article:
                    <textarea name="article"><?= old('article', $story->article) ?></textarea>
                </p>
                <span class="error"><?= error('article') ?></span>

                <p>
                    Image URL:
                    <!-- <input type="file" name="fileToUpload" id="fileToUpload"> -->
                    <input type="text" name="img_url" value="<?= old('img_url', $story->img_url) ?>">
                </p>
                <span class="error"><?= error('img_url') ?></span>

                <p>
                    Author:
                    <select name="author_id">
                        <option value="">Please choose the author...</option>
                        <?php foreach ($authors as $author): ?>
                            <option value=<?= $author->id ?>     <?= chosen("author_id", $author->id, $story->author_id) ? "selected" : ""; ?>>
                                <?= $author->first_name ?>     <?= $author->last_name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <span class="error"><?= error('author_id') ?></span>

                <p>
                    Category:
                    <select name="category_id">
                        <option value="">Please choose the category...</option>
                        <?php foreach ($categories as $category): ?>
                            <option value=<?= $category->id ?>     <?= chosen("category_id", $category->id, $story->category_id) ? "selected" : ""; ?>>
                                <?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <span class="error"><?= error('category_id') ?></span>

                <p>
                    Location:
                    <select name="location_id">
                        <option value="">Please choose the location...</option>
                        <?php foreach ($locations as $location): ?>
                            <option value=<?= $location->id ?>     <?= chosen("location_id", $location->id, $story->location_id) ? "selected" : ""; ?>>
                                <?= $location->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <span class="error"><?= error('location_id') ?></span>

                <span class="error"><?= error('created_at') ?></span>

                <p id="control-btns">
                    <a href="index_edit.php"><button type="button">Cancel</button></a>
                    <button type="submit">Submit</button>
                </p>
            </form>
        </div>
    </div>
</body>

</html>

<?php
if (array_key_exists("form-data", $_SESSION)) {
    unset($_SESSION["form-data"]);
}
if (array_key_exists("form-errors", $_SESSION)) {
    unset($_SESSION["form-errors"]);
}
?>