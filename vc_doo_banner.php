<?php
/*
Plugin Name: Animated Icon Doo Banner
Description: Advance Banner for Visual Composer
Version: 1.1
Author: Diego Benna
Author URI: http://www.diegobenna.it
License: GPL2
Domain Path: /languages
 */



function vc_doo_banner_css_and_js() {
wp_register_style('vc_doo_banner_css_and_js', plugins_url('./vc_doo_banner.css',__FILE__ ));
wp_enqueue_style('vc_doo_banner_css_and_js');
}
add_action( 'admin_init','vc_doo_banner_css_and_js');



function vc_doo_banner_styles_with_the_lot()
{
    // Register the style like this for a plugin:
    wp_register_style( 'custom-style', plugins_url( './vc_doo_banner.css', __FILE__ ), array(), '20120208', 'all' );

    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'custom-style' );
}
add_action( 'wp_enqueue_scripts', 'vc_doo_banner_styles_with_the_lot' );

/* icon banner */

function vc_doo_banner_func( $atts, $content) {
 extract( shortcode_atts( array(
        'bg_image' => 'bg_image',
		'image_size' => 'image_size',
        'header' => 'header',
		'title_font_color' => 'title_font_color',
		'title_font_size' => 'title_font_size',	 
		'title_overlay_font_color' => 'title_overlay_font_color',
		'description_font_color'=>'description_font_color',
		'description_font_size'=>'description_font_size',	 
		'background' => 'background',
		'background_overlay'=>'background_overlay',
		'height' => 'height',
		'link' => 'link'
    ), $atts ) );
    $href = vc_build_link( $link);
    $end_content = '<a class="service websites" style="background-color:'.$background.';  height:'.$height.';" href="'.$href['url'].'" title="'.$href['title'].'">
                                <span class="static">
                                    <span class="vcenter-parent">
                                        <span class="vcenter">
                                            <span class="icon">
											'.wp_get_attachment_image($bg_image, $image_size ).'
                                            </span>
                                            <span class="title" style="color:'.$title_font_color.';font-size:'.$title_font_size.';">'.$header.'</span>
                                        </span><!-- .vcenter -->
                                    </span><!-- .vcenter-parent -->
                                </span><!-- /.static -->
                                <span class="hover" style="background-color:'.$background_overlay.'">
                                    <span class="vcenter-parent">
                                        <span class="vcenter">
                                            <h3 class="title" style="color:'.$title_overlay_font_color.';font-size:'.$title_font_size.';">'.$header.'</h3>
                                            <p class="description" style="color:'.$description_font_color.';font-size:'.$description_font_size.';">'.$content.'</p>
                                        </span><!-- .vcenter -->
                                    </span><!-- .vcenter-parent -->
                                </span><!-- /.hover -->
                            </a>';
 
    return $end_content;  
}  
add_shortcode( 'vc_doo_banner', 'vc_doo_banner_func');


add_action( 'vc_before_init', 'your_name_integrateWithVC' );
function your_name_integrateWithVC() {
vc_map( array(
	"base" => "vc_doo_banner",
	"name" => __( "Doo Icon Banner", "samu-text-domain" ),
	"icon" => "dt_vc_ico_banner2",
    'admin_enqueue_css' => array(get_template_directory_uri().'/vc_doo_banner.css'),
	'category' => __( 'DiAdvanced', 'js_composer' ),
	'description' => __( 'Animated panel', 'js_composer' ),
    "params" => array(
        array(
            "type" => "attach_image", // it will bind a img choice in WP
            "heading" => __("Icon", "js_composer"),	
            "param_name" => "bg_image",
        ),
        array(
            "type" => "textfield", // it will bind a img choice in WP
            "heading" => __("Image size", "js_composer"),
			"value" => __( "thumbnail", "samu-text-domain" ),
            "description" => __( "Enter image size (Example: \"thumbnail\", \"medium\", \"large\", \"full\" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)). Leave parameter empty to use \"thumbnail\" by default." ),					
            "param_name" => "image_size",
        ),		
        array(
            "type" => "textfield",
            "heading" => __("Height", "js_composer"),
			"value" => __( "300px", "samu-text-domain" ),
            "description" => __( "Banner max height in px.", "samu-text-domain" ),			
            "param_name" => "height",
        ),		

        array(
            "type" => "textfield", 
            "heading" => __("Title", "js_composer"),
			"value" => __( "Panel title", "samu-text-domain" ),
            "param_name" => "header",
        ),
		
        array(
            "type" => "textfield", 
            "heading" => __("Title font size", "js_composer"),
			"value" => __( "18px", "samu-text-domain" ),
            "param_name" => "title_font_size",
        ),
		


        array(
            "type" => "colorpicker",
            "heading" => __("Title font color", "js_composer"),
            "param_name" => "title_font_color",
			"value" => __( "#414042", "samu-text-domain" ),			
        ),
		
        array(
            "type" => "colorpicker", 
            "heading" => __("Title overlay font color", "js_composer"),
            "param_name" => "title_overlay_font_color",
			"value" => __( "#ffffff", "samu-text-domain" ),				
        ),
		
        array(
            "type" => "textarea_html", 
            "heading" => __("Description", "js_composer"),
			"holder" => "div",
            "class" => "",
            "param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "samu-text-domain" ),
		),
		
        array(
            "type" => "colorpicker", 
            "heading" => __("Description font color", "js_composer"),
            "param_name" => "description_font_color",
			"value" => __( "#ffffff", "samu-text-domain" )			
		),
		
        array(
            "type" => "textfield", 
            "heading" => __("Description font size", "js_composer"),
			"value" => __( "15px", "samu-text-domain" ),
            "param_name" => "description_font_size",
        ),		

        array(
            "type" => "colorpicker", 
            "heading" => __("Background", "js_composer"),
			"value" => __( "#c6c8ca", "samu-text-domain" ),
            "param_name" => "background",
        ),
        array(
            "type" => "colorpicker", 
            "heading" => __("Background overlay", "js_composer"),
			"value" => __( "#D70036", "samu-text-domain" ),
            "param_name" => "background_overlay",
        ),
        array(
            "type" => "vc_link", 
            "heading" => __("Url", "js_composer"),
			"value" => __( "#", "samu-text-domain" ),
            "param_name" => "link",
        )	
    )
) );
}
 


