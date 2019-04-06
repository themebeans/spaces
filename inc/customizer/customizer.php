<?php
/**
 * Theme Customizer functionality
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

/**
 * Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function spaces_customize_register( $wp_customize ) {

	/**
	 * Customize.
	 */
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector'        => '.site-title a',
			'settings'        => array( 'blogname' ),
			'render_callback' => 'spaces_customize_partial_blogname',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'spaces_customize_partial_blogdescription',
		)
	);

	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-title-control.php' );
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-range-control.php' );
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-toggle-control.php' );

	/**
	 * Top-Level Customizer sections and panels.
	 */
	$wp_customize->add_section(
		'spaces_theme_options', array(
			'title'    => esc_html__( 'Theme Options', 'spaces' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_section(
		'contact_settings', array(
			'title'    => esc_html__( 'Contact', 'spaces' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_section(
		'404_settings', array(
			'title'    => esc_html__( '404 & Coming Soon', 'spaces' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_section(
		'spaces_typography', array(
			'title'    => esc_html__( 'Typography', 'spaces' ),
			'priority' => 30,
		)
	);

	/**
	 * Add the site logo max-width options to the Site Identity section.
	 */
	$wp_customize->add_setting(
		'custom_logo_max_width', array(
			'default'           => 50,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_max_width', array(
				'default'     => 50,
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Max Width', 'spaces' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 8,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 300,
					'step' => 2,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'custom_logo_mobile_max_width', array(
			'default'           => 50,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_mobile_max_width', array(
				'default'     => 50,
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Mobile Max Width', 'spaces' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 9,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 200,
					'step' => 2,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'theme_style', array(
			'default' => 'theme_style_1',
		)
	);
	$wp_customize->add_control(
		'theme_style', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Theme Style', 'spaces' ),
			'description' => esc_html__( 'Select an alternate style for the theme.', 'spaces' ),
			'section'     => 'spaces_theme_options',
			'choices'     => array(
				'theme_style_1' => esc_html__( 'Mono', 'spaces' ),
				'theme_style_2' => esc_html__( 'Dark', 'spaces' ),
				'theme_style_3' => esc_html__( 'Clean', 'spaces' ),
				'theme_style_4' => esc_html__( 'Classic', 'spaces' ),
			),
		)
	);

	/**
	 * Header.
	 */
	$wp_customize->add_setting( 'header_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'header_title', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'Header', 'spaces' ),
				'section' => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'header_search', array(
			'default' => false,
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'header_search', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Search', 'spaces' ),
				'description' => esc_html__( 'Enable the header search field that appears next to the main menu.', 'spaces' ),
				'section'     => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'header_intro', array(
			'default' => esc_html__( 'A creative\'s dream theme featuring a classic minimal appeal & fully-featured portfolio to follow. Set up your professional portfolio effortlessly, with zero coding required.', 'spaces' ),
		)
	);

	$wp_customize->add_control(
		'header_intro', array(
			'type'    => 'textarea',
			'label'   => esc_html__( 'Tagline', 'spaces' ),
			'section' => 'spaces_theme_options',
		)
	);

	$wp_customize->add_setting(
		'header_style', array(
			'default' => 'header_style_1',
		)
	);

	$wp_customize->add_control(
		'header_style', array(
			'type'    => 'select',
			'label'   => esc_html__( 'Layout', 'spaces' ),
			'section' => 'spaces_theme_options',
			'choices' => array(
				'header_style_1' => esc_html__( 'Default', 'spaces' ),
				'header_style_2' => esc_html__( 'Centered', 'spaces' ),
			),
		)
	);

	/**
	 * Portfolio.
	 */
	$wp_customize->add_setting( 'portfolio_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'portfolio_title', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'Portfolio', 'spaces' ),
				'section' => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'portfolio_filter', array( 'default' => true )
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'portfolio_filter', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Porfolio Filter', 'spaces' ),
				'description' => esc_html__( 'The portfolio category filter on templates that support this feature.', 'spaces' ),
				'section'     => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'portfolio_likes', array( 'default' => true )
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'portfolio_likes', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Porfolio Likes', 'spaces' ),
				'description' => esc_html__( 'Enable portfolio likes to display on templates that support this feature.', 'spaces' ),
				'section'     => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'show_portfolio_sharing', array( 'default' => true )
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'show_portfolio_sharing', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Porfolio Sharing', 'spaces' ),
				'description' => esc_html__( 'Sharing sharing for portfolio layouts that support this feature.', 'spaces' ),
				'section'     => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'show_portfolio_loop_single', array( 'default' => true )
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'show_portfolio_loop_single', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Porfolio Single Loop', 'spaces' ),
				'description' => esc_html__( 'Display other portfolio posts on supported portfolio single posts.', 'spaces' ),
				'section'     => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'portfolio_more_loop', array( 'default' => 'more' )
	);

	$wp_customize->add_control(
		'portfolio_more_loop', array(
			'type'    => 'select',
			'section' => 'spaces_theme_options',
			'choices' => array(
				'more'    => 'All Posts',
				'related' => 'Related Posts',
			),
		)
	);

	$options_pages     = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = '';
	foreach ( $options_pages_obj as $page ) {
		$options_pages[ $page->ID ] = $page->post_title;
	}

	$wp_customize->add_setting( 'portfolio_page_selector' );
	$wp_customize->add_control(
		'portfolio_page_selector', array(
			'settings'    => 'portfolio_page_selector',
			'label'       => esc_html__( 'Portfolio Page', 'spaces' ),
			'description' => esc_html__( 'Select the portfolio page to feature on the pagination grid icon.', 'spaces' ),
			'section'     => 'spaces_theme_options',
			'type'        => 'select',
			'choices'     => $options_pages,
		)
	);

	$wp_customize->add_setting(
		'theme_version', array( 'default' => 'theme_version_std' )
	);

	$wp_customize->add_control(
		'theme_version', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Template Layout', 'spaces' ),
			'description' => esc_html__( 'The primary portfolio template layout. Override with templates assigned to pages.', 'spaces' ),
			'section'     => 'spaces_theme_options',

			'choices'     => array(
				'theme_version_carousel'     => esc_html__( 'Carousel', 'spaces' ),
				'theme_version_edge'         => esc_html__( 'Edge to Edge', 'spaces' ),
				'theme_version_fullscreen'   => esc_html__( 'Fullscreen', 'spaces' ),
				'theme_version_fullwidth'    => esc_html__( 'Fullwidth', 'spaces' ),
				'theme_version_grid'         => esc_html__( 'Gallery Grid', 'spaces' ),
				'theme_version_masonry'      => esc_html__( 'Masonry', 'spaces' ),
				'theme_version_masonry_full' => esc_html__( 'Masonry Fullwidth', 'spaces' ),
				'theme_version_std'          => esc_html__( 'Standard', 'spaces' ),
			),
		)
	);

	$wp_customize->add_setting(
		'portfolio_column_width', array( 'default' => 'col_std' )
	);

	$wp_customize->add_control(
		'portfolio_column_width', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Template Columns', 'spaces' ),
			'description' => esc_html__( 'Select a specific column grid that applies to portfolio grid templates.', 'spaces' ),
			'section'     => 'spaces_theme_options',
			'choices'     => array(
				'col_std' => esc_html__( 'Small Columns', 'spaces' ),
				'col4'    => esc_html__( 'Large Columns', 'spaces' ),
			),
		)
	);

	$wp_customize->add_setting(
		'portfolio_posts_count', array( 'default' => '-1' )
	);

	$wp_customize->add_control(
		'portfolio_posts_count', array(
			'label'       => esc_html__( 'Template Count', 'spaces' ),
			'description' => esc_html__( 'Select the number of portfolio posts to display intially on the portfolio templates.', 'spaces' ),
			'section'     => 'spaces_theme_options',
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting(
		'portfolio_loop_orderby', array( 'default' => 'date' )
	);

	$wp_customize->add_control(
		'portfolio_loop_orderby', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Template Order', 'spaces' ),
			'description' => esc_html__( 'Select the order in which portfolio posts should display on portfolio templates.', 'spaces' ),
			'section'     => 'spaces_theme_options',
			'choices'     => array(
				'date'       => esc_html__( 'Most Recent', 'spaces' ),
				'view_count' => esc_html__( 'Most Popular', 'spaces' ),
				'menu_order' => esc_html__( 'Sort Order', 'spaces' ),
			),
		)
	);

	$wp_customize->add_setting( 'portfolio_css_filter', array( 'default' => 'none' ) );
	$wp_customize->add_control(
		'portfolio_css_filter', array(
			'type'        => 'select',
			'label'       => esc_html__( 'CSS3 Filter', 'spaces' ),
			'description' => esc_html__( 'Set a custom filter to stylize your portfolio.', 'spaces' ),
			'section'     => 'spaces_theme_options',
			'choices'     => array(
				'none'       => 'None',
				'grayscale'  => 'Black & White',
				'sepia'      => 'Sepia Tone',
				'saturation' => 'High Saturation',
			),
		)
	);

	/**
	 * Blog.
	 */
	$wp_customize->add_setting( 'blog_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'blog_title', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'Blog', 'spaces' ),
				'section' => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'hidden_sidebar', array(
			'default' => false,
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'hidden_sidebar', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Hidden Sidebar', 'spaces' ),
				'description' => esc_html__( 'Enable the hidden sidebar that appears at the right of each page.', 'spaces' ),
				'section'     => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'post_likes', array(
			'default' => false,
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'post_likes', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Post Likes', 'spaces' ),
				'description' => esc_html__( 'Enable post likes to display on each post.', 'spaces' ),
				'section'     => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'post_sharing', array(
			'default' => false,
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'post_sharing', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Post Sharing', 'spaces' ),
				'description' => esc_html__( 'Enable the post sharing elements to display on the blog post view.', 'spaces' ),
				'section'     => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'about_author', array(
			'default' => false,
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'about_author', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Author Info', 'spaces' ),
				'description' => esc_html__( 'Enable the author metadata that displays on the blog post view.', 'spaces' ),
				'section'     => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'reveal_content', array(
			'default' => false,
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'reveal_content', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Post Content Reveal', 'spaces' ),
				'description' => esc_html__( 'Hide author and comments behind buttons located below the post.', 'spaces' ),
				'section'     => 'spaces_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'twitter_profile', array(
			'default' => '',
		)
	);

	$wp_customize->add_control(
		'twitter_profile', array(
			'label'       => esc_html__( 'Twitter Username', 'spaces' ),
			'description' => esc_html__( 'Add your Twitter handle (without the "@") to append to the Twitter share link.', 'spaces' ),
			'section'     => 'spaces_theme_options',
			'type'        => 'text',
		)
	);

	/**
	 * Footer.
	 */
	$wp_customize->add_setting( 'footer_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'footer_title', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'Footer', 'spaces' ),
				'section' => 'spaces_theme_options',
			)
		)
	);
	$wp_customize->add_setting(
		'footer_copyright', array(
			'default' => '',
		)
	);

	$wp_customize->add_control(
		'footer_copyright', array(
			'type'    => 'textarea',
			'label'   => esc_html__( 'Copyright', 'spaces' ),
			'section' => 'spaces_theme_options',
		)
	);

	/**
	 * Contact.
	 */
	$wp_customize->add_setting( 'bean_contact_form', array( 'default' => false ) );
	$wp_customize->add_control(
		'bean_contact_form', array(
			'type'    => 'checkbox',
			'label'   => 'Use Default Contact Form',
			'section' => 'contact_settings',
		)
	);

	$wp_customize->add_setting( 'admin_custom_email', array( 'default' => '' ) );
	$wp_customize->add_control(
		'admin_custom_email', array(
			'label'   => esc_html__( 'Contact Form Email', 'spaces' ),
			'section' => 'contact_settings',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting( 'contact_button_text', array( 'default' => 'Send Message' ) );
	$wp_customize->add_control(
		'contact_button_text', array(
			'label'     => esc_html__( 'Contact Button Text', 'spaces' ),
			'section'   => 'contact_settings',
			'transport' => 'postMessage',
			'type'      => 'text',
		)
	);

	$wp_customize->add_setting( 'google_maps_code', array( 'default' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3022.6150171700842!2d-73.985596!3d40.748495999999996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire+State+Building!5e0!3m2!1sen!2sus!4v1398365535004" width="600" height="450" frameborder="0" style="border:0"></iframe>' ) );
	$wp_customize->add_control(
		'google_maps_code', array(
			'type'    => 'textarea',
			'label'   => esc_html__( 'Google Maps Code', 'spaces' ),
			'section' => 'contact_settings',
		)
	);

	$wp_customize->add_setting( '404-img-upload', array() );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, '404-img-upload', array(
				'label'    => esc_html__( '404 Custom Image', 'spaces' ),
				'section'  => '404_settings',
				'settings' => '404-img-upload',
			)
		)
	);

	$wp_customize->add_setting( 'error_text', array( 'default' => '' ) );
	$wp_customize->add_control(
		'error_text',
		array(
			'label'   => esc_html__( '404 Text', 'spaces' ),
			'section' => '404_settings',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting( 'comingsoon_year', array( 'default' => '' ) );
	$wp_customize->add_control(
		'comingsoon_year',
		array(
			'label'   => esc_html__( 'Year (ex: 2014)', 'spaces' ),
			'section' => '404_settings',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting( 'comingsoon_month', array( 'default' => '' ) );
	$wp_customize->add_control(
		'comingsoon_month',
		array(
			'label'   => esc_html__( 'Month (ex: 01 for JAN)', 'spaces' ),
			'section' => '404_settings',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting( 'comingsoon_day', array( 'default' => '' ) );
	$wp_customize->add_control(
		'comingsoon_day',
		array(
			'label'   => esc_html__( 'Day (ex: 01)', 'spaces' ),
			'section' => '404_settings',
			'type'    => 'text',
		)
	);

	/**
	 * Colors.
	 */
	$wp_customize->add_setting(
		'wrapper_background_color', array(
			'default' => '#FFF',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'wrapper_background_color', array(
				'label'    => esc_html__( 'Background', 'spaces' ),
				'section'  => 'colors',
				'settings' => 'wrapper_background_color',
			)
		)
	);

	$wp_customize->add_setting(
		'theme_accent_color', array(
			'default' => '#1AA8D8',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'theme_accent_color', array(
				'label'    => esc_html__( 'Accent Color', 'spaces' ),
				'section'  => 'colors',
				'settings' => 'theme_accent_color',
			)
		)
	);

	/**
	 * Typography.
	 */

	$fonts = spaces_fonts();

	$font_size_range          = array(
		'min'  => '10',
		'max'  => '80',
		'step' => '1',
	);
	$font_lineheight_range    = array(
		'min'  => '10',
		'max'  => '80',
		'step' => '1',
	);
	$font_letterspacing_range = array(
		'min'  => '-5',
		'max'  => '20',
		'step' => '1',
	);

	$wp_customize->add_setting( 'logo_font_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'logo_font_title', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'Logo', 'spaces' ),
				'section' => 'spaces_typography',
			)
		)
	);

	$wp_customize->add_setting( 'type_select_logo', array( 'default' => 'Courier' ) );
	$wp_customize->add_control(
		'type_select_logo', array(
			'type'    => 'select',
			'label'   => esc_html__( 'Font', 'spaces' ),
			'section' => 'spaces_typography',
			'choices' => $fonts,
		)
	);

	$wp_customize->add_setting(
		'type_slider_logo_size', array(
			'default'           => '22',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'type_slider_logo_size', array(
				'default'     => '22',
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Font Size', 'spaces' ),
				'description' => 'px',
				'section'     => 'spaces_typography',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 80,
					'step' => 1,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'type_slider_logo_lineheight', array(
			'default'           => '30',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'type_slider_logo_lineheight', array(
				'default'     => '30',
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Line Height', 'spaces' ),
				'description' => 'px',
				'section'     => 'spaces_typography',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 80,
					'step' => 1,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'type_slider_logo_letterspacing', array(
			'default'           => '0',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'type_slider_logo_letterspacing', array(
				'default'     => '0',
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Logo Letter Spacing', 'spaces' ),
				'description' => 'px',
				'section'     => 'spaces_typography',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 20,
					'step' => 1,
				),
			)
		)
	);

	$wp_customize->add_setting( 'theme_fonts_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'theme_fonts_title', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'Theme Fonts', 'spaces' ),
				'section' => 'spaces_typography',
			)
		)
	);

	$wp_customize->add_setting( 'type_select_primary_headings', array( 'default' => 'Courier' ) );
	$wp_customize->add_control(
		'type_select_primary_headings', array(
			'type'    => 'select',
			'label'   => esc_html__( 'Primary Header', 'spaces' ),
			'section' => 'spaces_typography',
			'choices' => $fonts,
		)
	);

	$wp_customize->add_setting( 'type_select_secondary_headings', array( 'default' => 'Helvetica' ) );
	$wp_customize->add_control(
		'type_select_secondary_headings', array(
			'type'    => 'select',
			'label'   => esc_html__( 'Secondary Header', 'spaces' ),
			'section' => 'spaces_typography',
			'choices' => $fonts,
		)
	);

	$wp_customize->add_setting( 'type_select_body', array( 'default' => 'Courier' ) );
	$wp_customize->add_control(
		'type_select_body', array(
			'type'    => 'select',
			'label'   => esc_html__( 'Body', 'spaces' ),
			'section' => 'spaces_typography',
			'choices' => $fonts,
		)
	);
}
add_action( 'customize_register', 'spaces_customize_register', 11 );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function spaces_customize_preview_js() {
	wp_enqueue_script( 'spaces-customize-preview', get_theme_file_uri( '/assets/js/admin/customize-preview' . SPACES_ASSET_SUFFIX . '.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'spaces_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function spaces_customize_controls_js() {
	wp_enqueue_script( 'spaces-customize-controls', get_theme_file_uri( '/assets/js/admin/customize-controls' . SPACES_ASSET_SUFFIX . '.js' ), array( 'customize-controls' ), '@@pkg.version', true );
}
add_action( 'customize_controls_enqueue_scripts', 'spaces_customize_controls_js' );

/**
 * CSS to make the Customizer controls look a bit better.
 */
function spaces_customize_controls_css() {
	wp_enqueue_style( 'spaces-customize-preview', get_theme_file_uri( '/assets/css/customize-controls' . SPACES_ASSET_SUFFIX . '.css' ), '@@pkg.version', true );
}
add_action( 'customize_controls_print_styles', 'spaces_customize_controls_css' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @see spaces_customize_register()
 *
 * @return void
 */
function spaces_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @see spaces_customize_register()
 *
 * @return void
 */
function spaces_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
