dojo.provide("paste.layer");

(function() {
    dojo.require("dijit.layout.ContentPane");
    dojo.require("dijit.layout.BorderContainer");
    dojo.require("dijit.layout.TabContainer");
    dojo.require("dijit.form.FilteringSelect");
    dojo.require("dijit.form.ValidationTextBox");
    dojo.require("dijit.form.SimpleTextarea");
    dojo.require("dijit.form.Button");
    dojo.require("dijit.form.Form");
    dojo.require("dojox.grid.DataGrid");
    dojo.require("dojox.data.QueryReadStore");
    /* dojo.require("dojox.grid._data.model"); */
    dojo.require("dojo.parser");
    dojo.require("dojox.highlight.languages.html");
    dojo.require("dojox.highlight.languages.xml");
    dojo.require("paste.highlight.php");
    dojo.require("dojox.highlight.languages.python");
    dojo.require("dojox.highlight.languages._www");
    dojo.require("paste.TabHandler");
    dojo.addOnLoad(function() {
        paste.upgrade(); 
        dojo.connect(dijit.byId("new-paste"), "onLoad", paste, "prepareNewPasteForm");
    });

    dojo.mixin(paste, {
        activeStatusTabs: ["about", "active", "new-paste"],

        newPasteButton:  function() {
            var form = dijit.byId("pasteform");
            if (form.isValid()) {
                form.submit(); 
            }
        },

        followupPasteButton: function() {
            var form = dijit.byId("followupform");
            if (form.isValid()) {
                form.submit(); 
            }
        },

        unformattedShow: function() {
            dojo.toggleClass("pastecode", "highlight", false);
            var linkNode = dojo.byId("format-toggle");
            dojo.attr(linkNode, "onClick", "paste.formattedShow()");
            linkNode.innerHTML = "formatted";
        },

        formattedShow: function() {
            dojo.toggleClass("pastecode", "highlight", true);
            dojo.query("#pastecode pre code").forEach(function(node) {
                dojox.highlight.init(node);
            });
 
            var linkNode = dojo.byId("format-toggle");
            dojo.attr(linkNode, "onClick", "paste.unformattedShow()");
            linkNode.innerHTML = "unformatted";
        },

        upgrade: function() {
            dojo.forEach([".new-paste", "#paste-nav"],
                function(query, index, array) {
                    dojo.query(query).style("display", "none");
                }
            );
            dojo.style("footer", "visibility", "visible");
            dojo.subscribe("pastebin-selectChild", paste, "updateStatus");
        },

        findParentForm: function(elementNode) {
            while (elementNode.nodeName.toLowerCase() != 'form') {
                elementNode = elementNode.parentNode;
            }
            return elementNode;
        },

        setStatusFromMetadata: function() {
            var metadata = dojo.byId("metadata");
            var footer = dijit.byId("footer");
            footer.attr('content', "<p>" + metadata.innerHTML + "</p>");
        },

        updateStatus: function(tab) {
            var id = tab.domNode.id;
            if (-1 != paste.activeStatusTabs.indexOf(id)) {
                dojo.xhrGet({
                    url: "/paste/active-data-count/format/ajax",
                    handleAs: "text",
                    load: function(count) {
                        var footer = dijit.byId("footer");
                        footer.attr('content', '<p>' + count + " active pastes</p>");
                    }
                });
            } else {
                paste.setStatusFromMetadata();
            }
        },

        _processForm: function(pasteform) {
            if (!pasteform.isValid()) {
                return;
            }

            dojo.xhrPost({
                url:   pasteform.attr("url") + "/format/ajax",
                form:  pasteform,
                load:  function(data) {
                    if (data.success) {
                        tabs.loadPasteTabs(data.success);
                        tabs.resetNewPasteTab();
                    } else {
                        // display errors...
                    }
                },
                error: function(data) {
                    // display errors
                },
            });
        },

        processNewForm: function(e) {
            e.preventDefault();
            var form = dijit.byId("pasteform");
            return paste._processForm(form);
        },

        processFollowupForm: function(e) {
            e.preventDefault();
            var form = dijit.byId("followupform");
            return paste._processForm(form);
        },    

        _prepareForm: function(form) {
            var url  = dojo.attr(form, "action");

            var widget = dijit.byId(dojo.attr(form, "id"));

            dojo.attr(form, "action", "#");
            dojo.attr(form, "method", "");
            dojo.attr(form, "url", url);

            widget.attr("action", "#");
            widget.attr("method", "");
            widget.attr("url", url);
        },

        prepareNewPasteForm: function() {
            var pasteform = dojo.byId("pasteform");
            paste._prepareForm(pasteform);
            dojo.connect(pasteform, "onsubmit", paste, "processNewForm");
            dojo.connect(dijit.byId(dojo.attr(pasteform, "id")), "onSubmit", paste, "processNewForm");
        },

        prepareFollowupForm: function() {
            var followupform = dojo.byId("followupform");
            paste._prepareForm(followupform);
            dojo.connect(followupform, "onsubmit", paste, "processFollowupForm");
            dojo.connect(dijit.byId(dojo.attr(followupform, "id")), "onSubmit", paste, "processFollowupForm");
        },
    });
})();
