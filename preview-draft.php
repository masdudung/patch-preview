<?php
/**
 * Class preview_draft
 *
 * @author SoftwareSeni Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Ast_Preview_Draft' ) ) {

	/**
	 * Class Ast_Preview_Draft
	 */
	class Ast_Preview_Draft {

		/**
		 * Instance variable.
		 *
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Singleton
		 *
		 * @return Ast_Preview_Draft|null
		 */
		public static function init() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Ast_Preview_Draft constructor.
		 */
		private function __construct() {

			// Register rewrite rule.
			add_action( 'init', [ $this, 'rewrite_rule' ] );

			// Register filter preview_post_link.
			add_filter( 'preview_post_link', [ $this, 'filter_preview_post_link' ], 10, 2 );
		}

		/**
		 * Callback for previewing draft post link.
		 *
		 * @param string $link current preview link.
		 * @param WP_Post $post object of the current post.
		 *
		 * @return string|void
		 */
		function filter_preview_post_link( $link, $post ) {
			if isset($post->post_status){
					
				if ( 'draft' === $post->post_status ) {
					$slug = basename( get_permalink( $post ) );

					$link = home_url( "/blog/preview/$slug" );
				}
			}

			return $link;
		}

		/**
		 * Callback for adding rewrite rule.
		 */
		function rewrite_rule() {
			add_rewrite_rule( '^blog/preview?$', "index.php?preview=true", 'top' );
		}
	}

	Ast_Preview_Draft::init();
}
