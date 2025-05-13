<?php
    $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/mainHeader.css">
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/globals.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="/ITMentorstva/vezbe/PHP-16_webshop_assignment/scripts/app.js" defer type="module"></script>
</head>
<body>

<?php include __DIR__ . '/../components/mainHeader.php'; ?>
    <main class='textCenter'>
        <h1>Welcome</h1>
        <div>
            <p>This is just Welcome page.</p>
            <?php if(!$isLoggedIn): ?>
                <p>Log in to manage products.</p>
            <?php endif ?>
            <p>Enjoy!</p>
        </div>
    </main>
</body>
</html>