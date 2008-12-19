dojo.provide("paste.layout.AboutPane");

(function() {
    dojo.require("dijit.layout.ContentPane"); 

    dojo.declare("paste.layout.AboutPane", dijit.layout.ContentPane, {
        id:          "about",
        title:       "About",
        class:       "tab",
        href:        spindle.baseUrl + "/api/spindle/paste/content/about.html",
        parseOnLoad: true
    });
})();
