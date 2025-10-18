# MoMoPDA: GitHub Copilot & Coding Agent Guide

This guide explains how to use MoMoPDA (Modular Moodle Plugin Development Assistant) with GitHub Copilot and VS Code Coding Agents for rapid Moodle 5.x plugin development.

## Quick Start

### 1. Setup Your Environment

```bash
# Clone MoMoPDA
git clone https://github.com/vivedlearning/momopda.git

# Clone Moodle core alongside (for reference and testing)
cd ..
git clone https://github.com/moodle/moodle.git
cd momopda
```

Your directory structure should be:
```
.
├── moodle/          # Moodle core (for reference and testing)
└── momopda/         # This repository
```

### 2. Create a New Plugin from Template

Use the templates to scaffold a new plugin:

```bash
# Copy the template for your plugin type
cp -r templates/block ../moodle-block_myplugin
# or
cp -r templates/mod ../moodle-mod_myactivity
# or
cp -r templates/local ../moodle-local_mytool
```

Available plugin templates:
- `block` - Block plugins
- `mod` - Activity modules
- `qtype` - Question types
- `qbank` - Question bank plugins
- `enrol` - Enrolment methods
- `filter` - Content filters
- `tiny` - TinyMCE editor plugins
- `report` - Admin reports
- `local` - Local plugins

### 3. Customize the Plugin

Replace placeholders in the copied files:

- `{{COMPONENT}}` → Your component name (e.g., `block_myplugin`)
- `{{NAME}}` → Plugin name (e.g., `myplugin`)
- `{{PLUGIN_DISPLAY_NAME}}` → Display name (e.g., `My Plugin`)
- `{{VERSION_DATE}}` → Version in YYYYMMDDRR format (e.g., `2025011800`)
- `{{REQUIRES_VERSION}}` → Required Moodle version (e.g., `2024100700`)
- `{{MATURITY}}` → MATURITY_ALPHA, MATURITY_BETA, MATURITY_RC, or MATURITY_STABLE
- `{{RELEASE}}` → Release version string (e.g., `1.0.0`)

**Tip:** Use GitHub Copilot's find/replace with AI to replace all placeholders at once!

## Agent Workflows

### Workflow 1: Create New Plugin from Scratch

1. **Start with a prompt:**
   ```
   @workspace I want to create a new block plugin called "student_progress" 
   that displays a student's course completion progress. Use the MoMoPDA 
   template and customize it with real functionality.
   ```

2. **Copilot will:**
   - Copy the appropriate template
   - Replace all placeholders
   - Add custom functionality
   - Generate tests

3. **Run tests:**
   ```bash
   cd ../moodle-block_student_progress
   ../momopda/scripts/run_tests.sh
   ```

### Workflow 2: Enhance Existing Plugin

1. **Reference the guides:**
   ```
   @workspace Review .prompts/plugins/block.md and add a configuration 
   form to my block plugin with these settings: title, display_limit, 
   show_percentage
   ```

2. **Copilot will:**
   - Read the relevant guide
   - Apply patterns from `.prompts/plugins/block_patterns.md`
   - Implement the feature
   - Add tests

### Workflow 3: Test-Driven Development

1. **Generate test plan:**
   ```bash
   php scripts/generate_test_plan.php block_myplugin
   ```

2. **Ask Copilot to implement tests:**
   ```
   @workspace Create PHPUnit tests based on TEST_PLAN.md, 
   focusing on sections 2 and 3
   ```

3. **Run tests iteratively:**
   ```bash
   scripts/run_tests.sh
   ```

### Workflow 4: Security Review

1. **Ask Copilot to review:**
   ```
   @workspace Review my plugin code against .prompts/core/security-checklist.md 
   and identify any security issues
   ```

2. **Fix issues:**
   ```
   @workspace Fix the SQL injection vulnerability in lib.php 
   using Moodle's DML API
   ```

## Plugin Type Specific Guides

MoMoPDA includes comprehensive guides for each plugin type:

### Activity Modules (mod)
- **Guide:** `.prompts/plugins/mod.md`
- **Patterns:** `.prompts/plugins/mod_patterns.md`
- **Key Features:** Gradebook integration, backup/restore, completion tracking

### Block Plugins
- **Guide:** `.prompts/plugins/block.md`
- **Key Features:** Block configuration, instance settings, applicable formats

### Question Types (qtype)
- **Guide:** `.prompts/plugins/qtype.md`
- **Patterns:** `.prompts/plugins/qtype_patterns.md`
- **Key Features:** Question rendering, answer processing, grading

### Local Plugins
- **Guide:** `.prompts/plugins/local.md`
- **Patterns:** `.prompts/plugins/local_patterns.md`
- **Key Features:** Hooks, navigation, admin tools

