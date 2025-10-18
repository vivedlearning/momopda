# MoMoPDA Plugin Templates Index

This document provides an overview of all available plugin templates and their features.

## Template Overview

| Plugin Type | Template Path | Key Features |
|-------------|--------------|--------------|
| Block | `templates/block/` | Block class, configuration, tests |
| Activity Module | `templates/mod/` | Full backup/restore, events, privacy, grading |
| Question Type | `templates/qtype/` | Question type class, basic structure |
| Question Bank | `templates/qbank/` | Plugin feature class |
| Enrolment | `templates/enrol/` | Enrol plugin class, capabilities |
| Filter | `templates/filter/` | Text filter class |
| TinyMCE Editor | `templates/tiny/` | Editor plugin with buttons |
| Report | `templates/report/` | Admin report with capabilities |
| Local | `templates/local/` | Hook implementations, navigation |

## Template Details

### Block Plugin (`templates/block/`)

**Files:**
- `version.php` - Plugin metadata
- `block_{{NAME}}.php` - Main block class
- `lang/en/{{COMPONENT}}.php` - Language strings
- `tests/structure_basic_test.php` - Basic tests

**Features:**
- Block initialization
- Content generation
- Instance configuration support
- Applicable formats configuration
- Privacy metadata

**Use for:** Dashboard blocks, course blocks, custom content display

---

### Activity Module (`templates/mod/`)

**Files:**
- `version.php` - Plugin metadata
- `lib.php` - Core Moodle hooks (add, update, delete, supports)
- `mod_form.php` - Instance configuration form
- `view.php` - Main display page
- `db/access.php` - Capability definitions
- `classes/event/course_module_viewed.php` - Event logging
- `classes/privacy/provider.php` - GDPR privacy provider (stub)
- `backup/moodle2/` - Complete backup/restore skeleton:
  - `backup_{{NAME}}_activity_task.class.php`
  - `backup_{{NAME}}_stepslib.php`
  - `restore_{{NAME}}_activity_task.class.php`
  - `restore_{{NAME}}_stepslib.php`
- `lang/en/{{COMPONENT}}.php` - Language strings
- `tests/structure_basic_test.php` - Structure tests
- `tests/add_instance_test.php` - Instance lifecycle tests

**Features:**
- Complete activity lifecycle (add/update/delete)
- Backup and restore support
- Event logging
- Privacy provider implementation
- Gradebook integration ready
- Capability system
- Multiple test coverage

**Use for:** Learning activities, assignments, interactive content, gradable items

**Note:** This is the most complete template with full backup/restore skeleton as per requirements.

---

### Question Type (`templates/qtype/`)

**Files:**
- `version.php` - Plugin metadata
- `questiontype.php` - Question type class
- `lang/en/{{COMPONENT}}.php` - Language strings
- `tests/structure_basic_test.php` - Basic tests

**Features:**
- Question type registration
- Name method implementation
- Privacy metadata

**Use for:** Custom quiz question types

---

### Question Bank Plugin (`templates/qbank/`)

**Files:**
- `version.php` - Plugin metadata
- `classes/plugin_feature.php` - Plugin feature class
- `lang/en/{{COMPONENT}}.php` - Language strings
- `tests/structure_basic_test.php` - Basic tests

**Features:**
- Question bank integration
- Plugin feature base

**Use for:** Question bank management tools, bulk operations

---

### Enrolment Method (`templates/enrol/`)

**Files:**
- `version.php` - Plugin metadata
- `lib.php` - Enrol plugin class
- `db/access.php` - Capability definitions (config, enrol, unenrol)
- `lang/en/{{COMPONENT}}.php` - Language strings
- `tests/structure_basic_test.php` - Basic tests

**Features:**
- Enrolment/unenrolment support
- Instance name customization
- Capability system
- Privacy metadata

**Use for:** Custom enrolment methods, SSO integration, automated enrolment

---

### Content Filter (`templates/filter/`)

**Files:**
- `version.php` - Plugin metadata
- `filter.php` - Filter class
- `lang/en/{{COMPONENT}}.php` - Language strings
- `tests/structure_basic_test.php` - Basic tests

**Features:**
- Text filtering
- Content transformation
- Privacy metadata

