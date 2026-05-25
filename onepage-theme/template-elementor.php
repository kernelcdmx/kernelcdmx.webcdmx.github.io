<?php
/**
 * Template Name: Página con Elementor
 * Description: Template completo para usar con Elementor Page Builder
 *
 * @package OnePage_Minimal
 */

get_header();

while ( have_posts() ) :
    the_post();
    ?>

    <main id="main-content" class="site-main">
        
        <?php 
        // Si estamos en el editor de Elementor, mostrar solo el contenido
        if ( \Elementor\Plugin::instance()->editor->is_edit_mode() || \Elementor\Plugin::instance()->preview->is_preview_mode() ) : ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>

        <?php else : 
            // En frontend, verificar si hay contenido de Elementor
            $elementor_content = get_post_meta( get_the_ID(), '_elementor_content', true );
            
            if ( ! empty( $elementor_content ) ) :
                // Mostrar contenido de Elementor
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php else : 
                // Si no hay contenido de Elementor, mostrar las secciones del tema
                // Hero Section
                $hero_title = get_theme_mod( 'onepage_hero_title', __( 'Bienvenido a nuestro sitio', 'onepage-theme' ) );
                $hero_subtitle = get_theme_mod( 'onepage_hero_subtitle', __( 'Creamos soluciones digitales que transforman tu negocio', 'onepage-theme' ) );
                ?>
                
                <section id="hero" class="hero">
                    <div class="container">
                        <div class="hero-content fade-in-up">
                            <h1><?php echo esc_html( $hero_title ); ?></h1>
                            <p class="hero-subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
                            <a href="#contact" class="btn btn-primary">
                                <?php esc_html_e( 'Contáctanos', 'onepage-theme' ); ?>
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Features Section -->
                <section id="features" class="features">
                    <div class="container">
                        <header class="section-header">
                            <h2><?php esc_html_e( 'Nuestros Servicios', 'onepage-theme' ); ?></h2>
                            <p><?php esc_html_e( 'Ofrecemos soluciones integrales para tu negocio', 'onepage-theme' ); ?></p>
                        </header>
                        <div class="features-grid">
                            <div class="feature-card">
                                <div class="feature-icon">🎨</div>
                                <h3><?php esc_html_e( 'Diseño Web', 'onepage-theme' ); ?></h3>
                                <p><?php esc_html_e( 'Creamos sitios web modernos y responsivos.', 'onepage-theme' ); ?></p>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">⚡</div>
                                <h3><?php esc_html_e( 'Desarrollo', 'onepage-theme' ); ?></h3>
                                <p><?php esc_html_e( 'Implementamos soluciones personalizadas.', 'onepage-theme' ); ?></p>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">📱</div>
                                <h3><?php esc_html_e( 'Mobile', 'onepage-theme' ); ?></h3>
                                <p><?php esc_html_e( 'Desarrollamos aplicaciones móviles.', 'onepage-theme' ); ?></p>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">🚀</div>
                                <h3><?php esc_html_e( 'SEO', 'onepage-theme' ); ?></h3>
                                <p><?php esc_html_e( 'Optimizamos tu presencia online.', 'onepage-theme' ); ?></p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- About Section -->
                <section id="about" class="about">
                    <div class="container">
                        <div class="about-grid">
                            <div class="about-image">
                                <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=800" alt="<?php esc_attr_e( 'Equipo de trabajo', 'onepage-theme' ); ?>" loading="lazy">
                            </div>
                            <div class="about-content">
                                <header class="section-header" style="text-align: left;">
                                    <h2><?php esc_html_e( 'Sobre Nosotros', 'onepage-theme' ); ?></h2>
                                    <p><?php esc_html_e( 'Somos un equipo apasionado por la tecnología y la innovación.', 'onepage-theme' ); ?></p>
                                </header>
                                <p><?php esc_html_e( 'Notre misión es transformar ideas en experiencias digitales memorables.', 'onepage-theme' ); ?></p>
                                <div class="about-stats">
                                    <div class="stat-item">
                                        <span class="stat-number"><?php echo esc_html( get_theme_mod( 'onepage_stat_projects', '150' ) ); ?>+</span>
                                        <span class="stat-label"><?php esc_html_e( 'Proyectos', 'onepage-theme' ); ?></span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number"><?php echo esc_html( get_theme_mod( 'onepage_stat_clients', '98' ) ); ?>%</span>
                                        <span class="stat-label"><?php esc_html_e( 'Satisfacción', 'onepage-theme' ); ?></span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number"><?php echo esc_html( get_theme_mod( 'onepage_stat_experience', '8' ) ); ?>+</span>
                                        <span class="stat-label"><?php esc_html_e( 'Años', 'onepage-theme' ); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Contact Section -->
                <section id="contact" class="contact">
                    <div class="container">
                        <header class="section-header">
                            <h2><?php esc_html_e( 'Contáctanos', 'onepage-theme' ); ?></h2>
                            <p><?php esc_html_e( '¿Tienes un proyecto en mente? Escríbenos y te responderemos.', 'onepage-theme' ); ?></p>
                        </header>
                        <div class="contact-grid">
                            <div class="contact-info">
                                <?php
                                $email = get_theme_mod( 'onepage_email', 'contacto@ejemplo.com' );
                                $phone = get_theme_mod( 'onepage_phone', '+52 55 1234 5678' );
                                $address = get_theme_mod( 'onepage_address', __( 'Ciudad de México, México', 'onepage-theme' ) );
                                ?>
                                <div class="contact-item">
                                    <div class="icon">📧</div>
                                    <div>
                                        <h4><?php esc_html_e( 'Correo', 'onepage-theme' ); ?></h4>
                                        <p><a href="mailto:<?php echo esc_attr( $email ); ?>" style="color: inherit;"><?php echo esc_html( $email ); ?></a></p>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <div class="icon">📞</div>
                                    <div>
                                        <h4><?php esc_html_e( 'Teléfono', 'onepage-theme' ); ?></h4>
                                        <p><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" style="color: inherit;"><?php echo esc_html( $phone ); ?></a></p>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <div class="icon">📍</div>
                                    <div>
                                        <h4><?php esc_html_e( 'Dirección', 'onepage-theme' ); ?></h4>
                                        <p><?php echo esc_html( $address ); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="contact-form">
                                <form id="contact-form" method="post">
                                    <div class="form-group">
                                        <label for="contact-name"><?php esc_html_e( 'Nombre', 'onepage-theme' ); ?> *</label>
                                        <input type="text" id="contact-name" name="name" required placeholder="<?php esc_attr_e( 'Tu nombre completo', 'onepage-theme' ); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="contact-email"><?php esc_html_e( 'Correo', 'onepage-theme' ); ?> *</label>
                                        <input type="email" id="contact-email" name="email" required placeholder="<?php esc_attr_e( 'tu@email.com', 'onepage-theme' ); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="contact-message"><?php esc_html_e( 'Mensaje', 'onepage-theme' ); ?> *</label>
                                        <textarea id="contact-message" name="message" rows="5" required placeholder="<?php esc_attr_e( 'Cuéntanos sobre tu proyecto...', 'onepage-theme' ); ?>"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><?php esc_html_e( 'Enviar Mensaje', 'onepage-theme' ); ?></button>
                                    <div id="form-response" class="mt-4" style="display: none;"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>

            <?php endif; ?>
        <?php endif; ?>

    </main>

    <?php
endwhile;

get_footer();