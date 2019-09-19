<?php
if (!defined('ABSPATH')) { exit; }

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class Hm_Faq extends Widget_Base {

	public function get_name() {
        return 'hm-faq';
    }

	public function get_title() {
        return __( 'HM FAQ', 'hm-elementor-demo' );
    }

	public function get_icon() {
        return 'fa fa-question';
    }

	public function get_categories() {
        return [ 'hm-category' ];
    }

	protected function _register_controls() {
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'hm-elementor-demo' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
        );
        
        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'hm_faq_title',
			[
				'label' => __( 'Title', 'hm-elementor-demo' ),
				'type'  => Controls_Manager::TEXT,
                'label_block'    => true,
            ]
        );

        $repeater->add_control(
			'hm_faq_description',
			[
				'label' => __( 'Description', 'hm-elementor-demo' ),
                'type'  => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
			'hm_faq_items',
			[
				'label'         => __( 'FAQs', 'hm-elementor-demo' ),
                'type'          => Controls_Manager::REPEATER,
                'fields'        => $repeater->get_controls(),
                'title_field'   => '{{{ hm_faq_title }}}',
            ]
        );
        
        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();
        $faqs = $settings['hm_faq_items'];
        if($faqs):
        ?>
        <div class="hm-faq-wrapper">
            <?php foreach($faqs as $faq): ?>
                <h4 class="hm-faq-title">Q: <?php echo esc_attr($faq['hm_faq_title']); ?></h4>
                <p class="hm-faq-description"><?php echo wp_kses_post($faq['hm_faq_description']); ?></p>
            <?php endforeach; ?>
        </div>
        <?php
        endif;
    }

	protected function _content_template() {}

}