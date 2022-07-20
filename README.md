# Zip Media Plugin

**This README.md file should be modified to describe the features, installation, configuration, and general usage of the plugin.**

The **Zip Media** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). This Plugin lets you create a zip archive of a page&#039;s media. You can choose, if this plugin should run for every page independently and which files should be included.

## Installation

Installing the Zip Media plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)
**This is not yet possible**
To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install zip-media

This will install the Zip Media plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/zip-media`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `zip-media`. You can find these files on [GitHub](https://github.com/maxwienole/grav-plugin-zip-media) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/zip-media

> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/maxwienole/grav-plugin-zip-media/blob/master/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/zip-media/zip-media.yaml` to `user/config/plugins/zip-media.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

Note that if you use the Admin Plugin, a file with your configuration named zip-media.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

## Usage

This plugin adds a section to a pages options tab in the Admin Plugin. You can choose the files you want and a custom filename for the archive. The default is the page's folder name.
Of course, you can also use frontmatter:
```yaml
zip:
  media:
      - filename.ext
      - filename.ext
      ...
  filename: filename
```

## Thanks

Thanks to Trilby Media for creating this **amazing** CMS.
