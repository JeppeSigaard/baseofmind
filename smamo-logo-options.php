<?php 

function smamo_logo_get_default_options() {
    $options = array(
        'logo' => ''
    );
    return $options;
}

function smamo_logo_options_init() {
    $smamo_logo_options = get_option( 'theme_smamo_logo_options' );
    if ( false === $smamo_logo_options ) {
        $smamo_logo_options = smamo_logo_get_default_options();
        add_option( 'theme_smamo_logo_options', $smamo_logo_options );
    }
} 
add_action( 'after_setup_theme', 'smamo_logo_options_init' );

function smamo_logo_options_setup() {
    global $pagenow;
    if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
        add_filter( 'gettext', 'replace_thickbox_text'  , 1, 3 );
    }
}
add_action( 'admin_init', 'smamo_logo_options_setup' );
 
function replace_thickbox_text($translated_text, $text, $domain) {
    if ('Insert into Post' == $text) {
        $referer = strpos( wp_get_referer(), 'smamo_logo-settings' );
        if ( $referer != '' ) {
            return __('indstil som logo', 'smamo_logo' );
        }
    }
    return $translated_text;
}

function smamo_logo_menu_options() {
    add_theme_page('Logo', 'Logo', 'edit_theme_options', 'smamo_logo-settings', 'smamo_logo_admin_options_page');
}
add_action('admin_menu', 'smamo_logo_menu_options');
 
function smamo_logo_admin_options_page() {
    ?>
        <div class="wrap">
 
            <div id="icon-themes" class="icon32"><br /></div>
 
            <h2><?php _e( 'Indstillinger for logo', 'smamo_logo' ); ?></h2>
 
            <?php settings_errors( 'smamo_logo-settings-errors' ); ?>
 
            <form id="form-smamo_logo-options" action="options.php" method="post" enctype="multipart/form-data">
 
                <?php
                    settings_fields('theme_smamo_logo_options');
                    do_settings_sections('smamo_logo');
                ?>
 
                <p class="submit">
                    <input name="theme_smamo_logo_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Gem ændringer', 'smamo_logo'); ?>" />
                    <input name="theme_smamo_logo_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Nulstil', 'smamo_logo'); ?>" />
                </p>
 
            </form>
 
        </div>
    <?php
}



function smamo_logo_options_settings_init() {
    register_setting( 'theme_smamo_logo_options', 'theme_smamo_logo_options', 'smamo_logo_options_validate' );
 
    add_settings_section('smamo_logo_settings_header', __( '', 'smamo_logo' ), 'smamo_logo_settings_header_text', 'smamo_logo');
 
    add_settings_field('smamo_logo_setting_logo',  __( 'Logo', 'smamo_logo' ), 'smamo_logo_setting_logo', 'smamo_logo', 'smamo_logo_settings_header');
    
    // Add Current Image Preview
    add_settings_field('smamo_logo_setting_logo_preview',  __( 'Logo Preview', 'smamo_logo' ), 'smamo_logo_setting_logo_preview', 'smamo_logo', 'smamo_logo_settings_header');

}
add_action( 'admin_init', 'smamo_logo_options_settings_init' );
 
function smamo_logo_settings_header_text() {
    ?>
        <p><?php _e( 'Indstil logo, eller nulstil indstillingerne for at bruge bomærke (sidens titel).', 'smamo_logo' ); ?></p>
    <?php
}
 
function smamo_logo_setting_logo() {
    $smamo_logo_options = get_option( 'theme_smamo_logo_options' );
    ?>
        <input type="hidden" id="logo_url" name="theme_smamo_logo_options[logo]" value="<?php echo esc_url( $smamo_logo_options['logo'] ); ?>" />
        <input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', 'smamo_logo' ); ?>" />
        <span class="description"><?php _e('Tilføj et logo til hjemmesiden', 'smamo_logo' ); ?></span>
    <?php
}

function smamo_logo_setting_logo_preview() {
    $smamo_logo_options = get_option( 'theme_smamo_logo_options' );  ?>
    <div id="upload_logo_preview" style="min-height: 100px;">
        <img style="max-width:100%;" src="<?php echo esc_url( $smamo_logo_options['logo'] ); ?>" />
    </div>
    <?php
}


function smamo_logo_options_validate( $input ) {
    $default_options = smamo_logo_get_default_options();
    $valid_input = $default_options;
 
    $submit = ! empty($input['submit']) ? true : false;
    $reset = ! empty($input['reset']) ? true : false;
 
    if ( $submit )
        $valid_input['logo'] = $input['logo'];
    elseif ( $reset )
        $valid_input['logo'] = $default_options['logo'];
 
    return $valid_input;
}

function smamo_logo_options_enqueue_scripts() {
    wp_register_script( 'smamo_logo-upload', get_template_directory_uri() .'/smamo-logo-options/smamo-logo-upload.js', array('jquery','media-upload','thickbox') );
 
    if ( 'appearance_page_smamo_logo-settings' == get_current_screen() -> id ) {
        wp_enqueue_script('jquery');
 
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
 
        wp_enqueue_script('media-upload');
        wp_enqueue_script('smamo_logo-upload');
 
    }
 
}
add_action('admin_enqueue_scripts', 'smamo_logo_options_enqueue_scripts');






?>