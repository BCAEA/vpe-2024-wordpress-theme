<?php get_header(); ?>
<main id="content" class="standard">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="nav-spacer"></div>
<?php get_template_part( 'entry' ); ?>
<?php comments_template(); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
</main>
<?php get_footer(); ?>