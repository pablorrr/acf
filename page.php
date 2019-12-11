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

    <style type="text/css">
        .acf-map {
            width: 100%;
            height: 400px;
            border: #ccc solid 1px;
            margin: 20px 0;
        }

        /
        /
        Fixes potential theme css conflict.
        .acf-map img {
            max-width: inherit !important;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJa3F7quH884-DYDBA6lHB12d-PevyA-g"></script>
    <script type="text/javascript">
        (function ($) {

            /**
             * initMap
             *
             * Renders a Google Map onto the selected jQuery element
             *
             * @date    22/10/19
             * @since   5.8.6
             *
             * @param   jQuery $el The jQuery element.
             * @return  object The map instance.
             */
            function initMap($el) {

                // Find marker elements within map.
                var $markers = $el.find('.marker');

                // Create gerenic map.
                var mapArgs = {
                    zoom: $el.data('zoom') || 16,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map($el[0], mapArgs);

                // Add markers.
                map.markers = [];
                $markers.each(function () {
                    initMarker($(this), map);
                });

                // Center map based on markers.
                centerMap(map);

                // Return map instance.
                return map;
            }

            /**
             * initMarker
             *
             * Creates a marker for the given jQuery element and map.
             *
             * @date    22/10/19
             * @since   5.8.6
             *
             * @param   jQuery $el The jQuery element.
             * @param   object The map instance.
             * @return  object The marker instance.
             */
            function initMarker($marker, map) {

                // Get position from marker.
                var lat = $marker.data('lat');
                var lng = $marker.data('lng');
                var latLng = {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng)
                };

                // Create marker instance.
                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map
                });

                // Append to reference for later use.
                map.markers.push(marker);

                // If marker contains HTML, add it to an infoWindow.
                if ($marker.html()) {

                    // Create info window.
                    var infowindow = new google.maps.InfoWindow({
                        content: $marker.html()
                    });

                    // Show info window when marker is clicked.
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                }
            }

            /**
             * centerMap
             *
             * Centers the map showing all markers in view.
             *
             * @date    22/10/19
             * @since   5.8.6
             *
             * @param   object The map instance.
             * @return  void
             */
            function centerMap(map) {

                // Create map boundaries from all map markers.
                var bounds = new google.maps.LatLngBounds();
                map.markers.forEach(function (marker) {
                    bounds.extend({
                        lat: marker.position.lat(),
                        lng: marker.position.lng()
                    });
                });

                // Case: Single marker.
                if (map.markers.length == 1) {
                    map.setCenter(bounds.getCenter());

                    // Case: Multiple markers.
                } else {
                    map.fitBounds(bounds);
                }
            }

// Render maps on page load.
            $(document).ready(function () {
                $('.acf-map').each(function () {
                    var map = initMap($(this));
                });
            });

        })(jQuery);
    </script>


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
        <!-- https://www.advancedcustomfields.com/resources/google-map/ -->

        <?php

        // check if the repeater field has rows of data
        if (have_rows('repeater')):

            // loop through the rows of data
            while (have_rows('repeater')) : the_row();

                // display a sub field value
                the_sub_field('text1');
                the_sub_field('text2');

            endwhile;

        else :

            echo 'no rows found';

        endif;

        ?>


        <div class="acf-map"></div>

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

    <!--taxonomy  https://www.advancedcustomfields.com/resources/taxonomy/khklhkjh-->


    <?php
    $term = get_field('taxonomy');
    if ($term): ?>
        <h2><?php echo esc_html($term->name); ?></h2>
        <p><?php echo esc_html($term->description); ?></p>
    <?php endif; ?>

    <!--https://www.advancedcustomfields.com/resources/post-object/-->
    <!-- theme option page get value (create optipn page watcj functions.php))-->
    <?php


    the_field('text_option_footer_1', 'option');

    //hooks actions and filters
    //https://www.advancedcustomfields.com/resources/acf-save_post/

    //do it after saving data



    echo '<pre>';
    print_r(get_field('post_objects'));
    echo '</pre>';
    die;

    ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
