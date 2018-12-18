<?php
/*
 Archive Template 
*/
?>

<?php get_header(); ?>

	<div id="content" class="landing">
		<div id="inner-wrapper" class="container">
			<div class="row">
				<?php get_template_part( 'banner' ); ?>
			</div>
			<div class="row">
				<?php get_template_part( 'horizontal-navigation' ); ?>
			</div>				
			<div class="row">	
				<div id="main" class="col-sm-9">							
					<?php get_template_part( 'loop', 'archive' ); ?>
				</div>
				<div class="sidebar right col-sm-3">
					<?php dynamic_sidebar( 'Sidebar' ); ?>
				</div>
			</div>
			<div class="row local-footer">
				<div class="col-xs-12">
					<?php dynamic_sidebar( 'Footer' ); ?>
				</div>
			</div>
		</div>	
	</div>	
	
<?php get_footer(); ?>
 			
</body>
</html>