<?php
namespace {{COMPONENT}};

/**
 * Basic structure test for {{PLUGIN_DISPLAY_NAME}} activity module.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class structure_basic_test extends \advanced_testcase {

    /**
     * Test that required functions exist.
     *
     * @covers ::{{NAME}}_supports
     */
    public function test_required_functions_exist(): void {
        $this->assertTrue(function_exists('{{NAME}}_supports'));
        $this->assertTrue(function_exists('{{NAME}}_add_instance'));
        $this->assertTrue(function_exists('{{NAME}}_update_instance'));
        $this->assertTrue(function_exists('{{NAME}}_delete_instance'));
    }

    /**
     * Test module supports features.
     *
     * @covers ::{{NAME}}_supports
     */
    public function test_supports(): void {
        $this->assertTrue({{NAME}}_supports(FEATURE_MOD_INTRO));
        $this->assertTrue({{NAME}}_supports(FEATURE_BACKUP_MOODLE2));
        $this->assertNotNull({{NAME}}_supports(FEATURE_MOD_ARCHETYPE));
    }
}
