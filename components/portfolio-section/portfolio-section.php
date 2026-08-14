<?php
$hero_image_id = get_field('portfolio_section_bg');
?>

<section class="portfolio-section" id="portfolio">
    <div class="portfolio-section__inner">
        <header class="portfolio-section__hero">
            <div class="portfolio-section__hero-bg" <?php if ($hero_image_id): ?>
                    style="background-image: url('<?php echo esc_url(wp_get_attachment_image_url($hero_image_id, 'full')); ?>');"
                <?php endif; ?>>
            </div>
            <h2 class="portfolio-section__title">
                <?php echo esc_html(get_field('portfolio_section_title') ?: __('Portfolio', 'mondo-theme')); ?>
            </h2>
        </header>

        <div class="portfolio-section__grid">
            <?php

            $portfolio_query = new WP_Query(array(
                'post_type' => 'portfolio',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'ASC',
            ));

            if ($portfolio_query->have_posts()):
                $index = 0;
                while ($portfolio_query->have_posts()):
                    $portfolio_query->the_post();


                    $tags = get_field('portfolio_tags');
                    $desc = get_field('portfolio_description');
                    $demo_url = get_field('portfolio_demo_url');
                    $info = get_field('portfolio_info');
                    ?>

                    <article class="portfolio-section__item">
                        <div class="portfolio-section__media" aria-hidden="true">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large', array('loading' => 'lazy', 'decoding' => 'async')); ?>
                            <?php else: ?>
                                <div
                                    class="portfolio-section__placeholder portfolio-section__placeholder--<?php echo esc_attr(($index % 6) + 1); ?>">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="portfolio-section__overlay">
                            <div class="portfolio-section__overlay-body">
                                <div class="portfolio-section__ring">
                                    <?php if ($tags): ?>
                                        <span class="portfolio-section__tags"><?php echo esc_html('*' . $tags . '*'); ?></span>
                                    <?php endif; ?>

                                    <h3 class="portfolio-section__item-title"><?php the_title(); ?></h3>

                                    <?php if ($desc): ?>
                                        <p class="portfolio-section__item-desc"><?php echo esc_html($desc); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="portfolio-section__actions">
                                    <?php if ($demo_url): ?>
                                        <a class="btn-merge btn-merge--on-dark btn-merge--sm"
                                            href="<?php echo esc_url($demo_url); ?>" target="_blank" rel="noopener noreferrer">
                                            <?php esc_html_e('Demo', 'mondo-theme'); ?>
                                        </a>
                                    <?php endif; ?>

                                    <button type="button"
                                        class="btn-merge btn-merge--on-dark btn-merge--sm portfolio-section__more"
                                        data-popup-title="<?php echo esc_attr(get_the_title()); ?>"
                                        data-popup-tags="<?php echo esc_attr($tags); ?>"
                                        data-popup-text="<?php echo esc_attr($info); ?>">
                                        <?php esc_html_e('Details', 'mondo-theme'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>

                    <?php
                    $index++;
                endwhile;
                wp_reset_postdata();
            else: ?>
                <p><?php esc_html_e('No portfolio projects found.', 'mondo-theme'); ?></p>
            <?php endif; ?>
        </div>

        <footer class="portfolio-section__footer">
            <p class="portfolio-section__footer-text">
                <?php esc_html_e('And this is just the beginning!', 'mondo-theme'); ?>
            </p>
        </footer>
    </div>
</section>


<div class="portfolio-popup" id="portfolio-popup" hidden>
    <div class="portfolio-popup__backdrop" data-popup-close></div>
    <div class="portfolio-popup__dialog" role="dialog" aria-modal="true" aria-labelledby="portfolio-popup-title">
        <button type="button" class="portfolio-popup__close" data-popup-close
            aria-label="<?php esc_attr_e('Close', 'mondo-theme'); ?>">
            &times;
        </button>
        <p class="portfolio-popup__tags" id="portfolio-popup-tags"></p>
        <h3 class="portfolio-popup__title" id="portfolio-popup-title"></h3>
        <p class="portfolio-popup__text" id="portfolio-popup-text"></p>
    </div>
</div>