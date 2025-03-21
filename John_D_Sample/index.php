<?php
require_once "./etc/config.php";

try {
    // $stories = Story::findAll();
    // $stories = Story::findAll($options = array('limit' => 2));
    // $stories = Story::findAll($options = array('limit' => 2, 'offset' => 2));

    // $authorId = 7;
    // $stories = Story::findByAuthor($authorId);
    // $stories = Story::findByAuthor($authorId, $options = array('limit' => 3));
    // $stories = Story::findByAuthor($authorId, $options = array('limit' => 3, 'offset' => 2));

    // $categoryId = 4;
    // $stories = Story::findByCategory($categoryId);
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3));
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3, 'offset' => 2));

    $locationId = 7;
    // $stories = Story::findByLocation($locationId);
    // $stories = Story::findByLocation($locationId, $options = array('limit' => 3));
    $stories = Story::findByLocation($locationId, $options = array('limit' => 3, 'offset' => 0));
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>

<head>
    <title>Stories</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fonts.css">
</head>

<body>
    <?php require_once "./etc/navbar.php"; ?>
    <?php require_once "./etc/flash_message.php"; ?>
    <div class="container">


        <div class="width-3 mediumStory">
            <div>
                <span class="category space-mono-bold">cybersecurity</span>
                <img src="images/photo-1557992260-ec58e38d363c.jpg">

                <div class="content">
                    <h3 class="title lato-black">The Collapse of USAID Is Already Fueling Human Trafficking and Slavery
                        at
                        Scammer Compounds</h3>
                    <p class="body pt-serif-regular">The dismantling of USAID by Elon Musk’s DOGE and a State Department
                        funding freeze have severely
                        disrupted efforts to help people escape forced labor camps run by criminal scammers.</p>
                </div>
            </div>

            <div>
                <p class="author space-mono-regular">MATT BURGESS AND LILY HAY NEWMAN</p>
                <p class="date space-mono-bold">2025-02-12 14:58 0hr ago</p>
            </div>
        </div>



        <?php foreach ($stories as $s) { ?>
            <div class="width-3 mediumStory">
                <div>
                    <span class="category space-mono-bold"><?= Category::findById($s->category_id)->name ?></span>
                    <a href="view_story.php?id=<?= $s->id ?>">
                        <img src="<?= $s->img_url ?>" />
                    </a>

                    <div class="content">
                        <h3 class="title lato-black"><a href="view_story.php?id=<?= $s->id ?>"><?= $s->headline ?></a></h3>
                        <?= substr($s->article, 0, 175) ?>...
                    </div>
                </div>

                <div>
                    <!-- <p>Location: <?= Location::findById($s->location_id)->name ?></p> -->
                    <p class="author space-mono-regular">
                        <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?>
                    </p>
                    <p class="date space-mono-bold"><?= $s->created_at ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

</html>