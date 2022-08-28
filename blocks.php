<?php

// Create blocks here
new PHPBlock( "header" );

class JSXBlock {

    function __construct( $name, $use_render_callback = true, $data = null ) {
        $this->block_namespace = "new-beginnings";
        
        $this->name = $name;
        $this->use_render_callback = $use_render_callback;
        $this->data = $data;

        add_action( 'init', array( $this, 'init_block' ) );
    }

    function init_block() {

        $prefix = "{$this->block_namespace}-{$this->name}";

        wp_register_style( $prefix ."-style", get_theme_file_uri( "build/{$this->name}.css" ) );

        wp_register_script( $prefix . "-editor-script", get_theme_file_uri( "build/{$this->name}.js" ), array( 'wp-blocks', 'wp-editor' ) );

        wp_register_script( $prefix . "-view-script", get_theme_file_uri( "blocks/{$this->name}/build/frontend.js" ) );

        if ( $this->data ) {
            wp_localize_script( $prefix . "-editor-script", $this->name, $this->data );
        }

        $args = array(
            "editor_script" => $prefix . "-editor-script",
            'view_script'   => $prefix . "-view-script",
            'editor_style'  => $prefix . "-style",
            'style'         => $prefix . "-style",
        );

        if ( $this->use_render_callback ) {
            $args['render_callback'] = array( $this, 'render_block' );
            //Must manually enqueue view script since render_callback is being used
            if ( ! is_admin() ) {
                wp_enqueue_script( $prefix . "-view-script", '', array(), false, true );
            }
        }

        register_block_type_from_metadata( __DIR__ . "/blocks/{$this->name}", $args );

    }

    function render_block( $attributes, $content ) {
        ob_start();
        require get_theme_file_path( "blocks/{$this->name}/render.php" );
        return ob_get_clean();
    }
}



class PHPBlock {

    function __construct( $name ) {
        $this->block_namespace = "new-beginnings";
        
        $this->name = $name;

        add_action( 'init', array( $this, 'init_block' ) );
    }

    function init_block() {

        $prefix = "{$this->block_namespace}-{$this->name}";

        wp_register_style( $prefix . "-style", get_theme_file_uri( "blocks/{$this->name}/build/index.css" ) );
        
        wp_register_script( $prefix . "-editor-script", get_theme_file_uri( "blocks/{$this->name}/build/index.js" ), array( 'wp-blocks', 'wp-editor', 'wp-server-side-render' ) );

        wp_register_script( $prefix . "-view-script", get_theme_file_uri( "blocks/{$this->name}/build/frontend.js" ), array( 'wp-blocks', 'wp-editor', 'wp-server-side-render' ) );

        //Must manually enqueue view script since render_callback is being used
        if ( ! is_admin() ) {
            wp_enqueue_script( $prefix . "-view-script", '', array(), false, true );
        }

        register_block_type_from_metadata( __DIR__ . "/blocks/{$this->name}", array( 
            'editor_script'     => $prefix . "-editor-script",
            'view_script'       => $prefix . "-view-script",
            'editor_style'      => $prefix . "-style",
            'style'             => $prefix . "-style",
            'render_callback'   => array( $this, 'render_block' ),
         ) );

    }


    function render_block( $attributes, $content ) {
        ob_start();
        require get_theme_file_path( "blocks/{$this->name}/render.php" );
        return ob_get_clean();
    }
}