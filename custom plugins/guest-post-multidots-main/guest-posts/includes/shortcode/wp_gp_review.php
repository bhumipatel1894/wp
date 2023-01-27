<?php
/**
 * 'gp_review' Shortcode
 * 
 * @package  Guest Posts
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wp_gp_confirm_shortcode( $atts, $content = '') {

	// Taking some globals
	global $post;

	// Pagination parameter
	if(is_home() || is_front_page()) {
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged');
	}

	$args = array ( 
				'post_type'      		=> WP_GP_POST_TYPE,
				'post_status' 			=> array( 'pending' ),				
				'order'          		=> 'DESC',
				'posts_per_page' 		=> 2,
				'paged'          		=> $paged,				
			);

	$user = wp_get_current_user();
	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;
	if ( in_array( 'author', (array) $user->roles ) || $user->user_login == 'admin' ) {
	ob_start();
?>
	<div class="gp_pending_post_cover">
		<table>
			<tr>
				<th>Sr. No</th>
				<th>Post title</th>
				<th>Post Authur</th>
				<th>Post Status</th>
				
			</tr>
			
				<?php 
				
				$count = 0;
				while ($query->have_posts()) : $query->the_post();
					$count++;					
					$pid = $post->ID;
					$authid = $post->post_author;
					$ptitle = $post->post_title;
					$pstatus = $post->post_status;
					echo '<tr class="gp_row">';
					echo '<td>'.$count.'</td>';
					echo '<td>'.$ptitle.'</td>';
					echo '<td>'.$authid.'</td>';
					echo '<td> <a data-pid="'.$pid.'" class="change_status">'.$pstatus.'</a></td>';					
					echo '</tr>';
				endwhile;
				?>			
		</table>
		<div id="pub_succ"></div>
		<div>
		<?php 
			if($query->max_num_pages > 1){ ?>
				<div class=""><?php next_posts_link( __('Next', 'guest-posts').' &raquo;', $query->max_num_pages ); ?></div>
				<div class=""><?php previous_posts_link( '&laquo; '.__('Previous', 'guest-posts') ); ?></div>
			<?php } ?>
			
			</div>
	</div>
<?php
}
	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}
add_shortcode('gp_review', 'wp_gp_confirm_shortcode');