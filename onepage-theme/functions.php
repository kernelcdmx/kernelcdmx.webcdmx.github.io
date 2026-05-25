<?php
/**
 * OnePage Minimal functions and definitions
 *
 * @package OnePage_Minimal
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define theme constants
 */
define( 'ONE_PAGE_VERSION', '1.0.0' );

/**
 * Sets up theme defaults and registers support for various WordPress features
 */
function onepage_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain( 'onepage-theme', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    /*
     * Enable support for custom logo.
     *
     * @link https://developer.wordpress.org/themes/functionality/custom-logo/
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 100,
            'width'       => 300,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );

    // Register navigation menus
    register_nav_menus(
        array(
            'primary'   => esc_html__( 'Primary Menu', 'onepage-theme' ),
            'footer'    => esc_html__( 'Footer Menu', 'onepage-theme' ),
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'onepage_setup' );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars-registering-sidebars/
 */
function onepage_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Area 1', 'onepage-theme' ),
            'id'            => 'footer-1',
            'description'   => esc_html__( 'Add widgets here.', 'onepage-theme' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Area 2', 'onepage-theme' ),
            'id'            => 'footer-2',
            'description'   => esc_html__( 'Add widgets here.', 'onepage-theme' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );
}
add_action( 'widgets_init', 'onepage_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function onepage_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style(
        'onepage-style',
        get_stylesheet_uri(),
        array(),
        ONE_PAGE_VERSION
    );

    // Enqueue Google Fonts
    wp_enqueue_style(
        'onepage-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // Enqueue custom CSS
    wp_enqueue_style(
        'onepage-custom',
        get_template_directory_uri() . '/assets/css/custom.css',
        array( 'onepage-style' ),
        ONE_PAGE_VERSION
    );

    // Enqueue Elementor editor styles (if Elementor is active)
    if ( defined( 'ELEMENTOR_VERSION' ) ) {
        wp_enqueue_style(
            'onepage-elementor',
            get_template_directory_uri() . '/assets/css/elementor-editor.css',
            array( 'onepage-style' ),
            ONE_PAGE_VERSION
        );
    }

    // Enqueue main JavaScript
    wp_enqueue_script(
        'onepage-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        ONE_PAGE_VERSION,
        true
    );

    // Pass PHP data to JavaScript
    wp_localize_script(
        'onepage-main',
        'onePageData',
        array(
            'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
            'nonce'     => wp_create_nonce( 'onepage_nonce' ),
        )
    );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'onepage_scripts' );

/**
 * Customizer options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function onepage_customize_register( $wp_customize ) {

    // ==========================================================================
    // GENERAL SECTION
    // ==========================================================================
    $wp_customize->add_section(
        'onepage_general',
        array(
            'title'    => __( 'Configuración General', 'onepage-theme' ),
            'priority' => 30,
        )
    );

    // Hero Title
    $wp_customize->add_setting(
        'onepage_hero_title',
        array(
            'default'           => __( 'Bienvenido a nuestro sitio', 'onepage-theme' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'onepage_hero_title',
        array(
            'label'    => __( 'Título del Hero', 'onepage-theme' ),
            'section'  => 'onepage_general',
            'type'     => 'text',
            'priority' => 10,
        )
    );

    // Hero Subtitle
    $wp_customize->add_setting(
        'onepage_hero_subtitle',
        array(
            'default'           => __( 'Creamos soluciones digitales que transforman tu negocio', 'onepage-theme' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'onepage_hero_subtitle',
        array(
            'label'    => __( 'Subtítulo del Hero', 'onepage-theme' ),
            'section'  => 'onepage_general',
            'type'     => 'textarea',
            'priority' => 20,
        )
    );

    // ==========================================================================
    // COLORS SECTION
    // ==========================================================================
    $wp_customize->add_section(
        'onepage_colors',
        array(
            'title'    => __( 'Colores', 'onepage-theme' ),
            'priority' => 35,
        )
    );

    // Primary Color
    $wp_customize->add_setting(
        'onepage_primary_color',
        array(
            'default'           => '#2563eb',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'onepage_primary_color',
            array(
                'label'    => __( 'Color Primario', 'onepage-theme' ),
                'section'  => 'onepage_colors',
                'settings' => 'onepage_primary_color',
                'priority' => 10,
            )
        )
    );

    // Secondary Color
    $wp_customize->add_setting(
        'onepage_secondary_color',
        array(
            'default'           => '#1e40af',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'onepage_secondary_color',
            array(
                'label'    => __( 'Color Secundario', 'onepage-theme' ),
                'section'  => 'onepage_colors',
                'settings' => 'onepage_secondary_color',
                'priority' => 20,
            )
        )
    );

    // ==========================================================================
    // CONTACT SECTION
    // ==========================================================================
    $wp_customize->add_section(
        'onepage_contact',
        array(
            'title'    => __( 'Información de Contacto', 'onepage-theme' ),
            'priority' => 45,
        )
    );

    // Email
    $wp_customize->add_setting(
        'onepage_email',
        array(
            'default'           => 'contacto@ejemplo.com',
            'sanitize_callback' => 'sanitize_email',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'onepage_email',
        array(
            'label'    => __( 'Correo Electrónico', 'onepage-theme' ),
            'section'  => 'onepage_contact',
            'type'     => 'email',
            'priority' => 10,
        )
    );

    // Phone
    $wp_customize->add_setting(
        'onepage_phone',
        array(
            'default'           => '+52 55 1234 5678',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'onepage_phone',
        array(
            'label'    => __( 'Teléfono', 'onepage-theme' ),
            'section'  => 'onepage_contact',
            'type'     => 'text',
            'priority' => 20,
        )
    );

    // Address
    $wp_customize->add_setting(
        'onepage_address',
        array(
            'default'           => __( 'Ciudad de México, México', 'onepage-theme' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'onepage_address',
        array(
            'label'    => __( 'Dirección', 'onepage-theme' ),
            'section'  => 'onepage_contact',
            'type'     => 'text',
            'priority' => 30,
        )
    );

    // ==========================================================================
    // SOCIAL SECTION
    // ==========================================================================
    $wp_customize->add_section(
        'onepage_social',
        array(
            'title'    => __( 'Redes Sociales', 'onepage-theme' ),
            'priority' => 50,
        )
    );

    // Social Links
    $social_networks = array(
        'facebook'  => __( 'Facebook', 'onepage-theme' ),
        'twitter'   => __( 'Twitter/X', 'onepage-theme' ),
        'instagram' => __( 'Instagram', 'onepage-theme' ),
        'linkedin'  => __( 'LinkedIn', 'onepage-theme' ),
    );

    foreach ( $social_networks as $network => $label ) {
        $wp_customize->add_setting(
            "onepage_social_{$network}",
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'transport'         => 'refresh',
            )
        );

        $wp_customize->add_control(
            "onepage_social_{$network}",
            array(
                'label'    => $label,
                'section'  => 'onepage_social',
                'type'     => 'url',
                'priority' => array_search( $network, array_keys( $social_networks ) ) + 10,
            )
        );
    }

    // ==========================================================================
    // STATS SECTION
    // ==========================================================================
    $wp_customize->add_section(
        'onepage_stats',
        array(
            'title'    => __( 'Estadísticas', 'onepage-theme' ),
            'priority' => 55,
        )
    );

    $stats = array(
        'projects'  => __( 'Proyectos completados', 'onepage-theme' ),
        'clients'   => __( 'Clientes satisfechos', 'onepage-theme' ),
        'experience' => __( 'Años de experiencia', 'onepage-theme' ),
    );

    $default_values = array(
        'projects'   => '150',
        'clients'    => '98',
        'experience' => '8',
    );

    foreach ( $stats as $stat => $label ) {
        $wp_customize->add_setting(
            "onepage_stat_{$stat}",
            array(
                'default'           => $default_values[ $stat ],
                'sanitize_callback' => 'absint',
                'transport'         => 'refresh',
            )
        );

        $wp_customize->add_control(
            "onepage_stat_{$stat}",
            array(
                'label'    => $label,
                'section'  => 'onepage_stats',
                'type'     => 'number',
                'priority' => array_search( $stat, array_keys( $stats ) ) + 10,
            )
        );
    }
}
add_action( 'customize_register', 'onepage_customize_register' );

/**
 * Generate custom CSS from customizer values
 */
function onepage_customizer_css() {
    $primary_color   = get_theme_mod( 'onepage_primary_color', '#2563eb' );
    $secondary_color = get_theme_mod( 'onepage_secondary_color', '#1e40af' );

    echo '<style id="onepage-customizer-css" type="text/css">';
    echo ':root {';
    echo '--primary-color: ' . esc_attr( $primary_color ) . ';';
    echo '--secondary-color: ' . esc_attr( $secondary_color ) . ';';
    echo '}';
    echo '</style>';
}
add_action( 'wp_head', 'onepage_customizer_css', 999 );

/**
 * Helper function to get customizer value
 *
 * @param string $key     Option key.
 * @param mixed  $default Default value.
 *
 * @return mixed
 */
function onepage_get_option( $key, $default = '' ) {
    return get_theme_mod( $key, $default );
}

/**
 * AJAX Contact Form Handler
 */
function onepage_contact_form_ajax() {
    // Verify nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'onepage_nonce' ) ) {
        wp_send_json_error( array( 'message' => __( 'Error de seguridad. Por favor recargue la página.', 'onepage-theme' ) ) );
    }

    // Sanitize inputs
    $name    = sanitize_text_field( $_POST['name'] ?? '' );
    $email   = sanitize_email( $_POST['email'] ?? '' );
    $subject = sanitize_text_field( $_POST['subject'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    // Validate
    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => __( 'Por favor complete todos los campos requeridos.', 'onepage-theme' ) ) );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => __( 'Por favor ingrese un correo electrónico válido.', 'onepage-theme' ) ) );
    }

    // Email parameters
    $to      = get_option( 'admin_email' );
    $subject = sprintf( '[%s] Nuevo mensaje de contacto: %s', get_bloginfo( 'name' ), $subject );

    $body = sprintf(
        "Nombre: %s\nEmail: %s\nMensaje:\n%s",
        $name,
        $email,
        $message
    );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        sprintf( 'From: %s <%s>', $name, $email ),
        sprintf( 'Reply-To: %s <%s>', $name, $email ),
    );

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( array( 'message' => __( '¡Gracias! Tu mensaje ha sido enviado exitosamente.', 'onepage-theme' ) ) );
    } else {
        wp_send_json_error( array( 'message' => __( 'Hubo un error al enviar tu mensaje. Por favor intenta más tarde.', 'onepage-theme' ) ) );
    }
}
add_action( 'wp_ajax_contact_form', 'onepage_contact_form_ajax' );
add_action( 'wp_ajax_nopriv_contact_form', 'onepage_contact_form_ajax' );

