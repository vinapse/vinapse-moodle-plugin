# Vinapse Moodle plugin

This plugin allows to upload and view videos in Moodle.

It supports Moodle 4.1 LTS and newer.

## Installation

Install through the Moodle admin page by uploading the ZIP file. Then fill configuration details.

## Development setup

```sh
cd $MOODLE_PATH/mod
git clone git@github.com:txc2team/vinapse-moodle-plugin.git vinapse
```

Go to Moodle admin to complete the installation.

Make sure to follow the steps in [Developer mode](https://docs.moodle.org/dev/Developer_Mode) while developing.

If you change JavaScript files in `amd/src`, make sure to rebuild the modules.

```sh
cd $MOODLE_PATH
nvm install
nvm use
npm install
cd mod/vinapse
npx grunt amd # or npx grunt watch
```

For proper code completion in PhpStorm/IntelliJ IDEA, add the Moodle root directory to the PHP *Include Paths* in the project settings.

Also make sure to set the PHP version to 7.4 (the minimum required by Moodle 4.1).

## Packaging

Run `./build.sh` to create a ZIP file with the source code of this repository contained in a folder named `vinapse`.

**NOTE:** the script creates the package starting from the `HEAD` of the current branch, i.e. the latest commit.
