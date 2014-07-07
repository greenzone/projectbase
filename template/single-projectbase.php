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
					.deskripsi {
						margin-bottom: 12px;}
				</style>
				<!-- Display description "projectbase" contents -->
				<div class="deskripsi"><i class="fa fa-file-text-o"></i> Deskripsi</div>
				<div class="entry-content"><?php the_content(); ?></div>
				<br />
				<div class="deskripsi"><i class="fa fa-user"></i> Customer : <?php echo esc_html( get_post_meta( get_the_ID(), 'customer', true ) ); ?></div>
				<div class="deskripsi"><i class="fa fa-globe"></i> Webclass : <?php echo esc_html( get_post_meta( get_the_ID(), 'webclass', true ) ); ?></div>
				<br />
				<table>
					<tr>
						<td class="button-demo">
							<a href="#" target="_blank">
							<i class="fa fa-desktop"></i> Live Priview</a>
						</td>
					</tr>
				</table>
			</div><!--- /.isi-profile --->
			<?php endwhile; ?>
		</div><!-- .row content -->
</div><!--/.container -->
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
