<?php
/**
 * Plugin Name: Testing Template Loading
 * Description: Testing template loading for 58905
 * Author: SirLouen <sir.louen@gmail.com>
 * Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function test_locate_template_shortcode() {
    ob_start();
    ?>
    <div style="border: 1px solid #ccc; padding: 15px; margin: 10px 0; background-color: #f9f9f9;">
        <h3>Testing locate_template() Function</h3>
        
        <?php
        $template_file = 'index.php';
        $template_result = locate_template($template_file, false, false);
        echo '<p><strong>Test 1 - Legitimate Template File:</strong> ';
        if ($template_result) {
            echo '✅ Found template file at: ' . esc_html($template_result);
        } else {
            echo '❌ No template file found: ' . $template_file;
        }
        echo '</p>';

        $non_template_file = 'test-non-template.txt';
        $non_template_result = locate_template($non_template_file, false, false);
        echo '<p><strong>Test 2 - Non-Template File:</strong> ';
        if ($non_template_result) {
            echo '❌ Wrongly loaded non-template file at: ' . esc_html($non_template_result);
        } else {
            echo '✅ Correctly did not load non-template file: ' . esc_html($non_template_file);
        }
        echo '</p>';

        $traversal_file = '../../wp-config.php';
        $traversal_result = locate_template($traversal_file, false, false);
        echo '<p><strong>Test 3 - Directory Traversal Attempt:</strong> ';
        if ($traversal_result) {
            echo '❌ Loaded file outside theme at: ' . esc_html($traversal_result);
        } else {
            echo '✅ Blocked traversal attempt for: ' . esc_html($traversal_file);
        }
        echo '</p>';
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('test_locate_template', 'test_locate_template_shortcode');
