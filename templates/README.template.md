# {{PLUGIN_DISPLAY_NAME}}

{{PLUGIN_DISPLAY_NAME}} plugin for Moodle 5.x

## Description

[Add description of what this plugin does]

## Requirements

- Moodle 5.0 or higher
- PHP 8.1 or higher

## Installation

1. Copy the plugin directory to the appropriate location:
   - Block plugins: `moodle/blocks/{{NAME}}/`
   - Activity modules: `moodle/mod/{{NAME}}/`
   - Question types: `moodle/question/type/{{NAME}}/`
   - Local plugins: `moodle/local/{{NAME}}/`

2. Log in to your Moodle site as an administrator

3. Navigate to Site Administration > Notifications

4. Follow the on-screen instructions to complete the installation

## Configuration

[Add configuration instructions if applicable]

## Usage

[Add usage instructions]

## Testing

This plugin includes PHPUnit tests. To run them:

```bash
# From the plugin directory
../momopda/scripts/run_tests.sh

# Or from Moodle root
vendor/bin/phpunit --testsuite {{COMPONENT}}_testsuite
```

## License

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program. If not, see <http://www.gnu.org/licenses/>.

## Credits

Created using [MoMoPDA](https://github.com/vivedlearning/momopda) - Modular Moodle Plugin Development Assistant

## Support

[Add support information - repository URL, issue tracker, etc.]
