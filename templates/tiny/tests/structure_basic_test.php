<?php
namespace {{COMPONENT}};

/**
 * Basic structure test for {{PLUGIN_DISPLAY_NAME}} TinyMCE plugin.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class structure_basic_test extends \advanced_testcase {

    /**
     * Test that the plugin info class exists.
     *
     * @covers \tiny_{{NAME}}\plugininfo
     */
    public function test_plugin_class_exists(): void {
        $this->assertTrue(class_exists('tiny_{{NAME}}\plugininfo'));
    }

    /**
     * Test available buttons.
     *
     * @covers \tiny_{{NAME}}\plugininfo::get_available_buttons
     */
    public function test_get_available_buttons(): void {
        $buttons = \tiny_{{NAME}}\plugininfo::get_available_buttons();
        $this->assertIsArray($buttons);
        $this->assertNotEmpty($buttons);
    }
}
