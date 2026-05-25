<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * This template is used for single posts and pages when no specific template exists.
 *
 * @package OnePage_Minimal
 */

get_header();
?>

<main id="main-content" class="site-main">
    
    <?php
    // Start the Loop
    while ( have_posts() ) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <?php if ( ! is_singular() || ! \Elementor\Plugin::instance()->editor->is_edit_mode() ) : ?>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header>
            <?php endif; ?>

            <div class="entry-content">
                <?php
                /**
                 * Hook for Elementor content
                 * This is required for Elementor to work properly
                 */
                the_content();

                /**
                 * Pagination for multi-page posts
                 */
                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'onepage-theme' ),
                        'after'  => '</div>',
                    )
                );
                ?>
            </div>

            <?php if ( ! is_singular() ) : ?>
                <footer class="entry-footer">
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                        <?php esc_html_e( 'Leer más', 'onepage-theme' ); ?>
                    </a>
                </footer>
            <?php endif; ?>

        </article>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile;
    ?>

</main>

<?php
get_footer();