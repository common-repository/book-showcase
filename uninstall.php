<?php
/*
 * When using uninstall.php, the plugin should always check for the WP_UNINSTALL_PLUGIN constant,
 * before executing. The WP_UNINSTALL_PLUGIN constant is defined by WordPress at runtime during a plugin uninstall,
 * it will not be present if uninstall.php is requested directly.
 * It will also not be present when using the uninstall hook technique.
 * WP_UNINSTALL_PLUGIN is only defined when an uninstall.php file is found in the plugin folder.
 *
 */
// If uninstall is not called from WordPress or access directly then, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}
// exit if current user does not have permission to delete plugin
if ( ! current_user_can( 'delete_plugins' ) )
    wp_die('You do not have permission to delete plugins.');


// get all posts added by the plugin
$bs3d_book_args = array(
    'numberposts' => -1,
    'post_type'   => 'bs3dbook',
    'post_status' => 'any',
);
// get all shortcode generated by the plugin
$bs3d_shortcode_args = array(
    'numberposts' => -1,
    'post_type'   => 'bs3d_sgenerator',
    'post_status' => 'any',
);
$bs3d_all_books = get_posts( $bs3d_book_args );
$bs3d_all_shortcodes = get_posts( $bs3d_shortcode_args );
foreach ($bs3d_all_books as $book){
    // delete all meta data related to the post
    delete_post_meta($book->ID, 'bs3dmaincontent');
    delete_post_meta($book->ID, 'bs3d_author_name');
    delete_post_meta($book->ID, 'bs3d_front_cover');
    delete_post_meta($book->ID, 'bs3d_back_cover');
    delete_post_meta($book->ID, 'bs3dbackcovertext');
    delete_post_meta($book->ID, 'bs3d_show_author_book_on_cover');
    delete_post_meta($book->ID, 'bs3d_show_text_on_back_cover');
    delete_post_meta($book->ID, 'bs3d_author_book_title_color');
    delete_post_meta($book->ID, 'bs3d_book_author_font_size');
    delete_post_meta($book->ID, 'bs3d_book_title_font_size');
    delete_post_meta($book->ID, 'bs3d_download_btn_link');
    delete_post_meta($book->ID, 'bs3d_book_bg_color');
    delete_post_meta($book->ID, 'bs3d_book_cover_bg_color');
    delete_post_meta($book->ID, 'bs3d_book_nav_bg_color');
    delete_post_meta($book->ID, 'bs3d_book_nav_hover_color');
    delete_post_meta($book->ID, 'bs3d_book_nav_color');
    delete_post_meta($book->ID, 'bs3d_download_btn_bg_color');
    delete_post_meta($book->ID, 'bs3d_download_btn_hover_color');
    delete_post_meta($book->ID, 'bs3d_download_btn_hover_color');
    delete_post_meta($book->ID, 'bs3d_download_btn_text_color');
    wp_delete_post( $book->ID, true); // delete each post
}
foreach ($bs3d_all_shortcodes as $shortcode){
    // delete all post meta related to shortcode post type
    delete_post_meta($shortcode->ID, 'bs3d_book_query_type');
    delete_post_meta($shortcode->ID, 'bs3d_book_by_id');
    delete_post_meta($shortcode->ID, 'bs3d_book_by_author');
    delete_post_meta($shortcode->ID, 'bs3d_book_from_year');
    delete_post_meta($shortcode->ID, 'bs3d_book_from_month');
    delete_post_meta($shortcode->ID, 'bs3d_book_from_month_year');
    delete_post_meta($shortcode->ID, 'bs3d_category_terms');
    delete_post_meta($shortcode->ID, 'bs3d_chars_per_page');
    delete_post_meta($shortcode->ID, 'bs3d_book_per_page');
    delete_post_meta($shortcode->ID, 'bs3d_show_pagination');
    delete_post_meta($shortcode->ID, 'bs3d_image_crop');
    delete_post_meta($shortcode->ID, 'bs3d_image_width');
    delete_post_meta($shortcode->ID, 'bs3d_image_height');
    delete_post_meta($shortcode->ID, 'bs3d_book_bg_color');
    delete_post_meta($shortcode->ID, 'bs3d_book_cover_bg_color');
    delete_post_meta($shortcode->ID, 'bs3d_book_title_color');
    delete_post_meta($shortcode->ID, 'bs3d_book_title_font_size');
    delete_post_meta($shortcode->ID, 'bs3d_book_button_color');
    delete_post_meta($shortcode->ID, 'bs3d_book_button_bg_color');
    delete_post_meta($shortcode->ID, 'bs3d_book_button_color_hover');
    delete_post_meta($shortcode->ID, 'bs3d_page_nav_bg_color');
    delete_post_meta($shortcode->ID, 'bs3d_page_nav_hover_color');
    delete_post_meta($shortcode->ID, 'bs3d_page_nav_color');
    wp_delete_post( $shortcode->ID, true); // delete each shortcode
}