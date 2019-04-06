<?php
/**
 * Widget Name: Bean Portfolio Filter
 */

// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Bean_Portfolio_Filter_Widget' );
	}
);

class Bean_Portfolio_Filter_Widget extends WP_Widget {

	// Constructor
	function __construct() {
		parent::__construct(
			'bean_portfolio_filter', // Base ID
			__( 'Portfolio Filter', 'spaces' ), // Name
			array( 'description' => esc_html__( 'A filter for the portfolio templates.', 'spaces' ) ) // Args
		);
	}




	/*
	===================================================================*/
	/*
	  DISPLAY WIDGET
	/*===================================================================*/
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );

		// BEFORE WIDGET
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		// PULL CATEGORIES TO USE ON FILTER
		$terms = get_terms( 'portfolio_category' );
		?>

		<ul id="filter">
			<li><a href="#all" class="active" data-filter=".type-portfolio"><?php echo esc_html__( 'All', 'spaces' ); ?></a></li>
			<?php
			foreach ( $terms as $term ) {
				echo '<li><a href="' . get_term_link( $term ) . '" data-filter=".' . $term->term_id . '">' . $term->name . '</a></li>';
			}
			?>
		</ul>

		<script type="text/javascript">
			jQuery(document).ready(function($){
				if($('.portfolio').length){
					var filter = $('.widget_bean_portfolio_filter');
						themes = $('.grid');
					filter.find('#filter li a').on('click', function(){
						filter.find('#filter li a').removeClass('active');
						$(this).addClass('active');
						var selector = $(this).attr('data-filter');
						themes.find('.type-portfolio').addClass('inactive');
						themes.find(selector).removeClass('inactive');
						return false;
					});
				}
			});
		</script>

		<?php

		// AFTER WIDGET
		echo $after_widget;
	}




	/*
	===================================================================*/
	/*
	  UPDATE WIDGET
	/*===================================================================*/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// STRIP TAGS TO REMOVE HTML - IMPORTANT FOR TEXT IMPUTS
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}




	/*
	===================================================================*/
	/*
	  WIDGET SETTINGS (FRONT END PANEL)
	/*===================================================================*/
	function form( $instance ) {
		// WIDGET DEFAULTS
		$defaults = array(
			'title' => 'Filter',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'spaces' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

	<?php
	} // END FORM

} // END CLASS
?>
