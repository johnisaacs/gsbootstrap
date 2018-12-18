<nav id="submenu-horizontal" class="navbar navbar-default" role="navigation">						
 <!-- mobile menu -->
<div class="navbar-header">					 
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#dept-subnav">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>					  
</div>
	<div class="collapse navbar-collapse" id="dept-subnav">
		<?php wp_nav_menu(array('menu' => 'Primary Navigation', 'depth' => 2, 'menu_class' => 'nav navbar-nav', 'menu_id' => 'wpmenu', 'walker' => new wp_bootstrap_navwalker() )); ?> 
	</div>
</nav>