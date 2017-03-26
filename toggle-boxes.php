<?php
/*
Plugin Name: Toggle Boxes
Description: Simple jQuery Toggle Boxes. Use this shortcode format: [toggle title="Your Title Here"] Your Content Here [/toggle]
Author: Chris Liu-Beers &middot; Tomatillo Design
Author URI: http://www.tomatillodesign.com
Version: 1.1
*/

// Add Shortcode
function clb_toggle_box( $atts , $content = null ) {

	$toggle_boxes_background_color = get_option( 'toggle_boxes_background_color' );
	$toggle_boxes_foreground_color = get_option( 'toggle_boxes_foreground_color' );

	// Attributes
	$atts = shortcode_atts(
		array(
			'title' => 'Title_Here',
		),
		$atts
	);

     $output = '<div class="clb-toggle state-closed "><h3 class="clb-toggle-trigger "  style="background: ' . $toggle_boxes_background_color . '; color: ' . $toggle_boxes_foreground_color . '">' . $atts['title'] .'</h3><div class="clb-toggle-container symple-clearfix">' . $content . '</div></div>';
        return $output;

}
add_shortcode( 'toggle', 'clb_toggle_box' );




/**
 * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
 */
add_action( 'wp_enqueue_scripts', 'toggle_stylesheet' );

/**
 * Enqueue plugin style-file
 */
function toggle_stylesheet() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'clb-style', plugins_url('css/style.css', __FILE__) );
    wp_enqueue_style( 'clb-style' );
}


/**
 * Include jQuery file
 */
function toggle_scripts() {
    wp_register_script( 'clb-jquery',  plugin_dir_url( __FILE__ ) . 'js/toggle.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'clb-jquery' );
}
add_action( 'wp_enqueue_scripts', 'toggle_scripts' );




add_action( 'wp_enqueue_scripts', 'mytheme_scripts' );
/**
 * Enqueue Dashicons style for frontend use
 */
function mytheme_scripts() {
	wp_enqueue_style( 'dashicons' );
}






// CREATE the Admin Settings Page to add custom Background Color, saved in wp_options
function add_theme_menu_item()
{
	add_submenu_page('options-general.php', "Toggle Settings", "Toggle Settings", "manage_options", "toggle-settings", "toggle_settings_page", 99);
}

add_action("admin_menu", "add_theme_menu_item");


function toggle_settings_page()
{
    ?>
	    <div class="wrap">
	    <h1>Toggle Boxes Settings</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");
	            submit_button();
	        ?>
	    </form>
		</div>
	<?php
}

function toggle_boxes_background_color()
{
	?>
    	<input type="text" name="toggle_boxes_background_color" id="toggle_boxes_background_color" value="<?php echo get_option('toggle_boxes_background_color'); ?>" />
    <?php
}

function toggle_boxes_foreground_color()
{
	?>
    	<input type="text" name="toggle_boxes_foreground_color" id="toggle_boxes_foreground_color" value="<?php echo get_option('toggle_boxes_foreground_color'); ?>" />
    <?php
}

function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "theme-options");
	add_settings_field("toggle_boxes_background_color", "Toggle Background Color (HEX)", "toggle_boxes_background_color", "theme-options", "section");
	register_setting("section", "toggle_boxes_background_color");

	add_settings_field("toggle_boxes_foreground_color", "Toggle Foreground Color (HEX)", "toggle_boxes_foreground_color", "theme-options", "section");
	register_setting("section", "toggle_boxes_foreground_color");
}

add_action("admin_init", "display_theme_panel_fields");






add_action('genesis_entry_content', 'clb_test', 8);
function clb_test() {

	$option = get_option( 'twitter_url' );
	$option_publish = $option;

	echo '<h2>' . $option_publish . '</h2>';

}
