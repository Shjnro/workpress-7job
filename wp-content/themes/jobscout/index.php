<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JobScout
 */

get_header(); ?>

<!-- Start Module 5 -->
<?php
$blog_heading = get_theme_mod('blog_section_title', __('NEWEST BLOG ENTRIES', 'jobscout'));
$sub_title    = get_theme_mod('blog_section_subtitle', __('We will help you find it. We are your first step to becoming everything you want to be.', 'jobscout'));
$blog         = get_option('page_for_posts');
$label        = get_theme_mod('blog_view_all', __('See More Posts', 'jobscout'));
$hide_author  = get_theme_mod('ed_post_author', false);
$hide_date    = get_theme_mod('ed_post_date', false);
$ed_blog      = get_theme_mod('ed_blog', true);

$args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 8,
	'ignore_sticky_posts' => true
);
$qry = new WP_Query($args);
?>

<div id="primary" class="content-area">

	<?php if ($ed_blog && ($blog_heading || $sub_title || $qry->have_posts())) { ?>
		<section id="blog-section" class="article-section bg-st-edit thinh" style="background: #f5f5f7;">
			<div class="container">
				<?php if ($blog_heading) echo '<h2 class="section-title thinh">' . esc_html($blog_heading) . '</h2>'; ?>
				<?php if ($qry->have_posts()) { ?>
					<div class="article-wrap bonus-edit thinh">
						<?php
						while ($qry->have_posts()) {
							$qry->the_post(); ?>
							<div class="content_my_box thinh">
								<div class="content_my_box_left thinh">
								<?php
                                if (has_post_thumbnail()) {
                                    echo get_the_post_thumbnail($post->ID, 'post-thumbnail', "class=img-fluid img-thinh");
                                } else {
                                    jobscout_fallback_svg_image('jobscout-blog');
                                }
                                ?>
								</div>

								<div class="content_my_box_right thinh">
								<div class="header_content_box thinh">
                                    <h4 class="header_content_box_child thinh">
                                        <a href="<?php the_permalink(); ?>" class="header_text_content_box thinh"><?php the_title(); ?></a>
                            </h4>
                                </div>
                                <div class="center_content_box thinh">
                                    <?php the_content()?>
                                </div>
                                <div class="readmore_content_box thinh">
                                <a href="<?php the_permalink(); ?>" class="readmore_text thinh">Read more</a>
                                </div>
								</div>
                                </div>
						
						<?php
						}
						wp_reset_postdata();
						?>
					</div><!-- .article-wrap -->
				<?php } ?>
			</div>
		</section>
	<?php } ?>
</div><!-- #primary -->
<!-- End Module 5 -->


<?php
get_sidebar();
get_footer();