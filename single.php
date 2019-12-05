<?php acf_form_head(); ?>
<?php get_header(); ?>
    <!-- https://www.advancedcustomfields.com/resources/acf_form/

     -->
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <?php /* The loop */ ?>
            <?php while (have_posts()) : the_post(); ?>

                <?php /*

                    for mularz tworzy nowe posty z typu posta event

    `               acf_form(array(
                    'post_id'		=> 'new_post',
                    'new_post'		=> array(
                        'post_type'		=> 'travel',
                        'post_status'		=> 'publish'
                    ),
                    'submit_value'		=> 'Create a new travel'
                ));
 */ ?>

                <?php //dodawanie wlasnych pol i zachowanie ich wartosci
                acf_form(array(

                    'field_groups' => array('forms'),
                    'fields' => array('textform1', 'textform2'),
                    'submit_value' => 'save',
                    'updated_message' => __("Post updated", 'acf'),
                    'html_submit_spinner' => '<span class="acf-spinner"></span>',
                    'kses' => true
                )); ?>


            <?php endwhile; ?>

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>