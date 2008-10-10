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
    dojo.addOnLoad(function() {
        paste.upgrade(); 
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
    });
})();
