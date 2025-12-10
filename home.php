<?php
/**
 * Blog Archive Template
 * Template Name: Blog
 * Displays the blog posts listing page
 */

get_header();
?>

<div class="blog-header">
    <div class="blog-header-content">
        <h1 class="blog-title">Blog</h1>
        <p class="blog-description">Insights, tutorials, and thoughts on web development</p>
    </div>
</div>

<main id="primary" class="site-main blog-archive">
    <div class="blog-container">
        
        <div class="blog-posts">
            <?php
            if (have_posts()) :
                
                echo '<div class="posts-grid">';
                
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="blog-card-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="blog-card-content">
                            
                            <div class="blog-meta">
                                <span class="blog-date">
                                    <i class="date-icon">📅</i>
                                    <?php echo get_the_date('F j, Y'); ?>
                                </span>
                                
                                <?php
                                $categories = get_the_category();
                                if ($categories) :
                                    echo '<span class="blog-category">';
                                    echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">';
                                    echo esc_html($categories[0]->name);
                                    echo '</a>';
                                    echo '</span>';
                                endif;
                                ?>
                            </div>
                            
                            <h2 class="blog-card-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                            <div class="blog-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <div class="blog-card-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                    Read More →
                                </a>
                                
                                <span class="reading-time">
                                    <?php
                                    $content = get_post_field('post_content', get_the_ID());
                                    $word_count = str_word_count(strip_tags($content));
                                    $reading_time = ceil($word_count / 200);
                                    echo $reading_time . ' min read';
                                    ?>
                                </span>
                            </div>
                            
                        </div>
                        
                    </article>
                    
                    <?php
                endwhile;
                
                echo '</div>'; // .posts-grid
                
                // Pagination
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '← Previous',
                    'next_text' => 'Next →',
                    'class' => 'blog-pagination',
                ));
                
            else :
                ?>
                <div class="no-posts">
                    <h2>No posts found</h2>
                    <p>Check back later for new content!</p>
                </div>
                <?php
            endif;
            ?>
        </div>
        
        <?php get_sidebar(); ?>
        
    </div>
</main>

<?php
get_footer();