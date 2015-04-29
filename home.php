<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package
 */
get_header();
?>
    <data data-ajax="<?php echo admin_url('admin-ajax.php'); ?>"/>
<?php if (have_posts()) : ?>
    <!--    <header id="cd-header">-->
    <!--    </header>-->
    <script type="text/template" class="mulo-tpl">
        {{#data}}
        <div class="cd-timeline-block">
            <div class="cd-timeline-img cd-movie">
                <img src="img/cd-icon-movie.svg" alt="Movie"/>
            </div>
            <div class="cd-timeline-content">
                <h2>{{title}}</h2>

                <div class="mulo-cover">
                    <img src="{{cover}}"/>
                </div>
                {{&content}}
                <audio controls="controls">
                    <source src="{{audio}}" type="audio/mpeg">
                </audio>
                <span class="cd-date">{{date}}</span>
            </div>
        </div>
        {{/data}}
    </script>
    <section id="cd-timeline" class="cd-container"></section>
<?php else : ?>
    <?php get_template_part('content', 'none'); ?>
<?php endif; ?>

<?php get_footer(); ?>