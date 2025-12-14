<?php
/**
 * Template cho Trang Chủ tùy chỉnh.
 *
 * @package trungtiendevtheme
 */

get_header(); // Nạp tệp header.php
?>

<div class="site-main-content p-2">

    <section class="mb-12">
        <div class="flex flex-col md:flex-row items-center justify-between mb-6 border-b-2 border-secondary">
            <h2 class="text-4xl font-bold mb-4 text-secondary">Văn Bản Mới Cập Nhật</h2>
            <a href="<?php echo esc_url( home_url( '/category/tai-lieu-hoi-nghi/' ) ); ?>" class="inline-block mb-4 text-primary font-semibold hover:text-accent transition-colors">
                Xem tất cả văn kiện &rarr; 
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            // Tạo truy vấn mới: 3 bài viết mới nhất
            $recent_posts = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'post_status'    => 'publish',
            ));

            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    // Nạp template loop đã tạo ở Bước 1
                    get_template_part('template-parts/content', 'loop');
                endwhile;
                // QUAN TRỌNG: Thiết lập lại dữ liệu bài viết toàn cục
                wp_reset_postdata();
            else :
                echo '<p class="col-span-3 text-center text-gray-500">Chưa có văn bản nào được cập nhật.</p>';
            endif;
            ?>
        </div>
    </section>

    <hr class="my-12 border-gray-200" />

    <section class="mb-12">
        <div class="flex flex-col md:flex-row items-center justify-between mb-6 border-b-2 border-secondary">
            <h2 class="text-4xl font-bold mb-4 text-secondary">Văn Kiện Hội Nghị</h2>
            <a href="<?php echo esc_url( home_url( '/category/tai-lieu-hoi-nghi/' ) ); ?>" class="inline-block mb-4 text-primary font-semibold hover:text-accent transition-colors">
                Xem tất cả văn kiện &rarr; 
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php
            // Tạo truy vấn mới: 4 bài viết trong chuyên mục 'hien-chuong'
            $hien_chuong_posts = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'category_name'  => 'tai-lieu-hoi-nghi', // Thay thế bằng slug chuyên mục thực tế
                'post_status'    => 'publish',
            ));

            if ($hien_chuong_posts->have_posts()) :
                while ($hien_chuong_posts->have_posts()) : $hien_chuong_posts->the_post();
                    // Tùy chỉnh hiển thị cho vùng này nếu cần (hoặc dùng content-loop)
                    get_template_part('template-parts/content', 'loop');
                endwhile;
                // QUAN TRỌNG: Thiết lập lại dữ liệu bài viết toàn cục
                wp_reset_postdata();
            else :
                echo '<p class="col-span-2 text-center text-gray-500">Không tìm thấy văn kiện Hiến Chương nào.</p>';
            endif;
            ?>
        </div>
    </section>

</div>

<?php get_footer(); ?>