<?php
require_once "./etc/config.php";

try {
    $stories = Story::findAll($options = array('order' => 'created_at ', 'limit' => 8));

    $largeStory = array_slice($stories, 0, 1)[0];
    $med_stories = array_slice($stories, 4, 4);
    $horizontal_stories = array_slice($stories, 1, 3);

} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>

<head>
    <title>Stories Edit</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mediumStory.css">
    <link rel="stylesheet" href="css/horizStory.css">
    <link rel="stylesheet" href="css/largeStory.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/edit.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/fonts.css">

    <script defer src="js/app.js"></script>

</head>

<body>
    <?php require_once "./etc/navbar.php"; ?>
    <?php require_once "./etc/flash_message.php"; ?>

    <!-- row 1 -->
    <div class="container">
        <div class="width-7 largeStory">
            <div class="contentDiv" style='background-image: url("images/<?= $largeStory->img_url ?>");'>
                <div class="content">
                    <span
                        class="category space-mono-bold"><?= Category::findById($largeStory->category_id)->name ?></span>
                    <div class="text">
                        <h3 class="title lato-black"><?= $largeStory->headline ?></h3>
                        <p class="body"><?= substr($largeStory->article, 0, 155) ?>...</p>
                    </div>
                    <div>
                        <p class="author space-mono-regular">
                            <?= Author::findById($largeStory->author_id)->first_name . " " . Author::findById($largeStory->author_id)->last_name ?>
                        </p>
                        <p class="date space-mono-bold"><?= $largeStory->created_at ?></p>
                    </div>
                </div>

                <span id="actions">
                    <a href="story_edit.php?id=<?= $largeStory->id ?>" class="edit"><button
                            class="action-btn">Edit</button></a>
                    <form class="story-delete" action="story_delete.php" method="POST">
                        <input type="hidden" name="id" value="<?= $largeStory->id ?>">
                        <input class="action-btn" id="delete-btn" type="submit" value="Delete">
                    </form>
                </span>
            </div>
        </div>

        <div class="width-5 vertical_box">
            <?php foreach ($horizontal_stories as $key => $s) { ?>
                <div class="width-5 horizStory">
                    <span class="category space-mono-bold"><?= Category::findById($s->category_id)->name ?></span>
                    <div class="content">
                        <h3 class="title lato-black"><?= $s->short_headline ?></h3>
                        <p class="author space-mono-regular">
                            <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?>
                        </p>
                    </div>

                    <div class="imageSection">
                        <img src="images/<?= $s->img_url ?>">
                    </div>
                    <span id="actions">
                        <a href="story_edit.php?id=<?= $s->id ?>" class="edit"><button class="action-btn">Edit</button></a>
                        <button class='action-btn' id="delete-btn" data-id="<?= $s->id ?>">Delete</button>
                    </span>
                </div>
            <?php } ?> <!-- end php -->
        </div>
    </div> <!-- end row 1-->

    <!-- row 2 -->
    <div class="container">
        <?php foreach ($med_stories as $s) { ?>
            <div class="width-3 mediumStory">
                <div>
                    <img src="images/<?= $s->img_url ?>" />

                    <div class="content">
                        <h3 class="title lato-black"><?= $s->headline ?></h3>
                        <?= substr($s->article, 0, 175) ?>...
                    </div>

                    <span class="category space-mono-bold"><?= Category::findById($s->category_id)->name ?></span>
                </div>

                <div>
                    <!-- <p>Location: <?= Location::findById($s->location_id)->name ?></p> -->
                    <p class="author space-mono-regular">
                        <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?>
                    </p>
                    <p class="date space-mono-bold"><?= $s->created_at ?></p>
                </div>
                <span id="actions">
                    <a href="story_edit.php?id=<?= $s->id ?>" class="edit"><button class="action-btn">Edit</button></a>
                    <form class="story-delete" action="story_delete.php" method="POST">
                        <input type="hidden" name="id" value="<?= $s->id ?>">
                        <input class="action-btn" id="delete-btn" type="submit" value="Delete">
                    </form>
                </span>
            </div>
        <?php } ?> <!-- end php -->
    </div> <!-- end row 2 -->

    <!-- confirmation box-->
    <div id="confirm" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to delete this story?</p>

            <button id="modal-cancel">Cancel</button>
            <form class="story-delete" action="story_delete.php" method="POST">
                <input type="button" id="modal-delete" value="Delete">
            </form>
        </div>
    </div>
</body>

</html>