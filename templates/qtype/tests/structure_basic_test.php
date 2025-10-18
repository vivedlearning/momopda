<?php
namespace {{COMPONENT}};

/**
 * Basic structure test for {{PLUGIN_DISPLAY_NAME}} question type.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class structure_basic_test extends \advanced_testcase {

    /**
     * Test that the question type class exists.
     *
     * @covers \qtype_{{NAME}}
     */
    public function test_questiontype_class_exists(): void {
        $this->assertTrue(class_exists('qtype_{{NAME}}'));
    }

    /**
     * Test question type name.
     *
     * @covers \qtype_{{NAME}}::name
     */
    public function test_name(): void {
        $qtype = new \qtype_{{NAME}}();
        $this->assertEquals('{{NAME}}', $qtype->name());
    }
}
