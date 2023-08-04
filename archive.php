<?php get_header(); ?>
<main id="content" class="standard blog">
    <div class="nav-spacer"></div>
    <header class="header">
        <h1 class="blog-title">Blog</h1>
        <?php the_archive_description('<div class="archive-meta">', '</div>') ?>
    </header>
    <div class="entry-wrapper">
        <div class="article-wrapper">
            <?php if (have_posts()) {
                while (have_posts()) {
                    the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php get_template_part('entry', 'summary'); ?>
                    </article>
                    <?php if (comments_open() && !post_password_required()) {
                        comments_template('', true);
                    }
                }
                get_template_part('nav', 'below');
            } ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>

