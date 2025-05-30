<?php 

$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;

?>
<header data-logged-in="<?php echo $isLoggedIn ?>" class="headerOne">
    <div class="containerLg">
        <button type="button" id="menuBtn">
        <svg class="menuIcon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <line x1="2" y1="6" x2="25" y2="6" />
            <line x1="2" y1="12" x2="25" y2="12" />
            <line x1="2" y1="18" x2="25" y2="18" />
        </svg>
        </button>
    </div>
    <div class="containerLg hidden headerDiv">
        <div>
            <p>LOGO</p>
        </div>
        <nav>
            <ul>
                
                <li>
                    <a href="/">Welcome</a>
                </li>
                <li>
                    <a href="?page=aboutUs">About us</a>
                </li>
                <?php if($isLoggedIn):?>
                <li>
                    <a href="?page=products">Product list</a>
                </li>
                
                <li>
                    <a href="?page=add-product">Add product</a>
                </li>
                <li>
                    <a href="?page=logOut">Log Out</a>
                </li>
                <?php endif?>
                <?php if(!$isLoggedIn):?>
                <li>
                    <a href="?page=logIn">Log In</a>
                </li>
                <?php endif?>
            </ul>
        </nav>
    </div>
</header>