/**
 * Comment form modification
 *
 * @param array $fields Default comment fields.
 *
 * @return array Modified fields.
 */
function onepage_comment_fields( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );

    $fields['comment'] = $comment_field;

    return $fields;
}
add_filter( 'comment_form_fields', 'onepage_comment_fields' );

/**
 * Custom excerpt length
 *
 * @param int $length Excerpt length.
 *
 * @return int Modified length.
 */
function onepage_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'onepage_excerpt_length' );

/**
 * Custom excerpt more
 *
 * @param string $more More string.
 *
 * @return string Modified more string.
 */
function onepage_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'onepage_excerpt_more' );

/**
 * Add custom body classes
 *
 * @param array $classes Body classes.
 *
 * @return array Modified classes.
 */
function onepage_body_classes( $classes ) {
    if ( is_singular() ) {
        $classes[] = 'singular';
    }

    if ( has_post_thumbnail() ) {
        $classes[] = 'has-featured-image';
    }

    return $classes;
}
add_filter( 'body_class', 'onepage_body_classes' );

/**
 * Archive title customization
 *
 * @param string $title Archive title.
 *
 * @return string Modified title.
 */
function onepage_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( 'Y' );
    } elseif ( is_month() ) {
        $title = get_the_date( 'F Y' );
    } elseif ( is_day() ) {
        $title = get_the_date( 'F j, Y' );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }

    return $title;
}
add_filter( 'get_the_archive_title', 'onepage_archive_title' );

