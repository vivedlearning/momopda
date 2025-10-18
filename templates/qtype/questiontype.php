<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Question type class for {{PLUGIN_DISPLAY_NAME}}.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_{{NAME}} extends question_type {

    /**
     * @return string the name of this question type.
     */
    public function name() {
        return '{{NAME}}';
    }
}
