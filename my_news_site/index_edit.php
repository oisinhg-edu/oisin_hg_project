<?php
require_once "./etc/config.php";

try {
    // $stories = Story::findAll();
    // $stories = Story::findAll($options = array('limit' => 2));
    // $stories = Story::findAll($options = array('limit' => 2, 'offset' => 2));

    $horizontal_stories = Story::findAll($options = array('limit' => 3, 'offset' => 1));

    // $authorId = 7;
    // $stories = Story::findByAuthor($authorId);
    // $stories = Story::findByAuthor($authorId, $options = array('limit' => 3));
    // $stories = Story::findByAuthor($authorId, $options = array('limit' => 3, 'offset' => 2));

    // $categoryId = 4;
    // $stories = Story::findByCategory($categoryId);
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3));
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3, 'offset' => 2));

    $locationId = 2;
    // $stories = Story::findByLocation($locationId);
    // $stories = Story::findByLocation($locationId, $options = array('limit' => 3));
    $stories = Story::findByLocation($locationId, $options = array('limit' => 4, 'offset' => 0));

    $largeStory = Story::findById(1);
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
    <link rel="stylesheet" href="css/fonts.css">

    <script defer src="script/myScript.js"></script>
    
</head>

<body>
    <?php require_once "./etc/navbar.php"; ?>
    <?php require_once "./etc/flash_message.php"; ?>

    <!-- row 1 -->
    <div class="container">
        <div class="width-7 largeStory" onclick="location.href='view_story.php?id=<?= $largeStory->id ?>';">
            <img src="<?= $largeStory->img_url ?>">

            <div class="contentDiv">
                <span class="category space-mono-bold"><?= Category::findById($largeStory->category_id)->name ?></span>
                <div class="content">
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
                <a href="story_edit.php?id=<?= $largeStory->id ?>" class="edit"><button class="btn-edit">Edit</button></a>
            </div>
        </div>

        <div class="width-5 vertical_box">
            <?php foreach ($horizontal_stories as $key => $s) { ?>


                <div class="width-5 horizStory" onclick="location.href='view_story.php?id=<?= $s->id ?>';">
                    <span class="category space-mono-bold"><?= Category::findById($s->category_id)->name ?></span>
                    <div class="content">
                        <h3 class="title lato-black"><?= $s->headline ?></h3>
                        <p class="author space-mono-regular">
                            <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?>
                        </p>
                    </div>

                    <div class="imageSection">
                        <img src="<?= $s->img_url ?>">
                    </div>
                    <a href="story_edit.php?id=<?= $s->id ?>" class="edit"><button class="btn-edit">Edit</button></a>
                </div>
            <?php } ?> <!-- end php -->
        </div>
    </div> <!-- end row 1-->

    <!-- row 2 -->
    <div class="container">
        <?php foreach ($stories as $s) { ?>
            <div class="width-3 mediumStory" onclick="location.href='view_story.php?id=<?= $s->id ?>';">
                <div>
                    <img src="<?= $s->img_url ?>" />

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
                <a href="story_edit.php?id=<?= $s->id ?>" class="edit"><button>Edit</button></a>
            </div>
        <?php } ?> <!-- end php -->
    </div> <!-- end row 2 -->
</body>

</html>