/* image banner */

function vc_doo_image_banner_func( $atts, $content) {
 extract( shortcode_atts( array(
        'bg_image' => 'bg_image',
		'image_size' => 'image_size',
        'header' => 'header',
	 	'title_font_size' => 'title_font_size',
		'title_overlay_font_color' => 'title_overlay_font_color',
		'description_font_color'=>'description_font_color',
		'description_font_size'=>'description_font_size',	 
		'background' => 'background',
		'background_overlay'=>'background_overlay',
		'height' => 'height',
		'link' => 'link'
    ), $atts ) );
    $href = vc_build_link( $link);
    $end_content = '<a class="service websites" style="background-color:'.$background.';  height:'.$height.';" href="'.$href['url'].'" title="'.$href['title'].'">
                                <span class="static">
                                    <span class="vcenter-parent">
                                        <span class="vcenter">
											'.wp_get_attachment_image($bg_image, "full" ).'
                                        </span><!-- .vcenter -->
                                    </span><!-- .vcenter-parent -->
                                </span><!-- /.static -->
                                <span class="hover" style="background-color:'.$background_overlay.'">
                                    <span class="vcenter-parent">
                                        <span class="vcenter">
                                            <h3 class="title" style="color:'.$title_overlay_font_color.';font-size:'.$title_font_size.';">'.$header.'</h3>
                                            <p class="description" style="color:'.$description_font_color.';font-size:'.$description_font_size.';">'.$content.'</p>
                                        </span><!-- .vcenter -->
                                    </span><!-- .vcenter-parent -->
                                </span><!-- /.hover -->
                            </a>';
 
    return $end_content;  
}  
add_shortcode( 'vc_doo_img_banner', 'vc_doo_image_banner_func');


add_action( 'vc_before_init', 'vc_doo_image_integrateWithVC' );
function vc_doo_image_integrateWithVC() {
vc_map( array(
	"base" => "vc_doo_img_banner",
	"name" => __( "Doo Image Banner", "samu-text-domain" ),
	"icon" => "dt_vc_img_banner",
    'admin_enqueue_css' => array(get_template_directory_uri().'/vc_doo_banner.css'),
	'category' => __( 'DiAdvanced', 'js_composer' ),
	'description' => __( 'Animated panel', 'js_composer' ),
    "params" => array(
        array(
            "type" => "attach_image", // it will bind a img choice in WP
            "heading" => __("Background image", "js_composer"),	
            "param_name" => "bg_image",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Height", "js_composer"),
			"value" => __( "300px", "samu-text-domain" ),
            "description" => __( "Banner max height in px.", "samu-text-domain" ),			
            "param_name" => "height",
        ),		

        array(
            "type" => "textfield", 
            "heading" => __("Title", "js_composer"),
			"value" => __( "Panel title", "samu-text-domain" ),
            "param_name" => "header",
        ),
		
        array(
            "type" => "textfield", 
            "heading" => __("Title font size", "js_composer"),
			"value" => __( "18px", "samu-text-domain" ),
            "param_name" => "title_font_size",
        ),
		

		
        array(
            "type" => "colorpicker", 
            "heading" => __("Title overlay font color", "js_composer"),
            "param_name" => "title_overlay_font_color",
			"value" => __( "#ffffff", "samu-text-domain" ),				
        ),
		
        array(
            "type" => "textarea_html", 
            "heading" => __("Description", "js_composer"),
			"holder" => "div",
            "class" => "",
            "param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "samu-text-domain" ),
		),
		
        array(
            "type" => "colorpicker", 
            "heading" => __("Description font color", "js_composer"),
            "param_name" => "description_font_color",
			"value" => __( "#ffffff", "samu-text-domain" )			
		),
		
        array(
            "type" => "textfield", 
            "heading" => __("Description font size", "js_composer"),
			"value" => __( "15px", "samu-text-domain" ),
            "param_name" => "description_font_size",
        ),		
        array(
            "type" => "colorpicker", 
            "heading" => __("Background", "js_composer"),
			"value" => __( "#c6c8ca", "samu-text-domain" ),
            "param_name" => "background",
        ),
        array(
            "type" => "colorpicker", 
            "heading" => __("Background overlay", "js_composer"),
			"value" => __( "#D70036", "samu-text-domain" ),
            "param_name" => "background_overlay",
        ),
        array(
            "type" => "vc_link", 
            "heading" => __("Url", "js_composer"),
			"value" => __( "#", "samu-text-domain" ),
            "param_name" => "link",
        )	
    )
) );
}
 

// This function provides a functionality of adding content elements into element
//class WPBakeryShortCode_SC_Slide extends WPBakeryShortCodesContainer {}

?>
