<?php
get_header();
$page_id = get_option('page_for_posts', true);
?>
<main id="content" class="standard blog">
    <div class="nav-spacer"></div>
    <article id="post-<?php echo $page_id ?>" <?php post_class("", $page_id); ?>>
        <header class="header">
            <h1 class="entry-title"><?php echo get_the_title($page_id); ?></h1>
        </header>
        <div class="entry-wrapper">
            <div class="article-wrapper">
                <div class="entry-content">
                    <?php if (has_post_thumbnail($page_id)){ ?>
                        <div class="entry-column-wrapper">
                            <div class="entry-image">
                                <?php echo get_the_post_thumbnail($page_id); ?>
                            </div>
                            <div class="entry-content-column">
                                <?php echo apply_filters('the_content', get_the_content(null,false, $page_id)); ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <?php echo apply_filters('the_content', get_the_content(null,false, $page_id)); ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </article>
    <div class="entry-wrapper">
        <div class="article-wrapper">
            <?php if (have_posts()){
                while (have_posts()){
                    the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php get_template_part('entry', 'summary'); ?>
            </article>

            <?php }} ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>