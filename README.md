# GitHub for cPanel
This repository is a work in progress. Use at your own risk. Currently supports adding a site to a cPanel account and then one-click deploys. Any local file will need to be added to the cPanel account after the repo is checked out with this extension as the initial checkout will delete any contents of the folder before checking out the repo.

A repository that allows cPanel users to install GitHub repos into their public web directory and auto-deploy updates on hooks.

Please note, this plugin will install the following on your server if it is not already installed:
* Git
* Composer

## Install Instructions
```sh
wget -q https://raw.githubusercontent.com/mbitson/github-for-cpanel/master/install.sh -O github-for-cpanel.sh
sh github-for-cpanel.sh
rm -f github-for-cpanel.sh
```

## Uninstall Instructions
```sh
wget -q https://raw.githubusercontent.com/mbitson/github-for-cpanel/master/uninstall.sh -O github-for-cpanel.sh
sh github-for-cpanel.sh
rm -f github-for-cpanel.sh
```

## Troubleshooting Tips
If for some reason you run into trouble with your cPanel theme you may re-install Paper Lantern at any time using the following two commands:
```sh
rm -fR /usr/local/cpanel/base/frontend/paper_lantern
/usr/local/cpanel/scripts/upcp --force
```