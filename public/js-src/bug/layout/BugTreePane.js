dojo.provide("bug.layout.BugTreePane");

(function(){
    dojo.require("dojox.layout.ExpandoPane");
    dojo.require("dojo.data.ItemFileWriteStore");
    dojo.require("dijit.Tree");

    dojo.declare("bug.layout.BugTreePane", dojox.layout.ExpandoPane, {
        postMixInProperties: function() {
            this.inherited(arguments);
            this.id            = "bugTreePane";
            this.region        = "left";
            this.splitter      = true;
            this.startExpanded = false;
            this.style         = "width: 150px;";
            this.setupTree();
        },

        setupTree: function() {
            var store  = new dojo.data.ItemFileWriteStore({
                jsId: "bugTreeStore",
                data: {
                    label:      "name",
                    identifier: "name",
                    items:      []
                }
            });
            var model = new dijit.tree.ForestStoreModel({
                jsId:      "bugTreeModel",
                rootLabel: "Bugs",
                store:     store,
            });

            this.tree = new dijit.Tree({
                jsId:  "bugTree",
                model: model
            });

            this.content = this.tree;
        }
    });
})();
