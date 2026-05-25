<?php
/**
 * The template for displaying the front page
 *
 * @package OnePage_Minimal
 */

get_header();
?>

<main id="main-content">

    <!-- ======================================================
         HERO SECTION
         ====================================================== -->
    <section id="hero" class="hero">
        <div class="container">
            <div class="hero-content fade-in-up">
                <h1><?php echo esc_html( get_theme_mod( 'onepage_hero_title', __( 'Bienvenido a nuestro sitio', 'onepage-theme' ) ) ); ?></h1>
                <p class="hero-subtitle">
                    <?php echo esc_html( get_theme_mod( 'onepage_hero_subtitle', __( 'Creamos soluciones digitales que transforman tu negocio', 'onepage-theme' ) ) ); ?>
                </p>
                <a href="#contact" class="btn btn-primary">
                    <?php esc_html_e( 'Contáctanos', 'onepage-theme' ); ?>
                    <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ======================================================
         FEATURES SECTION
         ====================================================== -->
    <section id="features" class="features">
        <div class="container">
            <header class="section-header">
                <h2><?php esc_html_e( 'Nuestros Servicios', 'onepage-theme' ); ?></h2>
                <p><?php esc_html_e( 'Ofrecemos soluciones integrales para tu negocio', 'onepage-theme' ); ?></p>
            </header>

            <div class="features-grid">
                <!-- Feature 1 -->
                <div class="feature-card">
                    <div class="feature-icon">🎨</div>
                    <h3><?php esc_html_e( 'Diseño Web', 'onepage-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Creamos sitios web modernos, responsivos y optimizados para conversión.', 'onepage-theme' ); ?></p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3><?php esc_html_e( 'Desarrollo', 'onepage-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Implementamos soluciones personalizadas con las últimas tecnologías.', 'onepage-theme' ); ?></p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3><?php esc_html_e( 'Mobile', 'onepage-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Desarrollamos aplicaciones móviles nativas y multiplataforma.', 'onepage-theme' ); ?></p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card">
                    <div class="feature-icon">🚀</div>
                    <h3><?php esc_html_e( 'SEO', 'onepage-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Optimizamos tu presencia online para mejorar tu posicionamiento.', 'onepage-theme' ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================================================
         ABOUT / STATS SECTION
         ====================================================== -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-grid">
                
                <!-- Image -->
                <div class="about-image">
                    <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=800" 
                         alt="<?php esc_attr_e( 'Equipo de trabajo collaboration', 'onepage-theme' ); ?>"
                         loading="lazy">
                </div>

                <!-- Content -->
                <div class="about-content">
                    <header class="section-header" style="text-align: left;">
                        <h2><?php esc_html_e( 'Sobre Nosotros', 'onepage-theme' ); ?></h2>
                        <p><?php esc_html_e( 'Somos un equipo apasionado por la tecnología y la innovación. Con años de experiencia en el sector, hemos ayudado a cientos de empresas a alcanzar sus objetivos digitales.', 'onepage-theme' ); ?></p>
                    </header>

                    <p>
                        <?php
                        esc_html_e( 'Notre misión es transformar ideas en experiencias digitales memorables. Trabajamos de la mano con nuestros clientes para crear soluciones que no solo cumplan sus expectativas, sino que las superen.', 'onepage-theme' );
                        ?>
                    </p>

                    <!-- Stats -->
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

    <!-- ======================================================
         BLOG / POSTS SECTION
         ====================================================== -->
    <?php
    $recent_posts = new WP_Query(
        array(
            'posts_per_page' => 3,
            'post_status'    => 'publish',
        )
    );

    if ( $recent_posts->have_posts() ) :
        ?>
        <section id="blog" class="blog-section" style="background-color: #f8fafc; padding: 5rem 0;">
            <div class="container">
                <header class="section-header">
                    <h2><?php esc_html_e( 'Últimas Noticias', 'onepage-theme' ); ?></h2>
                    <p><?php esc_html_e( 'Mantente informado con nuestro blog', 'onepage-theme' ); ?></p>
                </header>

                <div class="features-grid">
                    <?php
                    while ( $recent_posts->have_posts() ) :
                        $recent_posts->the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'feature-card' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div style="margin-bottom: 1rem; border-radius: 8px; overflow: hidden;">
                                    <?php the_post_thumbnail( 'medium', array( 'style' => 'width: 100%; height: 200px; object-fit: cover;' ) ); ?>
                                </div>
                            <?php endif; ?>
                            
                            <header class="entry-header">
                                <?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
                            </header>

                            <div class="entry-meta" style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">
                                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                    <?php echo esc_html( get_the_date() ); ?>
                                </time>
                            </div>

                            <div class="entry-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary" style="margin-top: 1rem;">
                                <?php esc_html_e( 'Leer más', 'onepage-theme' ); ?>
                            </a>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- ======================================================
         CONTACT SECTION
         ====================================================== -->
    <section id="contact" class="contact">
        <div class="container">
            <header class="section-header">
                <h2><?php esc_html_e( 'Contáctanos', 'onepage-theme' ); ?></h2>
                <p><?php esc_html_e( '¿Tienes un proyecto en mente? Escríbenos y te responderemos lo antes posible.', 'onepage-theme' ); ?></p>
            </header>

            <div class="contact-grid">
                
                <!-- Contact Info -->
                <div class="contact-info">
                    
                    <?php
                    $email   = get_theme_mod( 'onepage_email', 'contacto@ejemplo.com' );
                    $phone   = get_theme_mod( 'onepage_phone', '+52 55 1234 5678' );
                    $address = get_theme_mod( 'onepage_address', __( 'Ciudad de México, México', 'onepage-theme' ) );
                    ?>

                    <div class="contact-item">
                        <div class="icon">📧</div>
                        <div>
                            <h4><?php esc_html_e( 'Correo Electrónico', 'onepage-theme' ); ?></h4>
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

                <!-- Contact Form -->
                <div class="contact-form">
                    <form id="contact-form" method="post">
                        <div class="form-group">
                            <label for="contact-name"><?php esc_html_e( 'Nombre', 'onepage-theme' ); ?> *</label>
                            <input type="text" id="contact-name" name="name" required 
                                   placeholder="<?php esc_attr_e( 'Tu nombre completo', 'onepage-theme' ); ?>">
                        </div>

                        <div class="form-group">
                            <label for="contact-email"><?php esc_html_e( 'Correo Electrónico', 'onepage-theme' ); ?> *</label>
                            <input type="email" id="contact-email" name="email" required
                                   placeholder="<?php esc_attr_e( 'tu@email.com', 'onepage-theme' ); ?>">
                        </div>

                        <div class="form-group">
                            <label for="contact-subject"><?php esc_html_e( 'Asunto', 'onepage-theme' ); ?></label>
                            <input type="text" id="contact-subject" name="subject"
                                   placeholder="<?php esc_attr_e( '¿Sobre qué nos contactas?', 'onepage-theme' ); ?>">
                        </div>

                        <div class="form-group">
                            <label for="contact-message"><?php esc_html_e( 'Mensaje', 'onepage-theme' ); ?> *</label>
                            <textarea id="contact-message" name="message" rows="5" required
                                      placeholder="<?php esc_attr_e( 'Cuéntanos sobre tu proyecto...', 'onepage-theme' ); ?>"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <?php esc_html_e( 'Enviar Mensaje', 'onepage-theme' ); ?>
                        </button>

                        <div id="form-response" class="mt-4" style="display: none;"></div>
                    </form>
                </div>

            </div>
        </div>
    </section>

</main>

<?php
get_footer();