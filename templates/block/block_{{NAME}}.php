<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Block {{PLUGIN_DISPLAY_NAME}} class definition.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_{{NAME}} extends block_base {

    /**
     * Initializes the block instance.
     */
    public function init() {
        $this->title = get_string('pluginname', '{{COMPONENT}}');
    }

    /**
     * Returns the block content.
     *
     * @return stdClass
     */
    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->text = get_string('blockstring', '{{COMPONENT}}');
        $this->content->footer = '';

        return $this->content;
    }

    /**
     * Allow multiple instances of this block.
     *
     * @return bool
     */
    public function instance_allow_multiple() {
        return false;
    }

    /**
     * Check if block has config.
     *
     * @return bool
     */
    public function has_config() {
        return false;
    }

    /**
     * Applicable formats for this block.
     *
     * @return array
     */
    public function applicable_formats() {
        return [
            'all' => true,
        ];
    }
}
