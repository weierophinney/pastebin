dojo.provide("bug._base");

(function(){
    dojo.require("bug.layout.BugLayout");
    dojo.require("dijit.Dialog");
    dojo.require("dijit.form.ValidationTextBox");
    dojo.require("dijit.form.FilteringSelect");
    dojo.require("dijit.form.SimpleTextarea");
    dojo.require("dijit.form.Button");
    dojo.require("dijit.form.Form");
    dojo.require("dojox.data.QueryReadStore");
    dojo.require("dojox.grid.DataGrid");
    dojo.require("dojox.rpc.Service");
    dojo.require("dojox.rpc.JsonRPC");

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

    bug.newDialog = function() {
        if (!bug._newDialog) {
            bug._newDialog = new dijit.Dialog({
                title:         "Submit new issue",
                href:          spindle.baseUrl + "/spindle/bug/add/format/html",
                parseOnLoad:   true,
                refreshOnShow: false,
                style:         "height: 375px; width: 450px;",
                onLoad:        function() {
                    var bform = dojo.byId("bugform");
                    spindle.prepareForm(bform);
                    dojo.connect(bform, "onsubmit", bug, "processNewBug");
                }
            });
            dojo.body().appendChild(bug._newDialog.domNode);
        }
        bug._newDialog.startup();
        bug._newDialog.show();
    };

    bug.processNewBug = function(e) {
        e.preventDefault();

        var bugDef  = spindle.prepareFormElements(dojo.byId("bugform"));

        console.log(bugDef);

        var service = bug._getService();

        if ("id" in bugDef) {
            delete bugDef.id;
        }

        service.add(bugDef).addCallback(function(result) {
            if (!result.error && !result.success) {
                var errors = [{
                    label:    "General Transport Error: ", 
                    messages: ["A general error occurred; please try again later."],
                }];
                spindle.createErrorDialog(errors);
                return;
            } else if (result.error) {
                spindle.createErrorDialog(result.messages);
                return;
            }

            bug._newDialog.hide();
            var bugPane = dijit.byId("bugPane");
            bugPane.setHref("/api/spindle/bug/content/bug-" + result.success + ".html");
            bugPane.refresh();
        });
    };

    bug._getService = function() {
        if (!bug._service) {
            bug._service = new dojox.rpc.Service(
                spindle.baseUrl + "/api/spindle/bug/content/jsonrpc.smd", 
                { envelope:"JSON-RPC-2.0" }
            );
        }
        return bug._service;
    };
})();
