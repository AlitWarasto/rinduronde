<?php 



include(TEMPLATEPATH.'/header.php');

if(have_posts()):
	while(have_posts()):
		the_post();
		the_content();
	endwhile;
endif;


include(TEMPLATEPATH.'/footer.php');
 ?>