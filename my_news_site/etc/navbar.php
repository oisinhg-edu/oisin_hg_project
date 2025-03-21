<?php

try {
    $categories = Category::findAll();
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<div id="navbar">
    <div class="container-no-padding">
        <ul class="navbar-items width-12">
            <li><a href="index.php">Home</a></li>

            <?php foreach ($categories as $c) { ?>
                <li><a href="category.php?id=<?= $c->id ?>"><?= $c->name ?></a></li>
            <?php } ?>

            <div class="dropdown">
                <li><button id="dropbtn" onclick="toggle()">Admin</button>
                </li>

                <div class="dropdown-content">
                    <a href="story_create.php">Add Story</a>
                    <a href="index_edit.php">Edit Stories</a>
                    <a href="images.php">Upload Image</a>
                </div>
            </div>
        </ul>
    </div>
</div>