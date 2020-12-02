
<?php 

 // First Add this code in function.php

 //first steps add post type in dashbord
if(function_exists('register_post_type')) {
    register_post_type('videonews', array(
        'labels' => array(
            'name' => __('Add Video', 'news'),
            'menu_name' => __('Video Gallery', 'news'),
            'add_new' => __('Add Video', 'news'),
            'add_new_item' => __('Add Video', 'news'),
        ),
        'public' => true,
        'menu_icon' => 'dashicons-youtube',
        'supports' => array('title','editor', 'thumbnail')
       ));
    }

    //hook into the init action and call create_videonews_category_option when it fires
    add_action( 'init', 'create_videonews_category_option');

    function create_videonews_category_option() {
    
    $labels = array(
        'name' => ( 'VideoNews'),
        'singular_name' => ( 'VideoNews' ),
        'search_items' =>  __( 'Search VideoCategory' ),
        'all_items' => __( 'All VideoCategory' ),
        'parent_item' => __( 'Parent Subject' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Subject' ), 
        'update_item' => __( 'Update Video Category' ),
        'add_new_item' => __( 'Add New Video Category' ),
        'new_item_name' => __( 'New Subject Name' ),
        'menu_name' => __( 'Video Category' )
    );  
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'videonews' )
    );
    
    // Now register the taxonomy
    register_taxonomy('videonews', array('videonews'), $args);
    
    }


    // After adding this file in function.php
    // Call this code in where you would like to show your custom texonomy
    $the_query = new WP_Query( array(
        'post_type' => 'videonews',
        'tax_query' => array(
            array (
                'taxonomy' => 'videonews',
                'field' => 'slug',
                'terms' => 'lead-news',
            )
        ),
    ) );
    
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
    
    ?>

    <div class="Featued_video">

        <div class="VideoFeatureImg">
            <a href="#"><img class="VideoFeatureImg_svg" src=" <?php echo get_template_directory_uri(); ?>/img/videoPreview.svg" alt=""></a>
        </div>

        <?php the_post_thumbnail(); ?>
        <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
    </div>

    <?php } 

    wp_reset_query();

?>
