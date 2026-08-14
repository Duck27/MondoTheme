<?php

function mondo_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
}

add_action('after_setup_theme', 'mondo_theme_setup');



/* Enqueue styles */
function mondo_theme_enqueue_styles()
{
    wp_enqueue_style(
        'mondo-theme-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'mondo-theme-style',
        get_stylesheet_uri(),
        ['mondo-theme-fonts'],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style(
        'mondo-theme-hero-section',
        get_template_directory_uri() . '/components/hero-section/hero-section.css',
        ['mondo-theme-style'],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style(
        'mondo-theme-about-me-section',
        get_template_directory_uri() . '/components/about-me-section/about-me-section.css',
        ['mondo-theme-style'],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style(
        'mondo-theme-skills-section',
        get_template_directory_uri() . '/components/skills-section/skills-section.css',
        ['mondo-theme-style'],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style(
        'mondo-theme-portfolio-section',
        get_template_directory_uri() . '/components/portfolio-section/portfolio-section.css',
        ['mondo-theme-style'],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_script(
        'mondo-theme-portfolio-section',
        get_template_directory_uri() . '/components/portfolio-section/portfolio-section.js',
        [],
        wp_get_theme()->get('Version'),
        true
    );

    wp_enqueue_style(
        'mondo-theme-contact-section',
        get_template_directory_uri() . '/components/contact-section/contact-section.css',
        ['mondo-theme-style'],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style(
        'mondo-theme-footer',
        get_template_directory_uri() . '/components/footer/footer.css',
        ['mondo-theme-style'],
        wp_get_theme()->get('Version')
    );
}

add_action('wp_enqueue_scripts', 'mondo_theme_enqueue_styles');

/* Allow SVG upload */
function mondo_allow_svg_upload($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'mondo_allow_svg_upload');


/* Register social links CPT */
function mondo_theme_register_socials_cpt()
{
    register_post_type('social_link', array(
        'labels' => array(
            'name' => 'Social links',
            'singular_name' => 'Social link',
            'add_new_item' => 'Add new social link',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-share',
        'supports' => array('title', 'thumbnail'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'mondo_theme_register_socials_cpt');

function mondo_render_social_links($css_class = 'social-menu')
{
    $socials = new WP_Query(array(
        'post_type' => 'social_link',
        'posts_per_page' => -1,
        'orderby' => 'menu_order title',
        'order' => 'ASC',
    ));

    if ($socials->have_posts()): ?>
        <ul class="<?php echo esc_attr($css_class); ?>">
            <?php while ($socials->have_posts()):
                $socials->the_post();
                $url = get_field('social_url');
                if (!$url)
                    continue;
                ?>
                <li class="hero-section__social-item">
                    <a class="hero-section__social-link" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener"
                        title="<?php the_title_attribute(); ?>">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('full', array('class' => 'social-icon')); ?>
                        <?php else: ?>
                            <span><?php the_title(); ?></span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </ul>
    <?php endif;
}

/* Register skills CPT */


function mondo_register_skills_system()
{
    register_taxonomy('skill_category', array('skill'), array(
        'labels' => array(
            'name' => 'Skill category',
            'singular_name' => 'Skill category',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
    ));

    register_post_type('skill', array(
        'labels' => array(
            'name' => 'Skills',
            'singular_name' => 'Skill',
            'add_new_item' => 'Add skill',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-superhero',
        'supports' => array('title', 'thumbnail'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'mondo_register_skills_system');

/* Register portfolio CPT */

function mondo_register_portfolio_cpt()
{
    register_post_type('portfolio', array(
        'labels' => array(
            'name' => 'Portfolio',
            'singular_name' => 'Project',
            'add_new_item' => 'Add New Project',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'thumbnail', 'page-attributes'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'mondo_register_portfolio_cpt');

/* Register Menu */
function mondo_register_menus()
{
    register_nav_menus(array(
        'header_left' => esc_html__('Header Left (Light background)', 'mondo-theme'),
        'header_right' => esc_html__('Header Right (Dark background)', 'mondo-theme'),
    ));
}
add_action('after_setup_theme', 'mondo_register_menus');

function mondo_menu_classes($classes, $item, $args)
{
    if (in_array($args->theme_location, array('header_left', 'header_right'))) {
        $classes[] = 'hero-section__item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'mondo_menu_classes', 10, 3);

function mondo_menu_link_atts($atts, $item, $args)
{
    if ($args->theme_location === 'header_left') {
        $atts['class'] = 'hero-section__link hero-section__link--on-light';
    } elseif ($args->theme_location === 'header_right') {
        $atts['class'] = 'hero-section__link hero-section__link--on-dark';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'mondo_menu_link_atts', 10, 3);

/* Contact form */
function mondo_theme_handle_contact_form()
{
    if (
        !isset($_POST['mondo_theme_contact_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['mondo_theme_contact_nonce'])), 'mondo_theme_contact_form')
    ) {
        wp_die(esc_html__('Security verification failed.', 'mondo-theme'));
    }

    $redirect = isset($_POST['redirect_to'])
        ? wp_validate_redirect(wp_unslash($_POST['redirect_to']), home_url('/#contact'))
        : home_url('/#contact');

    $name = sanitize_text_field(wp_unslash($_POST['contact_name'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['contact_email'] ?? ''));
    $phone = sanitize_text_field(wp_unslash($_POST['contact_phone'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['contact_message'] ?? ''));

    if ($name === '' || $email === '' || $message === '' || !is_email($email)) {
        wp_safe_redirect(add_query_arg('contact', 'invalid', $redirect));
        exit;
    }

    $to = get_option('admin_email');
    $subject = sprintf(
        /* translators: %s: sender name */
        __('New message from %s', 'mondo-theme'),
        $name
    );
    $body = sprintf(
        "Name: %s\nEmail: %s\nPhone: %s\n\nMessage:\n%s",
        $name,
        $email,
        $phone,
        $message
    );
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $email,
    ];

    $sent = wp_mail($to, $subject, $body, $headers);

    if (!$sent && wp_get_environment_type() === 'local') {
        error_log(
            sprintf(
                "[mondo-theme contact form]\nTo: %s\nSubject: %s\n%s",
                $to,
                $subject,
                $body
            )
        );
        $sent = true;
    }

    wp_safe_redirect(add_query_arg('contact', $sent ? 'success' : 'mail', $redirect));
    exit;
}

add_action('admin_post_nopriv_mondo_theme_contact_form', 'mondo_theme_handle_contact_form');
add_action('admin_post_mondo_theme_contact_form', 'mondo_theme_handle_contact_form');
