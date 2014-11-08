<?php
	// Register Custom Navigation Walker
	require_once('wp_bootstrap_navwalker.php');

	register_nav_menus( array(
	    'primary' => __( 'Primary Menu', 'mytheme' ),
	) );

function nijjwal_widgets_init() {

	register_sidebar( array(
		'name' => 'Home search widget area',
		'id' => 'home_search_widget_area',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => 'Social Media Area 1',
		'id' => 'social_media_area_1',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'nijjwal_widgets_init' );

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_meta_box() {	
		add_meta_box(
			'myplugin_sectionid',
			__( 'Static Image Below Navigation Bar', 'myplugin_textdomain' ),
			'myplugin_meta_box_callback',
			'page'
		);
    
}


add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

	echo '<label for="upload_image">';
	_e( 'Upload an image below navigation bar', 'myplugin_textdomain' );
	echo '</label> ';

	$static_image = get_post_meta($post->ID, '_my_meta_value_key', true) ;
	echo '<img src="'.$static_image.'" width="200px"/>';	
	echo '<br/>';
	echo '<input type="text" id="upload_image" name="upload_image" value="' .$value. '" size="40" />';
    echo '<input id="upload_image_button" type="button" value="Upload Image" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['upload_image'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = $_POST['upload_image'];

	// Update the meta field in the database.
	update_post_meta( $post_id, '_my_meta_value_key', $my_data );
}
add_action( 'save_post', 'myplugin_save_meta_box_data' );

/**
 * Code for media upload button
 *
 */
function my_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/js/my-script.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}
 
function my_admin_styles() {
	wp_enqueue_style('thickbox');
}
 
add_action('add_meta_boxes', 'my_admin_scripts');
add_action('add_meta_boxes', 'my_admin_styles');

