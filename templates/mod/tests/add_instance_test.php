<?php
namespace {{COMPONENT}};

/**
 * Test add instance functionality for {{PLUGIN_DISPLAY_NAME}}.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class add_instance_test extends \advanced_testcase {

    /**
     * Test adding an instance of the activity.
     *
     * @covers ::{{NAME}}_add_instance
     */
    public function test_add_instance(): void {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();

        $data = new \stdClass();
        $data->course = $course->id;
        $data->name = 'Test {{PLUGIN_DISPLAY_NAME}}';
        $data->intro = 'Test intro';
        $data->introformat = FORMAT_HTML;

        $instanceid = {{NAME}}_add_instance($data);

        $this->assertIsInt($instanceid);
        $this->assertTrue($DB->record_exists('{{NAME}}', ['id' => $instanceid]));

        $instance = $DB->get_record('{{NAME}}', ['id' => $instanceid], '*', MUST_EXIST);
        $this->assertEquals($data->name, $instance->name);
        $this->assertEquals($data->course, $instance->course);
    }

    /**
     * Test updating an instance of the activity.
     *
     * @covers ::{{NAME}}_update_instance
     */
    public function test_update_instance(): void {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();

        $data = new \stdClass();
        $data->course = $course->id;
        $data->name = 'Test {{PLUGIN_DISPLAY_NAME}}';
        $data->intro = 'Test intro';
        $data->introformat = FORMAT_HTML;

        $instanceid = {{NAME}}_add_instance($data);

        $data->instance = $instanceid;
        $data->name = 'Updated name';

        $result = {{NAME}}_update_instance($data);

        $this->assertTrue($result);

        $instance = $DB->get_record('{{NAME}}', ['id' => $instanceid], '*', MUST_EXIST);
        $this->assertEquals('Updated name', $instance->name);
    }

    /**
     * Test deleting an instance of the activity.
     *
     * @covers ::{{NAME}}_delete_instance
     */
    public function test_delete_instance(): void {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();

        $data = new \stdClass();
        $data->course = $course->id;
        $data->name = 'Test {{PLUGIN_DISPLAY_NAME}}';
        $data->intro = 'Test intro';
        $data->introformat = FORMAT_HTML;

        $instanceid = {{NAME}}_add_instance($data);

        $result = {{NAME}}_delete_instance($instanceid);

        $this->assertTrue($result);
        $this->assertFalse($DB->record_exists('{{NAME}}', ['id' => $instanceid]));
    }
}
