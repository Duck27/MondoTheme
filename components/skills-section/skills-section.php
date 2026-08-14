<?php
$skill_categories = get_terms(array(
    'taxonomy' => 'skill_category',
    'hide_empty' => true,
));
?>

<section class="skills-section" id="skills">
    <div class="skills-section__inner container">
        <header class="skills-section__header">
            <h2 class="skills-section__title"><?php esc_html_e('Skills', 'mondo-theme'); ?></h2>
        </header>

        <?php if (!empty($skill_categories) && !is_wp_error($skill_categories)): ?>
            <div class="skills-section__groups">
                <?php foreach ($skill_categories as $category): ?>
                    <?php
                    $skills_query = new WP_Query(array(
                        'post_type' => 'skill',
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'skill_category',
                                'field' => 'term_id',
                                'terms' => $category->term_id,
                            ),
                        ),
                    ));
                    ?>

                    <?php if ($skills_query->have_posts()): ?>
                        <section class="skills-section__group">
                            <h3 class="skills-section__group-title"><?php echo esc_html($category->name); ?></h3>

                            <ul class="skills-section__grid">
                                <?php while ($skills_query->have_posts()):
                                    $skills_query->the_post(); ?>
                                    <li class="skills-section__item">
                                        <div class="skills-section__icon<?php echo has_post_thumbnail() ? ' skills-section__icon--has-image' : ''; ?>"
                                            aria-hidden="true">
                                            <?php if (has_post_thumbnail()): ?>
                                                <?php the_post_thumbnail('thumbnail', array(
                                                    'alt' => '',
                                                    'width' => 72,
                                                    'height' => 72,
                                                    'loading' => 'lazy',
                                                    'decoding' => 'async',
                                                )); ?>
                                            <?php endif; ?>
                                        </div>
                                        <span class="skills-section__label"><?php the_title(); ?></span>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </section>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>