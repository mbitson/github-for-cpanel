#!/bin/bash
# Installation script for GitHub for cPanel plugin.
# Will first check dependancies and install,
# notifying the user along the way.
# @author - Mikel Bitson <me@mbitson.com>
# @link - github-for-cpanel.mbitson.com

# Check for Git
command -v git >/dev/null 2>&1
GIT_IS_INSTALLED=$?

# If git is not installed, then
if [[ $GIT_IS_INSTALLED -ne 0 ]]; then

    # Warn the user about the failure
    echo "WARN - Git is not installed. Installing..."
    
    # Install git
    yum install git
    
    # Check for git once more!
    command -v git >/dev/null 2>&1
    GIT_IS_INSTALLED_NOW=$?
    
    # If git is not installed, then...
    if [[ $GIT_IS_INSTALLED_NOW -ne 0 ]]; then
    
        # Failure!
        echo "!! ERROR !! - Git could not be installed. Please install it manually to use GitHub for cPanel."
        
    # If it is installed!
    else
    
        # Notify the user, we handled it!
        echo "FIXED - Git Installed Successfully!"
    fi
    
# else if git was detected on the first attempt
else
    
    # notify the user of their greatness.
    echo "PASS - Git Detected!"
fi

# Check for composer
composer -v > /dev/null 2>&1
COMPOSER_IS_INSTALLED=$?

# If composer is not installed, then
if [[ $COMPOSER_IS_INSTALLED -ne 0 ]]; then

    # Warn the user about the failure
    echo "WARN - Composer is not installed. Installing..."
    
    # Install composer
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
    
    # Check for composer once more!
    composer -v > /dev/null 2>&1
    COMPOSER_IS_INSTALLED_NOW=$?
    
    # If composer is not installed, then...
    if [[ $COMPOSER_IS_INSTALLED_NOW -ne 0 ]]; then
    
        # Failure!
        echo "!! ERROR !! - Composer could not be installed. Please install it manually to use GitHub for cPanel."
        
    # If it is installed!
    else
    
        # Notify the user, we handled it!
        echo "FIXED - Composer Installed Successfully!"
    fi
    
# else if composer was detected on the first attempt
else
    
    # notify the user of their greatness.
    echo "PASS - Composer Detected!"
fi

# Move to cPanel plugin folder
rm -fR /usr/local/cpanel/base/frontend/paper_lantern/github_for_cpanel
mkdir /usr/local/cpanel/base/frontend/paper_lantern/github_for_cpanel
cd /usr/local/cpanel/base/frontend/paper_lantern/github_for_cpanel

# Download the plugin archive
echo "Downloading plugin..."
wget -q https://github.com/mbitson/github-for-cpanel/raw/master/build/ghcp-release.tar.gz -O github_for_cpanel.tar.gz

# Extract archive zip
echo "Extracting plugin..."
tar -zxf github_for_cpanel.tar.gz

# Register plugin with cPanel
/usr/local/cpanel/scripts/install_plugin /usr/local/cpanel/base/frontend/paper_lantern/github_for_cpanel --theme paper_lantern

#Cleanup by removing release
echo "Cleaning Up..."
rm -f /usr/local/cpanel/base/frontend/paper_lantern/github_for_cpanel/github_for_cpanel.tar.gz

# Run composer update once plugin is installed.
echo "Installing composer dependancies..."
php /usr/local/cpanel/base/frontend/paper_lantern/github_for_cpanel/composer.phar update -qn

# Fix permissions
echo "Finalizing permissions..."
chmod -R 755 /usr/local/cpanel/base/frontend/paper_lantern/github_for_cpanel
chmod -R 777 /usr/local/cpanel/base/frontend/paper_lantern/github_for_cpanel/applications
chmod -R 777 /usr/local/cpanel/base/frontend/paper_lantern/github_for_cpanel/ssh