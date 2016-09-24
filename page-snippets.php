<?php
/**
 * Template name: Entries
 *
 *
 */

get_header(); ?>


<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <ul class="list-unstyled banda-nav nav">
                <div class="col-xs-12" id="banda-sidebar-container">
                	<div id="banda-sidebar">
                		<ul class="list-unstyled banda-nav nav">
                			<li class="banda-nav-section-title">Snippets</li>
                			<li>
                				<ul class="list-unstyled banda-nav-section active">
                                    <?php
                                    // $slug = $section->slug;
                                    //                     var_dump($slug);
                                        $args = array(
                                          'post_type' => 'banda_snippet',
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
                			</li>
                		</ul>
                	</div>
                </div>

			</ul>
        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-xs">
                <div class="container">
                    <?php
                        $args = array(
                          'post_type' => 'banda_snippets',
                          'order' => 'ASC',
                        );
                        $entries = new WP_Query( $args );

                        if( $entries->have_posts() ) {
                          while( $entries->have_posts() ) {
                              $entries->the_post();
                            ?>
                            <div class="row">
                                <div class="col-xs">
                                    <div class="card" id="<?php print $post->post_name; ?>">

                                        <h4 class="card-header"><?php the_title(); ?></h4>
                                        <div class="card-block">
                                        <?php the_content(); ?>

                                            <?php
                                                // get custom fields
                                                $custom_field_keys = get_post_custom($post->ID);
                                                $code_snippet = $custom_field_keys["meta-text"][0];
                                                echo '<script src="' . $code_snippet .'.js"></script>';
                                            ?>

                                      </div>



                                    </div>
                                </div>
                            </div>




                              <?php
                          }
                        }
                      ?>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>

<?php get_footer(); ?>
