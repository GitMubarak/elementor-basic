<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;

class Hm_Button extends Widget_Base {

	public function get_name() {
        return 'hm-button';
    }

	public function get_title() {
        return __( 'HM Button', 'hm-elementor-demo' );
    }

	public function get_icon() {
        return 'eicon-button';
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
			'button_text',
			[
				'label'         => __( 'Button Text', 'hm-elementor-demo' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'BUTTON',
				'placeholder'   => __( 'Button Text', 'hm-elementor-demo' ),
            ]
        );

        $this->add_control(
			'button_url',
			[
				'label'       => __( 'Url', 'hm-elementor-demo' ),
				'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'         => '#',
                    'is_external' => '',
                ],
                'show_external' => true,
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
            'button-alignment',
            [
                'label'         => __( 'Button Alignment', 'hm-elementor-demo' ),
                'type'          => Controls_Manager::CHOOSE,
                'label_block' => true,
                'options'     => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'hm-elementor-demo' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'hm-elementor-demo' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'hm-elementor-demo' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
				'default'   => '',
                'selectors'     => [
                    '{{WRAPPER}} div.hm-button-wrapper'  => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->end_controls_section();
        

        // Style Controls
		$this->start_controls_section(
			'hm_button_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
        );

        $this->add_control(
			'button_bg_color',
			[
				'label'     => __( 'Button Background Color', 'hm-elementor-demo' ),
				'type'      => Controls_Manager::COLOR,
                'default'   => '#FF0000',
                'selectors' => [
                    '{{WRAPPER}} a.hm-button' => 'background: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Button Text Color', 'hm-elementor-demo' ),
				'type'      => Controls_Manager::COLOR,
                'default'   => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} a.hm-button' => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
			'hm_button_style',
			[
				'label' => esc_html__( 'Button Style', 'hm-elementor-demo' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
        );

        $this->add_control(
            'hm_button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'hm-elementor-demo' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hm-button'         => 'border-radius: {{SIZE}}px;',
                    '{{WRAPPER}} .hm-button::before' => 'border-radius: {{SIZE}}px;',
                    '{{WRAPPER}} .hm-button::after'  => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'hm_button_width',
            [
                'label'      => esc_html__( 'Width', 'hm-elementor-demo' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} a.hm-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hm_button_padding',
            [
                'label'      => esc_html__( 'Button Padding', 'hm-elementor-demo' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .hm-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
            'name'     => 'hm_button_typography',
            'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .hm-button',
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();

        $text = $settings['button_text'];

        $this->add_render_attribute('hm_button', [
            'class' => 'hm-button',
            'href'	=> esc_attr($settings['button_url']['url'] ),
        ]);

        if( $settings['button_url']['is_external'] ) {
            $this->add_render_attribute( 'hm_button', 'target', '_blank' );
		}
        
        if( $settings['button_url']['nofollow'] ) {
            $this->add_render_attribute( 'hm_button', 'rel', 'nofollow' );
		}
        ?>
        <div class="hm-button-wrapper" style="width:100%;">
            <a <?php echo $this->get_render_attribute_string( 'hm_button' ); ?> style="display:inline-block;">
                <?php echo esc_html($text); ?>
            </a>
        </div>
        <?php
    }

	protected function _content_template() {}

}