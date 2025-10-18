<?php
defined('MOODLE_INTERNAL') || die();

/**
 * {{PLUGIN_DISPLAY_NAME}} filter.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter_{{NAME}} extends moodle_text_filter {

    /**
     * Filter text.
     *
     * @param string $text HTML to be processed.
     * @param array $options filter options
     * @return string String containing processed HTML.
     */
    public function filter($text, array $options = []) {
        // Implement your filtering logic here.
        return $text;
    }
}
