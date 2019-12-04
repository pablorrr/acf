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

    <!--  https://www.advancedcustomfields.com/resources/radio-button/ -->
    <!-- This example demonstrates how to display the selected value. -->
    <p>Color: <?php the_field('color'); ?></p>
    <!-- This example demonstrates how to load a selected value and label without using the Format value setting. -->
    <?php
    $field = get_field_object('color');
    $value = $field['value'];
    $label = $field['choices'][$value]; ?>
    <p>Color: <span class="color-<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></span></p>
    <?php
    $color = get_field('color');
    ?>
    <p>Color: <span
                class="color-<?php //echo esc_attr($color['value']); ?>"><?php //echo esc_html($color['label']); ?></span>
    </p>
    <!-- https://www.advancedcustomfields.com/resources/select/-->
    <p>Color: <?php the_field('select_color'); ?></p>
    <?php
    $colors = get_field('select_color');

    // Create a comma-separated list from selected values.
    if ($colors): ?>
        <p>Color: <?php echo implode(', ', $colors); ?></p>
    <?php endif; ?>
    <?php
    /*
    $field = get_field_object( 'select_color' );
    $value = $field['value'];
    $label = $field['choices'][ $value ];*/
    ?>
    <p>Color: <span class="color-<?php // echo esc_attr($value); ?>"><?php //echo esc_html($label); ?></span></p>

    <?php
    $color = get_field('select_color');
    ?>
    <p>Color: <span
                class="color-<?php echo esc_attr($color['value']); ?>"><?php echo esc_html($color['label']); ?></span>
    </p>
    <!--https://www.advancedcustomfields.com/resources/true-false/  -->

    <?php

    if (get_field('true_false') === true)
        echo '<h6>value is yes</h6>';
    elseif (get_field('true_false') === false)
        echo '<h6>value is false  </h6>';
    ?>
    <!--https://www.advancedcustomfields.com/resources/file/  -->
    <?php if (get_field('file')): ?>
        <a href="<?php the_field('file'); ?>">Download File</a>
    <?php endif; ?>
    <--https://www.advancedcustomfields.com/resources/date-picker/-->
    <p>Event Date: <?php the_field('date'); ?></p>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
