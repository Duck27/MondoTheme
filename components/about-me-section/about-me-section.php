<?php
$about_text = get_field('about_text');
$about_left = get_field('about_left');
$about_right = get_field('about_right');

$services = [];

if ($about_left) {
    $services[] = [
        'title' => $about_left['left_title'] ?? '',
        'description' => $about_left['left_subtitle'] ?? '',
        'icon_id' => $about_left['left_icon'] ?? null,
        'reverse' => false,
    ];
}

if ($about_right) {
    $services[] = [
        'title' => $about_right['right_title'] ?? '',
        'description' => $about_right['right_subtitle'] ?? '',
        'icon_id' => $about_right['right_icon'] ?? null,
        'reverse' => true,
    ];
}
?>

<section class="about-me-section" id="about-me">
    <div class="about-me-section__inner container">
        <header class="about-me-section__header">
            <h2 class="about-me-section__title"><?php esc_html_e('About Me', 'mondo-theme'); ?></h2>
        </header>

        <?php if ($about_text): ?>
            <p class="about-me-section__intro"><?php echo esc_html($about_text); ?></p>
        <?php endif; ?>

        <a class="btn-merge btn-merge--on-light" href="#skills">
            <?php esc_html_e('View', 'mondo-theme'); ?>
        </a>

        <div class="about-me-section__divider" aria-hidden="true">
            <span class="about-me-section__divider-line"></span>
            <span class="about-me-section__divider-mark">\/</span>
            <span class="about-me-section__divider-line"></span>
        </div>

        <?php if ($services): ?>
            <div class="about-me-section__services">
                <?php foreach ($services as $service): ?>
                    <?php
                    $icon_id = $service['icon_id'];
                    $has_icon = !empty($icon_id);
                    ?>
                    <article class="about-me-section__service">
                        <?php if (!$service['reverse']): ?>
                            <div class="about-me-section__icon<?php echo $has_icon ? ' about-me-section__icon--has-image' : ''; ?>"
                                aria-hidden="true">
                                <?php if ($has_icon): ?>
                                    <?php echo wp_get_attachment_image($icon_id, 'thumbnail', false, [
                                        'width' => 72,
                                        'height' => 72,
                                        'loading' => 'lazy',
                                        'decoding' => 'async',
                                    ]); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div
                            class="about-me-section__service-body<?php echo $service['reverse'] ? ' about-me-section__service-right' : ''; ?>">
                            <?php if ($service['title']): ?>
                                <h3 class="about-me-section__service-title">
                                    <?php echo esc_html($service['title']); ?>
                                </h3>
                            <?php endif; ?>
                            <?php if ($service['description']): ?>
                                <p class="about-me-section__service-text"><?php echo esc_html($service['description']); ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if ($service['reverse']): ?>
                            <div class="about-me-section__icon<?php echo $has_icon ? ' about-me-section__icon--has-image' : ''; ?>"
                                aria-hidden="true">
                                <?php if ($has_icon): ?>
                                    <?php echo wp_get_attachment_image($icon_id, 'thumbnail', false, [
                                        'width' => 72,
                                        'height' => 72,
                                        'loading' => 'lazy',
                                        'decoding' => 'async',
                                    ]); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="about-me-section__divider" aria-hidden="true">
            <span class="about-me-section__divider-line"></span>
            <span class="about-me-section__divider-mark">\/</span>
            <span class="about-me-section__divider-line"></span>
        </div>
    </div>
</section>