<?php get_header(); ?>

<section class="projects" id="projects">
    <h2>Featured Projects</h2>

    <div class="project-grid">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article class="project-item">

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="project-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <h3 class="project-title"><?php the_title(); ?></h3>

                    <?php
                    /* ---------- Type (taxonomy: project_type) ---------- */
                    $terms = get_the_terms(get_the_ID(), 'project_type');
                    if ($terms && !is_wp_error($terms)) :
                        $term_names = array();
                        foreach ($terms as $term) {
                            $term_names[] = $term->name;
                        }
                        ?>
                        <p class="project-type">
                            <strong>Type:</strong>
                            <?php echo esc_html(implode(', ', $term_names)); ?>
                        </p>
                    <?php endif; ?>

                    <?php
                    /* ---------- Client ---------- */
                    $client_name = get_post_meta(get_the_ID(), '_project_client_name', true);

                    if ($client_name) : ?>
                        <p class="project-client">
                            <strong>Client:</strong>
                            <?php echo esc_html($client_name); ?>
                        </p>
                    <?php endif; ?>

                    <a href="<?php the_permalink(); ?>" class="project-link">View Project</a>
                </article>
                <?php
            endwhile;
            
            // Pagination (optional)
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('« Previous', 'my-portfolio-theme'),
                'next_text' => __('Next »', 'my-portfolio-theme'),
            ));
            
        else :
            echo '<p style="color: rgba(255,255,255,0.7); text-align: center; grid-column: 1/-1; font-size: 1.2rem;">No projects found yet. Stay tuned for amazing work!</p>';
        endif;
        ?>
    </div>
</section>

<script>
// ========== INTERSECTION OBSERVER FOR PROJECT CARDS ==========
const observerOptions = {
    threshold: 0.15,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0) rotateX(0)';
        }
    });
}, observerOptions);

document.querySelectorAll('.project-item').forEach(item => {
    observer.observe(item);
});

// ========== 3D TILT FOR PROJECT CARDS ==========
document.querySelectorAll('.project-item').forEach(card => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        
        const rotateX = (y - centerY) / 20;
        const rotateY = (centerX - x) / 20;
        
        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-20px) scale(1.03)`;
    });
    
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0) scale(1)';
    });
});
</script>

<?php get_footer(); ?>