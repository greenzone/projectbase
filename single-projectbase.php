<?php
/*
* Single Page Demo Website Base
* Author: Albert Sukmono
* Description: Single Template Plugin "boxlink" for view content post projectbase
*/
get_header(); ?>
<div class="container">
        <div class="row">
            <div class="span12">
                <?php if (function_exists('bootstrapwp_breadcrumbs_projectbase')) {
                bootstrapwp_breadcrumbs_projectbase();
                } ?>
            </div><!--/.span12 -->
        </div><!--/.row -->
		<div class="row content">
		<!-- Cycle through all posts -->
		<?php while ( have_posts() ) : the_post(); ?>
			<!-- Display featured image in right-aligned floating div -->
			<div class="pic-profile">
				<div class="image-post-single">
				<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail('full', array('class' => 'profile'));
				} else { ?>
				<img style="width:330px;height:auto;" src="<?php bloginfo('template_directory'); ?>/img/no-image-thumb.svg" alt="<?php the_title(); ?>" />
				<?php } ?>
				</div>
			</div>
			<div class="isi-profile">
			<!-- Display Title and Metabox -->
				<div class="deskripsi-profile"><?php the_title(); ?></div>
				<style type="text/css">
					.button-demo {
						padding-top:14px;}
					.button-demo a {
						background:#38A7A7;
						margin-bottom:25px;
						padding:10px 45px 10px;
						text-align:center;
						border-radius:4px;
						cursor: pointer;
						color:white;}
					.button-demo a:hover {
						background:#157777;
						margin-bottom:25px;
						padding:10px 45px 10px;
						text-align:center;
						border-radius:4px;
						cursor: pointer;
						color:white;}
				</style>
				<table>
					<tr>
						<td class="button-demo">
							<a href="<?php get_template_part( $slug, $name ); ?>" target="_blank">
							<i class="fa fa-desktop"></i> Live Priview</a>
						</td>
					</tr>
				</table>
				<br />
				<!-- Display description "projectbase" contents -->
				<div class="deskripsi-profile">Deskripsi</div>
				<div class="entry-content"><?php the_content(); ?></div>
				<br />
				<tr>
					<td style="width: 70%">Work Rating</td>
						<td>: <?php
								$nb_stars = intval( get_post_meta( get_the_ID(), 'user_rating', true ) );
								for ( $star_counter = 1; $star_counter <= 5; $star_counter++ ) {
									if ( $star_counter <= $nb_stars ) {
										echo '<img src="' . plugins_url( 'projectbase/images/icon.png' ) . '" />';
									} else {
										echo '<img src="' . plugins_url( 'projectbase/images/grey.png' ). '" />';
									}
								}
								?>
						</td>
				</tr>
				<br />
			</div><!--- /.isi-profile --->
			<?php endwhile; ?>
		</div><!-- .row content -->
</div><!--/.container -->
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
