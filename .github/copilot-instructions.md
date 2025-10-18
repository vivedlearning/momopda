# GitHub Copilot Instructions for MoMoPDA

This file provides instructions for GitHub Copilot when working with the MoMoPDA repository and Moodle plugin development.

## Context

You are assisting with Moodle 5.x plugin development using the MoMoPDA (Modular Moodle Plugin Development Assistant) framework. This repository contains:

1. **Templates** - Plugin scaffolding for all major Moodle plugin types
2. **Guides** - Comprehensive development guides in `.prompts/plugins/`
3. **Patterns** - Best practices and anti-patterns in `.prompts/plugins/*_patterns.md`
4. **Core Principles** - Moodle coding standards in `.prompts/core/`
5. **Testing Framework** - Scripts for side-by-side testing with Moodle core

## Plugin Types Supported

Always detect plugin type from component name or directory:

- `block_*` → Block plugin (directory: `blocks/`)
- `mod_*` → Activity module (directory: `mod/`)
- `qtype_*` → Question type (directory: `question/type/`)
- `qbank_*` → Question bank plugin (directory: `question/bank/`)
- `enrol_*` → Enrolment method (directory: `enrol/`)
- `filter_*` → Content filter (directory: `filter/`)
- `tiny_*` → TinyMCE editor plugin (directory: `lib/editor/tiny/plugins/`)
- `report_*` → Admin report (directory: `report/`)
- `local_*` → Local plugin (directory: `local/`)

## Code Generation Rules

### 1. Always Follow Moodle Coding Standards

From `.prompts/core/base-instructions.md`:

- Use lowercase function/class names with underscores
- Maximum line length: 132 characters
- Use long PHP tags (`<?php`), no closing tag at EOF
- Single quotes for literals, double quotes for variables
- Constants in UPPER_CASE with Frankenstyle prefix
- Indent with 4 spaces
- LF line endings

### 2. Template Placeholder Replacement

When using templates from `templates/`, replace these placeholders:

- `{{COMPONENT}}` → Full component (e.g., `block_myplugin`)
- `{{NAME}}` → Plugin name only (e.g., `myplugin`)
- `{{PLUGIN_DISPLAY_NAME}}` → Human-readable name (e.g., `My Plugin`)
- `{{VERSION_DATE}}` → Format: YYYYMMDDRR (e.g., `2025011800`)
- `{{REQUIRES_VERSION}}` → Moodle version (e.g., `2024100700` for 5.0)
- `{{MATURITY}}` → One of: MATURITY_ALPHA, MATURITY_BETA, MATURITY_RC, MATURITY_STABLE
- `{{RELEASE}}` → Release string (e.g., `1.0.0`)

### 3. Security First

Always reference `.prompts/core/security-checklist.md`:

- Use `required_param()` and `optional_param()` for input
- Check capabilities before actions
- Use `$DB->get_record()` and DML API, never raw SQL
- Call `format_text()` for user content output
- Validate CSRF tokens in forms

### 4. File Structure by Plugin Type

#### Block Plugin
```
block_{name}/
├── block_{name}.php        # Main class extends block_base
├── version.php
├── lang/en/block_{name}.php
└── tests/structure_basic_test.php
```

#### Activity Module (mod)
```
mod/{name}/
├── lib.php                 # Core functions: {name}_supports(), {name}_add_instance(), etc.
├── mod_form.php            # Extends moodleform_mod
├── view.php                # Main display page
├── version.php
├── db/access.php           # Capabilities
├── classes/
│   ├── event/course_module_viewed.php
│   └── privacy/provider.php
├── backup/moodle2/         # Backup/restore
│   ├── backup_{name}_activity_task.class.php
│   ├── backup_{name}_stepslib.php
│   ├── restore_{name}_activity_task.class.php
│   └── restore_{name}_stepslib.php
├── lang/en/mod_{name}.php
└── tests/
    ├── structure_basic_test.php
    └── add_instance_test.php
```

#### Local Plugin
```
local/{name}/
├── lib.php                 # Hook implementations
├── version.php
├── classes/                # Modern PHP classes
├── lang/en/local_{name}.php
└── tests/structure_basic_test.php
```

### 5. Privacy Provider Implementation

For mod templates, include privacy provider stub:

```php
namespace mod_{name}\privacy;

use core_privacy\local\metadata\collection;

class provider implements \core_privacy\local\metadata\null_provider {
    public static function get_reason(): string {
        return 'privacy:metadata';
    }
}
```

## Development Workflows

### Creating New Plugin

1. User provides plugin type and name
2. Copy appropriate template from `templates/{type}/`
3. Replace all placeholders
4. Customize based on requirements
5. Add tests
6. Guide user to run `scripts/run_tests.sh`

### Adding Features

1. Check relevant guide: `.prompts/plugins/{type}.md`
2. Review patterns: `.prompts/plugins/{type}_patterns.md`
3. Implement following Moodle standards
4. Add/update tests
5. Security review against `.prompts/core/security-checklist.md`

