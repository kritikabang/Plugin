<?php

class Su_Vote {

	function __construct() {
		add_action( 'load-plugins.php', array( __CLASS__, 'init' ) );
		add_action( 'wp_ajax_su_vote',  array( __CLASS__, 'vote' ) );
	}

	public static function init() {
		Shortcodes_Ultimate::timestamp();
		$vote = get_option( 'su_vote' );
		$timeout = time() > ( get_option( 'su_installed' ) + 60*60*24*3 );
		if ( in_array( $vote, array( 'yes', 'no', 'tweet' ) ) || !$timeout ) return;
		add_action( 'in_admin_footer', array( __CLASS__, 'message' ) );
		add_action( 'admin_head',      array( __CLASS__, 'register' ) );
		add_action( 'admin_footer',    array( __CLASS__, 'enqueue' ) );
	}

	public static function register() {
		wp_register_style( 'su-vote', plugins_url( 'assets/css/vote.css', SU_PLUGIN_FILE ), false, SU_PLUGIN_VERSION, 'all' );
		wp_register_script( 'su-vote', plugins_url( 'assets/js/vote.js', SU_PLUGIN_FILE ), array( 'jquery' ), SU_PLUGIN_VERSION, true );
	}

	public static function enqueue() {
		wp_enqueue_style( 'su-vote' );
		wp_enqueue_script( 'su-vote' );
	}

	public static function vote() {
		$vote = sanitize_key( $_GET['vote'] );
		if ( !is_user_logged_in() || !in_array( $vote, array( 'yes', 'no', 'later', 'tweet' ) ) ) die( 'error' );
		update_option( 'su_vote', $vote );
		if ( $vote === 'later' ) update_option( 'su_installed', time() );
		die( 'OK: ' . $vote );
	}

	public static function message() {
?>
		<?php
	}
}

new Su_Vote;
