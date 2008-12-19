dojo.provide("bug.main");

(function() {
    dojo.require("spindle.main");
    dojo.require("bug.layout.BugLayout");

    dojo.addOnLoad(function() {
        bug.bugLayout = new bug.layout.BugLayout();
        var mainPane = dijit.byId("mainPane");
        mainPane.attr("content", bug.bugLayout);
        mainPane.layout();
    });
})();
