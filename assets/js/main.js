/**
 * Tệp JavaScript chính của theme hoinghitheme.
 **/

// Chạy code khi tất cả nội dung HTML đã được tải (VANILLA JS)
document.addEventListener('DOMContentLoaded', function() {
    // Lấy các phần tử (element)
    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('menu-icon-open');
    const iconClose = document.getElementById('menu-icon-close');

    // Logic Menu Mobile
    if (menuButton && mobileMenu && iconOpen && iconClose) {
        menuButton.addEventListener('click', function() {
            // Bật/tắt class "hidden" trên menu-container
            mobileMenu.classList.toggle('hidden');

            // SỬA ĐỔI: Chỉ cần toggle 'hidden' cho cả hai icon
            iconOpen.classList.toggle('hidden'); 
            iconClose.classList.toggle('hidden');
        });
    }
});

// Mã để xử lý Top Header Notice (JQUERY)
// MÃ ĐỂ XỬ LÝ TOP HEADER NOTICE (JQUERY)
jQuery(document).ready(function($) {
    const $topHeader = $('#top-header-notice');
    const $hr = $('#top-header-hr');
    const $countdownSpan = $('#notice-countdown'); // Lấy phần tử đếm ngược

    if ($topHeader.length && $countdownSpan.length) {
        $topHeader.addClass('animate-flash');
        let countdown = 5; // Bắt đầu đếm từ 5

        // Hàm ẩn thông báo
        const hideNotice = () => {
            $topHeader.removeClass('animate-flash'); 
            
            $topHeader.slideUp(500, function() {
                if ($hr.length) {
                    $hr.slideUp(200);
                }
            });
        };
        
        // Thiết lập bộ đếm thời gian
        const timer = setInterval(() => {
            countdown--; // Giảm 1
            
            // Cập nhật số hiển thị
            $countdownSpan.text('Biến mất sau [' + countdown + '] giây');

            if (countdown <= 0) {
                clearInterval(timer); // Dừng bộ đếm
                hideNotice();         // Ẩn Top Header
            }
        }, 1000); // Lặp lại mỗi 1000ms (1 giây)
        
        // (Tùy chọn) Nếu người dùng nhấp vào, ẩn ngay lập tức
        $topHeader.on('click', function() {
            clearInterval(timer);
            hideNotice();
        });
    }
});