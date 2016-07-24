<?php

/**
 * Customize Background Image Control Class
 *
 * @package WordPress
 * @subpackage Customize
 * @since 3.4.0
 */
add_action( 'customize_register', 'maidive_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 * 
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function maidive_customizer_register() {

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
		'title'    => __( 'Background Images', 'maidive' ),
		'description' => __( '<p>Use the included default image or personalize your site by uploading your own image for the background.</p><p>The default image is <strong>1600 x 1000 pixels</strong>.</p>', 'maidive' ),
		'priority' => 75,
	) );

		// Default
		$wp_customize->add_setting( 'maidive-default-image', array(
			'type'     => 'option',
		) );
		 
		$wp_customize->add_control(
			new Child_Maidive_Image_Control(
				$wp_customize,
				'maidive-default-image-uploader',
				array(
					'label'       => __( 'Default Image', 'maidive' ),
					'section'     => 'maidive-image',
					'settings'    => 'maidive-default-image'
				)
			)
		);
		
			// Accommodations
		$wp_customize->add_setting( 'maidive-accommodations-image', array(
			'type'     => 'option',
		) );
		 
		$wp_customize->add_control(
			new Child_Maidive_Image_Control(
				$wp_customize,
				'maidive-accommodations-image-uploader',
				array(
					'label'       => __( 'Accommodations Image', 'maidive' ),
					'section'     => 'maidive-image',
					'settings'    => 'maidive-accommodations-image'
				)
			)
		);


		// Adventures
		$wp_customize->add_setting( 'maidive-adventures-image', array(
			'type'     => 'option',
		) );
		 
		$wp_customize->add_control(
			new Child_Maidive_Image_Control(
				$wp_customize,
				'maidive-adventures-image-uploader',
				array(
					'label'       => __( 'Adventures Image', 'maidive' ),
					'section'     => 'maidive-image',
					'settings'    => 'maidive-adventures-image'
				)
			)
		);


		// Gallery
		$wp_customize->add_setting( 'maidive-gallery-image', array(
			'type'     => 'option',
		) );
		 
		$wp_customize->add_control(
			new Child_Maidive_Image_Control(
				$wp_customize,
				'maidive-gallery-image-uploader',
				array(
					'label'       => __( 'Gallery Image', 'maidive' ),
					'section'     => 'maidive-image',
					'settings'    => 'maidive-gallery-image'
				)
			)
		);


		// Courses
		$wp_customize->add_setting( 'maidive-courses-image', array(
			'type'     => 'option',
		) );
		 
		$wp_customize->add_control(
			new Child_Maidive_Image_Control(
				$wp_customize,
				'maidive-courses-image-uploader',
				array(
					'label'       => __( 'Courses Image', 'maidive' ),
					'section'     => 'maidive-image',
					'settings'    => 'maidive-courses-image'
				)
			)
		);



	// Video Background
	//------------------------------------------------------------------
	$wp_customize->add_section( 'maidive-video', array(
		'title'    => __( 'Background Videos', 'maidive' ),
		'description' => __( '<p>Grab the URL from Vimeo under the File tab at the bottom of the page.  Use the high def MP4</p>', 'maidive' ),
		'priority' => 75,
	) );

		
		// Default Video
		$wp_customize->add_setting( 'maidive-background-video-mp4', array(
			'type'     => 'option',
		) );
		 
			$wp_customize->add_control(
				'background-video-mp4-textbox',
				array(
					'label'       => __( 'Default and/or Fallback', 'maidive' ),
					'section'     => 'maidive-video',
					'settings'    => 'maidive-background-video-mp4',
					'type' => 'text',
				)
			);
			
		// Accomodation Archive
		$wp_customize->add_setting( 'maidive-accomodation-video-mp4', array(
			'type'     => 'option',
		) );
		 
			$wp_customize->add_control(
				'accomodation-video-mp4-textbox',
				array(
					'label'       => __( 'Accomodation Archive', 'maidive' ),
					'section'     => 'maidive-video',
					'settings'    => 'maidive-accomodation-video-mp4',
					'type' => 'text',
				)
			);
		
		// Gallery Archive
		$wp_customize->add_setting( 'maidive-gallery-video-mp4', array(
			'type'     => 'option',
		) );
		 
			$wp_customize->add_control(
				'gallery-video-mp4-textbox',
				array(
					'label'       => __( 'Gallery Archive', 'maidive' ),
					'section'     => 'maidive-video',
					'settings'    => 'maidive-gallery-video-mp4',
					'type' => 'text',
				)
			);
		
		
		// Adventures Archive
		$wp_customize->add_setting( 'maidive-adventure-video-mp4', array(
			'type'     => 'option',
		) );
		 
			$wp_customize->add_control(
				'adventure-video-mp4-textbox',
				array(
					'label'       => __( 'Adventure Archive', 'maidive' ),
					'section'     => 'maidive-video',
					'settings'    => 'maidive-adventure-video-mp4',
					'type' => 'text',
				)
			);
		
		
		// Courses Archive
		$wp_customize->add_setting( 'maidive-course-video-mp4', array(
			'type'     => 'option',
		) );
		 
			$wp_customize->add_control(
				'course-video-mp4-textbox',
				array(
					'label'       => __( 'Courses Archive', 'maidive' ),
					'section'     => 'maidive-video',
					'settings'    => 'maidive-course-video-mp4',
					'type' => 'text',
				)
			);
}