<?php
/**
 * Theme Functions 
 */
 
// Enqueue scripts and styles
// Includes custom enqueue of old assets for college theme home page
function gs_theme_transition_enqueue() {
	if ( is_page_template( 'page-old-college-home.php' ) ) {  
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('jquery-ui-tabs');	
		wp_enqueue_script('jquery-effects-core');
		wp_enqueue_style('plugin-styles', network_site_url() . 'web_templates/CORE/css/plugins.css', false, null,'all');
		wp_enqueue_style('skeleton-framework', network_site_url() . '/web_templates/CORE/css/framework.css', false, null,'all');
		wp_enqueue_style('bootstrap-nav', network_site_url() . 'web_templates/bootstrap/css/nav.css', false, null,'all');
		wp_enqueue_style('global-nav', network_site_url() . 'web_templates/CORE/css/wp/global-nav.css', false, null,'all');
		wp_enqueue_style('global-styles', network_site_url() . 'web_templates/CORE/css/wp/styles.min.css', false, null,'all');
		wp_enqueue_style('responsive-styles', network_site_url() . 'web_templates/CORE/css/wp/responsive.min.css', false, null,'all');
		wp_enqueue_style('print-styles', network_site_url() . 'web_templates/CORE/css/wp/print.css', false, null,'print');		
		wp_enqueue_style('responsive-college', network_site_url() . 'web_templates/CORE/css/wp/responsive-college.css', false, null,'all');	
		wp_enqueue_script('bootstrap-navjs', network_site_url() . 'web_templates/bootstrap/js/nav.js', array( 'jquery' ), null, true);
		wp_enqueue_script('plugins', network_site_url() . 'web_templates/CORE/js/plugins.js', array( 'jquery' ), null, true);
		wp_enqueue_script('custom-scripts', network_site_url() . 'web_templates/CORE/js/custom-ui-scripts.js', array( 'jquery' ), null, true);
	}
	else {
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('jquery-ui-tabs');		
		wp_enqueue_script('bootstrap' , 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true);
		wp_enqueue_style('bootstrap-styles' , 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', false, null);	
		wp_enqueue_script('plugins', network_site_url() . 'web_templates/global/js/plugins.js', array( 'jquery' ), null, true);	
		wp_enqueue_script('global-scripts' , network_site_url() . 'web_templates/global/js/gs-custom-ui.js', array( 'jquery' ), null, true);
		wp_enqueue_script('lightbox', '//cdn.georgiasouthern.edu/js/plugin-lightbox.min.js', array( 'jquery' ), null, true);	
		wp_enqueue_style('global-styles' , network_site_url() . 'web_templates/global/css/global.min.css', false, null);
		wp_enqueue_style('cms-theme-styles' , network_site_url() . 'web_templates/global/css/themes.min.css', false, null);
		wp_enqueue_style('plugin-styles' , network_site_url() . 'web_templates/global/css/plugins.css', false, null);
		wp_enqueue_style('local-styles' , get_template_directory_uri() . '/style.css', false, null);
		wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/3c484262c3.js', false, null);
	}
}
add_action('wp_enqueue_scripts', 'gs_theme_transition_enqueue');

/* Enqueue for after old college home page discontinued
function add_custom_assets() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-effects-core');
	wp_enqueue_script('bootstrap' , 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true);
	wp_enqueue_style('bootstrap-styles' , 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', false, null);	
	wp_enqueue_script('plugins', network_site_url() . 'web_templates/global/js/plugins.js', array( 'jquery' ), null, true);	
	wp_enqueue_script('global-scripts' , network_site_url() . 'web_templates/global/js/gs-custom-ui.js', array( 'jquery' ), null, true);
	wp_enqueue_script('lightbox', '//cdn.georgiasouthern.edu/js/plugin-lightbox.min.js', array( 'jquery' ), null, true);	
	wp_enqueue_style('global-styles' , network_site_url() . 'web_templates/global/css/global.min.css', false, null);
	wp_enqueue_style('cms-theme-styles' , network_site_url() . 'web_templates/global/css/styles.min.css', false, null);
	wp_enqueue_style('plugin-styles' , network_site_url() . 'web_templates/global/css/plugins.css', false, null);
	wp_enqueue_style('local-styles' , get_template_directory_uri() . '/style.css', false, null);
	wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/3c484262c3.js', false, null);
}
add_action('wp_enqueue_scripts', 'add_custom_assets');
*/

// Remove wp version, api, xmlrpc and wlwmanifest links in meta
remove_action( 'wp_head', 'wp_generator');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );

// On login screen, replaces WP logo with Georgia Southern logo
add_action("login_head", "custom_login_logo");

