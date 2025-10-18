# Modular Moodle Plugin Development Assistant (MoMoPDA)

A comprehensive framework for rapid Moodle 5.x plugin development using AI coding agents. MoMoPDA provides plugin templates, development guides, testing scripts, and agent workflows optimized for VS Code + GitHub Copilot, Claude Code, and other AI-powered development tools.

## 🚀 New: VS Code + GitHub Copilot Support

MoMoPDA now includes:
- **Plugin Templates** - Ready-to-use scaffolding for all major plugin types
- **Testing Scripts** - Side-by-side testing with automated PHPUnit setup
- **Copilot Instructions** - Optimized AI agent workflows
- **Test Plan Generator** - Automated comprehensive test plan creation

**See [README-COPILOT.md](README-COPILOT.md) for VS Code + Copilot quick start guide.**

## File Structure

```
├── README-COPILOT.md                # VS Code + Copilot quick start guide
├── PROMPT.md                        # Orchestrator for Claude Code
├── CLAUDE.md                        # Redirect to PROMPT.md
├── templates/                       # Plugin scaffolding templates
│   ├── block/                       # Block plugin template
│   ├── mod/                         # Activity module template (with backup)
│   ├── qtype/                       # Question type template
│   ├── qbank/                       # Question bank plugin template
│   ├── enrol/                       # Enrolment method template
│   ├── filter/                      # Content filter template
│   ├── tiny/                        # TinyMCE editor plugin template
│   ├── report/                      # Admin report template
│   └── local/                       # Local plugin template
├── scripts/
│   ├── run_tests.sh                 # Automated PHPUnit testing
│   └── generate_test_plan.php      # Test plan generator
├── .github/
│   └── copilot-instructions.md     # GitHub Copilot agent instructions
└── .prompts/  
    ├── core/
    │   ├── base-instructions.md     # Core Moodle development principles
    │   └── security-checklist.md    # Security requirements
    ├── plugins/
    │   ├── block.md                 # Block plugin development guide
    │   ├── mod.md                   # Activity module development guide
    │   ├── mod_patterns.md          # Activity module patterns
    │   ├── qtype.md                 # Question type development guide
    │   ├── qtype_patterns.md        # Question type patterns
    │   ├── qbank.md                 # Question bank development guide
    │   ├── qbank_patterns.md        # Question bank patterns
    │   ├── enrol.md                 # Enrolment plugin guide
    │   ├── enrol_patterns.md        # Enrolment patterns
    │   ├── filter.md                # Filter plugin guide
    │   ├── filter_patterns.md       # Filter patterns
    │   ├── tiny.md                  # TinyMCE plugin guide
    │   ├── tiny_patterns.md         # TinyMCE patterns
    │   ├── report.md                # Report plugin guide
    │   ├── report_patterns.md       # Report patterns
    │   ├── local.md                 # Local plugin guide
    │   └── local_patterns.md        # Local plugin patterns
    └── patterns/
        └── html_writer.md           # HTML generation best practices
```

## Quick Start

### For VS Code + GitHub Copilot Users

1. **Clone repositories:**
   ```bash
   git clone <repository-url> momopda
   cd ..
   git clone https://github.com/moodle/moodle.git
   ```

2. **Create plugin from template:**
   ```bash
   cd momopda
   cp -r templates/block ../moodle-block_myplugin
   cd ../moodle-block_myplugin
   ```

3. **Use Copilot to customize:**
   ```
   @workspace Replace all {{PLACEHOLDER}} values with my plugin details
   ```

4. **Run tests:**
   ```bash
   ../momopda/scripts/run_tests.sh
   ```

**Full guide:** [README-COPILOT.md](README-COPILOT.md)

### For Claude Code Users

See [PROMPT.md](PROMPT.md) for conditional orchestration system.

## Moodle Core Repository

The Moodle core repository should be cloned alongside MoMoPDA:
```
../moodle/          # Moodle core repository (for reference and testing)
../momopda/         # This repository
```

This enables:
- **Testing:** The `scripts/run_tests.sh` script symlinks plugins into Moodle for PHPUnit testing
- **Reference:** AI agents can access Moodle core code for API examples and patterns
- **Development:** Side-by-side development without modifying Moodle core

## Plugin Templates

MoMoPDA provides ready-to-use templates for all major Moodle plugin types. Each template includes:

- **Core Files** - Essential plugin files with proper structure
- **Placeholder System** - Consistent `{{PLACEHOLDER}}` format for easy customization
- **Tests** - Basic PHPUnit test structure
- **Documentation** - README template

### Template Placeholders

All templates use these placeholders:

| Placeholder | Example | Description |
|-------------|---------|-------------|
| `{{COMPONENT}}` | `block_myplugin` | Full component name |
| `{{NAME}}` | `myplugin` | Plugin name only |
| `{{PLUGIN_DISPLAY_NAME}}` | `My Plugin` | Human-readable name |
| `{{VERSION_DATE}}` | `2025011800` | Version (YYYYMMDDRR) |
| `{{REQUIRES_VERSION}}` | `2024100700` | Required Moodle version |
| `{{MATURITY}}` | `MATURITY_STABLE` | Plugin maturity level |
| `{{RELEASE}}` | `1.0.0` | Release version string |

