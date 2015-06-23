<?php

/* Shortcode der kan bruges til at vise en kontaktformular */
function smamo_ct_shortcode( $atts ) {
    
    $smamo_base = get_template_directory_uri().'/library/smamo-ct';

    wp_enqueue_script('smamo_ct_script', $smamo_base.'/script.js', array('jquery'), null, true);
    wp_localize_script( 'smamo_ct_script', 'smamo_ct_root', get_template_directory_uri().'/library/smamo-ct');
    wp_enqueue_style('smamo_ct_style',  $smamo_base.'/style.css', '', '', 'all');
    wp_create_nonce('smamo-ct');
    
	// Attributes
	extract( shortcode_atts(
		array(
			'email' => '',
		), $atts )
	);
    
    if (empty($email)){
        $email = 'kontakt@baseofmind.dk';
    }

    ob_start();
    include dirname(__FILE__).'/smamo-ct/render.php';
    wp_reset_postdata();
    return ob_get_clean();
    
}
add_shortcode( 'kontaktformular', 'smamo_ct_shortcode' );


?>