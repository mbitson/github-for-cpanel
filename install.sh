#!/bin/bash
# Installation script for GitHub for cPanel plugin.
# Will first check dependancies and install

# Git
command -v git >/dev/null 2>&1
GIT_IS_INSTALLED=$?
if [[ $GIT_IS_INSTALLED -ne 0 ]]; then
    echo >&2 "Git is not installed. Installing..";
    yum install git
fi

#Composer
composer -v > /dev/null 2>&1
COMPOSER_IS_INSTALLED=$?
if [[ $COMPOSER_IS_INSTALLED -ne 0 ]]; then
    echo "Composer is not installed. Installing..."
    # Install Composer
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
else
    echo "Composer is installed. Running update..."
    sudo composer self-update
fi

# Download the plugin archive
wget -q https://github.com/mbitson/github-for-cpanel/blob/master/build/ghcp-release.tar.gz?raw=true -O ghcp-release.tar.gz

# Register plugin with cPanel
/usr/local/cpanel/scripts/install_plugin ghcp-release.tar.gz --theme paper_lantern

# Cleanup by removing release
rm -f ghcp-release.tar.gz

# TODO - Run composer update once plugin is installed.