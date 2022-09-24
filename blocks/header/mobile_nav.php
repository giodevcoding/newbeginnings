<?php 
require_once __DIR__ . '/header_helper.php';
?>

<div class="nav-mobile-menu-wrapper">
    <div class="nav-mobile-menu nav-mobile-menu--hide">
        
        <?php 
        mobile_nav_menu( get_selected_menu( $attributes ) );
        ?>

    </div>
</div>

<?php

function mobile_nav_menu( $menu_id ) {
    $items = get_menu_data( $menu_id );
    $sub_menus = array();
    ?>

    <div class="nav-mobile-menu__main-menu nav-mobile-menu__menu-page">
        <div class="nav-mobile-menu__nav-buttons">
            
            <?php
            foreach ( $items as $name => $data ) {
                if ( $data['sub_items'] ) {
                    $sub_menus[$data['slug']] = $data['sub_items'];
                    ?>
                    
                    <button 
                      class="nav-mobile-menu__button nav-mobile-menu__button--folder" 
                      data-folder-name="<?php echo $data['slug']; ?>">

                        <?php echo $name; ?>
                        <i class="bi bi-chevron-double-right"></i>
                    
                    </button>
                    
                    <?php
                } else {
                    ?>
    
                    <a class="nav-mobile-menu__button" href="<?php echo $data['url']; ?>"> <?php echo $name; ?></a>
                    
                    <?php
                }
            } 
            ?>

        </div>
    </div>

    <?php
    foreach ($sub_menus as $slug => $sub_items) {
        ?>

        <div class="nav-mobile-menu__sub-menu nav-mobile-menu__menu-page" data-folder-name="<?php echo $slug; ?>">
            <button class="nav-mobile-menu__button nav-mobile-menu__button--close"><i class="bi bi-chevron-double-left"></i>Back</button>
            <div class="nav-mobile-menu__nav-buttons">
        
                <?php
                foreach ($sub_items as $name => $data) {
                    ?>
                
                    <a class="nav-mobile-menu__button" href="<?php echo $data['url']; ?>"><?php echo $name; ?></a>
                    
                    <?php
                }
                ?>

            </div>
        </div>
 
        <?php
    }
}