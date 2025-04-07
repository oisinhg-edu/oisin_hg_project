<?php
require_once "etc/config.php";

try {
    if (!isset($_GET["id"])) {
        throw new Exception("Story ID not provided.");
    }
    $id = $_GET["id"];
    $s = Story::findById($id);
    if ($s == null) {
        throw new Exception("Story not found.");
    }
    $category = Category::findById($s->category_id);
    $related_stories = Story::findByCategory($category->id, $options = array('limit' => 3, 'order_by' => 'updated_at DESC'));
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>

<head>
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

    <title>Story</title>
</head>

<body>
    <?php require_once "etc/navbar.php"; ?>
    <?php require_once "etc/flash_message.php"; ?>
    <div>
        <h1><?= $s->headline ?></h1>
        <div>
            <p><?= $s->article ?></p>
        </div>
        <p><img src="assets/images/<?= $s->img_url ?>" /></p>
        <p>Author: <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?>
        </p>
        <p>Category: <?= Category::findById($s->category_id)->name ?></p>
        <p>Location: <?= Location::findById($s->location_id)->name ?></p>
        <p>Date created: <?= $s->created_at ?></p>
        <p>Last modified: <?= $s->updated_at ?></p>
    </div>
    <div>
        <h2>Related Stories</h2>
        <?php foreach ($related_stories as $rs) { ?>
            <?php if ($rs->id == $s->id) {
                continue;
            } ?>
            <div>
                <h3><a href="story_view.php?id=<?= $rs->id ?>"><?= $rs->headline ?></a></h3>
                <p>Author:
                    <?= Author::findById($rs->author_id)->first_name . " " . Author::findById($rs->author_id)->last_name ?>
                </p>
                <!-- <p>Category: <?= Category::findById($rs->category_id)->name ?></p> -->
                <!-- <p>Location: <?= Location::findById($rs->location_id)->name ?></p> -->
                <!-- <p>Date created: <?= $rs->created_at ?></p> -->
                <p>Last modified: <?= $rs->updated_at ?></p>
            </div>
        <?php } ?>

        <?php require_once "./etc/footer.php"; ?>
</body>

</html>