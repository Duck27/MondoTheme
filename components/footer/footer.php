<footer class="site-footer">
    <div class="site-footer__inner container">
        <a class="site-footer__back-to-top" href="#top">
            <svg class="site-footer__chevrons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                <path fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" d="m6 15 6-6 6 6"/>
                <path fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" d="m6 19 6-6 6 6"/>
            </svg>
            <span class="site-footer__back-to-top-text"><?php esc_html_e('Back to top', 'mondo-theme'); ?></span>
        </a>

        <?php mondo_render_social_links('hero-section__social'); ?>

        <p class="site-footer__copyright">
            <?php
            printf(
                esc_html__('©%1$s %2$s %3$s', 'mondo-theme'),
                esc_html(gmdate('Y')),
                esc_html__('Alexander Kirillov', 'mondo-theme'),
                esc_html__('All rights reserved.', 'mondo-theme')
            );
            ?>
        </p>
    </div>
</footer>
