<?php
// render( $attributes, $content ){ ->
?>
<div class="header">
    <div class=".header__col header__col--left"></div>
    <div class="header__col header__col--center">
        <div class="header__logo">
            <img src="<?php echo get_theme_file_uri( "assets/logo.png" )?>" alt="">
        </div>
    </div>

    <div class="header__col header__col--right">

        <nav class="header__nav">
            <ul class="header__nav-buttons">
                <a href="#"><li>Home</li></a>
                <a href="#">
                    <li class="header__nav-buttons__dropdown">
                        <span>About</span> 
                        <i class="bi bi-caret-down-fill"></i>
                    </li>
                </a>
                <a href="#"><li>Events</li></a>
                <a href="#"><li>Watch</li></a>
                <a href="#"><li>Give</li></a>
                <a href="#">
                    <li class="header__nav-buttons__dropdown header__nav-buttons__connect">
                        <span>Connect</span>
                        <i class="bi bi-caret-down-fill"></i>
                    </li>
                </a>
            </ul>
        </nav>

        <div class="header__nav-hamburger--wrapper">
            <a href="javascript:void(0)">
                <div class="header__nav-hamburger">
                    <span class="header__nav-hamburger__bar bi bi-dash-lg"></span>
                    <span class="header__nav-hamburger__bar bi bi-dash-lg"></span>
                    <span class="header__nav-hamburger__bar bi bi-dash-lg"></span>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="nav-mobile-menu nav-mobile-menu--hide">
    <ul class="nav-mobile-menu__nav-buttons">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Events</a></li>
        <li><a href="#">Watch</a></li>
        <li><a href="#">Give</a></li>
        <li><a href="#">Connect</a></li>
    </ul>
</div>


