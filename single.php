<?php
/**
 * Single Blog Post Template
 * 
 * Displays individual blog posts
 */

get_header();
?>

<main id="primary" class="site-main single-post-page">
    
    <?php
    while (have_posts()) :
        the_post();
        ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-article'); ?>>
            
            <!-- Post Header -->
            <header class="single-post-header">
                <div class="single-post-header-content">
                    
                    <?php
                    $categories = get_the_category();
                    if ($categories) :
                        echo '<div class="post-categories">';
                        foreach ($categories as $category) :
                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-category-badge">';
                            echo esc_html($category->name);
                            echo '</a>';
                        endforeach;
                        echo '</div>';
                    endif;
                    ?>
                    
                    <h1 class="single-post-title"><?php the_title(); ?></h1>
                    
                    <div class="single-post-meta">
                        <div class="meta-item">
                            <span class="meta-icon">📅</span>
                            <span><?php echo get_the_date('F j, Y'); ?></span>
                        </div>
                        
                        <div class="meta-item">
                            <span class="meta-icon">✍️</span>
                            <span><?php the_author(); ?></span>
                        </div>
                        
                        <div class="meta-item">
                            <span class="meta-icon">📖</span>
                            <span>
                                <?php
                                $content = get_post_field('post_content', get_the_ID());
                                $word_count = str_word_count(strip_tags($content));
                                $reading_time = ceil($word_count / 200);
                                echo $reading_time . ' min read';
                                ?>
                            </span>
                        </div>
                    </div>
                    
                </div>
            </header>
            
            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="single-post-featured-image">
                    <?php the_post_thumbnail('full'); ?>
                </div>
            <?php endif; ?>
            
            <!-- Post Content -->
            <div class="single-post-container">
                <div class="single-post-content">
                    <?php the_content(); ?>
                </div>
                
                <!-- Post Footer -->
                <footer class="single-post-footer">
                    
                    <!-- Tags -->
                    <?php
                    $tags = get_the_tags();
                    if ($tags) :
                        ?>
                        <div class="post-tags">
                            <span class="tags-label">Tags:</span>
                            <?php
                            foreach ($tags as $tag) :
                                echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="post-tag">';
                                echo esc_html($tag->name);
                                echo '</a>';
                            endforeach;
                            ?>
                        </div>
                        <?php
                    endif;
                    ?>
                    
                    <!-- Share Section -->
                    <div class="post-share">
                        <span class="share-label">Share:</span>
                        <div class="share-buttons">
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                               target="_blank" 
                               class="share-btn twitter"
                               title="Share on Twitter">
                                🐦 Twitter
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                               target="_blank" 
                               class="share-btn facebook"
                               title="Share on Facebook">
                                📘 Facebook
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                               target="_blank" 
                               class="share-btn linkedin"
                               title="Share on LinkedIn">
                                💼 LinkedIn
                            </a>
                        </div>
                    </div>
                    
                </footer>
                
                <!-- Post Navigation -->
                <nav class="post-navigation">
                    <div class="nav-links">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        
                        if ($prev_post) :
                            ?>
                            <div class="nav-previous">
                                <span class="nav-subtitle">← Previous Post</span>
                                <a href="<?php echo get_permalink($prev_post); ?>" class="nav-title">
                                    <?php echo get_the_title($prev_post); ?>
                                </a>
                            </div>
                            <?php
                        endif;
                        
                        if ($next_post) :
                            ?>
                            <div class="nav-next">
                                <span class="nav-subtitle">Next Post →</span>
                                <a href="<?php echo get_permalink($next_post); ?>" class="nav-title">
                                    <?php echo get_the_title($next_post); ?>
                                </a>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                </nav>
                
                <!-- Comments -->
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
                
            </div>
            
        </article>
        
    <?php endwhile; ?>
    
</main>

<?php
get_footer();