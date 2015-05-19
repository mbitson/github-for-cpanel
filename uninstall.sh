#!/bin/bash
# Uninstall script for GitHub for cPanel plugin.

# Download the plugin archive
wget -q https://github.com/mbitson/github-for-cpanel/blob/master/build/ghcp-release.tar.gz?raw=true -O ghcp-release.tar.gz

# Register plugin with cPanel
/usr/local/cpanel/scripts/uninstall_plugin ghcp-release.tar.gz

# Cleanup by removing release
rm -f ghcp-release.tar.gz