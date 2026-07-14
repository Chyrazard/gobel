<?php

// VC element: et_countdown

vc_map(array(
  'name' => esc_html__('Countdown', 'belctech-ecommerce' ),
  'base' => 'et_countdown',
  'icon' => 'et_countdown',
  'description' => esc_html__('Countdown module for your events.', 'belctech-ecommerce' ),
  'category' => esc_html__('Belctech', 'belctech-ecommerce' ),
  'params' => array(
    array(
      'type' => 'textfield',
      'heading' => esc_html__('Upcoming Event Date', 'belctech-ecommerce' ),
      'param_name' => 'date',
      'admin_label' => true,
      'value' => '12/24/2018 12:00:00',
      'description' => esc_html__('Enter the due date for Event. eg : 12/24/2018 12:00:00 => month/day/year hour:minute:second', 'belctech-ecommerce' )
    ),
    array(
      'heading' => esc_html__('UTC Timezone', 'belctech-ecommerce' ),
      'type' => 'dropdown',
      'param_name' => 'utc_timezone',
      'value' => array(
          '-12' => '-12',
          '-11' => '-11',
          '-10' => '-10',
          '-9' => '-9',
          '-8' => '-8',
          '-7' => '-7',
          '-6' => '-6',
          '-5' => '-5',
          '-4' => '-4',
          '-3' => '-3',
          '-2' => '-2',
          '-1' => '-1',
          '0' => '0',
          '+1' => '+1',
          '+2' => '+2',
          '+3' => '+3',
          '+4' => '+4',
          '+5' => '+5',
          '+6' => '+6',
          '+7' => '+7',
          '+8' => '+8',
          '+9' => '+9',
          '+10' => '+10',
          '+12' => '+12'
      ),

      'description'	=> sprintf( __( 'You can check your UTC Timezone in this %sinteractive map%s.', 'belctech-ecommerce' ), '<a href="https://www.timeanddate.com/time/map/#!cities=1440" target="_blank">', '</a>' )
    ),
    array(
      'type'      => 'dropdown',
      'heading'     => __( 'Countdown Size', 'belctech-ecommerce' ),
      'param_name'  => 'size',
      'value'     => array(
        __( 'Large', 'belctech-ecommerce' )     => 'lg',
        __( 'Medium', 'belctech-ecommerce' )    => 'md',
        __( 'Small', 'belctech-ecommerce' )     => 'sm',
      ),
      'std'       => 'md'
    ),
    array(
      'type'      => 'dropdown',
      'heading'     => __( 'Animation', 'belctech-ecommerce' ),
      'param_name'  => 'animation',
      'value'     => array(
        __( 'None', 'belctech-ecommerce' )               => '',
        __( 'Right to Left', 'belctech-ecommerce' )      => 'animation right-to-left',
        __( 'Left to Right', 'belctech-ecommerce' )      => 'animation left-to-right',
        __( 'Right to Left - 3D', 'belctech-ecommerce' ) => 'animation right-to-left-3d',
        __( 'Left to Right - 3D', 'belctech-ecommerce' ) => 'animation left-to-right-3d',
        __( 'Bottom to Top', 'belctech-ecommerce' )      => 'animation bottom-to-top',
        __( 'Top to Bottom', 'belctech-ecommerce' )      => 'animation top-to-bottom',
        __( 'Bottom to Top - 3D', 'belctech-ecommerce' ) => 'animation bottom-to-top-3d',
        __( 'Top to Bottom - 3D', 'belctech-ecommerce' ) => 'animation top-to-bottom-3d',
        __( 'Scale', 'belctech-ecommerce' )              => 'animation scale',
        __( 'Fade', 'belctech-ecommerce' )               => 'animation fade',
      ),
      'std'       => 'animation bottom-to-top',
      'group' => __( 'Styling','belctech-ecommerce' ),
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Countdown Color', 'belctech-ecommerce' ),
      'param_name' => 'countdown_color',
      'value' => array(
        __( 'Default', 'belctech-ecommerce' ) => '',
        __( 'Dark', 'belctech-ecommerce' ) => 'dark',
        __( 'Light', 'belctech-ecommerce' ) => 'light',
        __( 'Accent Color', 'belctech-ecommerce' ) => 'accent',
        __( 'Custom', 'belctech-ecommerce' ) => 'custom'
      ),
      'std' => '',
      'group' => __( 'Styling','belctech-ecommerce' ),
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Countdown Custom Color', 'belctech-ecommerce' ),
      'param_name'     => 'countdown_color_custom',
      'dependency' => array(
        'element' => 'countdown_color',
        'value' => array( 'custom' )
      ),
      'group' => __( 'Styling','belctech-ecommerce' ),
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Caption Color', 'belctech-ecommerce' ),
      'param_name' => 'caption_color',
      'value' => array(
        __( 'Default', 'belctech-ecommerce' ) => '',
        __( 'Dark', 'belctech-ecommerce' ) => 'dark',
        __( 'Light', 'belctech-ecommerce' ) => 'light',
        __( 'Accent Color', 'belctech-ecommerce' ) => 'accent',
        __( 'Custom', 'belctech-ecommerce' ) => 'custom'
      ),
      'std' => '',
      'group' => __( 'Styling','belctech-ecommerce' ),
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Captions Custom Color', 'belctech-ecommerce' ),
      'param_name'     => 'caption_color_custom',
      'dependency' => array(
        'element' => 'caption_color',
        'value' => array( 'custom' )
      ),
      'group' => __( 'Styling','belctech-ecommerce' ),
    ),

  )
));
