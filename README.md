# github-for-cpanel
This repository is a work in progress. It's extremely limited and not yet recommended for use.

A repository that allows cPanel users to install GitHub repos into their public web directory and auto-deploy updates on hooks.

Please note, this plugin will install the following on your server if it is not already installed:
Git
Composer

# Installation Instructions
```
wget -q https://raw.githubusercontent.com/mbitson/github-for-cpanel/master/install.sh -O github-for-cpanel.sh
sh github-for-cpanel.sh
rm -f github-for-cpanel.sh
```

# Uninstall Instructions
```
wget -q https://raw.githubusercontent.com/mbitson/github-for-cpanel/master/uninstall.sh -O github-for-cpanel.sh
sh github-for-cpanel.sh
rm -f github-for-cpanel.sh
```