function custom_login_logo() {
	echo "
	<style>
	body.login #login h1 a {
		background: url('https://cdn.georgiasouthern.edu/logos/eGSlogo-Eagle-Head-sm.png') no-repeat scroll center top transparent;
		height: 150px;
		width: 150px;
		margin: 0 auto;
	}	
	</style>
	";
}

// Add Pages, Remove News Access for Author Role
function gsu_author_caps() {
	$role = get_role( 'author' );
	$role->add_cap( 'unfiltered_html' );  
	$role->add_cap( 'edit_pages' );
	$role->add_cap( 'publish_pages' );
	$role->add_cap( 'edit_published_pages' );
	$role->add_cap( 'delete_published_pages' );
	$role->remove_cap( 'edit_posts' );
	$role->remove_cap( 'edit_published_posts' ); 
	$role->remove_cap( 'publish_posts' ); 
	$role->remove_cap( 'delete_published_posts' );
	$role->remove_cap( 'delete_posts' ); 
}
add_action( 'admin_menu', 'gsu_author_caps');

//Add Media Library and additional Posts capabilities to Contributor Role
function gsu_contributor_caps() {
	$role = get_role( 'contributor' );
	$role->add_cap( 'unfiltered_html' ); 
	$role->add_cap( 'edit_others_posts' );
	$role->add_cap( 'edit_published_posts' ); 
	$role->add_cap( 'upload_files' ); 
	$role->add_cap( 'publish_posts' ); 
	$role->add_cap( 'delete_published_posts' );
	$role->add_cap( 'manage_categories' );
}
add_action( 'admin_menu', 'gsu_contributor_caps');

// Restrict Site Admin Access
function gsu_admin_caps() {
	$role = get_role( 'administrator' );
	$role->add_cap( 'unfiltered_html' );   
	$role->remove_cap( 'activate_plugins' );
	$role->remove_cap( 'delete_plugins' );
	$role->remove_cap( 'delete_themes' );
	$role->remove_cap( 'edit_plugins' );
	$role->remove_cap( 'edit_themes' );
	$role->remove_cap( 'import' );
	$role->remove_cap( 'install_plugins' );
	$role->remove_cap( 'install_themes' );
	$role->remove_cap( 'switch_themes' );
	$role->remove_cap( 'update_core' );
	$role->remove_cap( 'update_plugins' );
	$role->remove_cap( 'update_themes' );
	$role->remove_cap( 'manage_sites' );
	$role->remove_cap( 'manage_options' );
	$role->remove_cap( 'remove_users' );
}
add_action( 'admin_menu', 'gsu_admin_caps');

// Remove News from menu for Authors
function remove_adminmenus_for_author() {
	global $menu;
	if(!current_user_can( 'edit_posts' )) {	
	remove_menu_page( 'edit.php' );
	}
}
add_action( 'admin_menu', 'remove_adminmenus_for_author' );

// Register nav menus
add_action('init', 'register_custom_menu');
 
function register_custom_menu() {
	register_nav_menu('local_navigation', 'Primary Navigation');
}
// Register custom navigation walker
    require_once('wp_bootstrap_navwalker.php');

// Add Custom Header support
function custom_header_support() {
  /* Font Sizes */
  add_theme_support( 'editor-font-sizes', array(
      array(
          'name' => __( 'Small', 'themeLangDomain' ),
          'size' => 11,
          'slug' => 'small'
      ),
      array(
          'name' => __( 'Normal', 'themeLangDomain' ),
          'size' => 13,
          'slug' => 'normal'
      ),
      array(
          'name' => __( 'Large', 'themeLangDomain' ),
          'size' => 18,
          'slug' => 'large'
      )
  ) );

  /* Color Blocks */
  add_theme_support( 'editor-color-palette', array(
      array(
          'name' => __( 'white', 'themeLangDomain' ),
          'slug' => 'white',
          'color' => '#ffffff',
      ),
      array(
          'name' => __( 'off-white', 'themeLangDomain' ),
          'slug' => 'off-white',
          'color' => '#f7f7f7',
      ),
      array(
          'name' => __( 'black', 'themeLangDomain' ),
          'slug' => 'black',
          'color' => '#000000',
      ),
      array(
          'name' => __( 'medium gray', 'themeLangDomain' ),
          'slug' => 'medium-gray',
          'color' => '#dddddd',
      ),
      array(
          'name' => __( 'light gray', 'themeLangDomain' ),
          'slug' => 'light-gray',
          'color' => '#e4e4e4',
      ),
      array(
          'name' => __( 'blue', 'themeLangDomain' ),
          'slug' => 'blue',
          'color' => '#041e42',
      ),
      array(
          'name' => __( 'aqua', 'themeLangDomain' ),
          'slug' => 'aqua',
          'color' => '#00679a',
      ),
      array(
          'name' => __( 'gold', 'themeLangDomain' ),
          'slug' => 'gold',
          'color' => '#a99260',
      ),
      array(
          'name' => __( 'gold fade', 'themeLangDomain' ),
          'slug' => 'gold-fade',
          'color' => '#e9e4da',
      ),
  ) );
}
add_action( 'after_setup_theme', 'custom_header_support' );

