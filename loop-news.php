<?php get_template_part( 'breadcrumbs' ); ?>
<!-- begin loop -->			
	<h1 class="title">News</h1>
	<?php query_posts('post_type=post&post_status=publish&posts_per_page=5&paged='. get_query_var('paged')); 
	// set $more to 0 to show the excerpt if more tag used
	global $more;
	$more = 0;
	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
	<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
	<p class="post-meta"><?php the_time(get_option('date_format')); ?></p>
	<?php the_content('Read more...'); ?>
	<div class="clearfix"></div>
	<hr class="spacer">						
	
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>	
<?php get_template_part( 'pagination' ); ?>
<?php wp_reset_query(); ?>
<!-- end loop -->

<div class="clearfix"></div>
