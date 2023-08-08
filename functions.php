<?php

define('VF_THEME_VER', '1.7.0');

add_action('after_setup_theme', 'vancoufur_setup');
function vancoufur_setup() {
    load_theme_textdomain('vancoufur', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form'));
    add_theme_support('woocommerce');
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1920;
    }
    register_nav_menus(array('main-menu' => esc_html__('Main Menu', 'vancoufur')));
    register_nav_menus(array('footer-menu' => esc_html__('Footer Menu', 'vancoufur')));
}

add_action('wp_enqueue_scripts', 'vancoufur_load_scripts');
function vancoufur_load_scripts() {
    //wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Arvo:400,400i,700,700i|Cabin:400,400i,700,700i&display=swap', [], null);
    //wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', [], null);
    wp_enqueue_style('vancoufur-style', get_stylesheet_uri(), [], VF_THEME_VER);

    wp_deregister_script('jquery');
    wp_deregister_script('jquery-core');
//    wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js', [], null);
    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', [], null);
    wp_register_script('jquery-core', get_template_directory_uri() . '/js/dummy.js', [], null);
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-core');

//    wp_register_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', ['jquery'], null);
//    wp_enqueue_script('slick');

    wp_register_script('fontawesome', 'https://kit.fontawesome.com/afef0e765d.js', ['jquery']);
    wp_enqueue_script('fontawesome');

    wp_register_script('vancoufur-scripts', get_template_directory_uri() . '/js/global.js', ['jquery'], VF_THEME_VER);
    wp_enqueue_script('vancoufur-scripts');
}

add_action('wp_footer', 'vancoufur_footer_scripts');
function vancoufur_footer_scripts() {
    ?>
    <script>
        jQuery(document).ready(function ($) {
            let deviceAgent = navigator.userAgent.toLowerCase();
            if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
                $("html").addClass(["ios", "mobile"]);
            }
            if (navigator.userAgent.search("MSIE") >= 0) {
                $("html").addClass("ie");
            } else if (navigator.userAgent.search("Chrome") >= 0) {
                $("html").addClass("chrome");
            } else if (navigator.userAgent.search("Firefox") >= 0) {
                $("html").addClass("firefox");
            } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                $("html").addClass("safari");
            } else if (navigator.userAgent.search("Opera") >= 0) {
                $("html").addClass("opera");
            }
        });
    </script>
    <?php
}

add_filter('document_title_separator', 'vancoufur_document_title_separator');
function vancoufur_document_title_separator($sep) {
    $sep = '|';
    return $sep;
}

add_filter('the_title', 'vancoufur_title');
function vancoufur_title($title) {
    if ($title == '') {
        return '...';
    } else {
        return $title;
    }
}

add_filter('the_content_more_link', 'vancoufur_read_more_link');
function vancoufur_read_more_link() {
    if (!is_admin()) {
        global $post;
        if($post->post_type != 'event') {
            return '&hellip; <a href="' . esc_url(get_permalink()) . '" class="more-link">Read More <span class="far fa-chevron-right" aria-hidden="true"></span></a>';
        } else {
            return '&hellip;';
        }
    }
}

add_filter('excerpt_more', 'vancoufur_excerpt_read_more_link');
function vancoufur_excerpt_read_more_link($more) {
    if (!is_admin()) {
        global $post;
        if($post->post_type != 'event') {
            return '&hellip; <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">Read More <span class="far fa-chevron-right" aria-hidden="true"></span></a>';
        } else {
            return '&hellip;';
        }
    }
}

add_filter('intermediate_image_sizes_advanced', 'vancoufur_image_insert_override');
function vancoufur_image_insert_override($sizes) {
    unset($sizes['medium_large']);
    return $sizes;
}

