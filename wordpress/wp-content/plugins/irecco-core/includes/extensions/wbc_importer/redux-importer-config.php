<?php

if (!function_exists('wbc_extended_example')) {
    /**
     * Add menu and rev slider to demo content.
     * Set defaults settings.
     * 
     * @package     WBC_Importer - Extension for Importing demo content
     * @author      Webcreations907
     * @version     1.0
     */
    function wbc_extended_example($demo_active_import, $demo_directory_path)
    {
        reset($demo_active_import);
        $current_key = key($demo_active_import);

        /**
         * Slider(s) Import 
         */
        if (class_exists('RevSlider')) {
            $wbc_sliders_array = [
                'demo' => [ // Set sliders zip name
                    '1' => 'home-1.zip',
                    '2' => 'home-2.zip',
                    '3' => 'home-3.zip',
                ]
            ];
            if (
                !empty($demo_active_import[$current_key]['directory'])
                && array_key_exists($demo_active_import[$current_key]['directory'], $wbc_sliders_array)
            ) {
                $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
                if (is_array($wbc_slider_import)) {
                    foreach ($wbc_slider_import as $key => $value) {
                        if (file_exists($demo_directory_path . $value)) {
                            $slider[$key] = new RevSlider();
                            $slider[$key]->importSliderFromPost(true, true, $demo_directory_path . $value);
                        }
                    }
                } elseif (file_exists($demo_directory_path . $wbc_slider_import)) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost(true, true, $demo_directory_path . $wbc_slider_import);
                }
            }
        }

        /**
         * Menu(s)
         */

        // Set menu name
        $wbc_menu_array = [
            'demo' => 'main'
        ];

        if (
            !empty($demo_active_import[$current_key]['directory'])
            && array_key_exists($demo_active_import[$current_key]['directory'], $wbc_menu_array)
        ) {
            $top_menu = get_term_by('name', $wbc_menu_array[$demo_active_import[$current_key]['directory']], 'nav_menu');
            if (isset($top_menu->term_id)) {
                set_theme_mod('nav_menu_locations', ['main_menu' => $top_menu->term_id]);
            }
        }

        /**
         * HomePage(s)
         */

        // Array of `demos => homepages` to select from
        $wbc_home_pages = [
            'demo' => 'Home',
        ];

        if (
            !empty($demo_active_import[$current_key]['directory'])
            && array_key_exists($demo_active_import[$current_key]['directory'], $wbc_home_pages)
        ) {
            $page = get_page_by_title($wbc_home_pages[$demo_active_import[$current_key]['directory']]);
            if (isset($page->ID)) {
                update_option('page_on_front', $page->ID);
                update_option('show_on_front', 'page');
            }
        }

        /**
         * Elementor defaults
         */

        // Support all Custom Post Types
        $cpt_support = get_option('elementor_cpt_support');
        if (!$cpt_support) {
            $cpt_support = ['page', 'post', 'portfolio', 'team', 'footer', 'side_panel', 'header'];
            update_option('elementor_cpt_support', $cpt_support);
        } else {
            $include_cpt = ['portfolio', 'team', 'footer', 'side_panel', 'header'];
            foreach ($include_cpt as $cpt) {
                if (!in_array($cpt, $cpt_support)) {
                    $cpt_support[] = $cpt;
                }
            }
            update_option('elementor_cpt_support', $cpt_support);
        }
        // Container Width 
        update_option('elementor_container_width', 1170);
        // Font Awesome
        update_option('elementor_load_fa4_shim', 'yes');

        /**
         * WGL Defaults
         */

        // Permalink Structure
        update_option('permalink_structure', "/%postname%/");
    }

    add_action('wbc_importer_after_content_import', 'wbc_extended_example', 10, 2);
}
