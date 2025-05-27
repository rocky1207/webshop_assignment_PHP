<?php
    $message = $_SESSION['message'] ?? '';
    $product = $_SESSION['product'] ?? [];
    unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update product</title>
    <link rel="stylesheet" href="../../../styles/mainHeader.css">
    <link rel="stylesheet" href="../../../styles/globals.css">
    <link rel="stylesheet" href="../../../styles/products.css">
    <link rel="stylesheet" href="../../../styles/forms.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="../../../scripts/app.js" defer type="module"></script>
</head>
<body>
    <?php include __DIR__."/../../components/mainHeader.php" ?>
    <div class="containerLg formWrappDiv">
    <form action="?page=update-product&id=<?=$product[0]['id'] ?? '' ?>" method="POST" class="form">
        <div class="inputDiv">
            <input type="text" name="product" placeholder="Product name" value="<?= $product[0]["ime"] ?? '' ?>">
        </div>
        <div class="inputDiv">
            <input type="text" name="description" placeholder="Descrition" value="<?= $product[0]["opis"] ?? '' ?>">
        </div>
        <div class="inputDiv">
            <input type="text" name="price" placeholder="Price" value="<?= $product[0]["cena"] ?? '' ?>">
        </div>
        <div class="inputDiv">
            <input type="text" name="image" placeholder="Image" value="<?= $product[0]["slika"] ?? '' ?>">
        </div>
        <div class="inputDiv">
            <input type="text" name="quantity" placeholder="Quantity" value="<?= $product[0]["kolicina"] ?? '' ?>">
        </div>
        <div class="formButton">
            <button type="submit">Send</button>
        </div>
    </form>
    <?php if($message): ?>
        <p class="errorMessage"><?= $message ?></p> 
    <?php endif ?>
    </div>
</body>
</html>