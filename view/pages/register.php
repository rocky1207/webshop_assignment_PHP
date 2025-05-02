<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/globals.css">
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/forms.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    $message = $_SESSION['message'] ?? '';
    $bla = $_SESSION['emailExist'] ?? '';
    
    var_dump($_SESSION["registerData"] ?? []);
    var_dump($bla);
    var_dump($_SESSION["id"] ?? '');
    unset($_SESSION['message']);
    unset($_SESSION['emailExist']);
    unset($_SESSION["registerData"]);
    unset($_SESSION["id"]);
    ?>
    <div class="containerLg formWrappDiv">
    <form action="?page=register" method="POST" class="loginForm">
        <div>
            <input type="text" placeholder="Email" name="email">
        </div>
        <div>
            <input type="text" placeholder="Password" name="password">
        </div>
        <div>
            <input type="text" placeholder="Confirm Password" name="confirmPassword">
        </div>
        <div>
            <button type="submit">Send</button>
        </div>
        <?php if($message): ?>
            <p><?= $message ?></p>
        <?php endif ?>
    </form>
    <p>Allready have an account? <a href="/ITMentorstva/vezbe/PHP-16_webshop_assignment?page=logIn">Login</a></p>
    </div>
</body>
</html>