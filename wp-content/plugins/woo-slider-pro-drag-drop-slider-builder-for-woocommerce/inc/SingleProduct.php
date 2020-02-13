<?php
/**
 * Created by PhpStorm.
 * User: myn
 * Date: 9/27/18
 * Time: 3:27 PM
 */

namespace BinaryCarpenter\BC_SD;

require_once ABSPATH . 'wp-admin/includes/admin.php';
global $wishlists;
class SingleProduct
{


    private $productID;
    private $product, $productType;

    function __construct($productID)
    {
        $this->productID = $productID;
        $this->product = wc_get_product($productID);
        $terms = get_the_terms($this->product->get_id(), 'product_type');
        $this->productType = (!empty($terms)) ? sanitize_title(current($terms)->name) : 'simple';

    }


    /**
     * @param $skeletonString: String that contain the layout of the slider, available in "mostly" HTML format with <div class="col-sm-x">[[product_title]]</div>
     * All elements inside double brackets will be replaced by actual HTML code parsed by the function below
     * @return string html content of a single product
     */
    public function generateHTML($skeletonString)
    {
        $content = '';

        if (!is_object($this->product))
        {
            return $content;
        }

        $content .= '<div class="woo-slider-pro-single-product">';



        //get all the [[code from the layout string]]
        preg_match_all('/\[\[(.*?)\]\]/', $skeletonString, $matches);

        $parsedContent = $skeletonString;
        for ($i = 0; $i < count($matches[0]); $i++)
        {
            $parsedContent = str_replace($matches[0][$i], $this->getElementContent($matches[0][$i]), $parsedContent);
        }

        return $content. $parsedContent .'</div>';


    }


    private function getStarRating($score)
    {
        $score = floatval($score);
        $whole = floor($score);
        $fract = $score - $whole;
        $empty = 5 - ceil($score);

        $content = '';

        for ($i = 0; $i < $whole; $i++)
        {
            $content.= '<i class="wsp-icon-star"></i>';
        }
        if ($fract == 0.5)
            $content.= '<i class="wsp-icon-star-half"></i>';
        else if ($fract > 0.5)
            $content.= '<i class="wsp-icon-star"></i>';
        else if ($fract > 0 && $fract < 0.5)
        {
            $content.= '<i class="wsp-icon-star-empty"></i>';
        }


        for ($i = 0; $i < $empty; $i++)
        {
            $content.= '<i class="wsp-icon-star-empty"></i>';
        }

        return '<div style="display: flex;">'.$content . '</div>';
    }


    private function getElementContent($elementName)
    {
        switch ($elementName)
        {
            case '[[title]]':
                $content = '<div class="woo-slider-pro-title"><a href="'.$this->product->get_permalink().'">'.$this->product->get_title() .'</a></div>';
                break;

            case '[[sale_price]]':
                $content = '<div class="woo-slider-pro-sale-price">' .wc_price($this->product->get_sale_price()) .'</div>';
                break;

            case '[[regular_price]]':
                $content = '<div class="woo-slider-pro-regular-price">'.wc_price($this->product->get_regular_price()).'</div>';
                break;

            case '[[short_description]]':
                $content = '<div class="woo-slider-pro-short-description">'.$this->product->get_short_description() .'</div>';
                break;

            case '[[stock_status]]':
                $content = '<div class="woo-slider-pro-stock-status">'.$this->product->get_stock_status() .'</div>';
                break;

            case '[[dimensions]]':
                $content = '<div class="woo-slider-pro-dimensions">'. \wc_format_dimensions($this->product->get_dimensions(false)) .'</div>';
                break;

            case '[[sku]]':
                $content = '<div class="woo-slider-pro-sku">'. $this->product->get_sku() .'</div>';
                break;

            case '[[weight]]':
                $content = '<div class="woo-slider-pro-weight">'. \wc_format_weight($this->product->get_weight()) .'</div>';
                break;

            case '[[category]]':
                $categories = $this->product->get_category_ids();
                $cat_names = array();
                foreach ($categories as $id)
                {
                    if( $term = get_term_by( 'id', $id, 'product_cat' ) ){
                        $cat_names[]=  '<span class="woo-slider-pro-single-category">' . $term->name . '</span>';
                    }
                }

                $content = '<div class="woo-slider-pro-categories">'. (implode(" ", $cat_names)) .'</div>';
                break;

            case '[[add_to_wishlist_button]]':
                if (shortcode_exists('yith_wcwl_add_to_wishlist'))
//                    $content = do_shortcode('[yith_wcwl_add_to_wishlist product_id='.$this->productID.']');
                    $content = '<button class="woo-slider-pro-yith-wishlist-button" data-url="'.esc_url( add_query_arg( 'add_to_wishlist', $this->productID ) ).'"><i class="fa fa-heart"></i> </button>';
//                    $content = YITH_WCWL()->get_wishlist_url('view/');
                else
                    $content = 'Please enable YITH wishlist plugin';
                break;
            case '[[star_rating]]':
                $content = '<div class="woo-slider-pro-rating">'. $this->getStarRating($this->product->get_average_rating()) .' ('.$this->product->get_rating_count().')</div>';
//                $content = '<div class="woo-slider-pro-rating">'.\wc_get_star_rating_html($this->product->get_average_rating(), array_sum($this->product->get_rating_counts())).'</div>';
//                $content = '<div class="woo-slider-pro-rating">'.\wp_star_rating(array(
//                    'rating' => $this->product->get_average_rating(),
//                    'type' => 'rating',
//                    'number' => array_sum($this->product->get_rating_counts()),
//                    'echo' => false
//                )). '</div>';
                break;

            case '[[product_image]]':
                $content = '<img class="woo-slider-pro-product-image" src="'.wp_get_attachment_url( get_post_thumbnail_id( $this->productID )) . '">';
                break;

            case '[[add_to_cart_button]]':
                $data = do_shortcode('[add_to_cart show_price="FALSE" style="" id="'.$this->productID.'"]');
                // need to add wsp-add-to-cart-text class to the text because we need to hide this text later when user clicking on the add to cart button. A check mark will be added and made visible
                $content = '<div class="woo-slider-pro-add-to-cart-button"> '.$data.'</div>';
                break;
            default:
                $content = '';
                break;
        }

        return trim($content);
    }

}