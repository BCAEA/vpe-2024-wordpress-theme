<?php get_header(); ?>
<?php global $post; ?>
    <main id="content" class="standard">
        <?php if (have_posts()) {
            while (have_posts()) {
                the_post(); ?>
                <div class="nav-spacer"></div>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    <div class="entry-wrapper">
                        <div class="article-wrapper">
                            <?php
                            $current_attachment = get_queried_object();
                            if ($current_attachment->post_parent > 0) { ?>
                                <a href="<?php echo esc_url(get_permalink($post->post_parent)); ?>"
                                   title="<?php printf(esc_html__('Return to %s', 'vancoufur'), esc_html(get_the_title($post->post_parent))); ?>"
                                   rev="attachment" class="button">
                                    <?php printf(
                                        esc_html__('%s Return to ', 'vancoufur'),
                                        '<span class="fas fa-lg fa-chevron-left" aria-hidden="true"></span>'
                                    ); ?>
                                    <?php echo get_the_title($post->post_parent); ?>
                                </a>
                            <?php } ?>
                            <div class="entry-content">
                                <div class="entry-attachment">
                                    <?php if (wp_attachment_is_image($post->ID)) {
                                        $att_image = wp_get_attachment_image_src($post->ID, 'full'); ?>
                                        <p class="attachment">
                                            <a href="<?php echo esc_url(wp_get_attachment_url($post->ID)); ?>"
                                               title="<?php the_title_attribute(); ?>" rel="attachment">
                                                <img src="<?php echo esc_url($att_image[0]); ?>"
                                                     width="<?php echo esc_attr($att_image[1]); ?>"
                                                     height="<?php echo esc_attr($att_image[2]); ?>"
                                                     class="attachment-full"
                                                     alt="<?php $post->post_excerpt; ?>"/>
                                            </a>
                                        </p>
                                    <?php } else { ?>
                                        <a href="<?php echo esc_url(wp_get_attachment_url($post->ID)); ?>"
                                           title="<?php echo esc_attr(get_the_title($post->ID), 1); ?>"
                                           rel="attachment"><?php echo esc_url(basename($post->guid)); ?></a>
                                    <?php } ?>
                                </div>
                                <div class="entry-caption">
                                    <?php if (!empty($post->post_excerpt)) {
                                        the_excerpt();
                                    } ?>
                                </div>
                            </div>
                            <footer>
                                <nav id="navigation post-navigation" class="navigation" aria-label="Images">
                                    <h2 class="screen-reader-text">Post Image Navigation</h2>
                                    <div class="nav-links">
                                        <div class="nav-previous">
                                            <?php previous_image_link(
                                                false,
                                                '<span class="fas fa-lg fa-chevron-left" aria-hidden="true"></span> Previous Image'
                                            ); ?>
                                        </div>
                                        <div class="nav-next">
                                            <?php next_image_link(
                                                false,
                                                'Next Image <span class="fas fa-lg fa-chevron-right" aria-hidden="true"></span>'
                                            ); ?>
                                        </div>
                                    </div>
                                </nav>
                            </footer>
                        </div>
                    </div>
                </article>
                <?php comments_template(); ?>
            <?php }
        } ?>
    </main>
<?php get_footer(); ?>