<?php get_header(); ?>
    <main id="content" class="standard">
        <div class="nav-spacer"></div>
        <header class="header">
            <?php the_post(); ?>
            <h1 class="entry-title author"><?php the_author_link(); ?></h1>
            <div class="archive-meta"><?php if (!empty(get_the_author_meta('user_description'))) {
                echo esc_html(get_the_author_meta('user_description'));
            } ?></div>
            <?php rewind_posts(); ?>
        </header>
        <div class="entry-wrapper">
            <div class="article-wrapper">
                <?php if (have_posts()){
                    while (have_posts()){
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
