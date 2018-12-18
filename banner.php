<div class="col-xs-12 banner">

		<?php if (is_front_page() ) {
		?> 
			<div class="titlebox home">				
				<h1 class="site-title"><span class="name"><a href="<?php echo home_url()?>"><?php echo get_bloginfo('name')?></a></span></h1>		
			</div>			
		<?php } 
		else {
		?> 						
			<div class="titlebox">				
				<span class="site-title"><span class="name"><a href="<?php echo home_url()?>"><?php echo get_bloginfo('name')?></a></span></span>				
			</div>			
		<?php } 
		?>
		
</div>