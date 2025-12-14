<?php
/**
 * Template để hiển thị một Trang tĩnh (Page).
 *
 * File này được sử dụng khi truy cập một Trang đơn lẻ (ví dụ: Trang Giới thiệu, Trang Liên hệ).
 *
 * @package trungtiendevtheme
 */

get_header(); // Nạp tệp header.php
?>

<div class="site-main-content">
    
    <?php if ( have_posts() ) : // Bắt đầu Vòng lặp WordPress ?>

        <?php while ( have_posts() ) : the_post(); // Lặp qua trang hiện tại ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white p-0 md:p-10 rounded-lg shadow-xl mb-12'); ?>>
                
                <header class="mb-8 border-b border-primary pb-4">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-content">
                        <?php the_title(); // Hiển thị tiêu đề Trang ?>
                    </h1>
                </header>

                <?php 
                // Hiển thị ảnh đại diện (nếu có)
                if ( has_post_thumbnail() ) : 
                ?>
                    <div class="mb-8">
                        <?php the_post_thumbnail('large', ['class' => 'w-full h-auto object-cover rounded-lg shadow-md']); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content prose prose-lg max-w-none text-content">
                    <?php
                    // Hiển thị toàn bộ nội dung của Trang
                    the_content();

                    // Xử lý liên kết phân trang nội dung (nếu dùng tag )
                    wp_link_pages( array(
                        'before' => '<div class="page-links mt-6 border-t pt-4 text-sm font-semibold">' . esc_html__( 'Trang:', 'trungtiendevtheme' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>
                
                <?php 
                // Hiển thị phần Bình luận và Form bình luận (nếu được bật trong Admin)
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>

            </article><?php endwhile; ?>

    <?php else : // Nếu không tìm thấy Trang ?>

        <div class="bg-white p-10 rounded-lg shadow-md my-12 text-center">
            <h1 class="text-3xl font-bold text-content mb-4">
                <?php esc_html_e( 'Trang không tồn tại.', 'trungtiendevtheme' ); ?>
            </h1>
            <p class="text-lg text-gray-600">
                <?php esc_html_e( 'Xin lỗi, chúng tôi không thể tìm thấy trang bạn yêu cầu.', 'trungtiendevtheme' ); ?>
            </p>
        </div>

    <?php endif; ?>

</div>

<?php
get_footer(); // Nạp tệp footer.php
?>