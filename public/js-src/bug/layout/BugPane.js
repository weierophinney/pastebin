dojo.provide("bug.layout.BugPane");

(function() {
    dojo.require("dijit.layout.ContentPane"); 

    dojo.declare("bug.layout.BugPane", dijit.layout.ContentPane, {
        id:       "bugPane",
        region:   "center",
        splitter: true,
    });
})();
