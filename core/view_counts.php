<?php // Source: https://gretathemes.com/count-post-views/
function webart_get_the_post_view()
{
    $count = get_post_meta(get_the_ID(), 'post_views_count', true);
    return $count ? $count : '0';
}

function webart_the_post_view($noViews = "% view", $oneView = "% view", $sevViews = "% views")
{
    $viewCount = webart_get_the_post_view();

    if ($viewCount == '0') {
        $strViewCount = str_replace('%', $viewCount, $noViews);
    } elseif ($viewCount == '1') {
        $strViewCount = str_replace('%', $viewCount, $oneView);
    } else {
        $strViewCount = str_replace('%', $viewCount, $sevViews);
    }
    echo $strViewCount;
}

function webart_set_post_view()
{
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int)get_post_meta($post_id, $key, true);
    $count++;
    update_post_meta($post_id, $key, $count);
}

function webart_posts_column_views($columns)
{
    $columns['post_views'] = 'Views';
    return $columns;
}

function webart_posts_custom_column_views($column)
{
    if ($column === 'post_views') {
        echo webart_get_the_post_view();
    }
}

add_filter('manage_posts_columns', 'webart_posts_column_views');
add_action('manage_posts_custom_column', 'webart_posts_custom_column_views');
