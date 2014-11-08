/**
 * Template Name: Movie Reviews
 **/

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



		<div class="col-md-9">
				<!--Display search box-->
				<div>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home_search_widget_area') ) : 
					endif; ?>
					<br/>
				</div>
				<!--Display search box ends-->
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