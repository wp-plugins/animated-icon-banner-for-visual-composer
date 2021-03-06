<?php
/*
Plugin Name: Essential Doo Components for Visual Composer Free
Description: Advanced Banners and Carousels for Visual Composer
Version: 1.9
Author: Diego Benna
Author URI: http://codecanyon.net/item/animated-doo-banners-for-visual-composer/11788811
License: GPL2
Domain Path: /languages
*/


defined( 'VERSION_DOO_ESSENZIAL' ) or define( 'VERSION_DOO_ESSENZIAL', '1.8' );
defined( 'DOO_CAROUSEL' ) or define( 'DOO_CAROUSEL', 'doo-carousel' );

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
	"name" => __( "Doo Icon Banner", "doo-text-domain" ),
	"icon" => "dt_vc_ico_banner2",
    'admin_enqueue_css' => array(get_template_directory_uri().'/vc_doo_banner.css'),
	'category' => __( 'Doo', "doo-text-domain" ),
	'description' => __( 'Animated panel', "doo-text-domain" ),
    "params" => array(
        array(
            "type" => "attach_image", // it will bind a img choice in WP
            "heading" => __("Icon", "doo-text-domain"),	
            "param_name" => "bg_image",
        ),
        array(
            "type" => "textfield", // it will bind a img choice in WP
            "heading" => __("Image size", "doo-text-domain"),
			"value" => __( "thumbnail", "doo-text-domain" ),
            "description" => __( "Enter image size (Example: \"thumbnail\", \"medium\", \"large\", \"full\" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)). Leave parameter empty to use \"thumbnail\" by default." ),					
            "param_name" => "image_size",
        ),		
        array(
            "type" => "textfield",
            "heading" => __("Height", "doo-text-domain"),
			"value" => __( "300px", "doo-text-domain" ),
            "description" => __( "Banner max height in px.", "doo-text-domain" ),			
            "param_name" => "height",
        ),		

        array(
            "type" => "textfield", 
            "heading" => __("Title", "doo-text-domain"),
			"value" => __( "Panel title", "doo-text-domain" ),
            "param_name" => "header",
        ),
		
        array(
            "type" => "textfield", 
            "heading" => __("Title font size", "doo-text-domain"),
			"value" => __( "18px", "doo-text-domain" ),
            "param_name" => "title_font_size",
        ),
		


        array(
            "type" => "colorpicker",
            "heading" => __("Title font color", "doo-text-domain"),
            "param_name" => "title_font_color",
			"value" => __( "#414042", "doo-text-domain" ),			
        ),
		
        array(
            "type" => "colorpicker", 
            "heading" => __("Title overlay font color", "doo-text-domain"),
            "param_name" => "title_overlay_font_color",
			"value" => __( "#ffffff", "doo-text-domain" ),				
        ),
		
        array(
            "type" => "textarea_html", 
            "heading" => __("Description", "doo-text-domain"),
			"holder" => "div",
            "class" => "",
            "param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "doo-text-domain" ),
		),
		
        array(
            "type" => "colorpicker", 
            "heading" => __("Description font color", "doo-text-domain"),
            "param_name" => "description_font_color",
			"value" => __( "#ffffff", "doo-text-domain" )			
		),
		
        array(
            "type" => "textfield", 
            "heading" => __("Description font size", "doo-text-domain"),
			"value" => __( "15px", "doo-text-domain" ),
            "param_name" => "description_font_size",
        ),		

        array(
            "type" => "colorpicker", 
            "heading" => __("Background", "doo-text-domain"),
			"value" => __( "#c6c8ca", "doo-text-domain" ),
            "param_name" => "background",
        ),
        array(
            "type" => "colorpicker", 
            "heading" => __("Background overlay", "doo-text-domain"),
			"value" => __( "#D70036", "doo-text-domain" ),
            "param_name" => "background_overlay",
        ),
        array(
            "type" => "vc_link", 
            "heading" => __("Url", "doo-text-domain"),
			"value" => __( "#", "doo-text-domain" ),
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
		'background_overlay'=>'background_overlay',
		'height' => 'height',
		'link' => 'link'
    ), $atts ) );
    $href = vc_build_link( $link);
    $end_content = '<a class="service websites" style="height:'.$height.';" href="'.$href['url'].'" title="'.$href['title'].'">
                                