// Register Sidebars
add_action( 'widgets_init' , 'register_custom_sidebars' );

function register_custom_sidebars() {
register_sidebar(array(
  'name' => __( 'Sidebar' ),
  'id' => 'right-sidebar',
  'description' => __( 'Primary sidebar on all inside pages.' ),
  'before_widget' => '<div class="widget">',
  'after_widget'  => '</div>',
  'before_title' => '<h6 class="title">',
  'after_title' => '</h6>'
));

register_sidebar(array(
  'name' => __( 'Footer' ),
  'id' => 'dept-footer',
  'description' => __( 'Footer content.' ),
  'before_widget' => '',
  'after_widget'  => '',
  'before_title' => '',
  'after_title' => ''
));

register_sidebar(array(
  'name' => __( 'Home Bottom Left' ),
  'id' => 'home-bottom-left',
  'description' => __( 'Optional - Widget will display when the Page with 3 Bottom Widgets template is used.' ),
  'before_widget' => '<div class="bottom-widget %2$s">',
  'after_widget'  => '</div>',
  'before_title' => '<h6>',
  'after_title' => '</h6>'
));

register_sidebar(array(
  'name' => __( 'Home Bottom Middle' ),
  'id' => 'home-bottom-middle',
  'description' => __( 'Optional - Widget will display when the Page with 3 Bottom Widgets template is used.' ),
  'before_widget' => '<div class="bottom-widget %2$s">',
  'after_widget'  => '</div>',
  'before_title' => '<h6>',
  'after_title' => '</h6>'
));

register_sidebar(array(
  'name' => __( 'Home Bottom Right' ),
  'id' => 'home-bottom-right',
  'description' => __( 'Optional - Widget will display when the Page with 3 Bottom Widgets template is used.' ),
  'before_widget' => '<div class="bottom-widget %2$s">',
  'after_widget'  => '</div>',
  'before_title' => '<h6>',
  'after_title' => '</h6>'
));

}

// Custom WordPress Admin Footer
function remove_footer_admin () {
	echo 'Theme Copyright &copy; 2019 University Web Team, Georgia Southern University';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Customize wp admin bar
function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('about');
	$wp_admin_bar->remove_menu('wporg');
	$wp_admin_bar->remove_menu('documentation');
	$wp_admin_bar->remove_menu('support-forums');
	$wp_admin_bar->remove_menu('feedback');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('updates');
	$wp_admin_bar->remove_menu('new-link');
	$wp_admin_bar->remove_menu('new-user');
	$wp_admin_bar->remove_menu('new-media');
	$wp_admin_bar->remove_menu('w3tc');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

// Customize tinymce editor
function customize_mce_buttons($init) {
	$init['toolbar1'] = 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,alignjustify,link,unlink,wp_more,spellchecker,fullscreen,wp_adv,bootstrapshortcode';
	$init['toolbar2'] = 'formatselect,pastetext,removeformat,charmap,superscript,subscript,outdent,indent,undo,redo,table,wp_help';
	$init['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6";
	return $init;
}
add_filter('tiny_mce_before_init', 'customize_mce_buttons');

// REMOVE LINKS, COMMENTS FROM ADMIN PANEL
function gsudept_remove_menu_pages() {		
		remove_menu_page('edit-comments.php');
		remove_menu_page('link-manager.php');		
		//remove_menu_page('users.php');
		//remove_menu_page('options-writing.php');
		//remove_menu_page('options-reading.php');
		//remove_menu_page('options-discussion.php');
		//remove_menu_page('options-privacy.php');
		//remove_menu_page('options-permalinks.php');
		//remove_menu_page('import.php');
		//remove_menu_page('upload.php');
		//remove_menu_page('tools.php');
		//remove_menu_page('options-general.php');
	}
add_action( 'admin_menu', 'gsudept_remove_menu_pages' );

// Removes unnecessary widgets from Appearance-->Widgets menu
function remove_wp_widgets() {
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Tag_Cloud');
	//unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Recent_Comments');
	//unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('WP_Widget_Links');
	}
add_action('widgets_init','remove_wp_widgets', 1);
remove_action( 'widgets_init', 'akismet_register_widgets' );

// ADD CUSTOM OPTIONS TO GENERAL SETTINGS PANEL
$new_general_setting = new new_general_setting();
 
class new_general_setting {
    function __construct( ) {
        add_filter( 'admin_menu' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'parent_college', 'esc_attr' );
        add_settings_field('parent_college', '<label for="parent_college">'.__('College' , 'parent_college' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'parent_college', '' );
        echo '<input type="text" id="parent_college" name="parent_college" value="' . $value . '" />';
    }
}

// CHANGE POSTS TO NEWS
function change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0] = 'News';
	$submenu['edit.php'][10][0] = 'Add News';	
	echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );
function change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'News';
	$labels->singular_name = 'News';
	$labels->add_new = 'Add News';
	$labels->add_new_item = 'Add News';
	$labels->edit_item = 'Edit News';
	$labels->new_item = 'News';
	$labels->view_item = 'View News';
	$labels->search_items = 'Search News';
	$labels->not_found = 'No News found';
	$labels->not_found_in_trash = 'No News found in Trash';
}
add_action( 'init', 'change_post_object_label' );
    
