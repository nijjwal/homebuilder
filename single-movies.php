<?php get_header(); ?>

<div class="well">

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

		<div class="col-md-3">
			<?php

	  	        $street_value = get_post_meta($post->ID, '_home_listing_cpt_street_value_key', true);
	  	        $city_value = get_post_meta($post->ID, '_home_listing_cpt_city_value_key', true);
	  	        $state_value = get_post_meta($post->ID, '_home_listing_cpt_state_value_key', true);
  	      
		  	    echo '<div class="single-listing-street-and-price ">'.'<h3>'.$street_value.'</h3>'.'</div>' ;
		  	    echo '<div class="single-listing-city-state-zip">'.'<h3>'.$city_value.' '.$state_value.'</h3>'.'</div>';	  	       			   		
			?>
		</div>

		<div class="col-md-2">
			<?php
				$plan_value = get_post_meta($post->ID, '_home_listing_cpt_plan_value_key', true);
				$sqft_value = get_post_meta($post->ID, '_home_listing_cpt_sqft_value_key', true);
				$story_value = get_post_meta($post->ID, '_home_listing_cpt_story_value_key', true);

				echo '<div class="single-listing-header-info">'.'Plan Name: '.'<span class="plan">'.$plan_value.'</span>'.'</div>';
				echo '<div class="single-listing-header-info">'.'SQ FT: '.$sqft_value.'</div>';
		        echo '<div class="single-listing-header-info">'.'Stories: '.$story_value.'</div>';
	        ?>
		</div>

	    <div class="col-md-2">
	    	<?php
		    	$bedroom_value = get_post_meta($post->ID, '_home_listing_cpt_bedroom_value_key', true);
		    	$bathroom_value = get_post_meta($post->ID, '_home_listing_cpt_bathroom_value_key', true);
		    	echo '<div class="single-listing-header-info">'.'Bedrooms: '.$bedroom_value.'</div>';
				echo '<div class="single-listing-header-info">'.'Baths: '.$bathroom_value.'</div>';
			?>
		</div>

		<div class="col-md-2">
			<?php
				$price_value = get_post_meta($post->ID, '_home_listing_cpt_price_value_key', true);
				echo '<div class="single-listing-street-and-price ">'.'<h3>'.'$'.$price_value.'</h3>'.'</div>';
			?>
		</div>
	</div>

	<div class="row well">
			<div class="col-md-3">
			</div>
			<div class="col-md-9">
				<!--Display page contents-->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>					
				 	<?php the_content(); ?>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>
				<!--Display page contents end-->
			</div>
	</div>


</div>
<!--Posts with categoires on left side Ends-->



<?php get_footer(); ?>