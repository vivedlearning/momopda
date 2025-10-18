#!/usr/bin/env php
<?php
/**
 * Generate initial TEST_PLAN.md for a Moodle plugin
 *
 * Usage: php scripts/generate_test_plan.php [plugin_component]
 *
 * @package    MoMoPDA
 * @copyright  2025
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('CLI_SCRIPT', true);

// Configuration
$current_dir = getcwd();
$component = '';
$plugin_type = '';
$plugin_name = '';

// Parse command line arguments
if (isset($argv[1])) {
    $component = $argv[1];
} else {
    // Try to detect from directory name
    $dir_name = basename($current_dir);
    if (preg_match('/^moodle-(.+)$/', $dir_name, $matches)) {
        $component = $matches[1];
    } else {
        $component = $dir_name;
    }
}

// Parse component to extract type and name
$plugin_types = [
    'block', 'mod', 'qtype', 'qbank', 'enrol', 
    'filter', 'tiny', 'report', 'local'
];

foreach ($plugin_types as $type) {
    if (preg_match("/^{$type}_(.+)$/", $component, $matches)) {
        $plugin_type = $type;
        $plugin_name = $matches[1];
        break;
    }
}

if (empty($plugin_type)) {
    fwrite(STDERR, "Error: Could not detect plugin type from component: $component\n");
    fwrite(STDERR, "Usage: php scripts/generate_test_plan.php [component]\n");
    exit(1);
}

// Plugin type specific test sections
$type_specific_tests = [
    'block' => [
        'Block Display' => [
            'Verify block appears in block drawer',
            'Test block content rendering',
            'Check block configuration options',
        ],
        'Block Instances' => [
            'Test adding block to dashboard',
            'Test adding block to course page',
            'Verify multiple instances if allowed',
        ],
    ],
    'mod' => [
        'Activity Creation' => [
            'Create new activity instance',
            'Edit activity settings',
            'Delete activity instance',
        ],
        'Activity Display' => [
            'View activity as student',
            'View activity as teacher',
            'Test activity intro/description display',
        ],
        'Grading' => [
            'Test gradebook integration',
            'Verify grade items creation',
            'Test grade updates',
        ],
        'Backup & Restore' => [
            'Backup course with activity',
            'Restore activity to new course',
            'Verify all data restored correctly',
        ],
    ],
    'qtype' => [
        'Question Creation' => [
            'Create new question of this type',
            'Edit question',
            'Delete question',
        ],
        'Question Display' => [
            'Display question in quiz',
            'Test question rendering',
            'Verify feedback display',
        ],
        'Answer Processing' => [
            'Submit correct answer',
            'Submit incorrect answer',
            'Verify grading logic',
        ],
    ],
    'qbank' => [
        'Question Bank Integration' => [
            'Access plugin from question bank',
            'Test question list filtering',
            'Verify bulk operations',
        ],
    ],
    'enrol' => [
        'Enrolment Process' => [
            'Enable enrolment method in course',
            'Enrol users via plugin',
            'Unenrol users',
        ],
        'Settings' => [
            'Configure instance settings',
            'Test role assignment',
            'Verify enrolment period settings',
        ],
    ],
    'filter' => [
        'Filter Processing' => [
            'Enable filter globally',
            'Test filter on course content',
            'Verify filtered output',
        ],
        'Performance' => [
            'Test filter with large content',
            'Verify caching behavior',
        ],
    ],
    'tiny' => [
        'Editor Integration' => [
            'Verify button appears in TinyMCE toolbar',
            'Test button functionality',
            'Check editor modal/dialog',
        ],
        'Content Generation' => [
            'Insert content via plugin',
            'Edit inserted content',
            'Verify content saves correctly',
        ],
    ],
    'report' => [
        'Report Access' => [
            'Access report as admin',
            'Verify capability requirements',
            'Test report navigation',
        ],
        'Report Display' => [
            'View report data',
            'Test filters and sorting',
            'Export report data',
        ],
    ],
    'local' => [
        'Plugin Integration' => [
            'Verify plugin hooks execute',
            'Test navigation integration',
            'Check settings page',
        ],
        'Functionality' => [
            'Test core features',
            'Verify permissions',
            'Test with different user roles',
        ],
    ],
];

// Generate TEST_PLAN.md
$output = "# Test Plan: {$component}\n\n";
$output .= "**Plugin Type:** " . ucfirst($plugin_type) . "\n";
$output .= "**Component:** {$component}\n";
$output .= "**Generated:** " . date('Y-m-d H:i:s') . "\n\n";

$output .= "## Overview\n\n";
$output .= "This test plan covers functional, integration, and regression testing for the {$component} plugin.\n\n";

// Common tests for all plugins
$output .= "## 1. Installation & Upgrade Tests\n\n";
$output .= "- [ ] Clean installation\n";
$output .= "- [ ] Verify database tables created\n";
$output .= "- [ ] Check capabilities registered\n";
$output .= "- [ ] Verify language strings loaded\n";
$output .= "- [ ] Test plugin upgrade from previous version\n\n";

// Type-specific tests
$output .= "## 2. Functional Tests\n\n";
if (isset($type_specific_tests[$plugin_type])) {
    foreach ($type_specific_tests[$plugin_type] as $section => $tests) {
        $output .= "### {$section}\n\n";
        foreach ($tests as $test) {
            $output .= "- [ ] {$test}\n";
        }
        $output .= "\n";
    }
}

// Common security and performance tests
$output .= "## 3. Security Tests\n\n";
$output .= "- [ ] Test capability checks\n";
$output .= "- [ ] Verify input validation\n";
$output .= "- [ ] Check SQL injection protection\n";
$output .= "- [ ] Test XSS prevention\n";
$output .= "- [ ] Verify CSRF token validation\n";
$output .= "- [ ] Test with different user roles\n\n";

$output .= "## 4. Privacy & GDPR Tests\n\n";
$output .= "- [ ] Verify privacy provider implementation\n";
$output .= "- [ ] Test data export\n";
$output .= "- [ ] Test data deletion\n";
$output .= "- [ ] Check user metadata declarations\n\n";

$output .= "## 5. Integration Tests\n\n";
$output .= "- [ ] Test with different themes\n";
$output .= "- [ ] Verify mobile app compatibility\n";
$output .= "- [ ] Test with groups/groupings\n";
$output .= "- [ ] Check accessibility (WCAG 2.1 AA)\n";
$output .= "- [ ] Test in different browsers\n\n";

$output .= "## 6. Automated Testing\n\n";
$output .= "- [ ] PHPUnit tests pass\n";
$output .= "- [ ] Behat tests pass (if applicable)\n";
$output .= "- [ ] Code coverage > 80%\n";
$output .= "- [ ] PHPDoc compliance\n";
$output .= "- [ ] Moodle coding style compliance\n\n";

$output .= "## 7. Performance Tests\n\n";
$output .= "- [ ] Test with large datasets\n";
$output .= "- [ ] Verify database query efficiency\n";
$output .= "- [ ] Check page load times\n";
$output .= "- [ ] Test concurrent user access\n\n";

$output .= "## 8. Regression Tests\n\n";
$output .= "- [ ] Verify existing features still work\n";
$output .= "- [ ] Test upgrade from previous versions\n";
$output .= "- [ ] Check backwards compatibility\n\n";

$output .= "## Test Environment\n\n";
$output .= "- **Moodle Version:** 5.x (latest stable)\n";
$output .= "- **PHP Version:** 8.1+\n";
$output .= "- **Database:** PostgreSQL 13+ / MySQL 8.0+ / MariaDB 10.6+\n";
$output .= "- **Web Server:** Apache 2.4+ / Nginx 1.20+\n\n";

$output .= "## Test Execution Notes\n\n";
$output .= "Document any issues, unexpected behavior, or observations during testing:\n\n";
$output .= "```\n";
$output .= "Date: \n";
$output .= "Tester: \n";
$output .= "Notes: \n";
$output .= "```\n";

// Write to file
$output_file = $current_dir . '/TEST_PLAN.md';
file_put_contents($output_file, $output);

echo "✓ Test plan generated: TEST_PLAN.md\n";
echo "  Component: {$component}\n";
echo "  Type: {$plugin_type}\n";
echo "\nNext steps:\n";
echo "  1. Review and customize the test plan\n";
echo "  2. Add plugin-specific test cases\n";
echo "  3. Execute tests and check off completed items\n";

exit(0);
