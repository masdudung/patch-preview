<?php
/**
 * Plugin Name: preview draft
 * Version: 0.0.1
 * Author: SoftwareSeni Team
 * 
 */

class preview_draft{
    
    function __construct()
    {
      #register rewrite rule
      add_action('init',[$this, 'rewrite_rule']);
      
      #register filter preview_post_link
      add_filter('init',[$this, 'filter_preview_post_link']);
		}
    
    function filter_preview_post_link($link)
    {
      global $post;
			if(isset($post->post_status) && $post->post_status == 'draft') {
        $slug = basename(get_permalink());
        return home_url("/preview/$slug");
			}
			return $link;
    }
    
    function rewrite_rule()
    {
      add_rewrite_rule('^preview?$', "index.php?preview=true");
    }

}
$plugin = new preview_draft();
