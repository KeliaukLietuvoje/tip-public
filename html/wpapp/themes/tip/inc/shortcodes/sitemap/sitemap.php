<?php

function tip_sitemap($atts)
{
    wp_enqueue_style('sitemap-shortcode-styles', TIP_THEME_URL . '/inc/shortcodes/sitemap/sitemap.css', [], '1.0', 'all');

    $atts = shortcode_atts(array(
      'id' => 'sitemap',
      'title' => false,
      'parent' => false,
      'authors' => false,
      'depth' => false,
      'sort_column' => 'post_title',
      'date_format' => 'j D Y',
      'show_date' => false,
      'exclude' => false,
      'link_before' => false,
      'link_after' => false,
      'poststatus' => false,
      'item_spacing' => false,
      'walker' => false,
      'list_style' => 'none',
    ), $atts);

    /* If no parent page, defaults to 0 (all) */
    $parent = ($atts['parent'] !== false) ? $atts['parent'] : '0';
    /* If no parent page, defaults to 0 (all) */
    $authors = ($atts['authors'] !== false) ? $atts['authors'] : '';
    /* Title list */
    $title = ($atts['title'] !== false) ? $atts['title'] : '';
    /* Depth */
    $depth = ($atts['depth'] !== false) ? $atts['depth'] : '0';
    /* Walker */
    $walker = ($atts['walker'] !== false) ? $atts['walker'] : '';
    /* Show date */
    $date = ($atts['show_date'] !== false) ? $atts['show_date'] : '';
    /* Exclude pages */
    $exclude = ($atts['exclude'] !== false) ? $atts['exclude'] : '';
    /* Post Status */
    $poststatus = ($atts['poststatus'] !== false) ? $atts['poststatus'] : 'publish';
    /* Item Spacing */
    $spacing = ($atts['item_spacing'] === false) ? 'preserve' : 'discard';
    /* Link after */
    $link_after = ($atts['link_after'] !== false) ? $atts['link_after'] : '';
    /* Link before */
    $link_before = ($atts['link_before'] !== false) ? $atts['link_before'] : '';
    /* Get map */  $sitemap = wp_list_pages('child_of=' . $parent . '&authors=' . $authors . '&title_li=' . $title . '&depth=' . $depth . '&sort_column=' . $atts['sort_column'] . '&walker=' . $walker . '&date=' . $date . '&exclude=' . $exclude . '&post_status=' . $poststatus . '&item_spacing=' . $spacing . '&link_after=' . $link_after . '&link_before=' . $link_before . '&echo=0');
    /* List (change to unordered with ul tags */

    if ($sitemap != '') {
        $sitemap = '<h2>'.__('Puslapiai', 'tip').'</h2><ul class="sitemap"' . ($atts['id'] == '' ? '' : ' id="' . $atts['id'] . '"') . '>' . $sitemap . '</ul>';
    }
    return '' . $sitemap . '';
}
add_shortcode('sitemap', 'tip_sitemap');
