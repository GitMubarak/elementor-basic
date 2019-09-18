<?php
use \Elementor\Widget_Base as Widget_Base;
use \Elementor\Controls_Manager as Controls_Manager;

class Hm_Text extends Widget_Base {

	public function get_name() {
        return 'mubarak';
    }

	public function get_title() {
        return __( 'HM Text', 'hm-elementor-demo' );
    }

	public function get_icon() {
        return 'eicon-text';
    }

	public function get_categories() {
        return [ 'hm-category' ];
    }

	protected function _register_controls() {
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'hm-elementor-demo' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'hm-elementor-demo' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Title', 'hm-elementor-demo' ),
            ]
        );

        $this->add_control(
			'description',
			[
				'label'       => __( 'Description', 'hm-elementor-demo' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Description', 'hm-elementor-demo' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'position_section',
			[
				'label' => __( 'Position', 'hm-elementor-demo' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'title-alignment',
            [
                'label'         => __( 'Title Alignment', 'hm-elementor-demo' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'left',
                'options'       => [
                                        'left'      => __( 'Left', 'hm-elementor-demo' ),
                                        'right'     => __( 'Right', 'hm-elementor-demo' ),
                                        'center'    => __( 'Center', 'hm-elementor-demo' ),
                                    ],
                'selectors'     => [
                    '{{WRAPPER}} h1.title'  => 'text-align: {{VALUE}}' 
                ]
            ]
        );
        
        $this->add_control(
            'description-alignment',
            [
                'label'         => __( 'Description Alignment', 'hm-elementor-demo' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'left',
                'options'       => [
                                        'left'      => __( 'Left', 'hm-elementor-demo' ),
                                        'right'     => __( 'Right', 'hm-elementor-demo' ),
                                        'center'    => __( 'Center', 'hm-elementor-demo' ),
                                    ],
                'selectors'     => [
                    '{{WRAPPER}} p.description'  => 'text-align: {{VALUE}}' 
                ]
            ]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'color_section',
			[
				'label' => __( 'Color', 'hm-elementor-demo' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'hm-elementor-demo' ),
				'type'      => Controls_Manager::COLOR,
                //'placeholder' => __( 'Enter Title', 'hm-elementor-demo' ),
                'default'   => '#FF0000',
                'selectors' => [
                    '{{WRAPPER}} h1.title' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
			'description_color',
			[
				'label'     => __( 'Description Color', 'hm-elementor-demo' ),
				'type'      => Controls_Manager::COLOR,
                //'placeholder' => __( 'Enter Title', 'hm-elementor-demo' ),
                'default'   => '#242424',
                'selectors' => [
                    '{{WRAPPER}} p.description' => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();
        
        $title = $settings['title'];
        $description = $settings['description'];
        ?>
        <h1 class="title"><?php echo esc_attr($title); ?></h1>
        <p class="description"><?php echo wp_kses_post($description); ?></p>
        <?php
    }

	protected function _content_template() {}

}