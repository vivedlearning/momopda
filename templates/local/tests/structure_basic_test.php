<?php
namespace {{COMPONENT}};

/**
 * Basic structure test for {{PLUGIN_DISPLAY_NAME}} local plugin.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class structure_basic_test extends \advanced_testcase {

    /**
     * Test that lib.php exists.
     */
    public function test_lib_exists(): void {
        global $CFG;
        $this->assertFileExists($CFG->dirroot . '/local/{{NAME}}/lib.php');
    }

    /**
     * Test that version.php exists and is valid.
     */
    public function test_version_exists(): void {
        global $CFG;
        $plugin = new \stdClass();
        require($CFG->dirroot . '/local/{{NAME}}/version.php');
        $this->assertEquals('{{COMPONENT}}', $plugin->component);
    }
}
