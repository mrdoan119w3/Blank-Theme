<?php
function social_item($link,$class){
    ?>
	<a href="<?php echo $link?>" target="_blank"><i class="fa <?php echo $class?>"></i></a>
<?php
}
function social(){
    $twitter		=	get_field('twitter','option');
    $facebook		=	get_field('facebook','option');
    $linkedin		=	get_field('linkedin','option');
    $instagram		=	get_field('instagram','option');
    $google_plus	=	get_field('google_plus','option');
    $youtube		=	get_field('youtube','option');
	ob_start();
?>
	<ul class="social clearfix">
		<?php if($facebook):?>
			<li><?php social_item($facebook,'fa-facebook-official');?></li>
		<?php endif;?>
		<?php if($twitter):?>
			<li><?php social_item($twitter,'fa-twitter');?></li>
		<?php endif;?>
		<?php if($youtube):?>
			<li><?php social_item($youtube,'fa-youtube');?></li>
		<?php endif;?>
		<?php if($linkedin):?>
			<li><?php social_item($linkedin,'fa-linkedin');?></li>
		<?php endif;?>
		<?php if($instagram):?>
			<li><?php social_item($instagram,'fa-instagram');?></li>
		<?php endif;?>
		<?php if($google_plus):?>
			<li><?php social_item($google_plus,'fa-google-plus');?></li>
		<?php endif;?>
	</ul>
<?php 
	return ob_get_clean();
}
add_shortcode('social', 'social');
