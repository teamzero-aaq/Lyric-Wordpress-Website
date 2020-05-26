<?php

/**
 * Adds Foo_Widget widget.
 */
class YouTube_Subs_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'foo_widget', // Base ID
            esc_html__('YouTube Subs', 'youtube-sw'), // Name
            array('description' => esc_html__('Add your youtube channel', 'youtube-sw')) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        echo '
    	<div class="g-ytsubscribe" data-channel="' . $instance['channel'] . '" data-layout="' . $instance['layout'] . '" data-count="' . $instance['count'] . '"></div>
    	';
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('YouTube Subs', 'youtube-sw');

        $channel = !empty($instance['channel']) ? $instance['channel'] : esc_html__('GoogleDevelopers', 'youtube-sw');

        $count = !empty($instance['count']) ? $instance['count'] : esc_html__('GoogleDevelopers', 'youtube-sw');

        ?>
    	<!-- title -->
    	<p>
    		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
    			<?php esc_attr_e('Title:', 'youtube-sw');?>
    		</label>
    		<input
    		class="widefat"
    		id="<?php echo esc_attr($this->get_field_id('title')); ?>"
    		name="<?php echo esc_attr($this->get_field_name('title')); ?>"
    		type="text"
    		value="<?php echo esc_attr($title); ?>">
    	</p>

    	<!-- channel -->
    	<p>
    		<label for="<?php echo esc_attr($this->get_field_id('channel')); ?>">
    			<?php esc_attr_e('Channel Name or ID:', 'youtube-sw');?>
    		</label>
    		<input
    		class="widefat"
    		id="<?php echo esc_attr($this->get_field_id('channel')); ?>"
    		name="<?php echo esc_attr($this->get_field_name('channel')); ?>"
    		type="text"
    		value="<?php echo esc_attr($channel); ?>">
    	</p>

    	<!-- layout -->
    	<p>
    		<label for="<?php echo esc_attr($this->get_field_id('layout')); ?>">
    			<?php esc_attr_e('Layout:', 'youtube-sw');?>
    		</label>
    		<select
    		class="widefat"
    		id="<?php echo esc_attr($this->get_field_id('layout')); ?>"
    		name="<?php echo esc_attr($this->get_field_name('layout')); ?>">
    		<option value="default" <?=($layout == 'default' ? 'selected' : '')?> >Default</option>
    		<option value="full" <?=($layout == 'full' ? 'selected' : '')?> >Full</option>
    	</select>
    </p>

    <!-- Subscriber count -->
    <p>
    	<label for="<?php echo esc_attr($this->get_field_id('count')); ?>">
    		<?php esc_attr_e('Subscriber count:', 'youtube-sw');?>
    	</label>
    	<select
    	class="widefat"
    	id="<?php echo esc_attr($this->get_field_id('count')); ?>"
    	name="<?php echo esc_attr($this->get_field_name('count')); ?>">
    	<option value="default" <?=($count == 'default' ? 'selected' : '')?> >Default</option>
    	<option value="hidden" <?=($count == 'hidden' ? 'selected' : '')?> >Hide</option>
    </select>
</p>
<?php
}

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        $instance['channel'] = (!empty($new_instance['channel'])) ? strip_tags($new_instance['channel']) : '';

        $instance['layout'] = (!empty($new_instance['layout'])) ? strip_tags($new_instance['layout']) : '';

        $instance['count'] = (!empty($new_instance['count'])) ? strip_tags($new_instance['count']) : '';

        return $instance;
    }

} // class Foo_Widget