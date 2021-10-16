# Session Viewer for ProcessWire

Description...

## Text
Text...

!["Text..."](https://tech-c.net/site/assets/files/1214/settings.500x0-is.jpg)


# Session Viewer for ProcessWire

Session Viewer is a module for ProcessWire to list session files and display session data. The module is helpful to display the session data of a specific session or to kick out a logged in user by simply delete his session file. After installation the module is available in the Setup menu.

!["Session Viewer"](https://tech-c.net/site/assets/files/1219/screenshot.500x0-is.jpg)

The following conditions must be met for the module to work properly:

## Session files
Session data must be stored in session files, which is the default way in ProcessWire. Sessions stored in the database are not supported by this module. The path to the directory where the session files are stored must be declared in the ProcessWire configuration which is by default: site/assets/sessions.

## Serialize handler
In order to transform session data easier back to a PHP array, the session data is stored serialized. PHP offers a way to declare a custom serialize handler. This module supports only the default serialize handlers: php, php_binary and php_serialize. WDDX was dropped in PHP 7.4.0 and is therefore not supported by this module as well as any other custom serialize handler. Which serialize handler is actually used you can find out in the module configuration which is available under Modules=>Configure=>SessionViewer.

!["Configuration"](https://tech-c.net/site/assets/files/1219/configuration.500x0-is.jpg)

## Session data
The session data can be displayed in two different ways. PHP's default output for arrays print_r() or by default for this module nice_r() offered on github: https://github.com/uuf6429/nice_r. There is a setting in the module configuration if someone prefers print_r(). Apart from the better handling and overview of the folded session data the output of nice_r() looks indeed nicer.

!["nice_r() vs print_r()"](https://tech-c.net/site/assets/files/1219/nicer.500x0-is.jpg)
