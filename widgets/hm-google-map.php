<?php
if (!defined('ABSPATH')) { exit; }

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class Hm_Google_Map extends Widget_Base {

	public function get_name() {
        return 'hm-google-map';
    }

	public function get_title() {
        return __( 'HM Google Maps', 'hm-elementor-demo' );
    }

	public function get_icon() {
        return 'eicon-google-maps';
    }

	public function get_categories() {
        return [ 'hm-category' ];
    }

	protected function _register_controls() {
        
        $this->start_controls_section(
			'hm_map_section',
			[
				'label' => __( 'Map', 'hm-elementor-demo' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hm_gm_location',
			[
				'label'       => __( 'Location', 'hm-elementor-demo' ),
				'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'separator'     => 'after',
            ]
        );

        $this->add_control(
			'hm_gm_zoom',
			[
				'label'     => __( 'Zoom', 'hm-elementor-demo' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
						'min' => 1,
						'max' => 20,
						'step' => 1,
					],
                ],
            ]
        );

        $this->add_control(
			'hm_gm_height',
			[
				'label'     => __( 'Height', 'hm-elementor-demo' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
						'min' => 1,
						'max' => 1000,
						'step' => 1,
					],
                ],
                'default' => [
					'unit' => '',
					'size' => 50,
				],
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();
        $location = $settings['hm_gm_location'];
        $zoom = $settings['hm_gm_zoom']['size'];
        $height = $settings['hm_gm_height']['size'];
        ?>
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe width="100%" 
                        height="<?php echo esc_attr($height); ?>" 
                        id="gmap_canvas" 
                        src="https://maps.google.com/maps?q=<?php echo esc_attr($location); ?>&t=&z=<?php echo esc_attr($zoom); ?>&ie=UTF8&iwloc=&output=embed" 
                        frameborder="0" 
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0">
                </iframe>
                <a href="https://www.emojilib.com"></a>
            </div>
            <style>
            .mapouter{
                position:relative;
                text-align:right;
                width:100%;
                height:auto;
            }
            .gmap_canvas {
                overflow:hidden;
                background:none!important;
                width:100%;
                height:auto;
            }
            </style>
        </div>
        <?php
    }

	protected function _content_template() {}

}