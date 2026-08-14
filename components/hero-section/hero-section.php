<?php
$hero_image_id = get_field('hero_photo');
$hero_name = get_field('hero_name');
$hero_job = get_field('hero_job');
$hero_text = get_field('hero_text');

?>

<section class="hero-section">
    <div class="hero-section__bar container">
        <div class="hero-section__bar-grid">
            <nav class="hero-section__nav hero-section__nav--left"
                aria-label="<?php esc_attr_e('Main navigation', 'mondo-theme'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'header_left',
                    'container' => false,
                    'menu_class' => 'hero-section__menu',
                    'fallback_cb' => false,
                    'depth' => 1,
                ));
                ?>
            </nav>

            <nav class="hero-section__nav hero-section__nav--right"
                aria-label="<?php esc_attr_e('Secondary navigation', 'mondo-theme'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'header_right',
                    'container' => false,
                    'menu_class' => 'hero-section__menu',
                    'fallback_cb' => false,
                    'depth' => 1,
                ));
                ?>
            </nav>
        </div>
    </div>

    <div class="hero-section__content">
        <div class="hero-section__content-left">
            <figure class="hero-section__photo">
                <?php if ($hero_image_id):
                    echo wp_get_attachment_image($hero_image_id, 'large', false, array('class' => 'hero-img'));
                endif; ?>
            </figure>
        </div>

        <div class="hero-section__content-right">
            <div class="hero-section__intro">
                <h2 class="hero-section__greeting"><?php esc_html_e('Hi, I\'m', 'mondo-theme'); ?></h2>

                <?php if (get_field('hero_name')): ?>
                    <h1 class="hero-section__name">
                        <?php esc_html_e($hero_name); ?>
                    </h1>
                <?php endif; ?>



                <?php if (get_field('hero_name')): ?>
                    <p class="hero-section__role">
                        <?php esc_html_e($hero_job); ?>
                    </p>
                <?php endif; ?>

                <?php mondo_render_social_links('hero-section__social'); ?>
            </div>
        </div>
    </div>

    <div class="hero_text" id="about">

        <div class="hero_text__inner container">
            <?php if ($hero_text): ?>
                <p class="hero_text__text"><?php echo esc_html($hero_text); ?></p>
            <?php endif; ?>


            <a class="btn-merge btn-merge--on-dark" href="#about-me">
                <?php esc_html_e('Learn More', 'mondo-theme'); ?>
            </a>
        </div>
    </div>
</section>