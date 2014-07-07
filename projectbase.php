<?php
/*
Plugin Name: Gallery Demo Site
Plugin URI: http://www.greenboxindonesia.com/
Description: Management Website Base and Demo Link
Version: 1.0
Author: Albert Sukmono
Author URI: http://www.albert.sukmono.web.id
License: GPLv2
*/

add_action( 'init', 'create_projectbase' );

function create_projectbase() {
register_post_type( 'projectbase',
array(
	'labels' => array(
	'name' => 'Projectbase',
	'singular_name' => 'Projectbase',
	'add_new' => 'Add New',
	'add_new_item' => 'Add Projectbase',
	'edit' => 'Edit',
	'edit_item' => 'Edit Projectbase',
	'new_item' => 'New Projectbase',
	'view' => 'View',
	'view_item' => 'View Projectbase',
	'search_items' => 'Search Projectbase',
	'not_found' => 'No Projectbase found',
	'not_found_in_trash' =>
	'No Projectbase found in Trash',
	'parent' => 'Parent Projectbase'
	),

	'public' => true,
	'publicly_queryable' => true,
	'rewrite' => array( 'slug' => 'projectbase/item','with_front' => false, 'hierarchical' => true),
	'show_ui' => true,
	'query_var' => true,
	'capability_type' => 'post',
	'menu_position' => 5,
	'supports' => array( 'title', 'editor', 'comments',	'thumbnail' ),
	'taxonomies' => array( 'projectbase_archive'),
	'register_meta_box_cb' => 'projectbase_meta_box',
	'menu_icon' => plugins_url( 'asset/favicon.png', __FILE__ ),
	'has_archive' => true	
)
);
flush_rewrite_rules();
}

/*
 * create taxonomy
 */
// hook into the init action and call create_staff_taxonomies when it fires
add_action( 'init', 'projectbase_taxonomies', 0 );
// create for the post type "projectbase"
function projectbase_taxonomies() {
    $labels = array(
        'name'              => _x( 'Projectbase Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Projectbase Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite' 			=> array( 'slug' => 'projectbase/arsip', 'with_front' => true ),
		'has_archive' 		=> true
    );

    register_taxonomy( 'projectbase_categories', array( 'projectbase' ), $args );
}

/*
 * create metabox
 */
add_action( 'admin_init', 'projectbase_admin' );

function projectbase_admin() {
add_meta_box( 
	'projectbase_meta_box',
	'Projectbase Details',
	'display_projectbase_meta_box',
	'projectbase', 'normal', 'high' 
	);
}

function display_projectbase_meta_box( $projectbase ) {
// metabox list
$customer = esc_html( get_post_meta( $projectbase->ID, 'customer', true ) );
$webclass = esc_html( get_post_meta( $projectbase->ID, 'webclass', true ) );
$website = esc_html( get_post_meta( $projectbase->ID, 'website', true ) );
?>
<table>
	<tr>
		<td style="width: 100%">Customer</td>
		<td><input type="text" size="80" name="projectbase_customer" value="<?php echo $customer; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 100%">Webclass</td>
		<td><input type="text" size="80" name="projectbase_webclass" value="<?php echo $webclass; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 100%">URL Demo</td>
		<td><input type="text" size="80" name="projectbase_website" value="<?php echo $website; ?>" /></td>
	</tr>
</table>
<?php }

add_action( 'save_post',
'add_projectbase_fields', 10, 2 );

function add_projectbase_fields( $projectbase_id,
$projectbase ) {
// Check post type for User Profile
if ( $projectbase->post_type == 'projectbase' ) {
// Store data in post meta table if present in post data

if ( isset( $_POST['projectbase_customer'] ) &&
$_POST['projectbase_customer'] != '' ) {
update_post_meta( $projectbase_id, 'customer',
$_POST['projectbase_customer'] );
}// Field Customer

if ( isset( $_POST['projectbase_webclass'] ) &&
$_POST['projectbase_webclass'] != '' ) {
update_post_meta( $projectbase_id, 'webclass',
$_POST['projectbase_webclass'] );
}// Field Webclass

if ( isset( $_POST['projectbase_website'] ) &&
$_POST['projectbase_website'] != '' ) {
update_post_meta( $projectbase_id, 'website',
$_POST['projectbase_website'] );
}// Field Website
}
}
add_filter( 'template_include',
'design_template_function', 1 );

// Load Template from themes
function design_template_function( $template_path ) {
if ( get_post_type() == 'projectbase' ) {
	if ( is_single() ) { $template_path = plugin_dir_path( __FILE__ ) .'/template/single-projectbase.php';}
	if ( is_archive() ) { $template_path = plugin_dir_path( __FILE__ ) .'/template/archive-projectbase.php';}
}
return $template_path;
}

?>