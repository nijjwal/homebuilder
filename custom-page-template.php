<?php
/**
 * Template Name: Custom Page Template
 *
 * 
 */
?>


<?php get_header(); ?>

<div class="well">
    <?php $static_image = get_post_meta($post->ID, '_my_meta_value_key', true); ?>
    <img src="<?php echo $static_image?>" width="100%"/>
</div>


<div class="row">
	<div class="col-md-7 child-page-title-below-static-image" >
			<h2><?php  echo wp_title("","",""); ?></h2>
	</div>

	<div class="col-md-2 share-this-text">
		<h5>
		Share This Page <br/>
		With a Friend! 
	    </h5>
	</div>

	<div class="col-md-3">
		<!--Display social media widget-->
		<div>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('social_media_area_1') ) : 
			endif; ?>
			<br/>
		</div>
		<!--Display social media widget ends-->
	</div>
</div>


<!--Posts with categoires on left side Starts-->
<div class="panel panel-default panel-body" style="margin-top:20px;">
	<!--Put categoires list and blog posts in a row-->
	<div class="row">


		<div class="col-md-3">
		    <span class="parent-page-title-below-static-img" ><h3><?php echo get_the_title($post->post_parent)." Menu";?></h3></span>
		    <?php
  				if($post->post_parent)
  					$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
  				else
  				$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
  				if ($children) { ?>
  				<span class="left-nav-list">
	  				<ul>
	  					<?php echo $children; ?>
	  				</ul>
  				</span>
  			<?php } ?>
		</div>



		<div class="col-md-9 well featured-image-listing">
				<!--Display search box-->
				<div>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home_search_widget_area') ) : 
					endif; ?>
					<br/>
				</div>
				<!--Display search box ends-->
				<!--Display page contents-->
				<?php
				$args = array( 'post_type' => 'movies', 'posts_per_page' => 10 );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					echo '<div style="float:left">';
						echo '<a href="' . get_permalink($post->ID) . '" >';
					  		echo the_post_thumbnail('featuredImageCropped');
					  	echo '</a>';
			  	        $street_value = get_post_meta($post->ID, '_home_listing_cpt_street_value_key', true);
			  	        $city_value = get_post_meta($post->ID, '_home_listing_cpt_city_value_key', true);
			  	        $state_value = get_post_meta($post->ID, '_home_listing_cpt_state_value_key', true);
			  	        $name_value = get_post_meta($post->ID, '_home_listing_cpt_name_value_key', true);
			  	        $plan_value = get_post_meta($post->ID, '_home_listing_cpt_plan_value_key', true);
			  	        $price_value = get_post_meta($post->ID, '_home_listing_cpt_price_value_key', true);
			  	        $bedroom_value = get_post_meta($post->ID, '_home_listing_cpt_bedroom_value_key', true);
			  	        $bathroom_value = get_post_meta($post->ID, '_home_listing_cpt_bathroom_value_key', true);
			  	        $story_value = get_post_meta($post->ID, '_home_listing_cpt_story_value_key', true);
			  	        $sqft_value = get_post_meta($post->ID, '_home_listing_cpt_sqft_value_key', true);
			  	        $additional_info_value = get_post_meta($post->ID, '_home_listing_cpt_additional_info_value_key', true);

			  	        echo '<br/>';
			  	        echo '<div class="one-listing">';
			  	        	echo '<div class="street">'.'<h4>'.$street_value.'</h4>'.'</div>' ;
			  	        	echo '<div class="city-and-state">'.'<h4>'.$city_value.', '.$state_value.'</h4>'.'</div>';
			  	        	echo '<div class="city-and-state">'.'<h4>'.$name_value.'</h4>'.'</div>';
			  	        	echo '<hr/>';
			  	        	echo '<div>'.'Plan: '.'<span class="plan">'.$plan_value.'</span>'.'</div>';
			  	        	echo '<div>'.'$'.$price_value.'</div>';
			  	        	echo '<div>'.$bedroom_value.' Bedrooms'.'</div>';
			  	        	echo '<div>'.$bathroom_value.' Bathrooms'.'</div>';
			  	        	echo '<div>'.$story_value.' Story'.'</div>';
			  	        	echo '<div>'.$sqft_value.' Sq Ft'.'</div>';
			  	        	echo '<div style="width:90%">'.'*'.$additional_info_value.'*'.'</div>';
			  	        echo '</div>';				   		
			   		echo '</div>';			   		
				endwhile;
				?>
				<!--Display page contents end-->
		</div>



	</div>
</div>
<!--Posts with categoires on left side Ends-->



<?php get_footer(); ?>