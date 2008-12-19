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
                title: "Open Bugs"
            });
            this.bugsResolved = new dijit.layout.ContentPane({
                id:    "bugListResolved",
                title: "Resolved Bugs"
            });
            this.bugsAll = new dijit.layout.ContentPane({
                id:    "bugListAll",
                title: "All Bugs"
            });

            this.addChild(this.bugsOpen);
            this.addChild(this.bugsResolved);
            this.addChild(this.bugsAll);

            this.inherited(arguments);
        }
    });
})();
