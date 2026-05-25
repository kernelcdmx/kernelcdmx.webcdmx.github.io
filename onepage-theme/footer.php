<?php
/**
 * The template for displaying the footer
 *
 * @package OnePage_Minimal
 */

?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
            <div class="footer-grid">
                
                <!-- Footer Brand -->
                <div class="footer-brand">
                    <?php
                    if ( has_custom_logo() ) :
                        the_custom_logo();
                    else :
                        ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    <?php endif; ?>
                    
                    <p>
                        <?php
                        printf(
                            esc_html__( '© %d %s. Todos los derechos reservados.', 'onepage-theme' ),
                            date( 'Y' ),
                            get_bloginfo( 'name' )
                        );
                        ?>
                    </p>
                </div>

                <!-- Footer Links -->
                <div class="footer-links">
                    <h4><?php esc_html_e( 'Enlaces Rápidos', 'onepage-theme' ); ?></h4>
                    <?php
                    if ( has_nav_menu( 'footer' ) ) :
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer',
                                'menu_class'     => 'footer-menu',
                                'container'      => false,
                                'depth'          => 1,
                            )
                        );
                    else :
                        ?>
                        <ul>
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Inicio', 'onepage-theme' ); ?></a></li>
                            <li><a href="#features"><?php esc_html_e( 'Servicios', 'onepage-theme' ); ?></a></li>
                            <li><a href="#about"><?php esc_html_e( 'Nosotros', 'onepage-theme' ); ?></a></li>
                            <li><a href="#contact"><?php esc_html_e( 'Contacto', 'onepage-theme' ); ?></a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Social Links -->
                <div class="footer-social">
                    <h4><?php esc_html_e( 'Síguenos', 'onepage-theme' ); ?></h4>
                    <div class="social-links">
                        <?php
                        $social_networks = array(
                            'facebook'  => '<span class="dashicons dashicons-facebook-alt" aria-hidden="true"></span><span class="screen-reader-text">' . esc_html__( 'Facebook', 'onepage-theme' ) . '</span>',
                            'twitter'   => '<span class="dashicons dashicons-twitter" aria-hidden="true"></span><span class="screen-reader-text">' . esc_html__( 'Twitter/X', 'onepage-theme' ) . '</span>',
                            'instagram' => '<span class="dashicons dashicons-instagram" aria-hidden="true"></span><span class="screen-reader-text">' . esc_html__( 'Instagram', 'onepage-theme' ) . '</span>',
                            'linkedin'  => '<span class="dashicons dashicons-linkedin" aria-hidden="true"></span><span class="screen-reader-text">' . esc_html__( 'LinkedIn', 'onepage-theme' ) . '</span>',
                        );

                        foreach ( $social_networks as $network => $icon ) :
                            $url = get_theme_mod( "onepage_social_{$network}", '' );
                            if ( ! empty( $url ) ) :
                                ?>
                                <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( ucfirst( $network ) ); ?>">
                                    <?php echo $icon; ?>
                                </a>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>

            </div>

            <div class="footer-bottom">
                <p>
                    <?php
                    printf(
                        esc_html__( 'Creado con %s por %s', 'onepage-theme' ),
                        '<span class="dashicons dashicons-heart" aria-hidden="true" style="color: #e53e3e;"></span>',
                        '<a href="https://example.com" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Tu Nombre', 'onepage-theme' ) . '</a>'
                    );
                    ?>
                </p>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>