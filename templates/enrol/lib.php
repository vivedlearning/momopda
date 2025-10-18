<?php
defined('MOODLE_INTERNAL') || die();

/**
 * {{PLUGIN_DISPLAY_NAME}} enrolment plugin.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class enrol_{{NAME}}_plugin extends enrol_plugin {

    /**
     * Returns localised name of enrol instance.
     *
     * @param stdClass $instance (null is accepted too)
     * @return string
     */
    public function get_instance_name($instance) {
        if (empty($instance->name)) {
            return get_string('pluginname', '{{COMPONENT}}');
        }
        return format_string($instance->name);
    }

    /**
     * Does this plugin allow manual enrolments?
     *
     * @param stdClass $instance course enrol instance
     * @return bool - true means user with 'enrol/{{NAME}}:enrol' capability may enrol other users
     */
    public function allow_enrol(stdClass $instance) {
        return true;
    }

    /**
     * Does this plugin allow manual unenrolment of all users?
     *
     * @param stdClass $instance course enrol instance
     * @return bool - true means user with 'enrol/{{NAME}}:unenrol' capability may unenrol others
     */
    public function allow_unenrol(stdClass $instance) {
        return true;
    }
}