/*
* Creating a function to create our CPT
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Movies', 'Post Type General Name', 'twentythirteen' ),
		'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'twentythirteen' ),
		'menu_name'           => __( 'Movies', 'twentythirteen' ),
		'parent_item_colon'   => __( 'Parent Movie', 'twentythirteen' ),
		'all_items'           => __( 'All Movies', 'twentythirteen' ),
		'view_item'           => __( 'View Movie', 'twentythirteen' ),
		'add_new_item'        => __( 'Add New Movie', 'twentythirteen' ),
		'add_new'             => __( 'Add New', 'twentythirteen' ),
		'edit_item'           => __( 'Edit Movie', 'twentythirteen' ),
		'update_item'         => __( 'Update Movie', 'twentythirteen' ),
		'search_items'        => __( 'Search Movie', 'twentythirteen' ),
		'not_found'           => __( 'Not Found', 'twentythirteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'movies', 'twentythirteen' ),
		'description'         => __( 'Movie news and reviews', 'twentythirteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon'           => 'dashicons-admin-home',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'movies', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_post_type', 0 );


add_theme_support( 'post-thumbnails' );
add_image_size('featuredImageCropped', 235, 180, true);


/** Home Listing  Custom Post Type custom fields
************************************************
*************************************************
**************************************************
***************************************************
*/
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function home_listing_cpt_add_meta_boxes() {
		add_meta_box(
			'street',
			__( 'Listing Information', 'home_listing_cpt_textdomain' ),
			'home_listing_cpt_meta_box_callback',
			'movies'
		);
}
add_action( 'add_meta_boxes', 'home_listing_cpt_add_meta_boxes' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function home_listing_cpt_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'home_listing_cpt_meta_box', 'home_listing_cpt_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$street = get_post_meta( $post->ID, '_home_listing_cpt_street_value_key', true );
	$city = get_post_meta( $post->ID, '_home_listing_cpt_city_value_key', true );
	$state = get_post_meta( $post->ID, '_home_listing_cpt_state_value_key', true );
	$name = get_post_meta( $post->ID, '_home_listing_cpt_name_value_key', true );
	$plan = get_post_meta( $post->ID, '_home_listing_cpt_plan_value_key', true );
	$price = get_post_meta( $post->ID, '_home_listing_cpt_price_value_key', true );
	$bedroom = get_post_meta( $post->ID, '_home_listing_cpt_bedroom_value_key', true );
	$bathroom = get_post_meta( $post->ID, '_home_listing_cpt_bathroom_value_key', true );
	$story = get_post_meta( $post->ID, '_home_listing_cpt_story_value_key', true );
	$sqft = get_post_meta( $post->ID, '_home_listing_cpt_sqft_value_key', true );
	$additional_info = get_post_meta( $post->ID, '_home_listing_cpt_additional_info_value_key', true );
	$zip = get_post_meta( $post->ID, '_home_listing_cpt_zip_value_key', true );
	$status = get_post_meta( $post->ID, '_home_listing_cpt_status_value_key', true );
	$garage = get_post_meta( $post->ID, '_home_listing_cpt_garage_value_key', true );


	echo '<label for="home_listing_cpt_street_field">';
	echo '<i>';
	_e( 'Street', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_street_field" name="home_listing_cpt_street_field" value="' . esc_attr( $street ) . '" size="25" />';
	echo '<br/> <hr/>';

	echo '<label for="home_listing_cpt_city_field">';
	echo '<i>';
	_e( 'City', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_city_field" name="home_listing_cpt_city_field" value="' . esc_attr( $city ) . '" size="25" />';
	echo '<br/> <hr/>';

	echo '<label for="home_listing_cpt_state_field">';
	echo '<i>';
	_e( 'State', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_state_field" name="home_listing_cpt_state_field" value="' . esc_attr( $state ) . '" size="25" />';
	echo '<br/> <hr/>';


	echo '<label for="home_listing_cpt_zip_field">';
	echo '<i>';
	_e( 'Zip', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_zip_field" name="home_listing_cpt_zip_field" value="' . esc_attr( $zip ) . '" size="25" />';
	echo '<br/> <hr/>';

	echo '<label for="home_listing_cpt_name_field">';
	echo '<i>';
	_e( 'Name', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_name_field" name="home_listing_cpt_name_field" value="' . esc_attr( $name ) . '" size="25" />';
	echo '<br/> <hr/>';

    echo '<label for="home_listing_cpt_plan_field">';
    echo '<i>';
	_e( 'Plan', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_plan_field" name="home_listing_cpt_plan_field" value="' . esc_attr( $plan ) . '" size="25" />';
	echo '<br/> <hr/>';

	echo '<label for="home_listing_cpt_price_field">';
	echo '<i>';
	_e( 'Price', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_price_field" name="home_listing_cpt_price_field" value="' . esc_attr( $price ) . '" size="25" />';
	echo '<br/> <hr/>';

	echo '<label for="home_listing_cpt_bedroom_field">';
	echo '<i>';
	_e( 'Bedrooms', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_bedroom_field" name="home_listing_cpt_bedroom_field" value="' . esc_attr( $bedroom ) . '" size="25" />';
	echo '<br/> <hr/>';

	echo '<label for="home_listing_cpt_bathroom_field">';
	echo '<i>';
	_e( 'Bathrooms', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_bathroom_field" name="home_listing_cpt_bathroom_field" value="' . esc_attr( $bathroom ) . '" size="25" />';
	echo '<br/> <hr/>';

	echo '<label for="home_listing_cpt_story_field">';
	echo '<i>';
	_e( 'Story', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_story_field" name="home_listing_cpt_story_field" value="' . esc_attr( $story ) . '" size="25" />';
	echo '<br/> <hr/>';

	echo '<label for="home_listing_cpt_sqft_field">';
	echo '<i>';
	_e( 'Sq Ft', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_sqft_field" name="home_listing_cpt_sqft_field" value="' . esc_attr( $sqft ) . '" size="25" />';
	echo '<br/> <hr/>';

	echo '<label for="home_listing_cpt_additional_info_field">';
	echo '<i>';
	_e( 'Additional Info', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_additional_info_field" name="home_listing_cpt_additional_info_field" value="' . esc_attr( $additional_info ) . '" size="25" />';
	echo '<br/> <hr/>';


	echo '<label for="home_listing_cpt_status_field">';
	echo '<i>';
	_e( 'Status', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_status_field" name="home_listing_cpt_status_field" value="' . esc_attr( $status ) . '" size="25" />';
	echo '<br/> <hr/>';


	echo '<label for="home_listing_cpt_garage_field">';
	echo '<i>';
	_e( 'Garage', 'home_listing_cpt_textdomain' );
	echo '</i>';
	echo '<br/>';
	echo '</label> ';
	echo '<input type="text" id="home_listing_cpt_garage_field" name="home_listing_cpt_garage_field" value="' . esc_attr( $garage ) . '" size="25" />';
	echo '<br/> <hr/>';

}


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function home_listing_cpt_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['home_listing_cpt_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['home_listing_cpt_meta_box_nonce'], 'home_listing_cpt_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['home_listing_cpt_street_field'] ) ) {
		return;
	}

	if ( ! isset( $_POST['home_listing_cpt_city_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$street = sanitize_text_field( $_POST['home_listing_cpt_street_field'] );
	$city = sanitize_text_field( $_POST['home_listing_cpt_city_field'] );
	$state = sanitize_text_field( $_POST['home_listing_cpt_state_field'] );
	$name = sanitize_text_field( $_POST['home_listing_cpt_name_field'] );
	$plan = sanitize_text_field( $_POST['home_listing_cpt_plan_field'] );
	$price = sanitize_text_field( $_POST['home_listing_cpt_price_field'] );
	$bedroom = sanitize_text_field( $_POST['home_listing_cpt_bedroom_field'] );
	$bathroom = sanitize_text_field( $_POST['home_listing_cpt_bathroom_field'] );
	$story = sanitize_text_field( $_POST['home_listing_cpt_story_field'] );
	$sqft = sanitize_text_field( $_POST['home_listing_cpt_sqft_field'] );
	$additional_info = sanitize_text_field( $_POST['home_listing_cpt_additional_info_field'] );
	$zip = sanitize_text_field( $_POST['home_listing_cpt_zip_field'] );
	$status = sanitize_text_field( $_POST['home_listing_cpt_status_field'] );
	$garage = sanitize_text_field( $_POST['home_listing_cpt_garage_field'] );


	// Update the meta field in the database.
	update_post_meta( $post_id, '_home_listing_cpt_street_value_key', $street);
	update_post_meta( $post_id, '_home_listing_cpt_city_value_key', $city);
	update_post_meta( $post_id, '_home_listing_cpt_state_value_key', $state);
	update_post_meta( $post_id, '_home_listing_cpt_name_value_key', $name);
	update_post_meta( $post_id, '_home_listing_cpt_plan_value_key', $plan);
	update_post_meta( $post_id, '_home_listing_cpt_price_value_key', $price);
	update_post_meta( $post_id, '_home_listing_cpt_bedroom_value_key', $bedroom);
	update_post_meta( $post_id, '_home_listing_cpt_bathroom_value_key', $bathroom);
	update_post_meta( $post_id, '_home_listing_cpt_story_value_key', $story);
	update_post_meta( $post_id, '_home_listing_cpt_sqft_value_key', $sqft);
	update_post_meta( $post_id, '_home_listing_cpt_additional_info_value_key', $additional_info);
	update_post_meta( $post_id, '_home_listing_cpt_zip_value_key', $zip);
	update_post_meta( $post_id, '_home_listing_cpt_status_value_key', $status);
	update_post_meta( $post_id, '_home_listing_cpt_garage_value_key', $status);
}
add_action( 'save_post', 'home_listing_cpt_save_meta_box_data' );


// WP Menu Categories
add_action( 'init', 'build_taxonomies', 0 );



function build_taxonomies() {
    register_taxonomy( 'mycategories', 'movies', array( 'hierarchical' => true, 'label' => 'Home Categories', 'query_var' => true, 'rewrite' => true ) );
}


//Add filter
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if(is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
	if($post_type)
	    $post_type = $post_type;
	else
	    $post_type = array('post','movies'); // replace cpt to your custom post type
    $query->set('post_type',$post_type);
	return $query;
    }
}

?>