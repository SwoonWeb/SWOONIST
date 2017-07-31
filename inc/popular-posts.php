<?php

/**
 * Track Post Popularity
 */
function atg_popular_posts($post_id) {
  $count_key = 'atg_popular_posts';
  $count = get_post_meta($post_id, $count_key, true);
  if ($count == '') {
    $count = 0;
    delete_post_meta($post_id, $count_key);
    add_post_meta($post_id, $count_key, '0');
  } else {
    $count++;
    update_post_meta($post_id, $count_key, $count);
  }
}

/**
 * Adds Custom_Popular_Posts_Widget widget.
 */
class Custom_Popular_Posts_Widget extends WP_Widget {  
  function __construct() {
    parent::__construct(
      'custom_popular_posts_widget', 'Custom Popular Posts', // Name
      array( 'description' => 'A custom popular posts widget' ) // Args
    );
  }

  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    echo $args['before_title'] . $instance['title'] .  $args['after_title'];

    $widget_posts = new WP_QUERY(
      array(
        'posts_per_page'=>$instance['number'],
        'meta_key'=>'atg_popular_posts',
        'orderby'=>'meta_value_num',
        'order'=>'DESC',
        'ignore_sticky_posts' => 1
      )
    );

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
    $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Popular Posts';
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

} // class Custom_Popular_Posts_Widget

/**
 * register Custom widgets
 */
function register_popular_post_widgets() { 
  register_widget( 'custom_popular_posts_widget' );
}
add_action( 'widgets_init', 'register_popular_post_widgets' );