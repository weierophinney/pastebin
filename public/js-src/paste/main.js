dojo.provide("paste.main");

(function() {
    dojo.require("spindle.main");
    dojo.require("paste._base");

    dojo.addOnLoad(function() {
        // Progressive enhancement of app
        paste.upgrade(); 

        // Initialize layout
        paste.initLayout();
    });
})();
