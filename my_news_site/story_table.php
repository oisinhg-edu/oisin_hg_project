<?php
require_once "etc/config.php";
require_once "etc/global.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$stories = Story::findAll();
$authors = Author::findAll();
$locations = Location::findAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Stories</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>
    <?php require_once "etc/navbar.php"; ?>

    <table>
        <thead>
            <tr>
                <th>Headline</th>
                <th>Short Headline</th>
                <th>Article</th>
                <th>Image</th>
                <th>Author</th>
                <th>Category</th>
                <th>Location</th>
                <th>Creation Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stories as $story): ?>
                <tr>
                    <td><a href="story_view.php?id=<?= $story->id ?>"><?= $story->headline ?></a></td>
                    <td><?= $story->short_headline ?></td>
                    <td><?= $story->article ?></td>
                    <td><?= $story->img_url ?></td>
                    <td>
                        <?= $authors[$story->author_id]->first_name ?>
                    </td>
                    <td>
                        <?= $categories[$story->category_id]->name ?>
                    </td>
                    <td>
                        <?= $locations[$story->location_id]->name ?>
                    </td>
                    <td>
                        <a href="story_edit.php?id=<?= $story->id ?>"><button>Edit</button></a>
                        <form class="form-delete" action="story_delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $story->id ?>">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>