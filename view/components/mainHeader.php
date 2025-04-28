<?php 

$isLoggedIn = $_SESSION['isLoggedIn'] ?? '';


?>
<header data-logged-in="<?php echo $isLoggedIn ?>" class="headerOne">
<?php 


var_dump($isLoggedIn);

?>
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
                        <a href="/ITMentorstva/vezbe/PHP-16_webshop_assignment/">Welcome</a>
                    </li>
                    <li>
                        <a href="/ITMentorstva/vezbe/PHP-16_webshop_assignment?page=aboutUs">About us</a>
                    </li>
                    <?php if($isLoggedIn):?>
                    <li>
                        <a href="/ITMentorstva/vezbe/PHP-16_webshop_assignment?page=products">Product list</a>
                    </li>
                    
                    <li>
                        <a href="">Add product</a>
                    </li>
                    <li>
                        <a href="">Log Out</a>
                    </li>
                    <?php endif?>
                    <?php if(!$isLoggedIn):?>
                    <li>
                        <a href="/ITMentorstva/vezbe/PHP-16_webshop_assignment?page=logIn">Log In</a>
                    </li>
                    <?php endif?>
                </ul>
            </nav>
        </div>
    </header>