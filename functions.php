<?php
/**
 * Tệp chức năng của theme trungtiendevtheme.
 *
 * @package trungtiendevtheme
 */

if (!defined('TRUNGTIENDEVTHEME_VERSION')) {
    // Đặt phiên bản theme, hữu ích cho việc clear cache trình duyệt khi cập nhật CSS
    define('TRUNGTIENDEVTHEME_VERSION', '1.0.0');
}

/**
 * Thiết lập các tính năng cơ bản của theme.
 */
function trungtiendevtheme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support( 'custom-logo' ); // Khai báo hỗ trợ logo chính
    
    register_nav_menus(
        array(
            'primary' => esc_html__('Primary Menu', 'trungtiendevtheme'),
        )
    );
}
add_action('after_setup_theme', 'trungtiendevtheme_setup');

/**
 * Nạp (enqueue) các script và style.
 */
function trungtiendevtheme_scripts() {
    // Nạp CSS chung (main.css - chứa Tailwind CSS đã build)
    wp_enqueue_style(
        'trungtiendevtheme-style', 
        get_template_directory_uri() . '/assets/css/main.css', 
        array(), 
        TRUNGTIENDEVTHEME_VERSION 
    );

    // Nạp JS chính (dùng jQuery)
    wp_enqueue_script(
        'trungtiendevtheme-main-js', 
        get_template_directory_uri() . '/assets/js/main.js', 
        array('jquery'), 
        TRUNGTIENDEVTHEME_VERSION, 
        true 
    );
    
    // Nạp JS live preview cho Customizer (chỉ khi đang tùy chỉnh)
    if (is_customize_preview()) {
        wp_enqueue_script(
            'trungtiendevtheme-customizer-js',
            get_template_directory_uri() . '/assets/js/customizer-preview.js',
            array('jquery', 'customize-preview'),
            TRUNGTIENDEVTHEME_VERSION,
            true
        );
    }
    
    // ----------------------------------------------------------------
    // LƯU Ý: Không còn hàm nạp Flipbook CSS/JS/Worker ở đây.
    // ----------------------------------------------------------------
}
add_action('wp_enqueue_scripts', 'trungtiendevtheme_scripts');


// --- KHU VỰC CẤU HÌNH CUSTOMIZER (GOM CÁC HÀM CUSTOMIZE VÀO 1 HÀM CHUNG) ---

function trungtientheme_customize_register_all( $wp_customize ) {
    
    // --- 1. Nhận dạng Site và Logo Width (Kích hoạt thanh trượt Logo)
    $wp_customize->add_setting( 'logo_width', array(
        'type' => 'theme_mod', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint',
        'transport' => 'postMessage', 'default' => 180,
    ) );
    $wp_customize->add_control( 'logo_width', array(
        'type' => 'range', 'section' => 'title_tagline', 'label' => __( 'Chiều rộng Logo (px)', 'trungtientheme' ),
        'input_attrs' => array( 'min' => 50, 'max' => 400, 'step' => 5 ),
    ) );

    // --- 2. Footer Logo ---
    $wp_customize->add_section( 'footer_logo_section', array(
        'title' => __( 'Footer Logo', 'trungtiendevtheme' ), 'priority' => 40,
    ) );
    $wp_customize->add_setting( 'footer_logo', array(
        'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo_control', array(
        'label' => __( 'Logo Footer', 'trungtiendevtheme' ), 'section' => 'footer_logo_section', 'settings' => 'footer_logo',
    ) ) );
    
    // --- 3. Hero Section và Topbar ---
    $wp_customize->add_section( 'hero_section', array( 'title' => __( 'Hero Section (Trang Chủ)', 'trungtientheme' ), 'priority' => 30, ) );
    $wp_customize->add_setting( 'hero_heading', array( 'default' => 'Hiến chương Giáo hội Phật giáo Việt Nam', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage', ) );
    $wp_customize->add_control( 'hero_heading_control', array( 'label' => __( 'Tiêu đề Chính Hero', 'trungtientheme' ), 'section' => 'hero_section', 'settings' => 'hero_heading', 'type' => 'text', ) );
    $wp_customize->add_setting( 'hero_description', array( 'default' => 'Nơi lưu trữ và chứng thực các văn bản pháp quy, nghị quyết, và tài liệu nền móng của Giáo hội Phật giáo Việt Nam.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage', ) );
    $wp_customize->add_control( 'hero_description_control', array( 'label' => __( 'Mô tả Hero', 'trungtientheme' ), 'section' => 'hero_section', 'settings' => 'hero_description', 'type' => 'textarea', ) );
    $wp_customize->add_setting( 'hero_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage', ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_foreground_image_control', array( 'label' => __( 'Ảnh nền Hero', 'trungtiendevtheme' ), 'section' => 'hero_section', 'settings' => 'hero_image', ) ) );
    $wp_customize->add_setting( 'hero_cta_post_id', array( 'default' => 0, 'sanitize_callback' => 'absint', ) );
    $wp_customize->add_section( 'topbar_section', array( 'title' => __( 'Thông báo Top Header', 'trungtientheme' ), 'priority' => 25, ) );
    $wp_customize->add_setting( 'topbar_notice_text', array( 'default' => '', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage', ) );
    $wp_customize->add_control( 'topbar_notice_control', array( 'label' => __( 'Nội dung Thông báo Header', 'trungtiendevtheme' ), 'description' => __( 'Nhập thông báo khẩn cấp hoặc tin tức nổi bật. Để trống để ẩn Top Header.', 'trungtiendevtheme' ), 'section' => 'topbar_section', 'settings' => 'topbar_notice_text', 'type' => 'textarea', ) );
    
    // Hàm lấy danh sách tất cả các trang/bài viết để đổ vào dropdown
    $pages = get_pages(); $posts = get_posts( array('numberposts' => -1) ); $choices = array( 0 => '--- Chọn Bài viết/Trang ---' );
    foreach ( $pages as $page ) { $choices[ $page->ID ] = 'Trang: ' . $page->post_title; }
    foreach ( $posts as $post ) { $choices[ $post->ID ] = 'Bài viết: ' . $post->post_title; }
    $wp_customize->add_control( 'hero_cta_post_id_control', array( 'label' => __( 'Liên kết nút CTA', 'trungtientheme' ), 'description' => __( 'Chọn Bài viết hoặc Trang mà nút "Đọc Hiến chương" sẽ dẫn đến.', 'trungtientheme' ), 'section' => 'hero_section', 'settings' => 'hero_cta_post_id', 'type' => 'select', 'choices' => $choices, ) );
    $wp_customize->add_setting( 'hero_cta_text', array( 'default' => 'Xem Chi Tiết', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage', ) );
    $wp_customize->add_control( 'hero_cta_text_control', array( 'label' => __( 'Văn bản Nút CTA', 'trungtientheme' ), 'section' => 'hero_section', 'settings' => 'hero_cta_text', 'type' => 'text', ) );
}
add_action( 'customize_register', 'trungtientheme_customize_register_all' );
