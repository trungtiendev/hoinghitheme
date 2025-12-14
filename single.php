<?php
/**
 * Template để hiển thị một Bài viết đơn lẻ (Single Post).
 *
 * File này hiện chỉ hỗ trợ hiển thị nội dung bài viết thông thường.
 * (Đã loại bỏ logic Flipbook PDF).
 *
 * @package trungtiendevtheme
 */

get_header(); // Nạp tệp header.php
?>

<div class="main-content-wrapper">
    <?php if ( have_posts() ) : // Bắt đầu Vòng lặp WordPress (The Loop) ?>

        <?php while ( have_posts() ) : the_post(); // Lặp qua bài viết hiện tại ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white p-2 md:p-10 rounded-lg shadow-xl mb-12'); ?>>
                
                <header class="mb-6 border-b border-gray-200 pb-4">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-content mb-3">
                        <?php the_title(); ?>
                    </h1>
                    
                    <div class="entry-meta text-sm text-gray-500 flex items-center space-x-4">
                        <span class="posted-on">
                            <svg class="w-4 h-4 inline me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="byline">
                            <svg class="w-4 h-4 inline me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4.418 0-8 3.582-8 8h16c0-4.418-3.582-8-8-8z"></path></svg>
                            <?php the_author(); ?>
                        </span>
                    </div>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mb-8">
                        <?php the_post_thumbnail('large', ['class' => 'w-full h-auto object-cover rounded-lg']); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content prose prose-lg max-w-none text-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Trang:', 'trungtiendevtheme' ),
                        'after'  => '</div>',
                    ) ); ?>
                </div>
                
                <footer class="mt-8 pt-4 border-t border-gray-200">
                    <span class="cat-links text-sm text-gray-500">
                        <?php esc_html_e( 'Chuyên mục: ', 'trungtiendevtheme' ); ?>
                        <?php the_category(', '); ?>
                    </span>
                    
                    <?php the_tags( '<div class="tag-links text-sm text-gray-500 mt-2">Tags: ', ', ', '</div>' ); ?>
                </footer>
                
                <?php 
                // Hiển thị phần Bình luận và Form bình luận
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>

            </article><?php endwhile; // Kết thúc vòng lặp while ?>

    <?php else : // Nếu không tìm thấy Bài viết ?>

        <p class="text-center text-xl text-gray-500 py-12">
            <?php esc_html_e( 'Rất tiếc, không tìm thấy nội dung bài viết này.', 'trungtiendevtheme' ); ?>
        </p>

    <?php endif; // Kết thúc The Loop ?>
</div>

<?php
get_footer(); // Nạp tệp footer.php
?>