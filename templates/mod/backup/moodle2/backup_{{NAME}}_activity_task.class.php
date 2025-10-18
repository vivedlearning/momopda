<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/{{NAME}}/backup/moodle2/backup_{{NAME}}_stepslib.php');

/**
 * {{PLUGIN_DISPLAY_NAME}} backup task.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_{{NAME}}_activity_task extends backup_activity_task {

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
        $this->add_step(new backup_{{NAME}}_activity_structure_step('{{NAME}}_structure', '{{NAME}}.xml'));
    }

    /**
     * Code the transformations to perform in the activity in order to get transportable (encoded) links.
     *
     * @param string $content
     * @return string
     */
    public static function encode_content_links($content) {
        global $CFG;

        $base = preg_quote($CFG->wwwroot, '/');

        // Link to the list of activities.
        $search = "/(" . $base . "\/mod\/{{NAME}}\/index.php\?id\=)([0-9]+)/";
        $content = preg_replace($search, '$@{{COMPONENT}}INDEX*$2@$', $content);

        // Link to activity view by moduleid.
        $search = "/(" . $base . "\/mod\/{{NAME}}\/view.php\?id\=)([0-9]+)/";
        $content = preg_replace($search, '$@{{COMPONENT}}VIEWBYID*$2@$', $content);

        return $content;
    }
}
