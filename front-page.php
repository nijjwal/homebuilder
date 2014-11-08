<?php get_header(); ?>

<!--Carousel starts
	=============================-->
  <div id="myCarousel" class="carousel slide front-page-carousel">
  	<ol class="carousel-indicators">
  		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
  		<li data-target="#myCarousel" data-slide-to="1" ></li>
  		<li data-target="#myCarousel" data-slide-to="2" ></li>
  	</ol>

  		<div class="carousel-inner">
  			<div class="item active">
  				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/img1.jpg"/>
  				<div class="container">
  					<div class="carousel-caption">
  						<p>This tag will contain the text which we want to appear on our slide.</p>
  						<p><a class="btn btn-large btn-primary">SEE MORE</a></p>
  					</div>
  				</div>
  			</div>

  			 
  			 <div class="item">
  				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/img2.jpg"/>
  				<div class="container">
  					<div class="carousel-caption" style="margin-right:0px;">
  						
  						<p >This tag will contain the text which we want to appear on our slide.</p>
  						<p ><a class="btn btn-large btn-primary">COMMUNITIES</a></p>
  					</div>
  				</div>
  			</div>



  			<div class="item">
  				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/img3.jpg"/>
  				<div class="container">
  					<div class="carousel-caption">
  						
  						<p>This tag will contain the text which we want to appear on our slide.</p>
  						<p><a class="btn btn-large btn-primary">VISIT KINGS GATE</a></p>
  					</div>
  				</div>
  			</div>


  		</div>

  		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
  			<span class="glyphicon glyphicon-chevron-left"></span>
  		</a>

        <a class="right carousel-control" href="#myCarousel" data-slide="next">
  			<span class="glyphicon glyphicon-chevron-right"></span>
  		</a>

  </div>
<!--Carousel Ends-->


<div style="padding-top:40px;">

</div>

  <!-- Grid
  ======================-->
  <div class="jumbotron">
  	<div class="row">
  		<div class="col-md-4">
  			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/available_homes_btn.jpg"/>
  		</div>

  		<div class="col-md-4">
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/floorplans_btn2.jpg"/>
  		</div>

  		<div class="col-md-4">
 			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/specials_btn.jpg"/>
  		</div>
  	</div>





    <div class="row">
      <div class="col-md-4">
        
          <!--Display page contents-->
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <h2 style="color:#921E13; font-size:20px; font-weight:400;"><?php the_title(); ?></h2>
            <div style="line-height:22px; font-family:proxima-nova, sans-serif; color:#333; font-size:10px">
              <?php the_content(); ?>
            </div>
          <?php endwhile; else: ?>
          <p><?php _e(''); ?></p> <!--Display nothing if nothing is present.-->
          <?php endif; ?>
          <!--Display page contents end-->

      </div>

      <div class="col-md-4">
        Second Column1
      </div>

      <div class="col-md-4">
        Third Column1
      </div>
    </div>






  	<div class="row">
  		<div class="col-md-6">
        <!--
  			<h2 style="color:#921E13; font-size:27px; font-weight:400;">Personalize your new home today!</h2>
  			<div style="line-height:22px; font-family:proxima-nova, sans-serif; color:#333;">
          -->
        <h2 >Personalize your new home today!</h2>
        <div >

          <!--Display page contents-->
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1> <?php the_title(); ?></h1> 
            <?php the_content(); ?>
          <?php endwhile; else: ?>
          <p><?php _e(''); ?></p> <!--Display nothing if nothing is present.-->
          <?php endif; ?>
          <!--Display page contents end-->
        </div>

  			<br/>

  			<div>
  				<span  style="color:#921E13;">Share this page with a friend!</span>
  				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/sharethis_32.png"/>
  				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/facebook_32.png"/>
  				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/twitter_32.png"/>
  				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/pinterest_32.png"/>
  				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/email_32.png"/>
        </div>

  		</div>

  		<div class="col-md-3">
  			<h3>Latest <span style="color:#921E13; font-size:27px; font-weight:700;">News</span></h3>
            <ul style="list-style-type:none; padding-left: 0;">
	            <li style="color:#921E13; line-height:21px; text-align:left; text-decoration:none">
	  				2014 Southwest Showcase of Homes Start This Weekend
	  			</li>

	  				<hr/>

	  			<li style="color:#921E13; line-height:21px; padding-left:0px;">
	  				Employment Opportunity!
	  			</li>

	  				<hr/>

	  			<li style="color:#921E13; line-height:21px; padding-left:0px">
	  				5 Places to Find Water Fun in OKC
	  			</li>

	  			<li style="color:#921E13; line-height:21px; padding-left:0px">
	  				Read More
	  			</li>
            </ul>
      </div>

  		<div class="col-md-3">
  			<h3>Featured <span style="color:#921E13; font-size:27px; font-weight:700;">Homes</span></h3>
						  			<!--Carousel
							=============================-->
						  <div id="nmyCarousel" class="carousel slide" >


						  		<div class="carousel-inner">
						  			<div class="item active">
						  				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/img1.jpg"/>
						  				<div class="container">
						  				</div>
						  			</div>

						  			 
						  			 <div class="item">
						  				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/img2.jpg"/>
						  				<div class="container">
						  				</div>
						  			</div>



						  			<div class="item">
						  				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/img3.jpg"/>
						  				<div class="container">
						  				</div>
						  			</div>


						  		</div>

						  		<a class="left carousel-control" href="#nmyCarousel" data-slide="prev">
						  			<span class="glyphicon glyphicon-chevron-left"></span>
						  		</a>

						        <a class="right carousel-control" href="#nmyCarousel" data-slide="next">
						  			<span class="glyphicon glyphicon-chevron-right"></span>
						  		</a>

						  </div>
						  <!--Second Carousel Ends-->
      </div>
  	</div>
  </div><!--Jumbotron ends-->
  <!--Three column container ends-->


  <div style="padding-top:40px;">

  </div>










<?php get_footer(); ?>
