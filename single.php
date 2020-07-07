<?php get_header(); ?>
<div class="blogsingle">
    <div class="blog-single__post-with-sidebar">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="blog">
                    <article class="single-article">
                        <div class="entry_blog singlepageentry">
                            <div class="singlepostimage">
                                <?php
                                the_post_thumbnail('full', array('class' => 'post_thumbnail_common post-image', 'alt' => get_the_title(), 'title' => get_the_title())); ?>
                            </div>
                            <h1 class='blogpost_title'><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                            <div class="blog-single-text"><?php the_content(); ?></div>

                                <section class="next-prev">
                                    <div class="next-prev-post">
                                        <div class="single_nav_pre"> <?php previous_post_link(); ?></div>
                                        <div class="single_nav_next"> <?php next_post_link(); ?></div>
                                    </div>
                                </section>

                        </div>
                    </article>
                <?php endwhile; ?>
            <?php endif; ?>

            <?php if (is_active_sidebar('blog_right_sidebar')) : ?>
                <aside class="sidebar">
                    <?php dynamic_sidebar('blog_right_sidebar'); ?>
                </aside>
            <?php endif; ?>
                </div>
    </div>

    <?php
    get_footer();
    ?>