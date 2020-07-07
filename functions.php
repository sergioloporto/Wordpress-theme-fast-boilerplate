<?php 
function admin_bar()
{
        if (is_user_logged_in()) {
                add_filter('show_admin_bar', '__return_true', 1000);
        }
}
add_action('init', 'admin_bar');

register_nav_menus(
        array(
                'menu-top' => __('Top menu', 'newtheme'),
        )
);

function styles_and_scripts()
{
        wp_enqueue_style('main-style', get_stylesheet_uri());
        wp_deregister_script('jquery');

}
add_action('wp_enqueue_scripts', 'styles_and_scripts');

// Register Sidebars
function mtw_blog_right_sidebar()
{
        $args = array(
                'id'            => 'blog_right_sidebar',
                'class'         => 'blog_right_sidebar',
                'name'          => __('Blog right sidebar', 'newtheme'),
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
        );
        register_sidebar($args);
}
add_action('widgets_init', 'mtw_blog_right_sidebar');




// Numbered Pagination
function pagination($pages = '', $range = 4)
{        
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
        //  echo "</div>\n";
     }
}

add_theme_support( 'post-thumbnails' );
