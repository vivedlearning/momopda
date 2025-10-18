#!/bin/bash
# scripts/run_tests.sh
# Run PHPUnit tests for a Moodle plugin in side-by-side repository setup
#
# Usage: ./scripts/run_tests.sh [plugin_name]
#
# This script:
# 1. Detects plugin type from directory name or parameter
# 2. Symlinks/copies plugin to correct Moodle subdirectory
# 3. Initializes PHPUnit if needed
# 4. Runs plugin tests
# 5. Outputs test_results.json

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
MOODLE_DIR="../moodle"
CURRENT_DIR=$(pwd)
PLUGIN_NAME=""
PLUGIN_TYPE=""
COMPONENT=""

# Plugin type to directory mapping
declare -A TYPE_TO_DIR=(
    ["block"]="blocks"
    ["mod"]="mod"
    ["qtype"]="question/type"
    ["qbank"]="question/bank"
    ["enrol"]="enrol"
    ["filter"]="filter"
    ["tiny"]="lib/editor/tiny/plugins"
    ["report"]="report"
    ["local"]="local"
)

# Detect plugin from directory or parameter
detect_plugin() {
    if [ -n "$1" ]; then
        PLUGIN_NAME="$1"
    else
        # Try to detect from current directory
        DIR_NAME=$(basename "$CURRENT_DIR")
        if [[ "$DIR_NAME" =~ ^moodle-(.+)$ ]]; then
            COMPONENT_NAME="${BASH_REMATCH[1]}"
        else
            COMPONENT_NAME="$DIR_NAME"
        fi
        
        # Extract plugin type and name
        for type in "${!TYPE_TO_DIR[@]}"; do
            if [[ "$COMPONENT_NAME" =~ ^${type}_(.+)$ ]]; then
                PLUGIN_TYPE="$type"
                PLUGIN_NAME="${BASH_REMATCH[1]}"
                COMPONENT="${type}_${PLUGIN_NAME}"
                break
            fi
        done
    fi
    
    if [ -z "$PLUGIN_TYPE" ]; then
        echo -e "${RED}Error: Could not detect plugin type${NC}"
        echo "Usage: $0 [plugin_name]"
        echo "Or run from a plugin directory with format: {plugintype}_{pluginname}"
        exit 1
    fi
}

# Check if Moodle directory exists
check_moodle() {
    if [ ! -d "$MOODLE_DIR" ]; then
        echo -e "${RED}Error: Moodle directory not found at $MOODLE_DIR${NC}"
        echo "Please clone Moodle core alongside this repository:"
        echo "  cd .."
        echo "  git clone https://github.com/moodle/moodle.git"
        exit 1
    fi
    echo -e "${GREEN}✓ Moodle directory found${NC}"
}

# Symlink or copy plugin to Moodle
install_plugin() {
    local target_dir="${MOODLE_DIR}/${TYPE_TO_DIR[$PLUGIN_TYPE]}/${PLUGIN_NAME}"
    
    echo -e "${YELLOW}Installing plugin to: $target_dir${NC}"
    
    # Remove existing symlink/directory
    if [ -L "$target_dir" ] || [ -d "$target_dir" ]; then
        echo "Removing existing plugin at $target_dir"
        rm -rf "$target_dir"
    fi
    
    # Create parent directory if needed
    mkdir -p "$(dirname "$target_dir")"
    
    # Create symlink
    ln -sf "$CURRENT_DIR" "$target_dir"
    echo -e "${GREEN}✓ Plugin linked to Moodle${NC}"
}

# Initialize PHPUnit if needed
init_phpunit() {
    cd "$MOODLE_DIR"
    
    if [ ! -f "config.php" ]; then
        echo -e "${YELLOW}Warning: Moodle config.php not found${NC}"
        echo "PHPUnit initialization skipped - configure Moodle first"
        return
    fi
    
    # Check if PHPUnit is initialized
    if [ ! -f "phpunit.xml" ]; then
        echo -e "${YELLOW}Initializing PHPUnit...${NC}"
        php admin/tool/phpunit/cli/init.php
        echo -e "${GREEN}✓ PHPUnit initialized${NC}"
    else
        echo -e "${GREEN}✓ PHPUnit already initialized${NC}"
    fi
    
    cd "$CURRENT_DIR"
}

# Run tests
run_tests() {
    cd "$MOODLE_DIR"
    
    echo -e "${YELLOW}Running tests for ${COMPONENT}...${NC}"
    
    # Run PHPUnit with JSON output
    local test_output
    if test_output=$(vendor/bin/phpunit --colors --testsuite "${COMPONENT}_testsuite" 2>&1); then
        echo -e "${GREEN}✓ All tests passed${NC}"
        echo "$test_output"
        
        # Create simple JSON result
        cat > "$CURRENT_DIR/test_results.json" <<EOF
{
    "status": "passed",
    "component": "${COMPONENT}",
    "timestamp": "$(date -u +%Y-%m-%dT%H:%M:%SZ)",
    "summary": "All tests passed"
}
EOF
    else
        echo -e "${RED}✗ Tests failed${NC}"
        echo "$test_output"
        
        # Create failure JSON result
        cat > "$CURRENT_DIR/test_results.json" <<EOF
{
    "status": "failed",
    "component": "${COMPONENT}",
    "timestamp": "$(date -u +%Y-%m-%dT%H:%M:%SZ)",
    "summary": "Some tests failed"
}
EOF
        cd "$CURRENT_DIR"
        exit 1
    fi
    
    cd "$CURRENT_DIR"
}

# Main execution
main() {
    echo -e "${GREEN}MoMoPDA Test Runner${NC}"
    echo "===================="
    
    detect_plugin "$@"
    echo -e "Plugin: ${GREEN}${COMPONENT}${NC}"
    echo -e "Type: ${GREEN}${PLUGIN_TYPE}${NC}"
    echo -e "Name: ${GREEN}${PLUGIN_NAME}${NC}"
    echo
    
    check_moodle
    install_plugin
    init_phpunit
    run_tests
    
    echo
    echo -e "${GREEN}Test results written to test_results.json${NC}"
}

main "$@"
