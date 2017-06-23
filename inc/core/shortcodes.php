<?php
class Su_Shortcodes {
	static $tabs = array();
	static $tab_count = 0;

	function __construct() {}

	
	public static function box( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'title'       => __( 'This is box title', 'shortcodes-ultimate' ),
				'style'       => 'default',
				'box_color'   => '#333333',
				'title_color' => '#FFFFFF',
				'color'       => null, // 3.x
				'radius'      => '3',
				'class'       => ''
			), $atts, 'box' );
		if ( $atts['color'] !== null ) $atts['box_color'] = $atts['color'];
		// Prepare border-radius
		$radius = ( $atts['radius'] != '0' ) ? 'border-radius:' . $atts['radius'] . 'px;-moz-border-radius:' . $atts['radius'] . 'px;-webkit-border-radius:' . $atts['radius'] . 'px;' : '';
		$title_radius = ( $atts['radius'] != '0' ) ? $atts['radius'] - 1 : '';
		$title_radius = ( $title_radius ) ? '-webkit-border-top-left-radius:' . $title_radius . 'px;-webkit-border-top-right-radius:' . $title_radius . 'px;-moz-border-radius-topleft:' . $title_radius . 'px;-moz-border-radius-topright:' . $title_radius . 'px;border-top-left-radius:' . $title_radius . 'px;border-top-right-radius:' . $title_radius . 'px;' : '';
		su_query_asset( 'css', 'su-box-shortcodes' );
		// Return result
		return '<div class="su-box su-box-style-' . $atts['style'] . su_ecssc( $atts ) . '" style="border-color:' . su_hex_shift( $atts['box_color'], 'darker', 20 ) . ';' . $radius . '"><div class="su-box-title" style="background-color:' . $atts['box_color'] . ';color:' . $atts['title_color'] . ';' . $title_radius . '">' . su_scattr( $atts['title'] ) . '</div><div class="su-box-content su-clearfix">' . su_do_shortcode( $content, 'b' ) . '</div></div>';
	}

	
	public static function lightbox( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'src'   => false,
				'type'  => 'iframe',
				'class' => ''
			), $atts, 'lightbox' );
		if ( !$atts['src'] ) return Su_Tools::error( __FUNCTION__, __( 'please specify correct source', 'shortcodes-ultimate' ) );
		su_query_asset( 'css', 'magnific-popup' );
		su_query_asset( 'js', 'jquery' );
		su_query_asset( 'js', 'magnific-popup' );
		su_query_asset( 'js', 'su-other-shortcodes' );
		return '<span class="su-lightbox' . su_ecssc( $atts ) . '" data-mfp-src="' . su_scattr( $atts['src'] ) . '" data-mfp-type="' . $atts['type'] . '">' . do_shortcode( $content ) . '</span>';
	}

	public static function lightbox_content( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'id'         => '',
				'width'      => '50%',
				'margin'     => '40',
				'padding'    => '40',
				'text_align' => 'center',
				'background' => '#FFFFFF',
				'color'      => '#333333',
				'shadow'     => '0px 0px 15px #333333',
				'class'      => ''
			), $atts, 'lightbox_content' );
		su_query_asset( 'css', 'su-box-shortcodes' );
		if ( !$atts['id'] ) return Su_Tools::error( __FUNCTION__, __( 'please specify correct ID for this block. You should use same ID as in the Content source field (when inserting lightbox shortcode)', 'shortcodes-ultimate' ) );
		$return = '<div class="su-lightbox-content ' . su_ecssc( $atts ) . '" id="' . trim( $atts['id'], '#' ) . '" style="display:none;width:' . $atts['width'] . ';margin-top:' . $atts['margin'] . 'px;margin-bottom:' . $atts['margin'] . 'px;padding:' . $atts['padding'] . 'px;background-color:' . $atts['background'] . ';color:' . $atts['color'] . ';box-shadow:' . $atts['shadow'] . ';text-align:' . $atts['text_align'] . '">' . do_shortcode( $content ) . '</div>';
		if ( did_action( 'su/generator/preview/before' ) ) return '<div class="su-lightbox-content-preview">' . $return . '</div>';
		else return $return;
	}

	
}

new Su_Shortcodes;

class Shortcodes_Ultimate_Shortcodes extends Su_Shortcodes {
	function __construct() {
		parent::__construct();
	}
}
