<?php get_header(); ?>
<main id="content" class="standard blog">
    <div class="nav-spacer"></div>
    <header class="header">
        <?php $shop_page = get_post(get_option('woocommerce_shop_page_id'));
        $title = get_the_archive_title();
        if(strpos($title, 'Archive') === 0) {
            $title = $shop_page->post_title;
        }
        ?>
        <h1 class="blog-title"><?php echo $title ?> <?php edit_post_link(null, '', '', $shop_page->ID) ?></h1>
    </header>
    <div class="entry-wrapper">
        <div class="article-wrapper">
            <?php
            if(is_category()) {
                echo category_description();
            } else {
                echo $shop_page->post_content;
            }
            if ( woocommerce_product_loop() ) {
                do_action( 'woocommerce_before_shop_loop' );

                woocommerce_product_loop_start();

                if (wc_get_loop_prop('total')) {
                    while (have_posts()) {
                        the_post();

                        do_action('woocommerce_shop_loop');

                        wc_get_template_part('content', 'product');
                    }
                }

                woocommerce_product_loop_end();
                do_action( 'woocommerce_after_shop_loop' );
            } else {
                do_action( 'woocommerce_no_products_found' );
            }
            ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>

