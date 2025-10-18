<?php
defined('MOODLE_INTERNAL') || die();

/**
 * List of features supported in {{PLUGIN_DISPLAY_NAME}} module
 *
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed True if module supports feature, false if not, null if doesn't know
 */
function {{NAME}}_supports($feature) {
    return match ($feature) {
        FEATURE_MOD_ARCHETYPE => MOD_ARCHETYPE_ASSIGNMENT,
        FEATURE_GROUPS => true,
        FEATURE_GROUPINGS => true,
        FEATURE_MOD_INTRO => true,
        FEATURE_COMPLETION_TRACKS_VIEWS => true,
        FEATURE_GRADE_HAS_GRADE => true,
        FEATURE_BACKUP_MOODLE2 => true,
        FEATURE_SHOW_DESCRIPTION => true,
        default => null,
    };
}

/**
 * Add activity instance
 *
 * @param stdClass $data
 * @param mod_{{NAME}}_mod_form|null $form
 * @return int The instance id of the new activity
 */
function {{NAME}}_add_instance(stdClass $data, ?mod_{{NAME}}_mod_form $form = null): int {
    global $DB;

    $data->timecreated = time();
    $data->timemodified = $data->timecreated;

    return $DB->insert_record('{{NAME}}', $data);
}

/**
 * Update activity instance
 *
 * @param stdClass $data
 * @param mod_{{NAME}}_mod_form|null $form
 * @return bool
 */
function {{NAME}}_update_instance(stdClass $data, ?mod_{{NAME}}_mod_form $form = null): bool {
    global $DB;

    $data->id = $data->instance;
    $data->timemodified = time();

    return $DB->update_record('{{NAME}}', $data);
}

/**
 * Delete activity instance
 *
 * @param int $id
 * @return bool
 */
function {{NAME}}_delete_instance(int $id): bool {
    global $DB;

    if (!$activity = $DB->get_record('{{NAME}}', ['id' => $id])) {
        return false;
    }

    $DB->delete_records('{{NAME}}', ['id' => $id]);

    return true;
}
