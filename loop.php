<?php get_template_part( 'breadcrumbs' ); ?>
<!-- begin loop -->
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
		<?php if (is_front_page() ) {
		?> 	
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
			<div class="clearfix"></div>
		<?php } 
		else {
		?> 
			<h1 class="title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<div class="clearfix"></div>
			<p class="date-updated">Last updated: <?php the_modified_date( 'n/j/Y' ); ?></p>
		<?php } 
		?>		
		
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, content not found.'); ?></p>
	<?php endif; ?>
<!-- end loop -->
