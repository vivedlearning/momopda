<?php
namespace {{COMPONENT}};

/**
 * Basic structure test for {{PLUGIN_DISPLAY_NAME}} report.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class structure_basic_test extends \advanced_testcase {

    /**
     * Test that index.php exists.
     */
    public function test_index_exists(): void {
        global $CFG;
        $this->assertFileExists($CFG->dirroot . '/report/{{NAME}}/index.php');
    }

    /**
     * Test capability exists.
     */
    public function test_capability_exists(): void {
        $this->assertTrue(get_capability_info('report/{{NAME}}:view') !== null);
    }
}