add_action('widgets_init', 'vancoufur_widgets_init');
function vancoufur_widgets_init() {
    register_sidebar(array(
        'name' => 'Footer Widget Area 1',
        'id' => 'footer-widget-area-1',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer Widget Area 2',
        'id' => 'footer-widget-area-2',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer Widget Area 3',
        'id' => 'footer-widget-area-3',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('wp_head', 'vancoufur_pingback_header');
function vancoufur_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('comment_form_before', 'vancoufur_enqueue_comment_reply_script');
function vancoufur_enqueue_comment_reply_script() {
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

function vancoufur_custom_pings($comment) {
    ?><li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li><?php
}

add_filter('get_comments_number', 'vancoufur_comment_count', 0);
function vancoufur_comment_count($count) {
    if (!is_admin()) {
        global $id;
        $get_comments = get_comments('status=approve&post_id=' . $id);
        $comments_by_type = separate_comments($get_comments);
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

add_filter('edit_post_link', 'vancoufur_edit_post_link', 10, 3);
function vancoufur_edit_post_link($link, $post_id, $text) {
    return '';
//    if (strlen($link) <= 0) return $link;
//    return
//        '<a target="_blank" href="' . get_edit_post_link($post_id) . '">
//            <span class="screen-reader-text">(Edit this post)</span>
//            <span class="fa-stack" aria-hidden="true">
//                <span class="fas fa-circle fa-stack-2x"></span>
//                <span class="fas fa-pencil fa-stack-1x fa-inverse"></span>
//            </span>
//        </a>';
}

add_filter('comments_open', 'vancoufur_filter_media_comment_status', 10, 2);
function vancoufur_filter_media_comment_status($open, $post_id) {
    $post = get_post($post_id);
    if ($post->post_type == 'attachment') {
        return false;
    }
    return $open;
}

function vancoufur_button($button_url = '', $button_text = 'button', $button_class = 'primary') {
    echo vancoufur_get_button($button_url, $button_text, $button_class);
}

function vancoufur_get_button($button_url = '', $button_text = 'button', $button_class = 'primary'){
    if (empty($button_text)) return '';
    $button_attr = (!empty($button_url))? 'class="button ' . $button_class . '" href="' . $button_url . '"' : 'class="button disabled"';
    return '<a ' . $button_attr . ((strpos($button_url, 'http') !== false)? ' target="_blank" rel="noopener noreferrer"' : '') . '>' . $button_text . '</a>';
}

function vancoufur_social_button($button_url = '', $button_text = 'button', $button_type = 'none') {
    echo vancoufur_get_social_button($button_url, $button_text, $button_type);
}

function vancoufur_get_social_button($button_url = '', $button_text = 'button', $button_type = 'none'){
    switch($button_type) {
        case 'twitter':
            if ($button_text == null) $button_text = "Twitter";
            $button_text = '<span class="fab fa-twitter" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'facebook':
            if ($button_text == null) $button_text = "Facebook";
            $button_text = '<span class="fab fa-facebook-square" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'discord':
            if ($button_text == null) $button_text = "Discord";
            $button_text = '<span class="fab fa-discord" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'telegram':
            if ($button_text == null) $button_text = "Telegram";
            $button_text = '<span class="fab fa-telegram" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'youtube':
            if ($button_text == null) $button_text = "YouTube";
            $button_text = '<span class="fab fa-youtube" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'soundcloud':
            if ($button_text == null) $button_text = "Soundcloud";
            $button_text = '<span class="fab fa-soundcloud" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'mixcloud':
            if ($button_text == null) $button_text = "Mixcloud";
            $button_text = '<span class="fab fa-mixcloud" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'bandcamp':
            if ($button_text == null) $button_text = "Bandcamp";
            $button_text = '<span class="fab fa-bandcamp" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'website':
            if ($button_text == null) $button_text = "Website";
            $button_text = '<span class="far fa-globe" aria-hidden="true"></span> ' . $button_text;
            break;
    }
    return vancoufur_get_button($button_url, $button_text, $button_type);
}

function vancoufur_first_paragraph() {
    $first_paragraph_str = wpautop(get_the_content());
    $first_paragraph_str = substr($first_paragraph_str, 0, strpos($first_paragraph_str, '<!-- /wp:paragraph -->') + 4);
    $first_paragraph_str = strip_tags($first_paragraph_str, '<i><b><strong><em>');
    return '<p>' . $first_paragraph_str . '</p>';
}

function woocommerce_template_loop_product_thumbnail() {
    echo '<div class="product-loop-image-wrapper">' . woocommerce_get_product_thumbnail() . '</div>';
}

// Remove company name from checkout
add_filter('woocommerce_checkout_fields', 'vancoufur_remove_company_name');
function vancoufur_remove_company_name($fields) {
    unset($fields['billing']['billing_company']);
    return $fields;
}

add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);
function wrap_embed_with_div($html, $url, $attr) {
    return '<div class="video-container">' . $html . '</div>';
}

add_action('woocommerce_before_customer_login_form', 'vancoufur_login_message');
function vancoufur_login_message() {
    if (get_option('woocommerce_enable_myaccount_registration') == 'yes') {
        ?>
        <div class="woocommerce-info">
            <span><?php _e('NOTE: This account is NOT linked to the registration system. You will need to create a new account. You cannot login to your reg account from here. '); ?></span>
        </div>
        <?php
    }
}

// set billing phone optional
//add_filter('woocommerce_billing_fields', 'vancoufur_remove_billing_phone_field', 20, 1);
//function vancoufur_remove_billing_phone_field($fields) {
//    $fields ['billing_phone']['required'] = false;
//
////    $fields['billing_email']['class'] = array('form-row-wide');
////    unset($fields ['billing_phone']);
//    return $fields;
//}

// Set shipping phone optional
//add_filter('woocommerce_shipping_fields', 'vancoufur_remove_shipping_phone_field', 20, 1);
//function vancoufur_remove_shipping_phone_field($fields) {
//    $fields ['shipping_phone']['required'] = false;
//
////    unset($fields ['shipping_phone']);
//    return $fields;
//}

// Check if WooCommerce is activated
if (!function_exists('is_woocommerce_activated')) {
    function is_woocommerce_activated() {
        return class_exists('woocommerce');
    }
}

// Show shipping info
//add_action('woocommerce_admin_order_data_after_order_details', 'vancoufur_editable_order_meta_general');
function vancoufur_editable_order_meta_general($order) {
//    ini_set('display_startup_errors', 1);
//    ini_set('display_errors', 1);
//    error_reporting(-1);
    $html = '<br><hr><h2>Shipment Info</h2>';
    try {
        /** @var WC_Order $order */
        $shipping_methods = $order->get_shipping_methods();
	if(count($shipping_methods) <= 0) return;
        $shipping_metas = array_values($shipping_methods)[0]->get_meta_data();
        /** @var WC_Meta_Data $shipping_meta */
        $html .= '<ul>';
        foreach ($shipping_metas as $shipping_meta) {
            $data = $shipping_meta->get_data();
            $html .= "<li>" . $data['key'] . ': ';
            if (gettype($data['value']) == "array") {
                $html .= '<pre>' . print_r($data['value'], true) . '</pre>';
            } else {
                $html .=  $data['value'];
            }
            $html .=  "</li>";
        }
        $html .=  '</ul>';
    } catch (Exception $e) {
        $html .= 'An exception occurred. Please report this to LinuxPony.';
    }
    echo $html;
}
require_once 'current-post-type-widget.php';

// Kill redirect
function kill_404_redirect_wpse_92103() {
    if (is_404()) {
        add_action('redirect_canonical','__return_false');
    }
}
add_action('template_redirect','kill_404_redirect_wpse_92103',1);

function add_body_class_if_webp_support($classes) {
    if(strpos($_SERVER['HTTP_ACCEPT'], 'image/webp')){
        $classes[] = 'webp-support';
    }
    return $classes;
}
add_filter('body_class', 'add_body_class_if_webp_support');

function vancoufur_show_latest_news() {
    $the_query = new WP_Query( array(
        'category_name' => 'news',
        'posts_per_page' => 3,
    ));
    ?>
    <div class="news-wrapper">
        <h2 class="news-title">LATEST NEWS</h2>
        <?php if ($the_query->have_posts()) { ?>
            <div class="news-container">
                <?php while ($the_query->have_posts()) {
                    $the_query->the_post(); ?>
                    <div class="news-item">
                        <?php the_post_thumbnail(); ?>
                        <div class="news-content">
                            <h3><?php the_title(); ?></h3>
                            <a href="<?php echo get_permalink(); ?>">READ MORE</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php wp_reset_postdata();
        } else { ?>
            <p><?php __('No News :\'('); ?></p>
        <?php } ?>
    </div>
    <?php
}
add_shortcode('vancoufur_news', 'vancoufur_show_latest_news');
