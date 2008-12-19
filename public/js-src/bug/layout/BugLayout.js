dojo.provide("bug.layout.BugLayout");

(function() {
    dojo.require("dijit.layout.BorderContainer"); 
    dojo.require("bug.layout.BugListPane")
    dojo.require("bug.layout.BugPane")
    dojo.require("bug.layout.BugTreePane")

    dojo.declare("bug.layout.BugLayout", dijit.layout.BorderContainer, {
        postCreate: function() {
            this.bugListPane = new bug.layout.BugListPane();
            this.bugPane     = new bug.layout.BugPane();
            this.bugTreePane = new bug.layout.BugTreePane();

            this.addChild(this.bugListPane);
            this.addChild(this.bugPane);
            this.addChild(this.bugTreePane);
            this.inherited(arguments);
        }
    });
})();
