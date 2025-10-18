<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Define the restore structure for the {{NAME}} activity.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_{{NAME}}_activity_structure_step extends restore_activity_structure_step {

    /**
     * Define the structure of the restore file.
     *
     * @return array
     */
    protected function define_structure() {

        $paths = [];
        $paths[] = new restore_path_element('{{NAME}}', '/activity/{{NAME}}');

        return $this->prepare_activity_structure($paths);
    }

    /**
     * Process a {{NAME}} restore.
     *
     * @param array $data The data in object form
     */
    protected function process_{{NAME}}($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        $data->course = $this->get_courseid();

        $data->timecreated = $this->apply_date_offset($data->timecreated);
        $data->timemodified = $this->apply_date_offset($data->timemodified);

        $newitemid = $DB->insert_record('{{NAME}}', $data);
        $this->apply_activity_instance($newitemid);
    }

    /**
     * Post-execution actions.
     */
    protected function after_execute() {
        // Add {{NAME}} related files.
        $this->add_related_files('{{COMPONENT}}', 'intro', null);
    }
}
