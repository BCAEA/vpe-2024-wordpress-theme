<?php get_header(); ?>
    <main id="content" class="standard">
        <div class="nav-spacer"></div>
        <?php if(have_posts()){ ?>
            <header class="header">
                <h1 class="entry-title"><?php printf( esc_html__( 'Search Results for: &ldquo;%s&rdquo;', 'vancoufur' ), get_search_query() ); ?></h1>
            </header>
            <?php
            while (have_posts()){
                the_post();
                get_template_part( 'entry' );
            }
            ?>
            <hr>
            <?php get_template_part( 'nav', 'below' ); ?>
        <?php } else { ?>
            <article id="post-0" class="post no-results not-found">
                <header class="header">
                    <h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'vancoufur' ); ?></h1>
                </header>
                <div class="entry-content">
                    <p><?php esc_html_e( 'Sorry, nothing matched your search. Please try again.', 'vancoufur' ); ?></p>
                    <?php get_search_form(); ?>
                </div>
            </article>
        <?php } ?>
    </main>
<?php get_footer(); ?>