'.wp_get_attachment_image($bg_image, "full" ).'
                            
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
	"name" => __( "Doo Image Banner", "doo-text-domain" ),
	"icon" => "dt_vc_img_banner",
    'admin_enqueue_css' => array(get_template_directory_uri().'/vc_doo_banner.css'),
	'category' => __( 'Doo', "doo-text-domain" ),
	'description' => __( 'Animated panel', "doo-text-domain" ),
    "params" => array(
        array(
            "type" => "attach_image", // it will bind a img choice in WP
            "heading" => __("Background image", "doo-text-domain"),	
            "param_name" => "bg_image",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Height", "doo-text-domain"),
			"value" => __( "100%", "doo-text-domain" ),
            "description" => __( "Banner max height in px.", "doo-text-domain" ),			
            "param_name" => "height",
        ),		

        array(
            "type" => "textfield", 
            "heading" => __("Title", "doo-text-domain"),
			"value" => __( "Panel title", "doo-text-domain" ),
            "param_name" => "header",
        ),
		
        array(
            "type" => "textfield", 
            "heading" => __("Title font size", "doo-text-domain"),
			"value" => __( "18px", "doo-text-domain" ),
            "param_name" => "title_font_size",
        ),
		

		
        array(
            "type" => "colorpicker", 
            "heading" => __("Title overlay font color", "doo-text-domain"),
            "param_name" => "title_overlay_font_color",
			"value" => __( "#ffffff", "doo-text-domain" ),				
        ),
		
        array(
            "type" => "textarea_html", 
            "heading" => __("Description", "doo-text-domain"),
			"holder" => "div",
            "class" => "",
            "param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "doo-text-domain" ),
		),
		
        array(
            "type" => "colorpicker", 
            "heading" => __("Description font color", "doo-text-domain"),
            "param_name" => "description_font_color",
			"value" => __( "#ffffff", "doo-text-domain" )			
		),
		
        array(
            "type" => "textfield", 
            "heading" => __("Description font size", "doo-text-domain"),
			"value" => __( "15px", "doo-text-domain" ),
            "param_name" => "description_font_size",
        ),		
        array(
            "type" => "colorpicker", 
            "heading" => __("Background overlay", "doo-text-domain"),
			"value" => __( "#D70036", "doo-text-domain" ),
            "param_name" => "background_overlay",
        ),
        array(
            "type" => "vc_link", 
            "heading" => __("Url", "doo-text-domain"),
			"value" => __( "#", "doo-text-domain" ),
            "param_name" => "link",
        )	
    )
) );
}
 

/* Fashion Banner */

function vc_doo_fashion_banner_func( $atts, $content) {
 extract( shortcode_atts( array(
        'fashion_style' => 'fashion_style',
        'bg_image' => 'bg_image',
		'image_size' => 'image_size',
        'header' => 'header',
	    'header2' => 'header2',
	 	'title_font_size' => 'title_font_size',
		'title_overlay_font_color' => 'title_overlay_font_color',
		'description_font_color'=>'description_font_color',
		'description_font_size'=>'description_font_size',	 
		'background_overlay'=>'background_overlay',
		'height' => 'height',
		'link' => 'link'
    ), $atts ) );
    $href = vc_build_link( $link);
    $end_content = '<a href="http://codecanyon.net/item/animated-doo-banners-for-visual-composer/11788811" alt="Diego Benna Doo Wordpress">You find this special component in Pro version</a>';      
    
    return $end_content;  
}  
add_shortcode( 'vc_doo_fashion_banner', 'vc_doo_fashion_banner_func');

