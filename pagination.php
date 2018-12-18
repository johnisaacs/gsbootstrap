<div class="row pagination clearfix">
	<div class="col-xs-12">
	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi();} else { ?> <div class="prevnextpage"><p><?php posts_nav_link(' ', '<span class="next-post">Newer posts --></span>', '<span class="prev-post"><-- Older posts</span>'); ?></p></div> <?php } ?>
	</div>
</div>