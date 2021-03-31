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


/* Enqueue Styles and Scripts */
function sm_product_machinery_plugin(){
    $dir = plugin_dir_path( __FILE__ );
    wp_enqueue_style('bxSlider-style', $dir = plugin_dir_path( __FILE__ ) . 'css/jquery.bxslider.min.css', array(), '4.2.12');
    wp_enqueue_script('bxSlider', $dir = plugin_dir_path( __FILE__ ) . 'js/jquery.bxslider.min.js', array('jquery'), '4.2.12', true);
    wp_enqueue_script('sm-product-machinery-plugin', $dir = plugin_dir_path( __FILE__ ) . 'js/scripts.js', array('bxSlider'), '1.0.0', true);
}
add_action( 'wp_enqueue_scripts', 'sm_product_machinery_plugin' );

if( ! function_exists('sm_product_tables') ) :
    /* To implement de shortcode please write the next code [sm_product_tables_shortcode] in a DIVI code module */
    function sm_product_tables(){
        // begin output buffering
        ob_start();
        $table = get_field('tabla_de_especificaciones'); 
        if($table){
        ?>
        <table class="machinery-table">
            <thead>
                <tr>
                    <?php foreach($table['header'] as $th): ?>

                    <th><?php echo $th['c']; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($table['body'] as $tr): ?>
                <tr>
                    <?php foreach($tr as $td): ?>
                    <td><?php echo $td['c']; ?></td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        }
        else{
            echo 'no hay contenido en la tabla de espeficicaciones de la maquinaria';
        }
        // end output buffering, grab the buffer contents, and empty the buffer
        return ob_get_clean();
    }
    add_shortcode( 'sm_product_tables_shortcode', 'sm_product_tables', 10 );
    /* To implement de shortcode please write the next code [sm_product_tables_shortcode] in a DIVI code module */
endif;

if( ! function_exists('sm_product_gallery') ) :

    function sm_product_gallery(){
        // begin output buffering
        ob_start();
        //printf ('<pre>%s</pre>', var_export(get_post_custom( get_the_ID()), true) );
        $machinery_gallery = get_post_meta(get_the_ID(), 'machinery_product_galeria_imagenes' , true);
        echo '<ul class="machinery-gallery">';
            foreach($machinery_gallery as $id => $image){
                echo '<li>';
                    echo wp_get_attachment_image( $id, 'full', false, ["class" => "img-fluid"] );
                echo '</li>';
            }
        echo '</ul>';
        // end output buffering, grab the buffer contents, and empty the buffer
        return ob_get_clean();
    }
    add_shortcode( 'sm_product_gallery_shortcode', 'sm_product_gallery', 10 );
    /* To implement de shortcode please write the next code [sm_product_gallery_shortcode] in a DIVI code module */

endif;