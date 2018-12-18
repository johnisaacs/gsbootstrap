<?php get_template_part( 'breadcrumbs' ); ?>
<!-- begin loop -->	
	<h1 class="title">Search Results for &quot;<em><?php the_search_query(); ?></em>&quot;</h1>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
	<div class="search">
		<ul class="results">
			<li><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
		</ul>
	</div>
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no search results found.'); ?></p>
	<?php endif; ?>	
<!-- end loop -->	

