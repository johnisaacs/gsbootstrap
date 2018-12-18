<?php get_template_part( 'breadcrumbs' ); ?>
<!-- begin loop -->	
	<h1 class="title"><?php single_cat_title(); ?></h1>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
	<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
	<p class="post-meta"><?php the_time(get_option('date_format')); ?></p>
	<?php the_content('Read more...'); ?>
		<div class="clearfix"></div>
		<hr class="spacer">
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>	
<!-- end loop -->	
<?php get_template_part( 'pagination' ); ?>

