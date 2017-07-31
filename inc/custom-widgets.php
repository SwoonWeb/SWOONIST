<?php 
/**
 * Adds Social_Media_Menu_Widget widget.
 */
class Social_Media_Menu_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'social_media_menu_widget', 'Social Media Menu', // Name
			array( 'description' => 'An inline social media menu' ) // Args
		);
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		$title = $instance['title'];
		if ( $title ) echo $args['before_title'] . $title . $args['after_title'];
    atg_social_menu();
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = esc_attr( $instance['title'] );?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
} // class Social_Media_Menu_Widget


/**
 * Adds Button widget.
 */
class Button extends WP_Widget {
	function __construct() {
		parent::__construct(
			'buttons', 'Button', // Name
			array( 'description' => 'A widget for creating a button' ) // Args
		);
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		$btn_class = $instance['btn_class'];
		$btn_href = $instance['btn_href'];
		$btn_label = $instance['btn_label'];
		if($btn_class && $btn_label){
			echo '<a class="btn btn-block '.$btn_class.'" href="'.$btn_href.'">'.$btn_label.'</a>';
		}
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$btn_label = esc_attr( $instance['btn_label'] );
		$btn_href = esc_attr( $instance['btn_href'] );
		$btn_class = esc_attr( $instance['btn_class'] );?>
		<p>
			<label for="<?php echo $this->get_field_id( 'btn_label' ); ?>"><?php _e( 'Button Label:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'btn_label' ); ?>" name="<?php echo $this->get_field_name( 'btn_label' ); ?>" type="text" value="<?php echo esc_attr( $btn_label ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'btn_href' ); ?>"><?php _e( 'Button Link:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'btn_href' ); ?>" name="<?php echo $this->get_field_name( 'btn_href' ); ?>" type="text" placeholder="http://" value="<?php echo esc_attr( $btn_href ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'btn_label' ); ?>"><?php _e( 'Button Label:' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'btn_class' ); ?>" name="<?php echo $this->get_field_name( 'btn_class' ); ?>" >
				<?php
					$classes = ['btn-primary','btn-outline-primary']; 
					foreach ( $classes as $class ) {
						$option = '<option value="' . $class . '"'. ($class == $btn_class ? ' selected' : '') .'>';
						$option .= ucfirst($class) ;
						$option .= '</option>';
						echo $option;
					}
				?>
			</select> 
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['btn_label'] = strip_tags($new_instance['btn_label']);
		$instance['btn_href'] = strip_tags($new_instance['btn_href']);
		$instance['btn_class'] = ( ! empty( $new_instance['btn_class'] ) ) ? strip_tags( $new_instance['btn_class'] ) : 'btn-primary';
		return $instance;
	}
} // class Button

/**
 * Adds Custom_Recent_Posts_Widget widget.
 */
class Custom_Recent_Posts_Widget extends WP_Widget {	
	function __construct() {
		parent::__construct(
			'custom_recent_posts_widget', 'Custom Recent Posts', // Name
			array( 'description' => 'A custom recent posts widget' ) // Args
		);
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if(strpos($instance['title'], 'SWOON') !== false){
			echo '<h5 class="widget-title custom-widget-title"><span class="text">'.str_replace("SWOON","<b>SWOON</b>",$instance['title']).'</span><span class="line"></span></h5>';
		} else {
			echo $args['before_title'] . $instance['title'] .  $args['after_title'];
		}

		$widget_posts = new WP_QUERY('ignore_sticky_posts=1&showposts='.$instance['number']);
		if ($widget_posts->have_posts()): ?>
			<ul>
				<?php while ($widget_posts->have_posts() ) : $widget_posts->the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<div class="d-flex justify-content-between post-details">
							<div class="cat-label">
								<?php
									$cats = get_the_category();
									echo $cats[0]->name;
								?>
							</div>
							<div class="time-label">
								<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
							</div>
						</div>						
					</li>
				<?php endwhile; ?>
			</ul>
		<?php
		endif; wp_reset_postdata();
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : 'Recent Posts';
		$number = ! empty( $instance['number'] ) ? $instance['number'] : '4';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of Posts:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
		return $instance;
	}

} // class Custom_Recent_Posts_Widget

/**
 * register Custom widgets
 */
function register_custom_widgets() { 
  register_widget( 'social_media_menu_widget' );
  register_widget( 'button' );
  register_widget( 'custom_recent_posts_widget' );
}
add_action( 'widgets_init', 'register_custom_widgets' );