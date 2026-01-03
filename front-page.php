<?php get_header(); ?>

<section class="hero">
    <!-- Floating Orbs -->
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="hero-orb hero-orb-3"></div>

    <div class="hero-content-wrapper">
        <!-- Typing Animation Title -->
        <h1 id="typing-title">Hi, I'm Jetler Egido<span class="typing-cursor"></span></h1>
        
        <p>Full-Stack Developer • Creative Problem Solver • Digital Experience Architect</p>

        <!-- 3D Hero Image -->
        <section class="my-hero-image">
            <div class="hero-image-inner">
                <img src="<?php echo get_template_directory_uri(); ?>/images/oka.jpg" alt="Jetler Egido" class="hero-image">
            </div>
        </section>

        <!-- CTA Buttons -->
        <div class="hero-cta">
            <a href="#projects" class="hero-btn hero-btn-primary">
                <span>View My Work</span>
            </a>
            <a href="#contact" class="hero-btn hero-btn-secondary">
                <span>Get In Touch</span>
            </a>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <span class="scroll-text">Scroll Down</span>
        <div class="scroll-mouse"></div>
        <div class="scroll-arrow"></div>
    </div>
</section>

<!-- <section class="projects" id="projects">
    <h2>Featured Projects</h2>

    <div class="project-grid">
        <?php
        // Query latest 6 Projects
        $args = array(
            'post_type'      => 'project',
            'posts_per_page' => 6,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
        $projects = new WP_Query($args);

        if ($projects->have_posts()) :
            while ($projects->have_posts()) : $projects->the_post();
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
            wp_reset_postdata();
        else :
            echo '<p style="color: rgba(255,255,255,0.7); text-align: center; grid-column: 1/-1; font-size: 1.2rem;">No projects found yet. Stay tuned for amazing work!</p>';
        endif;
        ?>
    </div>
</section> -->

<script>
// ========== TYPING ANIMATION ==========
const typingTitle = document.getElementById('typing-title');
const text = "Hi, I'm Jetler Egido";
const cursor = typingTitle.querySelector('.typing-cursor');

// Clear existing text
typingTitle.textContent = '';
typingTitle.appendChild(cursor);

let index = 0;
function typeText() {
    if (index < text.length) {
        const textNode = document.createTextNode(text.charAt(index));
        typingTitle.insertBefore(textNode, cursor);
        index++;
        setTimeout(typeText, 100);
    }
}

// Start typing after a short delay
setTimeout(typeText, 500);

// ========== SMOOTH SCROLLING ==========
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// ========== PARALLAX EFFECT FOR HERO ORBS ==========
document.addEventListener('mousemove', (e) => {
    const orbs = document.querySelectorAll('.hero-orb');
    const x = e.clientX / window.innerWidth;
    const y = e.clientY / window.innerHeight;
    
    orbs.forEach((orb, index) => {
        const speed = (index + 1) * 20;
        const xMove = (x - 0.5) * speed;
        const yMove = (y - 0.5) * speed;
        
        orb.style.transform = `translate(${xMove}px, ${yMove}px)`;
    });
});

// ========== 3D TILT EFFECT ON HERO IMAGE ==========
const heroImage = document.querySelector('.hero-image-inner');

if (heroImage) {
    heroImage.addEventListener('mousemove', (e) => {
        const rect = heroImage.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        
        const rotateX = (y - centerY) / 10;
        const rotateY = (centerX - x) / 10;
        
        heroImage.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
    });
    
    heroImage.addEventListener('mouseleave', () => {
        heroImage.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale(1)';
    });
}

// ========== CURSOR TRAIL EFFECT (Optional - adds magic!) ==========
let mouseX = 0, mouseY = 0;
let cursorX = 0, cursorY = 0;

document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
});

function createTrail() {
    cursorX += (mouseX - cursorX) * 0.1;
    cursorY += (mouseY - cursorY) * 0.1;
    
    const trail = document.createElement('div');
    trail.style.position = 'fixed';
    trail.style.left = cursorX + 'px';
    trail.style.top = cursorY + 'px';
    trail.style.width = '5px';
    trail.style.height = '5px';
    trail.style.borderRadius = '50%';
    trail.style.background = 'radial-gradient(circle, rgba(16, 185, 129, 0.8), transparent)';
    trail.style.pointerEvents = 'none';
    trail.style.zIndex = '9999';
    trail.style.boxShadow = '0 0 10px rgba(16, 185, 129, 0.8)';
    
    document.body.appendChild(trail);
    
    setTimeout(() => {
        trail.style.transition = 'opacity 0.5s, transform 0.5s';
        trail.style.opacity = '0';
        trail.style.transform = 'scale(2)';
    }, 10);
    
    setTimeout(() => {
        trail.remove();
    }, 500);
}

// Uncomment this if you want the cursor trail effect
// setInterval(createTrail, 50);
</script>

<?php get_footer(); ?>