<?php
function get_menu_data( $menu_id ) {
    $menu_data = wp_get_nav_menu_items( $menu_id );

    $preprocessed_data = array();

    foreach ( $menu_data as $item ){
        $item_id = $item->ID;
        $item_name = $item->title;
        $item_slug = $item->post_name;
        $item_url = $item->url;

        $is_top_level = $item->menu_item_parent == '0';

        if ( $is_top_level ) {
            $preprocessed_data[$item_id] = array( "name" => $item_name, "url" => $item_url, "slug" => $item_slug, "sub_items" => array() );
        } else {
            $parent_id = intval( $item->menu_item_parent );
            $preprocessed_data[$parent_id]["sub_items"][$item_name] = menu_item( $item_url, $item_slug );
        }
    }

    $processed_data = array();

    foreach ( $preprocessed_data as $item ) {
        $processed_data[$item['name']] = array('url' => $item['url'], 'slug' => $item['slug'], 'sub_items' => $item['sub_items']);
    }

    return $processed_data;
}


function get_selected_menu( $attributes ) {
    if ( $attributes && $attributes['selectedMenu'] ) {
        return intval( $attributes['selectedMenu'] );
    } else if( wp_get_nav_menus()[0] ) {
        return wp_get_nav_menus()[0]->term_id;
    } else {
        return array('' => '');
    }
}