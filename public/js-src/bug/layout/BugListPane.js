dojo.provide("bug.layout.BugListPane");

(function(){
    dojo.require("dijit.layout.ContentPane");
    dojo.require("bug.layout.BugListTabContainer");

    dojo.declare("bug.layout.BugListPane", dijit.layout.ContentPane, {
        postMixInProperties: function() {
            this.inherited(arguments);
            this.id       = "bugList";
            this.region   = "top";
            this.splitter = true;
            this.style    = "height: 150px;";

            this.bugLists = new bug.layout.BugListTabContainer();
            this.content  = this.bugLists;
        }
    });
})();
