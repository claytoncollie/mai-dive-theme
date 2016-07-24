<?php
/**
 * Template Name: Page - Builder
 *
 * @package Mai Dive Child Theme
 * @author Clayton Collie
 * @since 2.0.0
*/

add_action( 'genesis_meta', 'maidive_page_builder_genesis_meta' );
function maidive_page_builder_genesis_meta() {
	
    //* Add custom body class to the head
    add_filter( 'body_class', 'maidive_builder_add_body_class' );
    function maidive_builder_add_body_class( $classes ) {
       $classes[] = ' maidive-builder';
       return $classes;
    }

    //* Enqueue Scripts
	remove_action( 'wp_enqueue_scripts', 'maidive_load_video_scripts' );

	// Load scripts for all pages	
	add_action( 'wp_enqueue_scripts', 'maidive_load_builder_scripts' );
	function maidive_load_builder_scripts() {
        wp_enqueue_script( 'bigvideo-builder-init', get_stylesheet_directory_uri() . '/js/bigvideo-builder-init.js', array( 'maidive-global-js' ), '1.0.0', true );
	}

	// Remove 'site-inner' from structural wrap
	//add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets', 'footer' ) );

	//* Force full-width-content layout
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Remove all default page information
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

    // Remove watch video button
    remove_action('genesis_after','maidive_watch_video');

    // Remove mobile toolbar
    remove_action('genesis_after','maidive_mobile_toolbar');

	// Add new loop
	add_action('genesis_loop', 'maidive_builder_loop');

}

function maidive_builder_loop() {

    global $post;

	$post_type_slug = get_the_content();

	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

    $items = new WP_Query( array(
        'posts_per_page' => -1,
        'post_type'      => $post_type_slug,
        'paged'          => $paged,
        'order'			 => 'ASC',
        'orderby'		 => 'date',
    ) );

    if( $items->have_posts() ) {
        while( $items->have_posts() ) {
            $items->the_post();
            $formats = get_the_terms( get_the_ID(), 'format' );
				
        	if( has_term('full-screen-hero-with-video', 'format') ) {
                wp_localize_script( 'bigvideo-builder-init', 'BigVideoLocalizeMp4', get_field('maidive_video_url_mp4' ) );

                echo '<article class="'.join( ' ', get_post_class() ).'" itemscope="itemscope" itemtype="http://schema.org/Hotel">';
					echo '<div class="container">';
                		echo '<header class="entry-header">';
                            echo '<h1 class="entry-title" itemprop="name">'.get_the_title($post->ID).'</h1>';
                        echo '</header>';
                		echo '<div class="entry-content" itemprop="description">';
                            echo the_content();
                        echo '</div>';
                    echo '</div>';
                echo '</article>';
        	}

        	if( has_term('full-screen-hero-with-image', 'format') && has_post_thumbnail() ) {
        		$hero_image      = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'maidive_rectangle' );

                echo '<article class="'.join( ' ', get_post_class() ).'" style="background-image: url('.$hero_image[0].');" itemscope="itemscope" itemtype="http://schema.org/Hotel">';
            		echo '<div class="container">';
                        echo '<header class="entry-header">';
                            echo '<h1 class="entry-title" itemprop="name">'.get_the_title($post->ID).'</h1>';
                        echo '</header>';
                        echo '<div class="entry-content" itemprop="description">';
                            echo the_content();
                        echo '</div>';
                    echo '</div>';
                echo '</article>';
        	}

        	if( has_term('left-content-right-image', 'format') && has_post_thumbnail() ) {
        		$right_image    = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'maidive_square' );
                $right_image_id = get_post_thumbnail_id($post->id);
                $right_alt      = get_post_meta( $right_image_id, '_wp_attachment_image_alt', true);
                
                echo '<article class="'.join( ' ', get_post_class() ).'" itemscope="itemscope" itemtype="http://schema.org/Hotel">';
                    
                    //Copy Section
                    echo '<div class="copy">';
                        echo '<header class="entry-header">';
                            echo '<h2 class="section-title" itemprop="name">'.get_the_title($post->ID).'</h2>';
                        echo '</header>';
                        echo '<div class="entry-content" itemprop="description">';
                            echo the_content();
                        echo '</div>';
            		echo '</div>';

                    // Image Section
            		echo '<div class="image">';
                        echo '<img src="'.$right_image[0].'" alt="'.$right_alt.'" itemprop="photo">';
                    echo '</div>';

                echo '</article>';
        	}

        	if( has_term('left-image-right-content', 'format') && has_post_thumbnail() ) {
                $left_image     = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'maidive_square', false, '' );
                $left_image_id  = get_post_thumbnail_id($post->id);
                $left_alt       = get_post_meta( $left_image_id, '_wp_attachment_image_alt', true);

        		echo '<article class="'.join( ' ', get_post_class() ).'" itemscope="itemscope" itemtype="http://schema.org/Hotel">';
                    
                    // Image Section
                    echo '<div class="image">';
                        echo '<img src="'.$left_image[0].'" alt="'.$left_alt.'" itemprop="photo">';
                    echo '</div>';

            		//Copy Section
                    echo '<div class="copy">';
                        echo '<header class="entry-header">';
                            echo '<h2 class="section-title" itemprop="name">'.get_the_title($post->ID).'</h2>';
                        echo '</header>';
                        echo '<div class="entry-content" itemprop="description">';
                            echo the_content();
                        echo '</div>';
                    echo '</div>';

                echo '</article>';
        	}

        	if( has_term('full-width-image', 'format') && has_post_thumbnail() ) {
                $full_image     = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'maidive_rectangle', false, '' );
                $full_image_id  = get_post_thumbnail_id($post->id);
                $full_alt       = get_post_meta( $full_image_id, '_wp_attachment_image_alt', true);

        		echo '<article class="'.join( ' ', get_post_class() ).'" itemscope="itemscope" itemtype="http://schema.org/Hotel">';
                    echo '<img src="'.$full_image[0].'" alt="'.$full_alt.'" itemprop="photo">';
                echo '</article>';
        	}

            if( has_term('full-width-content', 'format') ) {
                echo '<article class="'.join( ' ', get_post_class() ).'" itemscope="itemscope" itemtype="http://schema.org/Hotel">';
                    echo '<header class="entry-header">';
                        echo '<h2 class="section-title" itemprop="name">'.get_the_title($post->ID).'</h2>';
                    echo '</header>';
                    echo '<div class="entry-content" itemprop="description">';
                        echo the_content();
                    echo '</div>';
                echo '</article>';
            }
        }
    }
    wp_reset_postdata();
}

// Run the Genesis loop
genesis();