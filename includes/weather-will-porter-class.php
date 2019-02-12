<?php
/**
 * Adds Weather_Will_Porter widget.
 */
 class Weather_Will_Porter extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
      parent::__construct(
        'weather-will-porter', // Base ID
        esc_html__( 'Weather Will Porter', 'default' ), // Name
        array( 'description' => esc_html__( 'Weather Will Porter', 'default' ), ) // Args
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
    public function widget( $args, $instance ) {
      echo $args['before_widget']; // Whatever you want to display before widget (<div>, etc)

      if ( ! empty( $instance['title'] ) ) {
        echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
      }

      // Widget Content Output
      //ouput divs to be written over using main.js
      echo '
      <div id="weather-widget-wrap">
      <div id="cityname"></div>
      <div id="weather-widget-title"></div>
      <div id="temp"></div>
      <div id="weather-description"></div>
      <div id="forecast"></div>
      </div>
      ';


      //loads main.js
      wp_enqueue_script('weather-main-script', plugins_url(). '/weather-will-porter/js/main.js');

      //passes data to main.js file
      wp_localize_script( 'weather-main-script', 'data_passed', array(
                      "apiKey" => $instance['api-key'],
                      "weatherZip" => $instance['weather-zip'],
      ) );





      echo $args['after_widget']; // Whatever you want to display after widget (</div>, etc)
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
      $api_key = ! empty( $instance['api-key'] ) ? $instance['api-key'] : esc_html__( 'API Key', 'api_key' );

      $weather_zip = ! empty( $instance['weather-zip'] ) ? $instance['weather-zip'] : esc_html__( '', 'weather_zip' );

      ?>



      <!-- OPEN WEATHER API KEY FIELD IN WP ADMIN -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'api-key' ) ); ?>">
          <?php esc_attr_e( 'OPEN WEATHER API KEY:', 'api_key' ); ?>
        </label>

        <input
          class="widefat"
          id="<?php echo esc_attr( $this->get_field_id( 'api-key' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'api-key' ) ); ?>"
          type="text"
          value="<?php echo esc_attr( $api_key ); ?>">
      </p>

      <!-- ZIP CODE FOR WEATHER DATA IN WP ADMIN -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'weather-zip' ) ); ?>">
          <?php esc_attr_e( 'Zip Code for weather:', 'weather_zip' ); ?>
        </label>

        <input
          class="widefat"
          id="<?php echo esc_attr( $this->get_field_id( 'weather-zip' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'weather-zip' ) ); ?>"
          type="text"
          value="<?php echo esc_attr( $weather_zip ); ?>">
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
    public function update( $new_instance, $old_instance ) {
      $instance = array();

      $instance['api-key'] = ( ! empty( $new_instance['api-key'] ) ) ? strip_tags( $new_instance['api-key'] ) : '';

      $instance['weather-zip'] = ( ! empty( $new_instance['weather-zip'] ) ) ? strip_tags( $new_instance['weather-zip'] ) : '';

      return $instance;

    }

  }