### Testing

Guide users to:
```bash
# Generate test plan
php scripts/generate_test_plan.php {component}

# Run tests (from plugin directory)
../momopda/scripts/run_tests.sh

# Or from momopda directory
./scripts/run_tests.sh {component}
```

## Common Patterns

### Database Operations

From `.prompts/patterns/database.md` (if exists):
- Use DML API: `$DB->get_record()`, `$DB->insert_record()`, etc.
- Never use `$DB->execute()` for SELECT queries
- Always use placeholders for parameters
- Optimize with `get_records_sql()` for complex queries

### Forms

- Activity forms extend `moodleform_mod`
- Settings forms extend `admin_settingpage`
- Custom forms extend `moodleform`
- Always validate in `validation()` method

### Capabilities

Define in `db/access.php`:
```php
$capabilities = [
    '{type}/{name}:view' => [
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => [
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
        ],
    ],
];
```

Check with:
```php
require_capability('{type}/{name}:view', $context);
```

## References to Include

When user asks about specific topics, reference these files:

- **Security:** `.prompts/core/security-checklist.md`
- **Coding style:** `.prompts/core/base-instructions.md`
- **Activity modules:** `.prompts/plugins/mod.md`, `.prompts/plugins/mod_patterns.md`
- **Block plugins:** `.prompts/plugins/block.md`
- **Question types:** `.prompts/plugins/qtype.md`, `.prompts/plugins/qtype_patterns.md`
- **Enrolment:** `.prompts/plugins/enrol.md`, `.prompts/plugins/enrol_patterns.md`
- **Local plugins:** `.prompts/plugins/local.md`, `.prompts/plugins/local_patterns.md`
- **TinyMCE:** `.prompts/plugins/tiny.md`, `.prompts/plugins/tiny_patterns.md`
- **Filters:** `.prompts/plugins/filter.md`, `.prompts/plugins/filter_patterns.md`
- **Reports:** `.prompts/plugins/report.md`, `.prompts/plugins/report_patterns.md`
- **Question bank:** `.prompts/plugins/qbank.md`, `.prompts/plugins/qbank_patterns.md`

## Testing Standards

### PHPUnit Tests Required

Every plugin must have:
- `tests/structure_basic_test.php` - Basic structure validation

Activity modules (mod) also need:
- `tests/add_instance_test.php` - Test add/update/delete operations

### Test Naming Conventions

- Test classes: `{description}_test` (e.g., `structure_basic_test`)
- Test methods: `test_{what_is_tested}()` (e.g., `test_block_init()`)
- Use `@covers` tags for code coverage
- Extend `\advanced_testcase`
- Call `$this->resetAfterTest()` when modifying DB

## Side-by-Side Testing

The testing model assumes:
```
.
├── moodle/                # Moodle core (must exist)
└── moodle-{component}/    # Plugin being developed
    └── (MoMoPDA cloned here initially)
```

Scripts will:
1. Symlink plugin to correct `../moodle/{type}/{name}/` directory
2. Initialize PHPUnit if needed
3. Run tests
4. Output `test_results.json`

## Response Guidelines

When helping users:

1. **Be Specific:** Reference exact files from `.prompts/`
2. **Follow Standards:** Always apply Moodle coding style
3. **Security First:** Review security implications
4. **Test Coverage:** Suggest tests for new code
5. **Link to Guides:** Point to relevant `.prompts/plugins/*.md` files
6. **Use Templates:** Start from `templates/{type}/` for new plugins

## Example Interactions

### User: "Create a block plugin called student_dashboard"

Response:
1. Copy `templates/block/` 
2. Replace placeholders:
   - `{{COMPONENT}}` → `block_student_dashboard`
   - `{{NAME}}` → `student_dashboard`
   - `{{PLUGIN_DISPLAY_NAME}}` → `Student Dashboard`
3. Customize `block_student_dashboard.php` with specific functionality
4. Update language strings
5. Add tests
6. Suggest: `scripts/run_tests.sh block_student_dashboard`

### User: "Add grading to my mod_interactive activity"

Response:
1. Reference `.prompts/plugins/mod.md` section on grading
2. Update `{name}_supports()` to return true for `FEATURE_GRADE_HAS_GRADE`
3. Add grade item definition
4. Implement grading functions
5. Update `db/access.php` with grading capabilities
6. Add gradebook integration tests
7. Security review for grade manipulation

### User: "Is this code secure?"

Response:
1. Check against `.prompts/core/security-checklist.md`
2. Verify `required_param()` usage
3. Check capability checks
4. Review database queries for SQL injection
5. Verify output escaping
6. Suggest fixes for any issues found

## Notes

- The `PROMPT.md` file contains orchestration logic for Claude Code, not GitHub Copilot
- Focus on the guides in `.prompts/` for accurate Moodle patterns
- Templates are starting points - always customize for specific requirements
- Privacy providers are required for GDPR compliance
- Backup/restore is mandatory for activity modules (mod)
