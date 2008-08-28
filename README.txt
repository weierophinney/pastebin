This is a demo pastebin application, primarily developed to show off new
features of the Dojo/Zend Framework integration.

INSTALLATION
=======================================================================
1. Untar the archive using:

    tar xzf <packagefile>

2. Symlink the library/Zend/ directory of your Zend Framework
   installation (1.6.0RC1 or later, or current trunk) to library/Zend/
   -- this is done to keep the tarball size down.

3. Make the directory application/data and all files within it world
   writeable; this can be accomplished on *nix systems using:

    chmod -R a+rwX <packagedir>/application/data

4. Create a vhost that points its DocumentRoot to the public
   subdirectory. As an example:

    <VirtualHost *>
        DocumentRoot /home/matthew/sites/pastebin-0.9.0beta/public
        ServerName paste.local
        ErrorLog /var/log/apache2/paste.local-error_log
        CustomLog /var/log/apache2/paste.local-access_log common

        <Directory /home/matthew/sites/pastebin-0.9.0beta/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>

   In this particular example, we use the ServerName "paste.local"; you
   will need to add this to your hosts file:

    127.0.1.1 paste.local

5. Finally, simply fire your browser to:

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

ZF specific features include:

    * Zend_Dojo_View_Helper_* (BorderContainer, TabContainer,
      ContentPane, etc.)
    * Zend_Dojo_Form (form and form elements)
    * Zend_Dojo_Data (used to populate the grid)

REQUESTS
=======================================================================
If you have any feature requests, feel free to send them to:

    Matthew Weier O'Phinney <matthew@zend.com>

I may or may not honor them. :)

LICENSE
=======================================================================
Please see LICENSE.txt
