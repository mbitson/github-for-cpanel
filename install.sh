#!/bin/bash
# Installation script for GitHub for cPanel plugin.
wget https://github.com/mbitson/github-for-cpanel/blob/master/build/ghcp-release.tar.gz?raw=true
/usr/local/cpanel/scripts/install_plugin ghcp-release.tar.gz