<?php
// Add extra SKA title element and .dojo class if a dojo site
if (preg_match('/[^.]+\.[^.]+\.[^.]+$/', $_SERVER['SERVER_NAME'])) {
    remove_action('genesis_site_title', 'genesis_seo_site_title');
    function dojo_title() {?><div class="org-title">Shotokan Karate of America</div><h1 class="site-title dojo" itemprop="headline"><a href="/"><?php bloginfo('name') ?></a></h1><?php };
    add_action('genesis_site_title', 'dojo_title');
}


// Reinsert site description which was removed elsewhere
add_action( 'genesis_site_description', 'genesis_seo_site_description' );


// Set new sizes at which WordPress will save an image when uploaded
add_image_size( '2-across', 495, 980, FALSE );
add_image_size( '050-page', 520, 1040, FALSE );


// Modify embeds to use wmode=opaque so they do not overlap menus
function add_video_wmode_transparent($html, $url, $attr) {
    if ( strpos( $html, "<embed src=" ) !== false ) {
        return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html);
    }
    elseif ( strpos ( $html, 'feature=oembed' ) !== false ) {
        return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html );
    }
    else { return $html; }
}
add_filter( 'embed_oembed_html', 'add_video_wmode_transparent', 10, 3);


// Remove comments
remove_action( 'genesis_after_entry', 'genesis_get_comments_template' );
remove_action( 'genesis_after_post', 'genesis_get_comments_template' );
