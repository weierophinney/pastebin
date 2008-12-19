dojo.provide("bug.BugTree");

(function(){
    dojo.require("dijit.Tree");
    dojo.require("dojo.data.ItemFileWriteStore");

    dojo.declare("bug.BugTree", dijit.Tree, {
        constructor: function(args) {
            var store  = new dojo.data.ItemFileWriteStore({
                jsId: "bugTreeStore",
                data: {
                    label:      "name",
                    identifier: "name",
                    items:      []
                }
            });
            args.model = new dijit.tree.ForestStoreModel({
                jsId:      "bugTreeModel",
                rootLabel: "Bugs",
                store:     store,
            });
            args.jsId  = "bugTree";

            this.inherited("constructor", arguments, args);
        }
    });
})();
