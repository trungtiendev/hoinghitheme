// assets/js/customizer-preview.js
(function ($) {
    "use strict";

    // === 1. LIVE PREVIEW CHO LOGO WIDTH ===
    wp.customize("logo_width", function (value) {
        value.bind(function (new_width) {
            // Cập nhật thẻ <img> của logo bằng style inline (nhờ ID đã đặt trong header.php)
            $("#site-logo-img").css("width", new_width + "px");
        });
    });

    // === 2. LIVE PREVIEW CHO TIÊU ĐỀ HERO ===
    wp.customize("hero_heading", function (value) {
        value.bind(function (new_val) {
            // Tìm phần tử bằng data-customize-setting-link
            $('[data-customize-setting-link="hero_heading"]').text(new_val);
        });
    });

    // === 3. LIVE PREVIEW CHO MÔ TẢ HERO ===
    wp.customize("hero_description", function (value) {
        value.bind(function (new_val) {
            $('[data-customize-setting-link="hero_description"]').text(new_val);
        });
    });

    // === 4. LIVE PREVIEW CHO VĂN BẢN NÚT CTA ===
    wp.customize("hero_cta_text", function (value) {
        value.bind(function (new_val) {
            // Tìm phần tử bằng data-customize-setting-link trên nút CTA
            $('[data-customize-setting-link="hero_cta_text"]').text(new_val);
        });
    });

    // === 5. LIVE PREVIEW CHO ẢNH NỀN HERO ===
    wp.customize("hero_image", function (value) {
        value.bind(function (new_val) {
            // Cập nhật thẻ <img> trong phần hero section
            $("#hero-section img").attr("src", new_val);
        });
    });
    wp.customize("topbar_notice_text", function (value) {
        value.bind(function (new_val) {
            const topbar = $("#top-header-notice");
            const textSpan = topbar.find(
                '[data-customize-setting-link="topbar_notice_text"]'
            );

            if (new_val && new_val.trim() !== "") {
                // Nếu có nội dung, hiển thị Top Header và cập nhật text
                textSpan.html(new_val);
                topbar.slideDown(200); // Hiển thị mượt mà
            } else {
                // Nếu nội dung trống, ẩn Top Header
                topbar.slideUp(200); // Ẩn mượt mà
            }
        });
    });

    // Live view cho logo footer
    wp.customize("footer_logo", function (value) {
        value.bind(function (new_value) {
            // Cập nhật thẻ <img> của logo footer bằng style inline (nhờ ID đã đặt trong footer.php)
            $("#footer-logo-img").attr("src", new_value);
        });
    });
})(jQuery);
