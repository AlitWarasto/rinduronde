<?php 
/**
 * Template Name: Landing Page
 *
 * @package WordPress
 * @subpackage rinduronde
 * @since rinduronde 1.0
 */

include(TEMPLATEPATH.'/header.php');

if(have_posts()):
	while(have_posts()):
		the_post();
		$strli = $post->post_content;
		$exstrli = explode("<li>", $strli); ?>
		<section id="s1">
			
			<?php echo implode("<li><span><i class='fas fa-angle-double-right'></i></span><span>", $exstrli);?>
			
		</section>
		<?php
	endwhile;
endif;


include(TEMPLATEPATH.'/footer.php');

 ?>