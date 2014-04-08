<?php get_header(); ?>
<div class="container-fluid">
	<div class="row">
		<section id="main-section" class="col-md-8 col-md-offset-2">
			<?php if ( have_posts()) : while ( have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix');?>>
					<header>
						<h1><?php the_title();?></h1>
						<p><?php edit_post_link( __( 'Edit', 'viradacultural' ), '', '' ); ?></p>
					</header>
					<div class="post-content clearfix">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<nav class="page-link">' . __( 'Pages:', 'viradacultural' ), 'after' => '</nav>' ) ); ?>
					</div>
					<!-- .post-content -->
				</article>
				<!-- .page -->
			<?php endwhile; ?>
			<?php else : ?>
			   <p><?php _e('No results found.', 'viradacultural'); ?></p>
			<?php endif; ?>
		</section>
		<!-- #main-section -->
		<?php get_footer(); ?>
	</div>
	<!-- .row -->
</div>
<!-- .container-fluid -->
<?php html::part('countdown'); ?>
