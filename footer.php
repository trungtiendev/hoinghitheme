<?php
/**
 * Template cho phần Footer.
 *
 * @package hoinghitheme
 */
?>
</main> <!-- #content -->
<!-- Nơi hiển thị các wedget footer nếu có -->
<div class="bg-blue-900 text-gray-300">
    <div>
        <?php 
            $logo_footer_url = get_theme_mod( 'footer_logo', '' );
        ?>
        <?php if ( ! empty( $logo_footer_url ) ) : ?>
        <div class="mb-6">
            <img id="footer-logo-img" src="<?php echo esc_url( $logo_footer_url ); ?>"
                alt="<?php bloginfo( 'name' ); ?> Logo" class="mx-auto h-30" />
        </div>
        <?php endif; ?>
    </div>
    <div class="flex flex-col md:flex-row gap-6 md:gap-4 justify-around mb-0">
        <div class="relative bg-none border p-4 rounded-lg border-gray-300 m-2 md:m-4">
            <h3 class="absolute top-0 -translate-y-1/2 px-2 bg-blue-900 font-semibold text-lg z-50">
                Trụ sở</h3>
            <ul class="mt-4">
                <li>Văn phòng 2 T.Ư – GHPGVN – số 294 Nam Kỳ Khởi Nghĩa, phường Xuân Hòa, TP.HCM</li>
            </ul>
        </div>
        <div class="relative bg-none border p-4 rounded-lg border-gray-300 m-2 md:m-4">
            <h3 class="absolute top-0 -translate-y-1/2 px-2 bg-blue-900 font-semibold text-lg z-50">
                Phụ trách hỗ trợ kỹ thuật</h3>
            <ul class="mt-4">
                <li>Tổ thông tin – Công nghệ VP2 Trung ương Giáo hội</li>
                <li>TT. Thích Minh Nhẫn</li>
                <li>Điện thoại: 0982760624</li>
            </ul>
        </div>
    </div>
</div>

<footer id="colophon" class="site-footer bg-secondary text-gray-300 mt-0 py-8">
    <div class="container mx-auto max-w-6xl px-4 text-center">
        <p>Copyright &copy; <?php echo date('Y'); // Lấy năm hiện tại ?> <?php bloginfo('name'); ?>. Mọi quyền được bảo
            lưu.</p>
    </div>
</footer>
</div> <!-- #page -->

<?php wp_footer(); // Hook quan trọng: WordPress và plugin chèn JS tại đây (trước khi đóng body) ?>

</body>

</html>