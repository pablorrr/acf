<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
        <?php //test gitUUUJUIOUJ0PO
		// Start the loop.
		while ( have_posts() ) :
			the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->
    <h1><?php the_field('tester1'); ?></h1>
    <h1><?php the_field('test_2'); ?></h1>
    <h1><?php the_field('test_2'); ?></h1>
    <!-- https://www.advancedcustomfields.com/resources/link/-->
    <?php
    $link = get_field('url');
    if( $link ): ?>
        <a class="button" href="<?php echo esc_url( $link ); ?>">just onet link</a>
    <?php endif; ?>
	<?php get_sidebar( 'content-bottom' ); ?>

    <!-- https://www.advancedcustomfields.com/resources/range/ -->
    <?php

    $h2_font_size = get_field('h2_font_size');
    if ($h2_font_size): ?>
        <style type="text/css">
            h2 {
                font-size: <?php echo $h2_font_size; ?>px;
            }
        </style>
    <?php endif; ?>
    <h2>test range filed font size</h2>
    <!--This example demonstrates how to display a Range field value as text.-->
    <p>This example demonstrates how to display a Range field value as text</p>
    <p>Searching for houses within a <?php the_field('h2_font_size'); ?> km radius.</p>
</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
