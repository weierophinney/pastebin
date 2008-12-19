dojo.provide("bug._base");

(function(){
    dojo.require("bug.layout.BugLayout");
    dojo.require("dojox.data.QueryReadStore");
    dojo.require("dojox.grid.DataGrid");

    bug.initLayout = function() {
        console.log("In bug.initLayout()");
        var mainPane  = spindle.prepareMainPane();
        if (!dijit.byId("bugLayout")) {
            console.log("dijit does not exist; creating layout");
            bug.bugLayout = new bug.layout.BugLayout();
        }

        mainPane.attr("content", bug.bugLayout);
        mainPane.resize();
        dijit.byId("spindleNavMenuAccordion").selectChild(dijit.byId("spindleNavMenuBugs"));
    };
})();
