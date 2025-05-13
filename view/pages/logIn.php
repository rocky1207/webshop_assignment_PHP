<?php
    $message = $_SESSION['message'] ?? '';
    unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/mainHeader.css">
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/globals.css">
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/forms.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="/ITMentorstva/vezbe/PHP-16_webshop_assignment/scripts/app.js" defer type="module"></script>
</head>
<body>
    <?php
        include __DIR__."/../components/mainHeader.php";
    ?>
    <div class="containerLg formWrappDiv">
    <form method="POST" action="?page=logIn" class="form">
        <div class="inputDiv">
            <input type="text" placeholder="Email" name="email">
        </div>
        <div class="inputDiv">
            <input type="text" placeholder="Password" name="password">
        </div>
        <div class="formButton">
            <button type="submit">Send</button>
        </div>
        
    </form>
    <?php if($message): ?>
        <p class="errorMessage"><?= $message ?></p>
    <?php endif ?>
    <p>You don't have an account? <a href="/ITMentorstva/vezbe/PHP-16_webshop_assignment?page=register">Register</a></p>
    
    </div>
</body>
</html>