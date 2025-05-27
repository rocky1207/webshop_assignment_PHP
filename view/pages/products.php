<?php 
$products = $_SESSION['products'] ?? [];
$message = $_SESSION["message"] ?? '';

unset($_SESSION['products']);
unset($_SESSION['message']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../../styles/mainHeader.css">
    <link rel="stylesheet" href="../../styles/globals.css">
    <link rel="stylesheet" href="../../styles/products.css">
    <link rel="stylesheet" href="../../styles/forms.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="../../scripts/app.js" defer type="module"></script>
</head>
<body>
    <div class="overlay hidden">
        <form method="POST" action="?page=delete-product" action class="overlayContent">
            <input type="hidden" name="id" value="">>
            <p>Are You sure??</p>
            <div class="overlayButtonDiv">
                <button type="submit">Yes</button>
                <button type="button">No</button>
            </div>
        </form>
    </div>
    <?php include __DIR__."/../components/mainHeader.php" ?>
    
    <main class="textCenter">
        <h1>This is a list of all products we have</h1>
        <form id="searchForm" class="form center" action="?page=search-product">
            <div class="inputDiv searchInputDiv">
            <input id="searchInput" type="text" name="search" placeholder="Search product" value="">
        </div>
        </form>
        <?php if(!$message): ?>
        <?php if(!empty($products)): ?>
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
                <p><a href="?page=product&id=<?= $product['id'] ?>">See more...</a></p>
                <div class="productButtonDiv">
                    <button type="button" data-id=<?= $product["id"] ?>>DELETE</button>
                </div>
            </li>
            <?php endforeach ?>
            
        </ul>
        <?php else: ?>
            <p class="errorMessage">There is no any product in the list...</p>
        <?php endif ?>
        <?php else: ?>
            <p class="errorMessage"><?= $message ?></p>
        <?php endif ?>
    </main>
</body>
</html>