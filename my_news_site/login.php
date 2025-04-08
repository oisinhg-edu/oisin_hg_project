<?php
require_once "etc/config.php";
require_once "etc/global.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <script defer src="js/app.js"></script>
</head>

<body>
    <form action="login_check.php" method="POST">
        <p>
            <label for="username">Username: </label>
            <input type="text" name="username" value="<?= old('username') ?>">
            <span class="error"><?= error('username') ?></span>
        </p>

        <p>
            <label for="password">Password: </label>
            <input type="password" name="password">
            <span class="error"><?= error('password') ?></span>
        </p>

        <a href="index.php"><button type="button">Cancel</button></a>
        <button>Login</button>
    </form>
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