/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    // Quét tất cả các tệp PHP ở thư mục gốc
    './*.php',
    // Quét tất cả các tệp PHP trong các thư mục con (ví dụ: /template-parts/*.php)
    './**/*.php',
  ],
  theme: {
    extend: {
      // THÊM KEYFRAMES CHO HIỆU ỨNG NHẤP NHÁY
      keyframes: {
        flash: {
          '0%, 100%': { opacity: '1' },
          '50%': { opacity: '0.6' }, // Nhấp nháy giữa 100% và 60%
        },
      },
      // THÊM ANIMATION
      animation: {
        'flash': 'flash 0.5s ease-in-out infinite', // Lặp vô hạn, 0.5s/chu kỳ
      },
      // Bạn có thể mở rộng theme của mình tại đây
      // Ví dụ: thêm font chữ, màu sắc...
      colors: {
        'primary': '#996515',      // Vàng Đồng (Hổ Phách)
        'secondary': '#1D2D50',    // Xanh Hải Quân Đậm
        'body': '#F9F7F3',         // Trắng Ngà
        'content': '#333333',      // Xám Đen
        'accent': '#CC5500',       // Đỏ Cam
      },
    },
  },
  plugins: [
    // Kích hoạt plugin typography
    // Plugin này sẽ tự động tạo kiểu cho nội dung từ trình soạn thảo WordPress (the_content)
    // với class 'prose'
    require('@tailwindcss/typography'),
  ],
}