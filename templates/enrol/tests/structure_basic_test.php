<?php
namespace {{COMPONENT}};

/**
 * Basic structure test for {{PLUGIN_DISPLAY_NAME}} enrolment plugin.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class structure_basic_test extends \advanced_testcase {

    /**
     * Test that the enrol plugin class exists.
     *
     * @covers \enrol_{{NAME}}_plugin
     */
    public function test_plugin_class_exists(): void {
        $this->assertTrue(class_exists('enrol_{{NAME}}_plugin'));
    }

    /**
     * Test plugin instance name.
     *
     * @covers \enrol_{{NAME}}_plugin::get_instance_name
     */
    public function test_get_instance_name(): void {
        $plugin = new \enrol_{{NAME}}_plugin();
        $instance = new \stdClass();
        $this->assertNotEmpty($plugin->get_instance_name($instance));
    }
}
