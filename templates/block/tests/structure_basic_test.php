<?php
namespace {{COMPONENT}};

/**
 * Basic structure test for {{PLUGIN_DISPLAY_NAME}} block.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class structure_basic_test extends \advanced_testcase {

    /**
     * Test that the block class exists and can be instantiated.
     *
     * @covers \block_{{NAME}}
     */
    public function test_block_class_exists(): void {
        $this->assertTrue(class_exists('block_{{NAME}}'));
    }

    /**
     * Test basic block initialization.
     *
     * @covers \block_{{NAME}}::init
     */
    public function test_block_init(): void {
        $this->resetAfterTest();

        $block = new \block_{{NAME}}();
        $block->init();

        $this->assertNotEmpty($block->title);
    }

    /**
     * Test block content generation.
     *
     * @covers \block_{{NAME}}::get_content
     */
    public function test_get_content(): void {
        $this->resetAfterTest();

        $block = new \block_{{NAME}}();
        $block->init();
        $content = $block->get_content();

        $this->assertNotNull($content);
        $this->assertIsObject($content);
        $this->assertObjectHasProperty('text', $content);
        $this->assertObjectHasProperty('footer', $content);
    }
}
