<?php
/**
 * The header for our theme
 *
 * @package OnePage_Minimal
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main-content">
        <?php esc_html_e( 'Saltar al contenido', 'onepage-theme' ); ?>
    </a>

    <header id="masthead" class="site-header" role="banner">
        <div class="container">
            <div class="header-inner">
                
                <!-- Site Logo / Branding -->
                <div class="site-branding">
                    <?php
                    if ( has_custom_logo() ) :
                        the_custom_logo();
                    else :
                        ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
                            <span class="site-name"><?php bloginfo( 'name' ); ?></span>
                        </a>
                        <?php
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description ) :
                            ?>
                            <p class="site-description"><?php echo esc_html( $description ); ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- Main Navigation -->
                <nav id="site-navigation" class="main-nav" role="navigation" aria-label="<?php esc_attr_e( 'Navegación principal', 'onepage-theme' ); ?>">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'menu_class'     => 'nav-menu',
                            'container'      => false,
                            'fallback_cb'    => function() {
                                ?>
                                <ul>
                                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a></li>
                                    <li><a href="#features">Servicios</a></li>
                                    <li><a href="#about">Nosotros</a></li>
                                    <li><a href="#contact">Contacto</a></li>
                                </ul>
                                <?php
                            },
                        )
                    );
                    ?>
                </nav>

                <!-- Mobile Menu Toggle -->
                <button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Abrir menú', 'onepage-theme' ); ?>">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

            </div>
        </div>
    </header>

    <div id="content" class="site-content">