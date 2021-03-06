<?php
/*
Plugin Name: Custom Stiles Machinery Shorcodes
Plugin URI: https://devitm.com
Description: Customize WordPress with powerful, professional and intuitive fields.
Version: 1.0.2
Author: Marco Aspeitia
Author URI: https://www.devitm.com
Text Domain: sm-product-tables
*/


if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Custom Shortcode of machinery product table compatible with ACF and ACF Table Field
 */
if( ! function_exists('sm_product_tables') ) :

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
                <?php
                    /**
                     * Agregar clase first-body-row mediante operador ternario
                     */
                    $first_body_row = true;
                    foreach($table['body'] as $tr):
                ?>
                <tr <?php echo $first_body_row ? 'class="first-body-row"' : '';?>>
                    <?php
                        /**
                        * Agregar clase first-body-column mediante operador ternario
                        */
                        $first_body_column = true;
                        foreach($tr as $td):
                    ?>
                    <td <?php echo $first_body_column ? 'class="first-body-column"' : '';?>><?php echo $td['c']; ?></td>
                    <?php
                        $first_body_column = false;
                        endforeach;
                        /**
                        * Fin de columnas del cuerpo de la tabla
                        */
                    ?>
                </tr>
                <?php
                    $first_body_row = false;
                    endforeach;
                    /**
                    * Fin de filas del cuerpo de la tabla
                    */
                ?>
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

endif; // function_exists('sm_product_tables)

/**
 * Custom Shortcode of machinery gallery slider compatible with slick slider and CMB2 custom fields
 */
if( ! function_exists('sm_product_gallery') ) :

    function sm_product_gallery(){

        // begin output buffering
        ob_start();

        //printf ('<pre>%s</pre>', var_export(get_post_custom( get_the_ID()), true) );
        $machinery_gallery = get_post_meta(get_the_ID(), 'machinery_product_galeria_imagenes' , true);

        if (!empty($machinery_gallery)){
            /**
             * First Slider for machinery images
             */
            echo '<ul class="machinery-gallery">';
                foreach($machinery_gallery as $id => $image){
                    echo '<li class="image-slide">';
                        echo wp_get_attachment_image( $id, 'full', false, ["class" => "img-fluid"]);
                    echo '</li>';
                }
            echo '</ul>';

            /**
             * Second Slider for machinery caption
             */
            echo '<ul class="machinery-caption">';
                foreach($machinery_gallery as $id => $image){
                    $image_alt = get_post_meta( $id, '_wp_attachment_image_alt', true);
                    echo '<li class="image-caption">';
                        echo $image_alt;
                    echo '</li>';
                }
            echo '</ul>';
        }

        // end output buffering, grab the buffer contents, and empty the buffer
        return ob_get_clean();

    }
    add_shortcode( 'sm_product_gallery_shortcode', 'sm_product_gallery', 10 );
    /* To implement de shortcode please write the next code [sm_product_gallery_shortcode] in a DIVI code module */

endif; //function_exists('sm_product_gallery')