add_action( 'vc_before_init', 'vc_doo_fashion_integrateWithVC' );
function vc_doo_fashion_integrateWithVC() {
vc_map( array(
	"base" => "vc_doo_fashion_banner",
	"name" => __( "Doo Fashion Banner", "doo-text-domain" ),
	"icon" => "dt_vc_fashion_banner",
    'admin_enqueue_css' => array(get_template_directory_uri().'/vc_doo_banner.css'),
	'category' => __( 'Doo', "doo-text-domain" ),
	'description' => __( 'Animated fashion panel', "doo-text-domain" ),
    "params" => array(
        array(
          "type"        => "dropdown",
          "heading"     => __("Fashion banner style", "doo-text-domain"),
          "param_name"  => "fashion_style",
          "value"       => array(
            'Altare'   => 'effect-altare',
            'Andromeda'   => 'effect-andromeda',
            'Auriga' => 'effect-auriga',
            'Bulino'  => 'effect-bulino',
            'Camaleonte'  => 'effect-camaleonte',
            'Carena'  => 'effect-carena',
            'Cassiopea'  => 'effect-cassiopea',
            'Centauro'  => 'effect-centauro',
            'Dorado'  => 'effect-dorado',
            'Ercole'  => 'effect-ercole',
            'Fenice'  => 'effect-fenice',
            'Giraffa'  => 'effect-giraffa',              
          ),
          "description" => __("Select the style of banner you want activate")
        ),
        array(
            "type" => "attach_image", // it will bind a img choice in WP
            "heading" => __("Background image", "doo-text-domain"),	
            "param_name" => "bg_image",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Height", "doo-text-domain"),
			"value" => __( "100%", "doo-text-domain" ),
            "description" => __( "Banner max height in px.", "doo-text-domain" ),			
            "param_name" => "height",
        ),		

        array(
            "type" => "textfield", 
            "heading" => __("Title", "doo-text-domain"),
			"value" => __( "PANEL", "doo-text-domain" ),
            "param_name" => "header",
        ),
		
        array(
            "type" => "textfield", 
            "heading" => __("Bold title", "doo-text-domain"),
			"value" => __( "TITLE", "doo-text-domain" ),
            "param_name" => "header2",
        ),		
		
        array(
            "type" => "textfield", 
            "heading" => __("Title font size", "doo-text-domain"),
			"value" => __( "30px", "doo-text-domain" ),
            "param_name" => "title_font_size",
        ),
		

		
        array(
            "type" => "colorpicker", 
            "heading" => __("Title overlay font color", "doo-text-domain"),
            "param_name" => "title_overlay_font_color",
			"value" => __( "#ffffff", "doo-text-domain" ),				
        ),
		
        array(
            "type" => "textarea_html", 
            "heading" => __("Description", "doo-text-domain"),
			"holder" => "div",
            "class" => "",
            "param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "doo-text-domain" ),
		),
		
        array(
            "type" => "colorpicker", 
            "heading" => __("Description font color", "doo-text-domain"),
            "param_name" => "description_font_color",
			"value" => __( "#ffffff", "doo-text-domain" )			
		),
		
        array(
            "type" => "textfield", 
            "heading" => __("Description font size", "doo-text-domain"),
			"value" => __( "15px", "doo-text-domain" ),
            "param_name" => "description_font_size",
        ),		
        array(
            "type" => "colorpicker", 
            "heading" => __("Background overlay", "doo-text-domain"),
			"value" => __( "#3085a3", "doo-text-domain" ),
            "param_name" => "background_overlay",
        ),
        array(
            "type" => "vc_link", 
            "heading" => __("Url", "doo-text-domain"),
			"value" => __( "#", "doo-text-domain" ),
            "param_name" => "link",
        )	
    )
) );
}



/* video banner */

function vc_doo_video_banner_func( $atts, $content) {
 extract( shortcode_atts( array(
        'fashion_style' => 'fashion_style',
        'bg_image' => 'bg_image',
		'image_size' => 'image_size',
        'header' => 'header',
	    'header2' => 'header2',

	 	'title_font_size' => 'title_font_size',
		'title_overlay_font_color' => 'title_overlay_font_color',
		'description_font_color'=>'description_font_color',
		'description_font_size'=>'description_font_size',	 
		'background_overlay'=>'background_overlay',
		'height' => 'height',
		'link' => 'link',
	    'video_url_mp4' => 'video_url_mp4',
	 	'video_url_ogg' => 'video_url_ogg',
	 	'video_url_webm' => 'video_url_webm',
    ), $atts ) );
    $href = vc_build_link( $link);
	$random_id = rand(0, 99999);
    $end_content = '<a href="http://codecanyon.net/item/animated-doo-banners-for-visual-composer/11788811" alt="Diego Benna Doo Wordpress">You find this special component in Pro version</a>';    
    
    return $end_content;  
}  
add_shortcode( 'vc_doo_video_banner', 'vc_doo_video_banner_func');

