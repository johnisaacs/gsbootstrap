<!-- insert breadcrumbs -->
	<?php if ( ! is_front_page() ) {?>			
	<div class="breadcrumbs">
		<?php if(function_exists('bcn_display'))
		{
			bcn_display();
		}?>
	</div>
	<?php }?>
	<!-- end breadcrumbs -->