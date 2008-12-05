This is a demo pastebin application, primarily developed to show off new
features of the Dojo/Zend Framework integration.

INSTALLATION
=======================================================================
This application requires that you either have Zend Framework on your
include_path, or that you will be symlinking your Zend Framework library
into the library directory. If you do not yet have Zend Framework, you
can get it from one of the following sources:

  * Official Release:
    http://framework.zend.com/dowload/latest

  * Subversion; use either the current trunk or the 1.7 release branch:
    svn co http://framework.zend.com/svn/framework/standard/trunk/library/Zend

    svn co http://framework.zend.com/svn/framework/standard/branches/release-1.7/library/Zend

Install Zend Framework locally, and the follow these steps:

1. Untar the archive using:

    tar xzf <packagefile>

2. I recommend creating a symlink to the directory created when
   extracting from the archive:

     ln -s /var/www/pastebin /path/to/<packagedir>

   (Assuming /var/www contains directories for your vhosts.)

3. Run the install script
   The application now comes with an install script, that creates the
   necessary symlinks, initializes the development database, and sets
   appropriate permissions. Simply run it using php:

     php install.php path/to/ZendFramework/library/Zend

   You can get full usage by passing the -h, --help, or -? options:

     php install.php -h

3. Create a vhost that points its DocumentRoot to the public
   subdirectory. As an example:

    <VirtualHost *>
        DocumentRoot /var/www/pastebin/public
        ServerName paste.local
        ErrorLog /var/log/apache2/paste.local-error_log
        CustomLog /var/log/apache2/paste.local-access_log common

        <Directory /var/www/pastebin/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>

   In this particular example, we use the ServerName "paste.local"; you
   will need to add this to your hosts file:

    127.0.1.1 paste.local

4. Finally, simply fire your browser to:

    http://paste.local/

FEATURES
=======================================================================
This application shows off the following Dojo features:

    * BorderContainer
    * TabContainer
    * ExpandoPane
    * AccordionContainer
    * dojox.Grid
    * dojox.highlight
    * dojo.back
    * A variety of dijits: ValidationTextBox, SimpleTextarea,
      and FilteringSelect
    * dojo.xhr
    * JSON-RPC

ZF specific features include:

    * Zend_Dojo_View_Helper_* (BorderContainer, TabContainer,
      ContentPane, etc.)
    * Zend_Dojo_Form (form and form elements)
    * Zend_Dojo_Data (used to populate the grid)
    * Zend_Json_Server (used to process forms and update statusbar
      metadata)

CUSTOM DOJO BUILDS
=======================================================================
For the adventurous, I have provided a profile for creating a custom
Dojo build for the pastebin application. You will need to copy the
public/js-src/paste directory and contents to your Dojo source
installation, and then use the misc/spindle.profile.js build profile to
create the build. Further instructions are in misc/README.txt.


REQUESTS
=======================================================================
If you have any feature requests, feel free to send them to:

    Matthew Weier O'Phinney <matthew@zend.com>

I may or may not honor them. :)

LICENSE
=======================================================================
Please see LICENSE.txt
