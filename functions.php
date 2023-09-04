<?php 


/* POST SUB CATEGORY FUNCTION */

add_shortcode( 'list_subcats', function() {
    ob_start();
    
    $current_cat = get_queried_object();
    $term_id = $current_cat->term_id;

    $categories = get_categories( array( 
        'parent' => $term_id,
        'hide_empty' => false,
    ) );

    echo '<ul class="list-subcats">';

    foreach ( $categories as $category ) {
    echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . $category->name . '</a></li>';
    }

    echo '</ul>';

    return ob_get_clean();
} );


/*ANOTHER POST SUB CATEGORY FUNCTION */

add_shortcode( 'list_subcats', function() {
    ob_start();
    
    $current_cat = get_queried_object();
    $term_id = $current_cat->term_id;
    $taxonomy_name = 'category';
    $term_children = get_term_children( $term_id, $taxonomy_name );

    echo '<ul class="list-subcats">';

    foreach ( $term_children as $child ) {
    $term = get_term_by( 'id', $child, $taxonomy_name );
    echo '<li><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>';
    }

    echo '</ul>';

    return ob_get_clean();
} );



/*ANOTHER POST SUB CATEGORY FUNCTION */

add_shortcode( 'list_subcats', function( $atts ) {
    $atts = shortcode_atts(
        array(
            'id' => '',
    ), $atts, 'list_subcats' );

    ob_start();
    
    $term_id = $atts['id'];
    $taxonomy_name = 'category';
    $term_children = get_term_children( $term_id, $taxonomy_name );

    echo '<ul class="list-subcats">';

    foreach ( $term_children as $child ) {
    $term = get_term_by( 'id', $child, $taxonomy_name );
    echo '<li><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>';
    }

    echo '</ul>';

    return ob_get_clean();
} );



/*ANOTHER POST SUB CATEGORY FUNCTION */

function display_subcategories( $atts ) {

    $atts = shortcode_atts( array(
        'category' => null
    ), $atts );

    $parent_cat_slug = get_category_by_slug( $atts['category'] );
    $parent_cat_ID = $parent_cat_slug->term_id;

    $args = array(
        'hierarchical' => 1,
        'hide_empty' => 0,
        'parent' => $parent_cat_ID,
        'taxonomy' => 'category'
    );
    $subcats = get_categories($args);
    ob_start();
    echo '<ul class="sub-categories">';
    foreach ($subcats as $subcat) {
        $link = get_term_link( $subcat->slug, $subcat->taxonomy );
        echo '<li><a href="' . $link . '">' . $subcat->name . '</a></li>';
    }
    echo '</ul>';

    return ob_get_clean();
}
add_shortcode( 'subcategory', 'display_subcategories' );