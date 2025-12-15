<?php
/**
 * Template cho phần Header.
 *
 * @package hoinghitheme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); // Thêm thuộc tính ngôn ngữ (ví dụ: lang="vi") ?>>
<head>
    <meta charset="<?php bloginfo('charset'); // Thêm bộ ký tự của website ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); // Hook quan trọng: WordPress và plugin sẽ chèn CSS, JS, meta tags tại đây ?>
</head>
<body <?php body_class('bg-gray-50 text-gray-800 antialiased'); // Thêm các class CSS động vào body ?>>

<?php wp_body_open(); // Hook cho các plugin chèn mã ngay sau khi mở body ?>

<div id="page" class="flex flex-col min-h-screen">
    <header id="masthead" class="bg-secondary text-white shadow-md">
        <div class="flex flex-col">
            <!-- Top Header -->
            <?php
                $topbar_text = get_theme_mod( 'topbar_notice_text', '' );
            ?>
            <?php if ( ! empty( $topbar_text ) ) : ?>
            <div id="top-header-notice" class="bg-primary text-white flash-notice animate-flash"> 
                <div class="container mx-auto max-w-6xl px-4 py-2 flex text-sm">
                    <span data-customize-setting-link="topbar_notice_text">
                        <?php echo wp_kses_post( $topbar_text ); // Cho phép một số thẻ HTML cơ bản?>
                    </span>
                    <span id="notice-countdown" class="ms-2 font-bold">Biến mất sau [5] giấy</span>
                </div>
            </div>
            <hr id="top-header-hr" class="border-b-1 border-gray-300"/> 
            <?php endif; ?>
            <!-- Site brand Và search form -->
            <div class="container mx-auto max-w-6xl px-4 py-4 flex items-center gap-2 justify-center md:justify-start">
                <?php
                $logo_id = get_theme_mod( 'custom_logo' );
                $logo_url = wp_get_attachment_image_url( $logo_id , 'full' );
                $logo_width = get_theme_mod( 'logo_width', 180 ); // Lấy chiều rộng logo từ Customizer, mặc định 180px
                ?>
                <?php if ( $logo_url ) : ?>
                    <div class="">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="width: <?php echo esc_attr( $logo_width ); ?>px; height: auto;">
                        </a>
                    </div>
                <?php endif; ?>
                <div class="site-branding flex items-center space-x-4">
                    <div class="site-branding">
                        <h1 class="text-sm md:text-2xl font-bold text-body text-center md:text-left mb-0">
                            <a href="<?php echo esc_url(home_url('/')); // Lấy URL trang chủ ?>" rel="home">
                                <?php bloginfo('name'); // Hiển thị tên website ?>
                            </a>
                        </h1>
                        <p class="text-sm md:text-xl text-body text-center md:text-left mb-0"><?php bloginfo('description'); // Hiển thị mô tả Website?></p> 
                    </div>
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="p-2 rounded-md text-white hover:bg-gray-700 focus:outline-none">
                        <span class="sr-only">Open main menu</span>
                        <svg id="menu-icon-open" class="h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <svg id="menu-icon-close" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <hr class="border-b-1 border-gray-300 hidden md:block"/>
            <!-- Thanh menu -->
            <div class="site-navigation hidden md:block">
                <?php
                // Hiển thị menu có ID 'primary' mà chúng ta đã đăng ký
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary', // Phải khớp với ID đã đăng ký trong functions.php
                        'menu_class'     => 'container mx-auto max-w-6xl primary-menu flex px-4 gap-4 py-2', // THÊM class tùy chỉnh 'primary-menu'
                        'container'      => false, // Không bọc menu trong thẻ <div>
                        'fallback_cb'    => false, // Không hiển thị gì nếu menu chưa được gán
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        // (Nâng cao) Để thêm class vào thẻ <a>, bạn sẽ cần tùy biến CSS
                        // hoặc dùng một "Walker" (phức tạp hơn)
                    )
                );
                ?>

                <?php
                // Hiển thị một link dự phòng nếu menu 'primary' chưa được tạo hoặc gán
                if (!has_nav_menu('primary')) {
                    echo '<a href="' . admin_url('nav-menus.php') . '" class="text-gray-600 hover:text-blue-600">Click để tạo Menu</a>';
                }
                ?>
            </div>
            <!-- Menu Mobile -->
            <div id="mobile-menu" class="md:hidden hidden transition-hidden duration-300 ease-in-out">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_class'     => 'primary-menu-mobile flex flex-col gap-1 ps-4',
                            'container'      => false,
                            'fallback_cb'    => false,
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        )
                    );
                    ?>
                </div>
            </div>
        </div>
    </header>
    <!-- Phần Hero -->
    <?php if ( is_front_page() ) : ?>
        <?php 
        // 1. Lấy URL ảnh hero
        $hero_img_url = get_theme_mod( 'hero_image' );
        ?>
        
        <?php if ( $hero_img_url ) : ?>
            <section id="hero-section">
                <div class="container mx-auto max-w-6xl p-4">
                    <div class="flex items-center justify-center gap-4 flex-col md:flex-row">
                        <div>
                            <img src="<?php echo esc_url( $hero_img_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="w-96 h-auto object-cover rounded-lg">
                        </div>
                        <div>
                            <?php
                                $hero_heading = get_theme_mod('hero_heading', 'Tiêu đề Hero');
                                $hero_description = get_theme_mod('hero_description', 'Đoạn văn mô tả Hero...');
                            ?>
                            <h1 class="leading-tight text-3xl md:text-5xl font-medium tracking-tight text-balance text-zinc-950 text-center md:text-left" data-customize-setting-link="hero_heading">
                                <?php echo esc_html( $hero_heading ); ?>
                            </h1>
                            <p class="my-6 text-lg md:text-xl text-zinc-600 leading-8 text-center md:text-left" data-customize-setting-link="hero_description">
                                <?php echo esc_html( $hero_description ); ?>
                            </p>
                            <div class="flex justify-center md:justify-start">
                                <?php 
                                $cta_post_id = get_theme_mod( 'hero_cta_post_id', 0 );
                                $cta_text = get_theme_mod( 'hero_cta_text', 'Xem Chi Tiết' );
                                $cta_url = ( $cta_post_id != 0 ) ? esc_url( get_permalink( $cta_post_id ) ) : esc_url( home_url('/') );
                                
                                if ( ! empty( $cta_text ) && ! empty( $cta_url ) ) :
                                ?>
                                <a href="<?php echo $cta_url; ?>" 
                                    class="inline-flex rounded-full px-6 py-3 text-base font-semibold transition bg-yellow-500 text-black hover:bg-yellow-600 !no-underline shadow-md"
                                    data-customize-setting-link="hero_cta_text"
                                >
                                    <?php echo esc_html( $cta_text ); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php else : ?>
            <!-- Fallback (Dự phòng): Hiển thị nếu KHÔNG có ảnh nền được chọn -->
            <!-- (Giữ nguyên code fallback của bạn) -->
            <section class="py-20 md:py-24 border-b border-gray-200 bg-gray-100">
                <div class="container mx-auto max-w-6xl px-4">
                    <div class="flex flex-col px-4 md:px-0 text-center max-w-3xl justify-center mx-auto">
                        <?php
                        $hero_heading = get_theme_mod( 'hero_heading', 'Hiến chương Giáo hội Phật giáo Việt Nam' );
                        $hero_description = get_theme_mod( 'hero_description', 'Nơi lưu trữ và chứng thực các văn bản pháp quy...' );
                        ?>
                        <h1 class="leading-tight text-3xl md:text-5xl font-medium tracking-tight text-balance text-zinc-950 text-center md:text-left"
                            data-customize-setting-link="hero_heading">
                            <?php echo esc_html( $hero_heading ); ?>
                        </h1>
                        <p class="my-6 text-lg md:text-xl text-zinc-600 leading-8 text-center md:text-left" data-customize-setting-link="hero_description">
                            <?php echo esc_html( $hero_description ); ?>
                        </p>
                        
                    </div>
                </div>
            </section>
        <?php endif; // Kết thúc kiểm tra if ( $hero_img_url ) ?>
    <?php endif; // Kết thúc if ( is_front_page() ) ?>

    <main id="content" class="site-content flex-grow container mx-auto max-w-6xl p-0 mt-8">