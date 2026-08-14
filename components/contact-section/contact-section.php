<?php
$contact_status = isset($_GET['contact']) ? sanitize_key(wp_unslash($_GET['contact'])) : '';
?>

<section class="contact-section" id="contact">
    <div class="contact-section__inner container">
        <header class="contact-section__header">
            <h2 class="contact-section__title"><?php esc_html_e('Contact', 'mondo-theme'); ?></h2>
        </header>

        <p class="contact-section__intro">
            <?php esc_html_e(
                'Have a project or question? Drop me a message — I\'ll reply and we can discuss the details. Fill out the form below and I\'ll get back to you soon.',
                'mondo-theme'
            ); ?>
        </p>

        <div class="contact-section__divider" aria-hidden="true">
            <span class="contact-section__divider-line"></span>
            <span class="contact-section__divider-mark">\//</span>
            <span class="contact-section__divider-line"></span>
        </div>

        <?php if ($contact_status === 'success') : ?>
            <p class="contact-section__notice contact-section__notice--success" role="status">
                <?php esc_html_e('Thank you! Your message has been sent.', 'mondo-theme'); ?>
            </p>
        <?php elseif ($contact_status === 'invalid') : ?>
            <p class="contact-section__notice contact-section__notice--error" role="alert">
                <?php esc_html_e('Please fill in all required fields and provide a valid email.', 'mondo-theme'); ?>
            </p>
        <?php elseif ($contact_status === 'mail') : ?>
            <p class="contact-section__notice contact-section__notice--error" role="alert">
                <?php esc_html_e('Failed to send the message. Please try again later or email me directly.', 'mondo-theme'); ?>
            </p>
        <?php elseif ($contact_status === 'error') : ?>
            <p class="contact-section__notice contact-section__notice--error" role="alert">
                <?php esc_html_e('Something went wrong. Please check the form and try again.', 'mondo-theme'); ?>
            </p>
        <?php endif; ?>

        <form
            class="contact-section__form"
            method="post"
            action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
        >
            <?php wp_nonce_field('mondo_theme_contact_form', 'mondo_theme_contact_nonce'); ?>
            <input type="hidden" name="action" value="mondo_theme_contact_form">
            <input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url('/#contact')); ?>">

            <div class="contact-section__field">
                <label class="contact-section__label" for="contact-name">
                    <?php esc_html_e('Enter your name*', 'mondo-theme'); ?>
                </label>
                <div class="contact-section__input-wrap">
                    <input
                        class="contact-section__input"
                        type="text"
                        id="contact-name"
                        name="contact_name"
                        required
                        autocomplete="name"
                    >
                </div>
            </div>

            <div class="contact-section__field">
                <label class="contact-section__label" for="contact-email">
                    <?php esc_html_e('Enter your email*', 'mondo-theme'); ?>
                </label>
                <div class="contact-section__input-wrap">
                    <input
                        class="contact-section__input"
                        type="email"
                        id="contact-email"
                        name="contact_email"
                        required
                        autocomplete="email"
                    >
                </div>
            </div>

            <div class="contact-section__field">
                <label class="contact-section__label" for="contact-phone">
                    <?php esc_html_e('Phone number', 'mondo-theme'); ?>
                </label>
                <div class="contact-section__input-wrap">
                    <input
                        class="contact-section__input"
                        type="tel"
                        id="contact-phone"
                        name="contact_phone"
                        autocomplete="tel"
                    >
                </div>
            </div>

            <div class="contact-section__field">
                <label class="contact-section__label" for="contact-message">
                    <?php esc_html_e('Your message*', 'mondo-theme'); ?>
                </label>
                <div class="contact-section__input-wrap contact-section__input-wrap--textarea">
                    <textarea
                        class="contact-section__input contact-section__input--textarea"
                        id="contact-message"
                        name="contact_message"
                        required
                    ></textarea>
                </div>
            </div>

            <div class="contact-section__submit">
                <button type="submit" class="btn-merge btn-merge--on-light">
                    <?php esc_html_e('Send', 'mondo-theme'); ?>
                </button>
            </div>
        </form>
    </div>
</section>
