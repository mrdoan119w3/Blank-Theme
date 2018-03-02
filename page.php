<?php

acf_form_head();

get_header();

?>
<div id="content">
	
	<?php
	
	acf_form(array(
		'post_id'		=> 'new_post',
		'post_title'	=> true,
		'post_content'	=> true,
		'new_post'		=> array(
			'post_type'		=> 'contact_form',
			'post_status'	=> 'publish'
		),
		'return'		=> home_url('contact-form-thank-you'),
		'submit_value'	=> 'Send'
	));
	
	?>
	
</div>

<?php get_footer(); ?>