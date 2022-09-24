<?php

class GDBlock {

    function __construct( $block_namespace, $name, $use_render_callback = true, $data = null ) {
        $this->block_namespace = $block_namespace;
        $this->name = $name;
        $this->use_render_callback = $use_render_callback;
        $this->data = $data;

        add_action( 'init', array( $this, 'init_block' ) );
    }

    function init_block() {

        $prefix = "{$this->block_namespace}-{$this->name}";

        wp_enqueue_script( 'wp-api' );

        wp_register_script( $prefix . "-view-script", get_theme_file_uri( "blocks/{$this->name}/build/view.js" ) );

        if ( ! is_admin() ) {
            wp_enqueue_script( $prefix . "-view-script", '', array(), false, true );
        }

        if ( $this->data ) {
            add_action( 'wp_enqueue_scripts', array( $this, 'localize_data'), PHP_INT_MAX );
            add_action( 'admin_enqueue_scripts', array( $this, 'localize_data'), PHP_INT_MAX );
        }

        $args = array();

        if ( $this->use_render_callback ) {
            //Must manually enqueue view script since render_callback is being used
            $args['render_callback'] = array( $this, 'render_block' );
        }

        register_block_type_from_metadata( get_theme_file_path( "blocks/{$this->name}" ), $args );

    }


    function localize_data() {
        $namespace_name = javascriptify_variable_name( $this->block_namespace );
        $var_name = javascriptify_variable_name( $this->name );

        $create_namespace = "var {$namespace_name} = {$namespace_name} || {};";
        $create_var = "{$namespace_name}.{$var_name} = " . json_encode( $this->data ) . ";";

        $js = $create_namespace . $create_var;

        wp_add_inline_script( "{$this->block_namespace}-{$this->name}-editor-script", $js);
        wp_add_inline_script( "{$this->block_namespace}-{$this->name}-view-script", $js );
    }


    function render_block( $attributes, $content ) {
        ob_start();
        require get_theme_file_path( "blocks/{$this->name}/render.php" );
        return ob_get_clean();
    }
}


function javascriptify_variable_name( $var_name ) {
    $length = strlen($var_name);
    $capitalize = FALSE;
    $answer = "";

    for ( $i = 0; $i < $length; $i++ ) {
        if ( $var_name[$i] == '-' || $var_name[$i] == '_'){
            $capitalize = TRUE;
            continue;
        }

        $new_char = $var_name[$i];

        if ( $capitalize ) {
            $new_char = strtoupper( $new_char );
            $capitalize = FALSE;
        }

        $answer .= $new_char;
    }

    return $answer;
}