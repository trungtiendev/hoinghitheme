<?php
/**
 * Template Part để hiển thị nội dung tóm tắt trong trang lưu trữ.
 *
 * @package hoinghitheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300'); ?>>
    
    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover rounded-md mb-4']); ?>
        </a>
    <?php endif; ?>
    
    <header class="mb-3">
        <span class="bg-primary text-white rounded-sm text-sm line-height-1 px-2 py-1 italic">
            <?php the_category( ', ', 'archive' ); // Hiển thị chuyên mục ?></span>
        <h2 class="text-xl font-bold mt-1 leading-tight">
            <a href="<?php the_permalink(); ?>" class="text-content hover:text-primary">
                <?php the_title(); ?>
            </a>
        </h2>
    </header>

    <div class="entry-summary text-gray-600 text-sm mb-4">
        <?php the_excerpt(); // Hiển thị tóm tắt nội dung ?>
    </div>
    
    <div class="text-right">
        <a href="<?php the_permalink(); ?>" class="text-primary font-semibold hover:text-accent transition-colors">
            Đọc tiếp &rarr;
        </a>
    </div>

</article>