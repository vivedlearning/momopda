<?php
namespace {{COMPONENT}};

/**
 * Basic structure test for {{PLUGIN_DISPLAY_NAME}} filter.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class structure_basic_test extends \advanced_testcase {

    /**
     * Test that the filter class exists.
     *
     * @covers \filter_{{NAME}}
     */
    public function test_filter_class_exists(): void {
        $this->assertTrue(class_exists('filter_{{NAME}}'));
    }

    /**
     * Test basic filtering.
     *
     * @covers \filter_{{NAME}}::filter
     */
    public function test_filter(): void {
        $this->resetAfterTest();

        $filter = new \filter_{{NAME}}(\context_system::instance(), []);
        $text = 'Sample text';
        $filtered = $filter->filter($text);

        $this->assertIsString($filtered);
    }
}
