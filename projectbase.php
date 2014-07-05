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
	'rewrite' => array( 'slug' => 'projectbase','with_front' => false, 'hierarchical' => true),
	'show_ui' => true,
	'query_var' => true,
	'capability_type' => 'post',
	'menu_position' => 5,
	'supports' => array( 'title', 'editor', 'comments',	'thumbnail' ),
	'taxonomies' => array( 'projectbase_archive','projectbase_preview'),
	'register_meta_box_cb' => 'projectbase_meta_box',
	'menu_icon' => plugins_url( 'images/favicon.png', __FILE__ ),
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
        'rewrite' 			=> array( 'slug' => 'projectbase_archive', 'with_front' => true ),
		'has_archive' 		=> true
    );

    register_taxonomy( 'projectbase_categories', array( 'projectbase' ), $args );
}
/* newadd functions */
add_action('admin_init', 'flush_rewrite_rules');
add_action('generate_rewrite_rules', 'projectbase_rewrite_rules');

function projectbase_rewrite_rules( $wp_rewrite )
{
$new_rules = array(
'projectbase/(.+)/(.+)' => 'index.php?post_type=' . $wp_rewrite->preg_index(2) . '&projectbase=' .$wp_rewrite->preg_index(1));

$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
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
$website = esc_html( get_post_meta( $projectbase->ID, 'website', true ) );
$user_rating = intval( get_post_meta( $projectbase->ID, 'user_rating', true ) );
?>
<table>
	<tr>
	<td style="width: 100%">Link Demo</td>
	<td><input type="text" size="80" name="projectbase_website" value="<?php echo $website; ?>" /></td>
	</tr>
	<tr>
		<td style="width: 150px">Rating</td>
		<td>
			<select style="width: 100px" name="projectbase_rating">
				<?php
				// Generate all items of drop-down list
				for ( $rating = 5; $rating >= 1; $rating -- ) {
				?>
				<option value="<?php echo $rating; ?>"
				<?php echo selected( $rating,
				$user_rating ); ?>>
				<?php echo $rating; ?> stars
				<?php } ?>
			</select>
		</td>
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

if ( isset( $_POST['projectbase_website'] ) &&
$_POST['projectbase_website'] != '' ) {
update_post_meta( $projectbase_id, 'website',
$_POST['projectbase_website'] );
}// Field website

if ( isset( $_POST['projectbase_rating'] ) &&
$_POST['projectbase_rating'] != '' ) {
update_post_meta( $projectbase_id, 'user_rating',
$_POST['projectbase_rating'] );
}
}
}
add_filter( 'template_include',
'design_template_function', 1 );

// Load Template from themes
function design_template_function( $template_path ) {
if ( get_post_type() == 'projectbase' ) {
	if ( is_single() ) { $template_path = plugin_dir_path( __FILE__ ) .'/single-projectbase.php';}
	if ( is_archive() ) { $template_path = plugin_dir_path( __FILE__ ) .'/archive-projectbase.php';}
}
return $template_path;
}
?>