<?php
/**
 * The main template file
 * 
 * This is the fallback template used when no other specific template is found.
 * It displays a generic archive/listing of posts.
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 * @package My_Portfolio_Theme
 */

get_header();
?>

<div class="generic-archive-header">
    <div class="generic-archive-content">
        <?php
        if (is_home() && !is_front_page()) :
            ?>
            <h1 class="generic-archive-title">Blog</h1>
            <p class="generic-archive-description">Insights, tutorials, and thoughts on web development</p>
            <?php
        elseif (is_archive()) :
            ?>
            <span class="archive-label">Archive</span>
            <h1 class="generic-archive-title"><?php the_archive_title(); ?></h1>
            <?php
            if (get_the_archive_description()) :
                ?>
                <div class="generic-archive-description">
                    <?php the_archive_description(); ?>
                </div>
                <?php
            endif;
        elseif (is_search()) :
            ?>
            <span class="archive-label">Search Results</span>
            <h1 class="generic-archive-title">
                "<?php echo get_search_query(); ?>"
            </h1>
            <p class="generic-archive-description">
                <?php
                global $wp_query;
                $count = $wp_query->found_posts;
                echo $count . ' ' . ($count == 1 ? 'result' : 'results') . ' found';
                ?>
            </p>
            <?php
        else :
            ?>
            <h1 class="generic-archive-title">Latest Posts</h1>
            <p class="generic-archive-description">All content from this site</p>
            <?php
        endif;
        ?>
    </div>
</div>

<main id="primary" class="site-main blog-archive">
    <div class="blog-container">
        
        <div class="blog-posts">
            <?php
            if (have_posts()) :
                
                echo '<div class="posts-grid">';
                
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
                                // Show post type for non-posts
                                $post_type = get_post_type();
                                if ($post_type !== 'post') :
                                    $post_type_obj = get_post_type_object($post_type);
                                    echo '<span class="post-type-badge">' . esc_html($post_type_obj->labels->singular_name) . '</span>';
                                else :
                                    // Show category for regular posts
                                    $categories = get_the_category();
                                    if ($categories) :
                                        echo '<span class="blog-category">';
                                        echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">';
                                        echo esc_html($categories[0]->name);
                                        echo '</a>';
                                        echo '</span>';
                                    endif;
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
                                    <?php echo ($post_type === 'project') ? 'View Project →' : 'Read More →'; ?>
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
                ));
                
            else :
                ?>
                <div class="no-posts">
                    <?php if (is_search()) : ?>
                        <h2>No results found</h2>
                        <p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>
                    <?php else : ?>
                        <h2>No content found</h2>
                        <p>It looks like nothing was found at this location.</p>
                    <?php endif; ?>
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
