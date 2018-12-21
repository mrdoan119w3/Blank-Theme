<?php

/***** Register Widgets *****/

function newspro_register_posts_news_1_widgets() {
	register_widget('newspro_posts_news_1_widget');
}
add_action('widgets_init', 'newspro_register_posts_news_1_widgets');

class newspro_posts_news_1_widget extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'newspro_news_block_1', 'description' => __('Bài viết phản hồi nhiều nhất', 'newspro'));
        parent::__construct('newspro-posts-news-1', __('Bài viết phản hồi nhiều nhất', 'newspro'), $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $postcount = empty($instance['postcount']) ? '3' : $instance['postcount'];
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : 1;
        $sticky = get_option( 'sticky_posts' );
        echo $before_widget;
        if (!empty( $title)) {  echo '<div class="newspro_post_news_header newspro_post_header ">
			<div class="news_heading catbx3">'.$before_title . esc_attr($title) . $after_title.'   </div>
			<div class="clearfix"></div>
			</div>'; 
		} ?>
        <?php
		$args = array(
			'post_type'		=> 'post',
			'posts_per_page'=> $postcount, 
			'orderby' 		=> 'comment_count',
			'post__not_in'  => $sticky,
		);
		$the_query = new WP_Query($args);
		if($the_query->have_posts()): 
		echo '<div class="devcpt-widget-list">';
		while ( $the_query->have_posts() ) : $the_query->the_post(); 
			
			$post_id 	= get_the_ID();
			$post_title = get_the_title();
			$date_cat 	= get_the_date();
			$comments 	= get_comments_number();
			
			$date_item='';
			if($show_date == 1) $date_item = '<p>'.$date_cat.'</p>';
			?>
				<div class="devcpt-post-item clearfix">
			   		<div class="img">
			   			<?php  the_post_thumbnail();?>
			   		</div>
					<div class="post-cont">
						<h5><a href="<?php the_permalink(  ); ?>"><?php echo $post_title; ?></a></h5>	
						<p><strong><?php echo $comments; ?></strong> Phản hồi</p>
						<?php echo $date_item; ?>
								
					</div> <!-- newspro_large_news -->
		
				</div> <!-- newspro_news_large -->
			<?php
			endwhile;wp_reset_query();
		echo '</div>';
	 	endif; 
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['postcount'] = absint($new_instance['postcount']);
        $instance['offset'] = absint($new_instance['offset']);
        
        $instance['show_date'] = isset($new_instance['show_date']) ? strip_tags($new_instance['show_date']) : '';
     
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => '', 'postcount'=>3, 'offset' => 0,  'show_date'=>1);
        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'newspro'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
	    
	    <p>
        	
			<input type="text" size="2" value="<?php echo esc_attr($instance['postcount']); ?>" name="<?php echo esc_attr($this->get_field_name('postcount')); ?>" id="<?php echo esc_attr($this->get_field_id('postcount')); ?>" /> <?php esc_html_e('Number of Posts', 'newspro'); ?>
	    </p>
	    
    	
    	 <p>
      		<input id="<?php echo esc_attr($this->get_field_id('show_date')); ?>" name="<?php echo esc_attr($this->get_field_name('show_date')); ?>" type="checkbox" value="1" <?php checked('1', $instance['show_date']); ?>/>
	  		<label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php esc_html_e('Show date', 'newspro'); ?></label>
    	</p>
    	<?php
    }
}
