<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Define the complete {{NAME}} structure for backup, with file and id annotations.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_{{NAME}}_activity_structure_step extends backup_activity_structure_step {

    /**
     * Define the structure of the backup file.
     *
     * @return backup_nested_element
     */
    protected function define_structure() {

        // Define each element separated.
        ${{NAME}} = new backup_nested_element('{{NAME}}', ['id'], [
            'name', 'intro', 'introformat', 'timecreated', 'timemodified',
        ]);

        // Define sources.
        ${{NAME}}->set_source_table('{{NAME}}', ['id' => backup::VAR_ACTIVITYID]);

        // Define file annotations.
        ${{NAME}}->annotate_files('{{COMPONENT}}', 'intro', null);

        return $this->prepare_activity_structure(${{NAME}});
    }
}
