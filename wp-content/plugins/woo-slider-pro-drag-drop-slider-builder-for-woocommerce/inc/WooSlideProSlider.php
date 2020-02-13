<?php
/**
 * Created by PhpStorm.
 * User: myn
 * Date: 9/27/18
 * Time: 4:52 PM
 */

namespace inc;


class WooSlideProSlider
{
    private $id;
    const POST_TYPE_NAME = "woo_slide_pro_post";
    const OPTION_META = "woo_slide_pro_options_meta";
    const SLIDER_FULL_HTML_META = "woo_slide_pro_full_html_meta";
    const SLIDER_CSS_ID = "woo_slide_pro_css_id";

    //the html contain the elements and their order. it will be parsed and stored to slider full meta
    const SKELETON_META = "woo_slide_pro_layout_meta";


    const PRODUCT_LIST = "list_of_products_meta";


    function __construct($id)
    {
        $this->id = $id;
    }




    /**
     * @return object
     */
    public function getOptions()
    {
        return json_decode($this->getOptionsString());
    }


    public function getPost()
    {
        return get_post($this->id);
    }


    /**
     * get the options meta to pass to the editor when edit the slider
     * @return string
     */
    public function getOptionsString()
    {
        return get_post_meta($this->id, self::OPTION_META, true);
    }


    public function getCSSID()
    {
        return get_post_meta($this->id, self::SLIDER_CSS_ID, true);
    }

    /**
     * get the layout meta to pass to the editor when edit the slider
     * @return string
     */
    public function getSkeletonString()
    {
        return rawurldecode(get_post_meta($this->id, self::SKELETON_META, true));
    }


    /**
     * Create the slider post type. This along with its meta values will determine how the slider
     * will be shown to users
     */
    public static function createPostType()
    {

        if (post_type_exists(self::POST_TYPE_NAME))
            return;

        register_post_type(self::POST_TYPE_NAME, array(
            'public' => false,
            'label' => 'Slider',
            'publicly_queryable' => false,
            'show_in_nav_menus' => false,
            'show_in_menu' => false,
            'show_ui' => false,
            'show_in_admin_bar' => false,
            'capability_type' => 'post',
            'exclude_from_search' => true
        ));
    }

    /**
     * Get ID of all products and stored in an array
     */
    public function getProductIDs()
    {
        $options = $this->getOptions();
        /**
         * $options = array(
         *  'product_source' => 'category',
         *  'source_list' => array('shoes', 'wallet'),
         *  'num_visible' => 3,
         *  'slider_delay' => 3000,
         *  '
         * );
//         */
//
        $productsIDs = array();


        if($options->product_source == 'category')
        {

            $categories = $options->source_lists;

            foreach ($categories as $cat)
            {

                $args = array(
                    'post_type'             => 'product',
                    'post_status'           => 'publish',
                    'posts_per_page'        => -1,
                    'tax_query'             => array(
                        array(
                            'taxonomy'      => 'product_cat',
                            'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                            'terms'         => $cat,
                            'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                        )
                    )
                );
                $query = new \WP_Query($args);
                $products = $query->get_posts();

//                var_dump($products);

                foreach ($products as $product)
                {
                    $productsIDs[] = $product->ID;
                }
            }



        }


        return $productsIDs;
    }

    public function generateHTML()
    {
        $skeletonString = $this->getSkeletonString();
        $optionsObject = $this->getOptions();

        $cssID = $this->getCSSID();
        $presetClass = isset($optionsObject->preset_class) ? $optionsObject->preset_class : 'woo-slider-pro-preset-1' ;



        $output = '<div class="owl-carousel '.$presetClass.' woo-slider-pro-slider" id="'.$cssID.'">';
            foreach($this->getProductIDs() as $productID)
            {
                $product = new WooSlideProSingleProduct($productID);
                $output.= $product->generateHTML($skeletonString);
            }
        $output .='</div>';

        $customStyle = "<style>".rawurldecode($optionsObject->slider_custom_css)."</style>";

        $owlResponsive = '{ 0: {items: '.$optionsObject->responsive->mobile.' } , 736: {items: '.$optionsObject->responsive->tablet.' } , 980: {items: '.$optionsObject->responsive->desktop.'} }';

        //prepare owl carousel
        $owlOptions = "{ loop: ".$optionsObject->slider_loop.", nav: ".$optionsObject->show_nav_button.", dots: ".$optionsObject->show_dots.", autoplay: ".$optionsObject->autoplay." ,  responsive: ".$owlResponsive."  }";

        $sliderScript = '<script>jQuery(function(){   jQuery("#'.$cssID.'").owlCarousel('.$owlOptions.');  });</script>';
        return $customStyle. $output . $sliderScript;
    }
    /**
     * this method is a quicker way to get the parsed HTML code that stored in a meta value
     */
    public function getParsedHTML()
    {
        return get_post_meta($this->id, self::SLIDER_FULL_HTML_META, true);
    }



    public function saveSlider($sliderID, $cssID, $sliderTitle, $skeletonString, $optionString, $content)
    {
        //generate HTML here and store to a meta tag


        $args = array(
            'ID' => $sliderID,
            'post_title' => $sliderTitle,
            'post_content' => $content,
            'post_type' => self::POST_TYPE_NAME,
            'meta_input' => array(
                self::OPTION_META => $optionString,
                self::SKELETON_META => $skeletonString,
                self::SLIDER_CSS_ID => $cssID
            )
        );

        if ($sliderID == 0)
        {
            $this->id = wp_insert_post($args);
        } else
        {
            wp_update_post($args);
        }

        $fullHTML = rawurlencode($this->generateHTML());
        update_post_meta($this->id, self::SLIDER_FULL_HTML_META, $fullHTML);
        return $this->id;


    }

    public static function getAllSliders()
    {
        $currentUser = wp_get_current_user();
        $sliders = new \WP_Query(array(
            'post_type' => self::POST_TYPE_NAME,
            'post_author' => $currentUser->ID
        ));

        return $sliders->posts;
    }


}