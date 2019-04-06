<?php
/**
 * The file for displaying the more portfolio loop below the portfolio single.
 * It is called via the single-portfolio.php.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

// PULL CATEGORIES TO USE ON FILTER
$terms = get_terms( 'portfolio_category' );
?>


<ul id="filter" class="sf-menu">
<li><a href="#all" data-filter=".type-portfolio"><?php echo esc_html__( 'Filter', 'spaces' ); ?></a>
<ul class="sub-menu">
	 <li><a href="#all" class="active" data-filter=".type-portfolio"><?php echo esc_html__( 'All', 'spaces' ); ?></a></li>
		<?php
		foreach ( $terms as $term ) {
			echo '<li><a href="javascript:void(0);" data-filter=".' . $term->term_id . '">' . $term->name . '</a></li>';
		}
		?>
</ul>
<li>
</ul>

<script type="text/javascript">
	 jQuery(document).ready(function($){
		  if($('.portfolio').length){
			   var filter = $('header');
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
