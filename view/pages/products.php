<?php 
$products = $_SESSION['products'] ?? [];

var_dump($_SESSION["user"] ?? []);

unset($_SESSION['products']);
unset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/mainHeader.css">
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/globals.css">
    <link rel="stylesheet" href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/styles/products.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="/ITMentorstva/vezbe/PHP-16_webshop_assignment/scripts/app.js" defer type="module"></script>
</head>
<body>
    <?php include __DIR__."/../components/mainHeader.php" ?>
    <main class="textCenter">
        <h1>This is a list of all products we have</h1>
        <ul class="productList">
            <?php foreach($products as $product): ?>
            <li>
                <h2>Product name: <?= $product['ime'] ?></h2>
                <div>
                    <img src="" alt="<?= $product['ime'] ?>">
                </div>
                <p>Description: <?= $product['opis'] ?></p>
                <p>Price: <?= $product['cena'] ?></p>
                <p>Quantity: <?= $product['kolicina'] ?></p>
            </li>
            <?php endforeach ?>
        </ul>
    </main>
</body>
</html>