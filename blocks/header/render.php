<?php
// render( $attributes, $content ){ ->
require_once __DIR__ . '/header_helper.php';
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
            <?php
            nav_menu( get_selected_menu( $attributes ) );
            ?>
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
<?php
require __DIR__ . '/mobile_nav.php';


function menu_item( $url, $slug, $sub_items = null ) {
    return array(
        'url'       => $url,
        'slug'      => $slug,
        'sub_items' => $sub_items    
    );
}


function nav_menu( $menu_id ) {
    $items = get_menu_data( $menu_id ); 

    ?>
    <div class="header__nav-buttons">
        <?php
        if( ! empty($items) ) {
            $count = 1; 
            $last = false;
            foreach ( $items as $name => $data ) {
                if ( $count == count($items) ) {
                    $last = true;
                } 
                if ( $data['sub_items'] ) {
                    menu_item_dropdown_HTML( $name, $data, $last );
                } else {
                menu_item_normal_HTML( $name, $data, $last ); 
                }
                $count++;
            }
        }

        ?>
    </div>
    <?php
}

function menu_item_normal_HTML( $name, $data, $last = false ) {
    $button_classes = 'header__button header__button-' . $data['slug'];
    $permalink = $data['url'];

    if ( $last ) {
        $button_classes .= " header__button--last";
    }

    // TODO: UNUSED FOR NOW: Simple check for active page, probably will need more complex check for checking if current page is child of navigation link
    global $wp;
    $current_url = home_url( $wp->request . "/");
    if ( $permalink == $current_url ) {
       // $button_classes .= ' header__button--active';
    }

    ?>

    <a class="<?php echo $button_classes; ?>" href="<?php echo $permalink; ?>">
        <span class="header__button-text"><?php echo $name; ?></span>
    </a>
    
    <?php
}


function menu_item_dropdown_HTML( $name, $data, $last = false ) {
    $button_classes = 'header__button header__button-' . $data['slug'] . ' header__button--dropdown';
    $dropdown_classes = 'header__dropdown-buttons header__dropdown-buttons--' . $data['slug'];
    $permalink = $data['url'];

    if ( $last ) {
        $button_classes .= " header__button--last";
    }

    ?>

    <div class="header__dropdown-container">
        <a class="<?php echo $button_classes; ?>" href="<?php echo $permalink ?>">
            <span class="header__button-text"><?php echo $name; ?></span>
            <i class="bi bi-caret-down-fill"></i>
        </a>
        <div class="<?php echo $dropdown_classes; ?>">
            <div class="header__dropdown-background">
                <?php

                foreach ( $data['sub_items'] as $name => $data ) {
                    menu_item_normal_HTML( $name, $data );
                }

                ?> 
            </div>
        </div>
    </div>
    <?php
}