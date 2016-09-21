<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

    <div id="secondary" class="widget-area" role="complementary">
      <div class="col-xs-12 banda-sidebar-container"  data-clampedwidth=".widget-area">
    	<div id="banda-sidebar">
            oi
    		<ul class="list-unstyled banda-nav nav">

                <?php
                // $slug = $section->slug;
                //                     var_dump($slug);
                    $args = array(
                      'post_type' => 'banda_snippets',
                      'order' => 'ASC',
                    );
                    $entries = new WP_Query( $args );

                    if ($entries->have_posts()) : while ($entries->have_posts()) : $entries->the_post();
                ?>
                    <li><a href="#<?php print $post->post_name; ?>"><?php the_title(); ?></a></li>
                <?php
                    endwhile; endif;
                ?>
			</ul>



    	</div>
    </div>
</div><!-- #secondary -->
