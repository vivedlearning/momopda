<?php
namespace {{COMPONENT}};

/**
 * Basic structure test for {{PLUGIN_DISPLAY_NAME}} question bank plugin.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class structure_basic_test extends \advanced_testcase {

    /**
     * Test that the plugin feature class exists.
     *
     * @covers \qbank_{{NAME}}\plugin_feature
     */
    public function test_plugin_class_exists(): void {
        $this->assertTrue(class_exists('qbank_{{NAME}}\plugin_feature'));
    }
}
