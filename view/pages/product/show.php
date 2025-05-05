<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/mainHeader.css">
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/globals.css">
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/product.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="/ITMentorstva/vezbe/PHP-16_webshop_assignment/scripts/app.js" defer type="module"></script>
</head>
<body>
    <?php
        include __DIR__."/../../components/mainHeader.php";
    ?>
    <main class="textCenter">
        <div class="product">
            <h1><?= $_SESSION["product"][0]["ime"] ?></h1>
            <p><?= $_SESSION["product"][0]["opis"] ?>, košta $<?= $_SESSION["product"][0]["cena"] ?>, a preostala količina je <?= $_SESSION["product"][0]["kolicina"] ?>.</p>
            
        </div>
    </main>
</body>
</html>