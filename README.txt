This is a demo pastebin application, primarily developed to show off new
features of the Dojo/Zend Framework integration.

INSTALLATION
=======================================================================
1. Untar the archive using:

    tar xzf <packagefile>

2. I recommend creating a symlink to the directory created when
   extracting from the archive:

     ln -s /var/www/pastebin /path/to/<packagedir>

   (Assuming /var/www contains directories for your vhosts.)

3. Symlink or install the library/Zend/ directory of your Zend Framework
   installation (1.6.0RC1 or later, or current trunk) to library/Zend/
   -- this is done to keep the tarball size down.

   Alternately, you can grab current trunk or the 1.6 release branch
   from SVN using:

     svn co http://framework.zend.com/svn/framework/standard/trunk/library/Zend

     svn co http://framework.zend.com/svn/framework/standard/branches/release-1.6/library/Zend

4. If you are on Windows, rename the public/js-src directory to
   public/js; on *nix, verify that public/js is a symlink to
   public/js-src.

5. Make the directory application/data and all files within it world
   writeable; this can be accomplished on *nix systems using:

    chmod -R a+rwX <packagedir>/application/data

6. Make the directory public/api/v1 world writeable; this can be
   accomplished on *nix systems using:

    chmod a+rwX <packagedir>/public/api/v1

   This will only affect you when you set the application environment to
   "production", at which time artifacts will be written to the
   directory.

7. Create a vhost that points its DocumentRoot to the public
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

8. Finally, simply fire your browser to:

    http://paste.local/

FEATURES
=======================================================================
This application shows off the following Dojo features:

    * BorderContainer
    * TabContainer
    * dojox.Grid
    * dojox.highlight
    * A variety of dijits: ValidationTextBox, SimpleTextarea,
      and FilteringSelect
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
installation, and then use the misc/paste.profile.js build profile to
create the build. Further instructions are in misc/README.txt.


REQUESTS
=======================================================================
If you have any feature requests, feel free to send them to:

    Matthew Weier O'Phinney <matthew@zend.com>

I may or may not honor them. :)

LICENSE
=======================================================================
Please see LICENSE.txt
