<?php
namespace qbank_{{NAME}};

/**
 * Question bank plugin for {{PLUGIN_DISPLAY_NAME}}.
 *
 * @package    {{COMPONENT}}
 * @copyright  {{VERSION_DATE}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plugin_feature extends \core_question\local\bank\plugin_features_base {

    /**
     * Get the name of the plugin.
     *
     * @return string
     */
    public function get_name(): string {
        return get_string('pluginname', '{{COMPONENT}}');
    }
}
