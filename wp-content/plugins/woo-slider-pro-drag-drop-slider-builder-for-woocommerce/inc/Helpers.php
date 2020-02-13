<?php
/**
 * Created by PhpStorm.
 * User: MYN
 * Date: 4/12/2019
 * Time: 7:22 AM
 */

namespace BinaryCarpenter\BC_SD;

class Helpers
{
    public static function getAllCategories()
    {

        $category_data = [];
        $taxonomy     = 'product_cat';
        $orderby      = 'name';
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no
        $title        = '';
        $empty        = 0;

        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );
        foreach ($all_categories as $cat) {
            {
                $category_data[] = array(
                    'ID' => $cat->term_id,
                    'name' => $cat->name
                );
            }
        }

        return $category_data;
    }
    public static function getAllProductTags()
    {

        $category_data = [];
        $taxonomy     = 'product_tag';
        $orderby      = 'name';
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no
        $title        = '';
        $empty        = 0;

        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );
        foreach ($all_categories as $cat) {
            {
                $category_data[] = array(
                    'ID' => $cat->term_id,
                    'name' => $cat->name
                );
            }
        }

        return $category_data;
    }

}