### Available Templates

- **`templates/block/`** - Block plugins with instance configuration
- **`templates/mod/`** - Activity modules with backup/restore, events, privacy provider
- **`templates/qtype/`** - Question types with basic structure
- **`templates/qbank/`** - Question bank plugins
- **`templates/enrol/`** - Enrolment methods with capabilities
- **`templates/filter/`** - Content filters
- **`templates/tiny/`** - TinyMCE editor plugins
- **`templates/report/`** - Admin reports
- **`templates/local/`** - Local plugins with hooks

### Testing Scripts

**`scripts/run_tests.sh`** - Automated testing with side-by-side Moodle setup:
- Auto-detects plugin type
- Symlinks plugin to correct Moodle directory
- Initializes PHPUnit if needed
- Runs tests and outputs JSON results

**`scripts/generate_test_plan.php`** - Generates comprehensive TEST_PLAN.md:
- Plugin-type specific test cases
- Security and privacy tests
- Integration and performance tests
- Test execution checklist

## Usage Examples

### VS Code + GitHub Copilot Workflow

**Example 1: Create New Block Plugin**
```bash
# Copy template
cp -r templates/block ../moodle-block_student_progress

# Use Copilot to customize
# @workspace Replace placeholders in all files with:
#   - COMPONENT: block_student_progress
#   - NAME: student_progress
#   - PLUGIN_DISPLAY_NAME: Student Progress Dashboard
#   - VERSION_DATE: 2025011800

# Add functionality
# @workspace Using .prompts/plugins/block.md, add a feature to display
# course completion percentage with a progress bar

# Test
cd ../moodle-block_student_progress
../momopda/scripts/run_tests.sh
```

**Example 2: Create Activity Module with Grading**
```bash
# Copy template (includes backup/restore skeleton)
cp -r templates/mod ../moodle-mod_interactive_quiz

# @workspace Customize the mod template and add:
#   - Question sets with multiple choice
#   - Timer functionality
#   - Gradebook integration
#   Reference: .prompts/plugins/mod.md sections on grading and backup
```

**Example 3: Generate and Execute Test Plan**
```bash
# Generate comprehensive test plan
php scripts/generate_test_plan.php local_course_tools

# @workspace Implement PHPUnit tests from TEST_PLAN.md sections 2-4

# Run tests
scripts/run_tests.sh
```

### Claude Code Workflow (Conditional Orchestration)

### Example 1: New Block Plugin
**Detected**: `block_` repository name
**Loads**:
- core/base-instructions.md
- plugins/block.md  
- tasks/create.md
- core/security-checklist.md

### Example 2: Bug Fix in Question Type
**Detected**: `qtype` repository name + git branch "fix/calculation-error"
**Loads**:
- core/base-instructions.md
- plugins/qtype.md
- plugins/qtype_patterns.md
- tasks/bugfix.md
- patterns/database.md (if DB operations detected)
- core/security-checklist.md

### Example 3: New Enrolment Plugin
**Detected**: `enrol_` repository name
**Loads**:
- core/base-instructions.md
- plugins/enrol.md
- plugins/enrol_patterns.md
- tasks/create.md
- core/security-checklist.md

### Example 4: TinyMCE Editor Plugin Enhancement
**Detected**: `tiny_` repository name + request mentions "add feature"
**Loads**:
- core/base-instructions.md
- plugins/tiny.md
- plugins/tiny_patterns.md
- tasks/enhance.md
- patterns/forms.md (if form integration detected)
- core/security-checklist.md

### Example 5: Adding Tests
**Detected**: Request mentions "tests" or "phpunit"
**Loads**:
- core/base-instructions.md
- plugins/{detected_type}.md
- plugins/{detected_type}_patterns.md (if available)
- tasks/test.md
- core/security-checklist.md

## Supported Plugin Types

MoMoPDA provides comprehensive development guides and pattern documentation for the following Moodle plugin types:

### Core Plugin Types
- **Activity Modules** (`mod_*`) - Custom learning activities and assignments
- **Block Plugins** (`block_*`) - Custom dashboard and course blocks
- **Question Types** (`qtype_*`) - Custom question types for quizzes and assignments
- **Question Bank Plugins** (`qbank_*`) - Question bank management and organization tools

### Enrolment and User Management
- **Enrolment Plugins** (`enrol_*`) - Custom user enrolment methods and workflows

### Content and Filtering
- **Filter Plugins** (`filter_*`) - Content processing and transformation filters
- **TinyMCE Editor Plugins** (`tiny_*`) - Rich text editor extensions and tools

### Administration and Reporting
- **Report Plugins** (`report_*`) - Administrative reports and analytics dashboards

