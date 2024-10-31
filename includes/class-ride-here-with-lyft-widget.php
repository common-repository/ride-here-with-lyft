<?php

class RideHereWithLyftWidget extends WP_Widget
{

    const FIELDS = [
        'location_street_address',
        'location_city',
        'location_postal_code',
        'title',
        'theme',
        'button_size',
        'text_color'
    ];

    const GET_A_RIDE_BASE_URL = 'https://www.lyft.com/api/get-a-ride';

    // class constructor
    public function __construct()
    {
        $options = array(
            'classname' => 'ride_here_with_lyft_widget',
            'description' => 'Embed a Lyft button on your site so customers can ride straight to your doorstep.',
        );

        parent::__construct(
            'ride_here_with_lyft_widget',
            'Ride Here With Lyft',
            $options
        );
    }

    // output the widget content on the front-end
    public function widget($args, $instance)
    {
        global $wp;

        echo $args['before_widget'];

        $instance['referrer'] = home_url(add_query_arg(array(), $wp->request));

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', esc_html($instance['title'])) . $args['after_title'];
        }


        ?>
        <div class="ride-here-with-lyft">
            <iframe width="275" height="70" sandbox="allow-scripts allow-forms allow-top-navigation-by-user-activation"
            src="https://cdn.lyft.com/static/widgets/embed.html?location_street_address=<? echo rawurlencode($instance['location_street_address']) ?>&location_city=<? echo rawurlencode($instance['location_city']) ?>&location_postal_code=<? echo rawurlencode($instance['location_postal_code']) ?>&theme=<? echo rawurlencode($instance['theme']) ?>&button_size=<? echo rawurlencode($instance['button_size']) ?>&referrer=<? echo rawurlencode($instance['referrer']) ?>&text_color=<? echo rawurlencode($instance['text_color']) ?>&title=<? echo rawurlencode($instance['title']) ?>"
            frameborder=0></iframe>
        </div>

    <?php
            echo $args['after_widget'];
        }

        // output the option form field in admin Widgets screen
        public function form($instance)
        {
            $location_street_address = !empty($instance['location_street_address']) ? $instance['location_street_address'] : null;
            $location_city = !empty($instance['location_city']) ? $instance['location_city'] : null;
            $location_postal_code = !empty($instance['location_postal_code']) ? $instance['location_postal_code'] : null;
            $title = !empty($instance['title']) ? $instance['title'] : null;
            $theme = !empty($instance['theme']) ? $instance['theme'] : null;
            $button_size = !empty($instance['button_size']) ? $instance['button_size'] : null;
            $text_color = !empty($instance['text_color']) ? $instance['text_color'] : null;
            ?>
        <div class="widget-ride-here-with-lyft-admin">
            <formgroup>
                <h2>Destination Address</h2>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('location_street_address')); ?>"><?php esc_attr_e('Street Address', 'text_domain'); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('location_street_address')); ?>" name="<?php echo esc_attr($this->get_field_name('location_street_address')); ?>" type="text" placeholder="123 Anyplace Ave" required value="<?php echo esc_attr($location_street_address); ?>">
                </p>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('location_city')); ?>"><?php esc_attr_e('City', 'text_domain'); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('location_city')); ?>" name="<?php echo esc_attr($this->get_field_name('location_city')); ?>" type="text" placeholder="Anytown" required value="<?php echo esc_attr($location_city); ?>">
                </p>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('location_postal_code')); ?>"><?php esc_attr_e('Zip Code', 'text_domain'); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('location_postal_code')); ?>" name="<?php echo esc_attr($this->get_field_name('location_postal_code')); ?>" placeholder="12345" required type="text" value="<?php echo esc_attr($location_postal_code); ?>">
                </p>
            </formgroup>
            <hr />
            <formgroup>
                <h2>Widget Appearance</h2>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('theme')); ?>"><?php esc_attr_e('Theme', 'text_domain'); ?></label>
                    <select class="widefat" id="<?php echo esc_attr($this->get_field_id('theme')); ?>" name="<?php echo esc_attr($this->get_field_name('theme')); ?>">
                        <option <? selected(null, esc_attr($theme)) ?> value=''>Lyft Pink (Default)</option>
                        <option <? selected('light', esc_attr($theme)) ?> value='light'>Light</option>
                    </select>
                </p>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('button_size')); ?>"><?php esc_attr_e('Button Size', 'text_domain'); ?></label>
                    <select class="widefat" id="<?php echo esc_attr($this->get_field_id('button_size')); ?>" name="<?php echo esc_attr($this->get_field_name('button_size')); ?>">
                        <option <? selected(null, esc_attr($button_size)) ?> value=''>Default</option>
                        <option <? selected('small', esc_attr($button_size)) ?> value='small'>Small</option>
                    </select>
                </p>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('text_color')); ?>"><?php esc_attr_e('Hex Text Color (Optional)', 'text_domain'); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('text_color')); ?>" name="<?php echo esc_attr($this->get_field_name('text_color')); ?>" type="text" placeholder="Hex color of text (#000000)" value="<?php echo esc_attr($text_color); ?>">
                </p>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Widget Title (Optional)', 'text_domain'); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" placeholder="Widget title that goes above the button" value="<?php echo esc_attr($title); ?>">
                </p>
            </formgroup>
        </div>
<?php
    }

    // save options
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        foreach (self::FIELDS as $field) {
            $instance[$field] = (!empty($new_instance[$field])) ? sanitize_text_field($new_instance[$field]) : '';
        }
        return $instance;
    }
}
