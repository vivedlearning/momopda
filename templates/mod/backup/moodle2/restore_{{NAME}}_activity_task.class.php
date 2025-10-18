<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/{{NAME}}/backup/moodle2/restore_{{NAME}}_stepslib.php');

/**
 * {{PLUGIN_DISPLAY_NAME}} restore task.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_{{NAME}}_activity_task extends restore_activity_task {

    /**
     * Define (add) particular settings this activity can have.
     */
    protected function define_my_settings() {
        // No particular settings for this activity.
    }

    /**
     * Define (add) particular steps this activity can have.
     */
    protected function define_my_steps() {
        $this->add_step(new restore_{{NAME}}_activity_structure_step('{{NAME}}_structure', '{{NAME}}.xml'));
    }

    /**
     * Define the contents in the activity that must be processed by the link decoder.
     */
    public static function define_decode_contents() {
        $contents = [];

        $contents[] = new restore_decode_content('{{NAME}}', ['intro'], '{{COMPONENT}}');

        return $contents;
    }

    /**
     * Define the decoding rules for links belonging to the activity to be executed by the link decoder.
     */
    public static function define_decode_rules() {
        $rules = [];

        $rules[] = new restore_decode_rule('{{COMPONENT}}VIEWBYID', '/mod/{{NAME}}/view.php?id=$1', 'course_module');
        $rules[] = new restore_decode_rule('{{COMPONENT}}INDEX', '/mod/{{NAME}}/index.php?id=$1', 'course');

        return $rules;
    }

    /**
     * Define the restore log rules that will be applied by the restore_logs_processor.
     */
    public static function define_restore_log_rules() {
        $rules = [];

        $rules[] = new restore_log_rule('{{NAME}}', 'add', 'view.php?id={course_module}', '{{{NAME}}}');
        $rules[] = new restore_log_rule('{{NAME}}', 'update', 'view.php?id={course_module}', '{{{NAME}}}');
        $rules[] = new restore_log_rule('{{NAME}}', 'view', 'view.php?id={course_module}', '{{{NAME}}}');

        return $rules;
    }
}
