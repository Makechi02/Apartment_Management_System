<?php
ob_start();
session_start();

require_once '../database/database.php';
$db = Database::getInstance();

$msg = false;
$email = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $loginType = $_POST['login-type'];

    if (empty($loginType)) {
        $error = 'Please select user type';
        $msg = true;
    }
}

$user_Type = [
    "admin",
    "owner",
    "employee",
    'tenant',
];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apartment Management System</title>

    <link rel="stylesheet" href="assets/css/style.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link rel="preload" href="assets/fonts/Chubbo/Chubbo-Variable.woff2" as="font" type="font/woff2" crossorigin />
    <link rel="preload" href="assets/fonts/Supreme/Supreme-Variable.woff2" as="font" type="font/woff2" crossorigin />
</head>
<body>

<div class="login-container">

    <div class="image-container">
        <img src="assets/images/stay-home-pull.gif"  alt="home-gif"/>
    </div>

    <div class="login-form">
        <h1>Apartment Management System</h1>

        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
            <h2>Forgot Password</h2>
            <h2>Search for your account</h2>

            <?php if($msg) { ?>
                <div id="login_error">
                    <p><?= $error ?></p>
                </div>
            <?php } ?>

            <div class="input-group">
                <label for="email">
                    <i class="fa fa-envelope"></i>
                </label>
                <input type="email" name="email" id="email" class="input" placeholder="Your Email" required
                       value="<?= htmlspecialchars($email) ?>" enterkeyhint="next" />
            </div>

            <div class="input-group">
                <label for="login-type">
                    <i class="fa fa-users"></i>
                </label>
                <select name="login-type" id="login-type" class="input">
                    <option value="">--Select User Type--</option>
                    <?php foreach($user_Type as $user): ?>
                        <option value="<?= $user ?>" style="text-transform: capitalize" <?= $loginType === $user ? 'selected' : '' ?> ><?= $user ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <button type="submit" id="login" class="submit-btn">
                    <i class="fa fa-search"></i>
                    Search
                </button>
            </div>

        </form>

        <div>
            <a href="index.php" >Back to Login</a>
        </div>

    </div>

</div>

<script src="assets/js/script.js"></script>
</body>
</html>