<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Guest Posts
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// create hook for formdata uploading
add_action('wp_ajax_nopriv_upload_file', 'formdata_callback');
add_action('wp_ajax_upload_file', 'formdata_callback' );

function formdata_callback(){

	check_ajax_referer('uploadingFile', 'security');
	$attach_id = '';
	$gp_post_title = strip_tags($_POST['gp_post_title']);
	$gp_post_type_val = strip_tags($_POST['gp_post_type_val']);
	$gp_post_type_name = strip_tags($_POST['gp_post_type_name']);
	$gp_post_descri = strip_tags($_POST['gp_post_descri']);
	$gp_post_excerpt = strip_tags($_POST['gp_post_excerpt']);	

	if($gp_post_title){
		$user = wp_get_current_user();

		 $insert_post = array(
            'post_name'         => $gp_post_title,
            'post_status'       => 'pending',
            'post_title'        => $gp_post_title,
            'post_type'         => WP_GP_POST_TYPE,
            'post_author'       => $user->ID,
            'post_category'     => array($termID),
            'post_content'      => $gp_post_descri,
            'post_excerpt'      => $gp_post_excerpt,
        );

        // Insert New post
        $ins_post_id            = wp_insert_post($insert_post, false);
       
        update_post_meta($ins_post_id, 'guest_cpt', $gp_post_type_name);
        if ( $_FILES ) {
			$attach_id = upload_user_file($_FILES["file"]);
			set_post_thumbnail( $ins_post_id, $attach_id );		
		}

		$posturl = get_post_permalink($ins_post_id);
		$to = get_bloginfo('admin_email');
		$subject = 'New Post has been Created: '.$gp_post_title;
		$body = 'Hello Admin, new post has been created. <br> you can check and review the post <a href="'.$posturl.'" >'.$gp_post_title.'</a>';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		 
		wp_mail( $to, $subject, $body, $headers );

		if($ins_post_id){

			echo 'form has been submitted successfully';

		}else{
			echo 'form has not submitted yet';
		}
        
	}else{
		echo 'form has not submitted yet';
	}

	wp_die();
}

/******FILE UPLOAD*****************/
function upload_user_file( $file = array() ) {    
    require_once( ABSPATH . 'wp-admin/includes/admin.php' );
    $file_return = wp_handle_upload( $file, array('test_form' => false ) );
    
    if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
    	echo $file_return['error'];
        return false;
    } else {

        $filename = $file_return['file'];
        $attachment = array(
            'post_mime_type' => $file_return['type'],
            'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
            'post_content' => '',
            'post_status' => 'inherit',
            'guid' => $file_return['url']
        );
        $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
        wp_update_attachment_metadata( $attachment_id, $attachment_data );
        if( 0 < intval( $attachment_id ) ) {
          return $attachment_id;
        }
    }
    return false;
}

// create hook for formdata uploading
add_action('wp_ajax_nopriv_gp_post_public', 'make_cpt_live');
add_action('wp_ajax_gp_post_public', 'make_cpt_live' );

function make_cpt_live(){

	$cpid = $_POST['pid'];	
	$guestcpt = get_post_meta($cpid, 'guest_cpt', true);
	
	global $post;

	$post = get_post( $cpid );
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
	$imgid = get_post_thumbnail_id( $cpid);

	if (isset( $post ) && $post != null) {
 		$postup = array( 'ID' => $cpid, 'post_status' => 'publish');
		wp_update_post($postup);
	    /*
	     * new post data array
	     */
	    $args = array(
	      'comment_status' => $post->comment_status,
	      'ping_status'    => $post->ping_status,
	      'post_author'    => $new_post_author,
	      'post_content'   => $post->post_content,
	      'post_excerpt'   => $post->post_excerpt,
	      'post_name'      => $post->post_name,
	      'post_parent'    => $post->post_parent,
	      'post_password'  => $post->post_password,
	      'post_status'    => 'publish',
	      'post_title'     => $post->post_title,
	      'post_type'      => $guestcpt,
	      'to_ping'        => $post->to_ping,
	      
	    );
	 
	    /*
	     * insert the post by wp_insert_post() function
	     */
	   $new_post_id = wp_insert_post( $args );
	   if($guestcpt != 'page'){
	   	set_post_thumbnail( $new_post_id, $imgid );	
	   }

	   if($new_post_id){
	   	echo '200';
	   }else{
	   	echo '100';
	   }
	} 
}