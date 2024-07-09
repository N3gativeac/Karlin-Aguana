<?php 
$techup_enable_team_section = get_theme_mod( 'techup_enable_team_section', false );
$techup_team_title  = get_theme_mod( 'techup_team_title' );
$techup_team_subtitle  = get_theme_mod( 'techup_team_subtitle' );
?>
	
<?php 
if($techup_enable_team_section==true ) {
    

        $techup_teams_no        = 6;
        $techup_teams_pages      = array();
        for( $i = 1; $i <= $techup_teams_no; $i++ ) {
             $techup_teams_pages[] = get_theme_mod('techup_team_page'.$i);

        }
        $techup_teams_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $techup_teams_pages ),
        'posts_per_page' => absint($techup_teams_no),
        'orderby' => 'post__in'
        ); 
        $techup_teams_query = new WP_Query( $techup_teams_args );
      

?>
<!-- ======= Team Section ======= -->
    <section id="team" class="team-5 section-bg fbusi">
      <div class="container">
        <div class="section-title-5">
		 <?php if($techup_team_title) : ?>
          <h2><?php echo esc_html($techup_team_title); ?></h2>
          <div class="separator">
            <ul>
              <li></li>
            </ul>
          </div>
		  <?php endif; ?>
          <?php if($techup_team_subtitle) { ?>
			<p><?php echo esc_html($techup_team_subtitle); ?></p>
		  <?php } ?>
        </div>

       <div class="container">
    <div class="row">
		<?php
            $count = 0;
            while($techup_teams_query->have_posts() && $count <= 4 ) :
            $techup_teams_query->the_post();
         ?> 
			<div class="col-md-4 col-sm-6">
				<div class="our-team">
					<div class="pic">
						<?php the_post_thumbnail(); ?>
						<div class="social_media_team">
							<p class="description">
								<?php echo  esc_html(get_the_excerpt()); ?>
							</p>
						</div>
					</div>
					<div class="team-prof">
						<h3 class="post-title"><?php the_title(); ?></h3>
						 
					</div>
				</div>
			</div>
		<?php
		$count = $count + 1;
		endwhile;
		wp_reset_postdata();
	 ?> 	
    </div>
</div>
      </div>
    </section><!-- End Team Section -->	



<?php } ?>