<?php
/**
 * Template Name: Page Builder (Elementor)
 * Description: Template for use with Elementor page builder
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
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>

        <?php
    endwhile;
    ?>

</main>

<?php
get_footer();