### Other Types
See `.prompts/plugins/` for guides on:
- `qbank` - Question bank plugins
- `enrol` - Enrolment methods
- `filter` - Content filters
- `tiny` - TinyMCE plugins
- `report` - Admin reports

## Testing Framework

### Running Tests

The side-by-side repository model allows testing without modifying Moodle core:

```bash
# From your plugin directory
../momopda/scripts/run_tests.sh

# Or specify plugin component
cd ../momopda
./scripts/run_tests.sh block_myplugin
```

The script will:
1. Detect plugin type from directory/component name
2. Symlink plugin to correct Moodle subdirectory
3. Initialize PHPUnit if needed
4. Run plugin tests
5. Output `test_results.json`

### Plugin Type to Directory Mapping

| Plugin Type | Moodle Directory |
|-------------|------------------|
| block | `../moodle/blocks/` |
| mod | `../moodle/mod/` |
| qtype | `../moodle/question/type/` |
| qbank | `../moodle/question/bank/` |
| enrol | `../moodle/enrol/` |
| filter | `../moodle/filter/` |
| tiny | `../moodle/lib/editor/tiny/plugins/` |
| report | `../moodle/report/` |
| local | `../moodle/local/` |

### Auto-Generated Test Plans

Generate comprehensive test plans:

```bash
php scripts/generate_test_plan.php block_myplugin
```

This creates `TEST_PLAN.md` with:
- Installation & upgrade tests
- Functional tests (plugin-type specific)
- Security tests
- Privacy & GDPR tests
- Integration tests
- Performance tests
- Regression tests

Use this with Copilot:
```
@workspace Implement all tests from TEST_PLAN.md section 2
```

## Copilot Best Practices

### 1. Reference Guides Explicitly

```
@workspace Using .prompts/plugins/mod.md, create a mod_form.php 
with grading options
```

### 2. Use Pattern Recognition

```
@workspace Apply the database patterns from .prompts/patterns/database.md 
to refactor this function
```

### 3. Leverage Security Checklists

```
@workspace Audit this code against .prompts/core/security-checklist.md
```

### 4. Iterative Development

```
# Step 1: Structure
@workspace Create basic file structure for mod_quiz_timer

# Step 2: Core functionality
@workspace Implement timer logic with JavaScript and AJAX

# Step 3: Testing
@workspace Add PHPUnit tests for timer_start() and timer_stop()

# Step 4: Security
@workspace Review and fix security issues
```

### 5. Multi-Step Workflows

```
@workspace 
1. Create a local plugin for bulk course enrollment
2. Add navigation to course administration
3. Create a form for CSV upload
4. Implement enrollment logic
5. Add tests
6. Generate TEST_PLAN.md
```

## Example Prompts

### Create Activity Module
```
@workspace Create a mod_flashcard activity module with:
- Card sets with questions/answers
- Study mode with flip animation
- Gradebook integration for completion
- Mobile app support
Use MoMoPDA templates and patterns
```

### Add Feature to Existing Plugin
```
@workspace Add export to PDF functionality to my report plugin
following .prompts/plugins/report_patterns.md
```

### Fix Bug with Context
```
@workspace The block doesn't display on dashboard. 
Check applicable_formats() against .prompts/plugins/block.md
```

### Security Audit
```
@workspace Perform full security audit of mod_myactivity 
using .prompts/core/security-checklist.md and fix all issues
```

## Advanced: Custom Templates

You can create custom templates for your organization:

```bash
# Create custom template
cp -r templates/local templates/custom_local
# Modify as needed

# Use in prompts
@workspace Create plugin from templates/custom_local
```

## Troubleshooting

### Tests Won't Run

1. **Check Moodle config:**
   ```bash
   ls -la ../moodle/config.php
   ```

2. **Initialize PHPUnit manually:**
   ```bash
   cd ../moodle
   php admin/tool/phpunit/cli/init.php
   ```

3. **Verify symlink:**
   ```bash
   ls -la ../moodle/blocks/myplugin
   ```

### Copilot Can't Find Guides

Ensure you're referencing files correctly:
```
# Good
@workspace Review .prompts/plugins/block.md

# Bad
@workspace Review the block guide
```

### Plugin Type Not Detected

Use full component name:
```bash
./scripts/run_tests.sh block_myplugin
```

## Getting Help

1. **Check the guides:** `.prompts/plugins/`
2. **Review patterns:** `.prompts/plugins/*_patterns.md`
3. **Read core principles:** `.prompts/core/base-instructions.md`
4. **Generate test plan:** `scripts/generate_test_plan.php`
5. **Ask Copilot:** Reference specific guide files

## Contributing

Improvements to templates and guides are welcome! See `PROMPT.md` for the orchestration logic.

## License

GPL v3 or later
