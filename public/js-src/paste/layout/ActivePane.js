dojo.provide("paste.layout.ActivePane");

(function() {
    dojo.require("dijit.layout.ContentPane"); 

    dojo.declare("paste.layout.ActivePane", dijit.layout.ContentPane, {
        id:          "active",
        title:       "Active Pastes",
        class:       "tab",
        href:        spindle.baseUrl + "/api/spindle/paste/content/active-grid.html",
        parseOnLoad: true
    });
})();