add_action( 'vc_before_init', 'vc_doo_video_integrateWithVC' );
function vc_doo_video_integrateWithVC() {
vc_map( array(
	"base" => "vc_doo_video_banner",
	"name" => __( "Doo Video Banner", "doo-text-domain" ),
	"icon" => "dt_vc_fashion_video_banner",
    'admin_enqueue_css' => array(get_template_directory_uri().'/vc_doo_banner.css'),
	'category' => __( 'Doo', "doo-text-domain" ),
	'description' => __( 'Animated Video panel', "doo-text-domain" ),
    "params" => array(
        array(
          "type"        => "dropdown",
          "heading"     => __("Fashion banner style", "doo-text-domain"),
          "param_name"  => "fashion_style",
          "value"       => array(
            'Altare'   => 'effect-altare',
            'Andromeda'   => 'effect-andromeda',
            'Auriga' => 'effect-auriga',
            'Bulino'  => 'effect-bulino',
            'Camaleonte'  => 'effect-camaleonte',
            'Carena'  => 'effect-carena',
            'Cassiopea'  => 'effect-cassiopea',
            'Centauro'  => 'effect-centauro',
            'Dorado'  => 'effect-dorado',
            'Ercole'  => 'effect-ercole',
            'Fenice'  => 'effect-fenice',
            'Giraffa'  => 'effect-giraffa',              
          ),
          "description" => __("Select the style of banner you want activate")
        ),
        array(
            "type" => "textfield", 
            "heading" => __("Video url mp4", "doo-text-domain"),
			"description" => __( "If you want download mp4 from youtube see <a href=\"http://www.clipconverter.cc/\">ClipConverter</a>", "doo-text-domain" ),
            "param_name" => "video_url_mp4",
        ),	
        array(
            "type" => "textfield", 
            "heading" => __("Video url ogg", "doo-text-domain"),
            "param_name" => "video_url_ogg",
        ),	
        array(
            "type" => "textfield", 
            "heading" => __("Video url webm", "doo-text-domain"),
            "param_name" => "video_url_webm",
        ),		
  		
        array(
            "type" => "attach_image", // it will bind a img choice in WP
            "heading" => __("Alternative background image", "doo-text-domain"),	
            "param_name" => "bg_image",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Height", "doo-text-domain"),
			"value" => __( "100%", "doo-text-domain" ),
            "description" => __( "Banner max height in px.", "doo-text-domain" ),			
            "param_name" => "height",
        ),		

        array(
            "type" => "textfield", 
            "heading" => __("Title", "doo-text-domain"),
			"value" => __( "PANEL", "doo-text-domain" ),
            "param_name" => "header",
        ),
		
        array(
            "type" => "textfield", 
            "heading" => __("Bold title", "doo-text-domain"),
			"value" => __( "TITLE", "doo-text-domain" ),
            "param_name" => "header2",
        ),		
		
        array(
            "type" => "textfield", 
            "heading" => __("Title font size", "doo-text-domain"),
			"value" => __( "30px", "doo-text-domain" ),
            "param_name" => "title_font_size",
        ),
		

		
        array(
            "type" => "colorpicker", 
            "heading" => __("Title overlay font color", "doo-text-domain"),
            "param_name" => "title_overlay_font_color",
			"value" => __( "#ffffff", "doo-text-domain" ),				
        ),
		
        array(
            "type" => "textarea_html", 
            "heading" => __("Description", "doo-text-domain"),
			"holder" => "div",
            "class" => "",
            "param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "doo-text-domain" ),
		),
		
        array(
            "type" => "colorpicker", 
            "heading" => __("Description font color", "doo-text-domain"),
            "param_name" => "description_font_color",
			"value" => __( "#ffffff", "doo-text-domain" )			
		),
		
        array(
            "type" => "textfield", 
            "heading" => __("Description font size", "doo-text-domain"),
			"value" => __( "15px", "doo-text-domain" ),
            "param_name" => "description_font_size",
        ),		
        array(
            "type" => "colorpicker", 
            "heading" => __("Background overlay", "doo-text-domain"),
			"value" => __( "#3085a3", "doo-text-domain" ),
            "param_name" => "background_overlay",
        ),
        array(
            "type" => "vc_link", 
            "heading" => __("Url", "doo-text-domain"),
			"value" => __( "#", "doo-text-domain" ),
            "param_name" => "link",
        )	
    )
) );
}



?>
