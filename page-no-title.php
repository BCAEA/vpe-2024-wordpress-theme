<?php
/**
 * Template Name: No Title
 */
get_header(); ?>
    <main id="content" class="standard">
        <?php if (have_posts()){
            while (have_posts()){
                the_post(); ?>
        <div class="nav-spacer"></div>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-wrapper">
                <div class="article-wrapper">
                    <div class="entry-content">
                        <?php if ( has_post_thumbnail() ){ ?>
                            <div class="entry-column-wrapper">
                                <div class="entry-image">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="entry-content-column">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        <?php } else { ?>
                            <?php the_content(); ?>
                        <?php } ?>
                        <div class="entry-links"><?php wp_link_pages(); ?></div>
                    </div>
                    <?php if (comments_open() && !post_password_required()) {
                        comments_template( '', true );
                    } ?>
                </div>
            </div>
        </article>
            <?php }
        } ?>
    </main>
<?php get_footer(); ?>