/**
 * Flush rewrite rules on theme activation
 */
function onepage_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'onepage_rewrite_flush' );

/* =============================================================================
   ELEMENTOR COMPATIBILITY
   ============================================================================= */

/**
 * Register Elementor support for this theme
 */
function onepage_elementor_support() {
    // Add Elementor support
    add_theme_support( 'elementor-global' );
    
    // Enable full width for Elementor
    add_theme_support( 'elementor-content-width', 1200 );
    
    // Add support for editor styles
    add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'onepage_elementor_support', 20 );

/**
 * Add body classes for Elementor
 */
function onepage_elementor_body_classes( $classes ) {
    $classes[] = 'elementor-page';
    $classes[] = 'onepage-theme';
    return $classes;
}
add_filter( 'body_class', 'onepage_elementor_body_classes' );

/**
 * Elementor Fonts - Register theme fonts
 */
function onepage_elementor_fonts( $fonts ) {
    $fonts['Inter'] = [
        'family' => 'Inter',
        'weights' => [ '100', '200', '300', '400', '500', '600', '700', '800', '900' ],
    ];
    return $fonts;
}
add_filter( 'elementor/fonts/additional_fonts', 'onepage_elementor_fonts' );

/**
 * Increase memory limit for Elementor
 */
function onepage_elementor_memory_limit() {
    $memory = wp_convert_hr_to_bytes( WP_MEMORY_LIMIT );
    
    // If memory is less than 256M, try to increase it
    if ( $memory < 268435456 ) {
        @ini_set( 'memory_limit', '256M' );
    }
}
add_action( 'init', 'onepage_elementor_memory_limit' );

/**
 * Custom CSS for Elementor editor
 */
function onepage_elementor_inline_css() {
    echo '<style id="onepage-elementor-css" type="text/css">
        .elementor-edit-area { max-width: 100%; }
        .site-header { z-index: 99; position: relative; }
        #page { padding-top: 0; }
    </style>';
}
add_action( 'wp_head', 'onepage_elementor_inline_css', 999 );

/**
 * Disable Elementor default fonts
 */
function onepage_elementor_disable_default_fonts() {
    update_option( 'elementor_disable_default_fonts', true );
}
add_action( 'after_switch_theme', 'onepage_elementor_disable_default_fonts' );