// CUSTOM SHORTCODES
function floatlist_shortcode( $atts, $content = null ) {
   return '<div class="floatleft">' . $content . '</div>';
}
add_shortcode( 'floatlist', 'floatlist_shortcode' );

function accordion_heading_shortcode( $atts, $content = null ) {
   return '<h6 class="btn_toggle">' . $content . '</h6>';
}
add_shortcode( 'accordion_heading', 'accordion_heading_shortcode' );

function accordion_content_shortcode( $atts, $content = null ) {
   return '<div class="slide_toggle">' . $content . '</div>';
}
add_shortcode( 'accordion_content', 'accordion_content_shortcode' );

function gsuslideshow_shortcode( $atts, $content = null ) {
   return '<div id="cycle">' . $content . '</div>';
}
add_shortcode( 'gsuslideshow', 'gsuslideshow_shortcode' );

function gstestimonial_shortcode( $atts, $content = null ) {
   return '<div class="testimonial"><p>' . do_shortcode($content) . '</p></div>';
}
add_shortcode( 'testimonial', 'gstestimonial_shortcode' );

function gstestimonial_author_shortcode( $atts, $content = null ) {
   return '<span class="author">' . $content . '</span>';
}
add_shortcode( 'author', 'gstestimonial_author_shortcode' );

add_filter('widget_text', 'do_shortcode'); //enable shortcode use in sidebar widgets

// remove version info from head and feeds
add_filter('the_generator', 'digwp_complete_version_removal');
function digwp_complete_version_removal() {
    return '';
}

// clear rss widget cache every 15 mins
//add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return 900;' ) );
add_filter('wp_feed_cache_transient_lifetime', 'clear_cache');
function clear_cache(){
		return 900;
	}

// 3/30/16 - RHickey, fix to resolve issue introduced in WP 4.4.2 with URL used for img srcset attributes
// In SSL, force URLs in srcset attributes to use https. 
// This prevents mixed content errors when displaying content on secure sites, i.e., on MyGS or when users are logged in to WordPress admin. 

function ssl_srcset( $sources ) {
  if(is_ssl()) {
	  foreach ( $sources as &$source ) {
		$source['url'] = set_url_scheme( $source['url'], 'https' );
	}
  }
  return $sources;
}
add_filter( 'wp_calculate_image_srcset', 'ssl_srcset' );

// Track user last login time 
add_action('wp_login','wpdb_capture_user_last_login', 10, 2);
function wpdb_capture_user_last_login($user_login, $user){
    update_user_meta($user->ID, 'last_login', current_time('mysql'));
}

// Display user last login time in WP Admin
add_filter( 'manage_users_columns', 'wpdb_user_last_login_column');
function wpdb_user_last_login_column($columns){
    $columns['lastlogin'] = __('Last Login', 'lastlogin');
    return $columns;
}
 
add_action( 'manage_users_custom_column',  'wpdb_add_user_last_login_column', 10, 3); 
function wpdb_add_user_last_login_column($value, $column_name, $user_id ) {
    if ( 'lastlogin' != $column_name )
        return $value;
 
    return get_user_last_login($user_id,false);
}

function get_user_last_login($user_id,$echo = true){
    $date_format = get_option('date_format') . ' ' . get_option('time_format');
    $last_login = get_user_meta($user_id, 'last_login', true);
    $login_time = 'Never logged in';
    if(!empty($last_login)){
       if(is_array($last_login)){
            $login_time = mysql2date($date_format, array_pop($last_login), false);
        }
        else{
            $login_time = mysql2date($date_format, $last_login, false);
        }
    }
    if($echo){
        echo $login_time;
    }
    else{
        return $login_time;
    }
}
