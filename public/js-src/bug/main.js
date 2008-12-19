dojo.provide("bug.main");

(function() {
    dojo.require("spindle.main");
    dojo.require("bug._base");

    dojo.addOnLoad(function() {
        bug.initLayout();
        dijit.byId("mainPane").resize();
    });
})();
