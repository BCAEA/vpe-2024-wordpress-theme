<?php get_header(); ?>
    <main id="content" class="standard">
        <?php
        if (have_posts()){
            while (have_posts()){
                the_post(); ?>
                <div class="nav-spacer"></div>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    <div class="entry-wrapper">
                        <div class="article-wrapper">
                            <div class="entry-content">
                                <?php wc_get_template_part( 'content', 'single-product' ); ?>
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