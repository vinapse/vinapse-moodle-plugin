# Vinapse Moodle plugin

This repository contains the source code of the Vinapse plugins for Moodle.

There are two plugins:

- `mod_vinapse` is the main plugin, which provides the Vinapse video activity and settings
- `mod_vinapsechat` is an optional plugin, which provides the Vinapse chat activity

The plugins support Moodle 4.1 LTS and newer.

## Installation

Install through the Moodle admin page by uploading the ZIP file. The plugins are also available in the Moodle plugins directory.

After installation, fill the configuration details that have been provided to you by the Vinapse team.

## Development setup

Clone this repository, then follow our [Moodle dev setup instructions](https://github.com/vinapse/vinapse-docs/blob/main/moodle.md) which mount the two plugins as Docker volumes.

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

Run `./build.sh` to create two ZIP files for the two plugins.

**NOTE:** the script creates the package starting from the `HEAD` of the current branch, i.e. the latest commit.
