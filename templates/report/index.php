<?php
require_once(__DIR__ . '/../../config.php');
require_login();

$context = context_system::instance();
require_capability('report/{{NAME}}:view', $context);

$PAGE->set_url(new moodle_url('/report/{{NAME}}/index.php'));
$PAGE->set_context($context);
$PAGE->set_title(get_string('pluginname', '{{COMPONENT}}'));
$PAGE->set_heading(get_string('pluginname', '{{COMPONENT}}'));

echo $OUTPUT->header();

echo $OUTPUT->heading(get_string('pluginname', '{{COMPONENT}}'));

echo $OUTPUT->footer();
