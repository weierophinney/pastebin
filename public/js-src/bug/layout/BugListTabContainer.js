dojo.provide("bug.layout.BugListTabContainer");

(function(){
    dojo.require("dijit.layout.TabContainer");
    dojo.require("dijit.layout.ContentPane");

    dojo.declare("bug.layout.BugListTabContainer", dijit.layout.TabContainer, {
        postMixInProperties: function() {
            this.id          = "bugListTabContainer";
            this.tabPosition = "left";
            this.inherited(arguments);
        },

        postCreate: function() {
            this.bugsOpen = new dijit.layout.ContentPane({
                id:    "bugListOpen",
                title: "Open Bugs",
                href:  spindle.baseUrl + "/api/spindle/bug/content/open-grid.html",
                parseOnLoad: true
            });
            this.bugsResolved = new dijit.layout.ContentPane({
                id:    "bugListResolved",
                title: "Resolved Bugs",
                href:  spindle.baseUrl + "/api/spindle/bug/content/resolved-grid.html",
                parseOnLoad: true
            });
            this.bugsAll = new dijit.layout.ContentPane({
                id:    "bugListAll",
                title: "All Bugs",
                href:  spindle.baseUrl + "/api/spindle/bug/content/all-grid.html",
                parseOnLoad: true
            });

            this.addChild(this.bugsOpen);
            this.addChild(this.bugsResolved);
            this.addChild(this.bugsAll);

            this.inherited(arguments);
        }
    });
})();
