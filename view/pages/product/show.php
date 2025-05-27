<?php
    $message = $_SESSION["message"] ?? '';
    $product = $_SESSION["product"][0] ?? [];
    unset($_SESSION["message"]);
    unset($_SESSION["product"]);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../styles/mainHeader.css">
    <link rel="stylesheet" href="../../../styles/globals.css">
    <link rel="stylesheet" href="../../../styles/product.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="../../../scripts/app.js" defer type="module"></script>
</head>
<body>
    <?php include __DIR__."/../../components/mainHeader.php" ?>
    <main class="textCenter">
        <?php if(!$message): ?>
        <div class="product">
            <h1><?= $product["ime"] ?></h1>
            <p><?= $product["opis"] ?>, košta $<?= $product["cena"] ?>, a preostala količina je <?= $product["kolicina"] ?>.</p>
        </div>
        <div>
            <a href="index.php?page=update-product&id=<?= $product['id'] ?>" class="button-like">UPDATE</a>
        </div>
        <?php else: ?>
            <p class="errorMessage"><?= $message ?></p>
        <?php endif ?>
    </main>
</body>
</html>