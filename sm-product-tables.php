<?php
/*
Plugin Name: Stiles Machinery Product Tables
Plugin URI: https://devitm.com
Description: Customize WordPress with powerful, professional and intuitive fields.
Version: 1.0.0
Author: Marco Aspeitia
Author URI: https://www.devitm.com
Text Domain: sm-product-tables
*/


if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! function_exists('sm_product_tables') ) :

    /* To implement de shortcode please write the next code [sm_product_tables_shortcode] in a DIVI code module */
    function sm_product_tables(){
        echo '<pre>';
        var_dump(get_field('tabla_de_especificaciones'));
        echo '<pre>';
        echo 'Hola desde el shortcode';
    }
    add_shortcode( 'sm_product_tables_shortcode', 'sm_product_tables', 10 );
endif;