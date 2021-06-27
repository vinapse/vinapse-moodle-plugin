# DADdy video #

## Development setup

```sh
cd $MOODLE_PATH/mod
git clone git@github.com:txc2team/daddy-moodle-plugin.git daddyvideo
```

Go to Moodle admin to complete the installation.

Make sure to follow the steps in [Developer mode](https://docs.moodle.org/dev/Developer_Mode) while developing.

If you change JavaScript files in `amd`, make sure to rebuild the modules.

```sh
cd $MOODLE_PATH
npm install
cd mod/daddyvideo
grunt # or grunt watch
```

## Deployment

Create a ZIP file with the source code of this repository contained in a folder named `daddyvideo`. Then install through the Moodle admin page. 

TODO: script
