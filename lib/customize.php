<?php

/**
 * Customize Background Image Control Class
 *
 * @package WordPress
 * @subpackage Customize
 * @since 3.4.0
 */
class Child_Maidive_Image_Control extends WP_Customize_Image_Control {

	/**
	 * Constructor.
	 *
	 * If $args['settings'] is not defined, use the $id as the setting ID.
	 *
	 * @since 3.4.0
	 * @uses WP_Customize_Upload_Control::__construct()
	 *
	 * @param WP_Customize_Manager $manager
	 * @param string $id
	 * @param array $args
	 */
	public function __construct( $manager, $id, $args ) {
		$this->statuses = array( '' => __( 'No Image', 'maidive' ) );

		parent::__construct( $manager, $id, $args );

		$this->add_tab( 'upload-new', __( 'Upload New', 'maidive' ), array( $this, 'tab_upload_new' ) );
		$this->add_tab( 'uploaded',   __( 'Uploaded', 'maidive' ), array( $this, 'tab_uploaded' ) );
		
		if ( $this->setting->default )
			$this->add_tab( 'default',  __( 'Default', 'maidive' ), array( $this, 'tab_default_background' ) );

		// Early priority to occur before $this->manager->prepare_controls();
		add_action( 'customize_controls_init', array( $this, 'prepare_control' ), 5 );
	}

	/**
	 * @since 3.4.0
	 * @uses WP_Customize_Image_Control::print_tab_image()
	 */
	public function tab_default_background() {
		$this->print_tab_image( $this->setting->default );
	}
	
}


global $wp_customize;

// Backstretch Image
//------------------------------------------------------------------
$wp_customize->add_section( 'maidive-image', array(
	'title'    => __( 'Default Background Image', 'maidive' ),
	'description' => __( '<p>Use the included default image or personalize your site by uploading your own image for the background.</p><p>The default image is <strong>1600 x 1000 pixels</strong>.</p>', 'maidive' ),
	'priority' => 75,
) );

$wp_customize->add_setting( 'maidive-backstretch-image', array(
	'default'  => sprintf( '%s/images/bg.jpg', get_stylesheet_directory_uri() ),
	'type'     => 'option',
) );
 
$wp_customize->add_control(
	new Child_Maidive_Image_Control(
		$wp_customize,
		'backstretch-image',
		array(
			'label'       => __( 'Backstretch Image Upload', 'maidive' ),
			'section'     => 'maidive-image',
			'settings'    => 'maidive-backstretch-image'
		)
	)
);


// Video Background
//------------------------------------------------------------------
$wp_customize->add_section( 'maidive-video', array(
	'title'    => __( 'Default Background Video', 'maidive' ),
	'description' => __( '<p>Set the default video if one is not set on the specific page.</p>', 'maidive' ),
	'priority' => 75,
) );

	
	// Mp4 file type
	$wp_customize->add_setting( 'maidive-background-video-mp4', array(
		'type'     => 'option',
	) );
	 
		$wp_customize->add_control(
			'background-video-mp4-textbox',
			array(
				'label'       => __( 'Vimeo URL - MP4', 'maidive' ),
				'section'     => 'maidive-video',
				'settings'    => 'maidive-background-video-mp4',
				'type' => 'text',
			)
		);
	
	
	
	
	