**Use for:** Content processing, link conversion, text enhancement

---

### TinyMCE Editor Plugin (`templates/tiny/`)

**Files:**
- `version.php` - Plugin metadata
- `classes/plugininfo.php` - Plugin info with button registration
- `lang/en/{{COMPONENT}}.php` - Language strings
- `tests/structure_basic_test.php` - Basic tests

**Features:**
- Button registration
- Editor integration
- Privacy metadata

**Use for:** Editor toolbars, content insertion, formatting tools

---

### Admin Report (`templates/report/`)

**Files:**
- `version.php` - Plugin metadata
- `index.php` - Main report page
- `db/access.php` - Capability definitions (view)
- `lang/en/{{COMPONENT}}.php` - Language strings
- `tests/structure_basic_test.php` - Basic tests

**Features:**
- Admin report page
- Capability checking
- Privacy metadata

**Use for:** Administrative reports, analytics, system monitoring

---

### Local Plugin (`templates/local/`)

**Files:**
- `version.php` - Plugin metadata
- `lib.php` - Hook implementations
- `lang/en/{{COMPONENT}}.php` - Language strings
- `tests/structure_basic_test.php` - Basic tests

**Features:**
- Settings navigation hook
- Hook system integration
- Privacy metadata

**Use for:** Custom tools, system extensions, integrations that don't fit other types

---

## Placeholder Reference

All templates use consistent placeholders:

```php
{{COMPONENT}}           // e.g., block_myplugin, mod_myactivity
{{NAME}}                // e.g., myplugin, myactivity
{{PLUGIN_DISPLAY_NAME}} // e.g., My Plugin, My Activity
{{VERSION_DATE}}        // e.g., 2025011800 (YYYYMMDDRR)
{{REQUIRES_VERSION}}    // e.g., 2024100700 (Moodle 5.0)
{{MATURITY}}            // MATURITY_ALPHA, MATURITY_BETA, MATURITY_RC, or MATURITY_STABLE
{{RELEASE}}             // e.g., 1.0.0, 2.1.3
```

## Usage

### Manual Customization

```bash
# Copy template
cp -r templates/block ../moodle-block_myplugin

# Find and replace placeholders
cd ../moodle-block_myplugin
find . -type f -name "*.php" -o -name "*.md" | xargs sed -i 's/{{COMPONENT}}/block_myplugin/g'
find . -type f -name "*.php" -o -name "*.md" | xargs sed -i 's/{{NAME}}/myplugin/g'
# ... continue for all placeholders
```

### With GitHub Copilot

```
@workspace Replace all template placeholders:
- {{COMPONENT}} with block_student_progress
- {{NAME}} with student_progress
- {{PLUGIN_DISPLAY_NAME}} with Student Progress Dashboard
- {{VERSION_DATE}} with 2025011800
- {{REQUIRES_VERSION}} with 2024100700
- {{MATURITY}} with MATURITY_STABLE
- {{RELEASE}} with 1.0.0
```

### With Script (Future Enhancement)

A placeholder replacement script could be added:
```bash
./scripts/customize_template.sh templates/block block_myplugin "My Plugin"
```

## Testing Templates

After customization, test your plugin:

```bash
# From plugin directory
../momopda/scripts/run_tests.sh

# Or from momopda directory
./scripts/run_tests.sh block_myplugin
```

## Template Contributions

Templates follow these principles:

1. **Minimal but complete** - Include essential files, not everything
2. **Consistent placeholders** - Use the standard placeholder format
3. **Test coverage** - Include basic test structure
4. **Moodle standards** - Follow coding style and API usage
5. **Privacy aware** - Include privacy metadata declarations
6. **Documented** - Clear comments and structure

To contribute a new template or improvement:
1. Follow the structure of existing templates
2. Include all essential files for the plugin type
3. Add tests
4. Update this index
5. Submit a pull request

## Future Enhancements

Planned improvements:
- [ ] Database install.xml templates for plugins needing DB tables
- [ ] Additional privacy provider templates for plugins storing user data
- [ ] Settings.php templates for plugins with admin configuration
- [ ] Mobile app support stubs
- [ ] Behat test templates
- [ ] Docker test harness integration
- [ ] Automated placeholder replacement script
- [ ] Interactive template customization CLI tool