### Each Plugin Type Includes:
- **Development Guide** - Complete implementation instructions with code examples
- **Patterns & Anti-Patterns** - Best practices, common pitfalls, and security considerations
- **Testing Strategies** - Unit testing, integration testing, and quality assurance
- **Performance Guidelines** - Optimization techniques and database best practices
- **Security Checklists** - Vulnerability prevention and secure coding practices

All guides are based on analysis of Moodle 5.x core implementations and follow official Moodle development standards.

## Getting Started

### Prerequisites
- [Claude Code](https://claude.ai/code) or compatible agentic AI development environment
- Git
- Moodle development environment (optional but recommended)

### Setup Instructions

1. **Clone the MoMoPDA repository**
   ```bash
   git clone https://github.com/your-org/momopda.git
   cd momopda
   ```

2. **Create your plugin repository**

   Rename or create a new repository following Moodle plugin naming conventions:

   ```bash
   # E.g., for a new block plugin
   git clone https://github.com/your-org/momopda.git moodle-block_your_plugin_name
   cd moodle-block_your_plugin_name

   ```

   **Plugin Naming Convention Examples:**
   - Activity modules: `moodle-mod_interactive_lesson`
   - Block plugins: `moodle-block_nice_new_block`
   - Question types: `moodle-qtype_custom_quiz`
   - Enrolment plugins: `moodle-enrol_company_sso`
   - Filter plugins: `moodle-filter_content_enhancer`
   - TinyMCE plugins: `moodle-tiny_equation_editor`
   - Report plugins: `moodle-report_analytics_dashboard`
   - Question bank plugins: `moodle-qbank_question_organizer`

3. **Optional: Clone Moodle core for reference**
   ```bash
   # In parent directory
   cd ..
   git clone https://github.com/moodle/moodle.git
   ```

   Your directory structure should look like:
   ```
   .
   ├── moodle/                           # Moodle core (optional reference)
   └── moodle-block_your_plugin_name/    # Your plugin with MoMoPDA
       ├── PROMPT.md
       ├── CLAUDE.md
       └── .prompts/
   ```

4. **Start your coding agent from the root of the repository**

5. **Begin development**

   Start by describing what you want to build. MoMoPDA will automatically detect your plugin type from the repository name and load the appropriate guides:

   ```
   "I want to create a new block plugin that displays student progress charts"
   "Help me add a new question type for mathematical expressions"
   "I need to fix a bug in my enrolment plugin's user sync feature"
   ```

### How It Works

MoMoPDA automatically detects your plugin type and development context:

- **Plugin Type Detection**: Based on repository name (e.g., `block_*`, `qtype_*`, `enrol_*`)
- **Task Detection**: Based on git branch names, file changes, and user requests
- **Context Loading**: Automatically loads relevant guides, patterns, and best practices
- **Security & Quality**: Always includes security checklists and quality standards

### Tips for Best Results

1. **Use descriptive repository names** following Moodle conventions
2. **Be specific in your requests** - mention features, requirements, and constraints
3. **Reference existing Moodle plugins** if you want similar functionality
4. **Ask for tests** - MoMoPDA includes comprehensive testing guidance
5. **Request security reviews** when handling user data or permissions

### Troubleshooting

- **Plugin type not detected?** Ensure your repository name follows the `moodle-{plugintype}_{pluginname}` convention
- **Missing guidance?** Check if your plugin type is supported in the list above
- **Need custom patterns?** The guides include extension points for custom functionality
- **Your new plugin has bugs?** Fix them and ask your coding agent to improve the patterns files!

### Example prompts

>I want to create a question bank (qbank) plugin, which adds a bulk edit functionality to the question bank. The idea is to use the questiongeneration purpose of the ../moodle-local_ai_manager plugin, and the logic of the ../moodle-qbank_questiongen plugin, to attain the following functionality: 1. bulk select which questions to modify 2. add a modification prompt 3. generate new versions of the questions according to the modification prompt. 4. add a prefix to the new questions, so they can be distinguished from the old ones. For example: "Add feedback to all answer options of these questions". MVP would be to add support to the multichoice questions, but create similar architecture to the questiongen plugin so that other question types can be added later. The plugin must be dependent on the local_ai_manager plugin, and it can be dependent on the qbank_questiongen plugin as well, if it makes the implementation simpler.

Notes: This worked, and the resulting plugin is here: https://github.com/wilenius/moodle-qbank_bulk_ai_edit.

>This repo has a modular prompt system for developing Moodle plugins. I need to develop a local plugin that adds User overrides to all the quizzes on the course area. To understand User overrides, look at the /home/hwileniu/git/moodle/public/mod/quiz. To understand local plugins, look at ../moodle-local_aiquestions. It needs to be added as a view to the course navigation. MVP: add custom quiz time limit for a user.

Notes: This worked very well. It might be that it makes sense to note that the initial contents of the repo (momopda) and the end product (plugin) are different, but they'll be done in the same repo, so that the agent needs one step less to get on the right track. Resulting code here: https://github.com/wilenius/moodle-local_course_overrides
