<?php
    $message = $_SESSION['message'] ?? '';
    unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../../styles/mainHeader.css">
    <link rel="stylesheet" href="../../styles/globals.css">
    <link rel="stylesheet" href="../../styles/forms.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="../../scripts/app.js" defer type="module"></script>
</head>
<body>
    <?php
        include __DIR__."/../components/mainHeader.php";
    ?>
    <div class="containerLg formWrappDiv">
    <form action="?page=register" method="POST" class="form">
        <div class="inputDiv">
            <input type="text" placeholder="Email" name="email">
        </div>
        <div class="inputDiv">
            <input type="text" placeholder="Password" name="password">
        </div>
        <div class="inputDiv">
            <input type="text" placeholder="Confirm Password" name="confirmPassword">
        </div>
        <div class="formButton">
            <button type="submit">Send</button>
        </div>
    </form>
    <?php if($message): ?>
            <p class="errorMessage"><?= $message ?></p>
    <?php endif ?>
    <p>Allready have an account? <a href="?page=logIn">Login</a></p>
    </div>
</body>
</html>