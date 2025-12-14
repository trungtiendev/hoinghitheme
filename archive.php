<?php
/**
 * Template để hiển thị các trang lưu trữ (Archive pages).
 *
 * Bao gồm Categories, Tags, Authors, và Date archives.
 *
 * @package trungtiendevtheme
 */

get_header(); // Nạp tệp header.php (mở <html>, <body>, header, và mở thẻ <main>)
?>

<div class="archive-header mb-8">
    
    <h1 class="text-4xl font-bold text-secondary border-b-2 border-primary pb-3 mb-2">
        <?php
        // Hiển thị tiêu đề lưu trữ động
        if ( is_category() ) :
            single_cat_title( 'Chuyên mục: ' ); // Ví dụ: Chuyên mục: Hiến Chương
        elseif ( is_tag() ) :
            single_tag_title( 'Thẻ: ' ); // Ví dụ: Thẻ: văn kiện
        elseif ( is_author() ) :
            the_post(); // Lấy dữ liệu tác giả
            echo 'Tác giả: ' . get_the_author();
            rewind_posts(); // Quay lại đầu vòng lặp
        elseif ( is_day() ) :
            echo 'Lưu trữ theo Ngày: ' . get_the_date();
        elseif ( is_month() ) :
            echo 'Lưu trữ theo Tháng: ' . get_the_date( 'F Y' );
        elseif ( is_year() ) :
            echo 'Lưu trữ theo Năm: ' . get_the_date( 'Y' );
        else :
            echo 'Lưu trữ Bài viết'; // Tiêu đề dự phòng
        endif;
        ?>
    </h1>
    
    <?php
    // Hiển thị mô tả chuyên mục/thẻ (nếu có)
    the_archive_description( '<div class="text-lg text-gray-600 mt-2">', '</div>' );
    ?>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    
    <?php if ( have_posts() ) : // Bắt đầu Vòng lặp WordPress ?>

        <?php while ( have_posts() ) : the_post(); // Lặp qua tất cả bài viết trong lưu trữ này ?>
            
            <?php get_template_part( 'template-parts/content', 'archive' ); ?>

        <?php endwhile; ?>
        
    <?php else : ?>

        <div class="col-span-full">
            <p class="text-center text-xl text-gray-500 py-12 bg-white rounded-lg shadow-md">
                <?php esc_html_e( 'Rất tiếc, không tìm thấy bài viết nào trong mục này.', 'trungtiendevtheme' ); ?>
            </p>
        </div>

    <?php endif; ?>

</div>

<div class="mt-12 flex justify-center">
    <?php
    // Hiển thị các liên kết phân trang (Older Posts / Newer Posts hoặc số trang)
    the_posts_pagination( array(
        'prev_text' => '<span class="text-lg">&larr;</span> ' . esc_html__( 'Trước', 'trungtiendevtheme' ),
        'next_text' => esc_html__( 'Sau', 'trungtiendevtheme' ) . ' <span class="text-lg">&rarr;</span>',
        'screen_reader_text' => 'Điều hướng bài viết',
        'mid_size'  => 2, // Hiển thị 2 số trang ở giữa
    ) );
    ?>
</div>

<?php
get_footer(); // Nạp tệp footer.php
?>