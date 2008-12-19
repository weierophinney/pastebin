dojo.provide("paste.layout.NewPane");

(function() {
    dojo.require("dijit.layout.ContentPane"); 

    dojo.declare("paste.layout.NewPane", dijit.layout.ContentPane, {
        id:          "new-paste",
        title:       "New Paste",
        class:       "tab",
        href:        spindle.baseUrl + "/api/spindle/paste/content/new-paste.html",
        parseOnLoad: true
    });
})();
