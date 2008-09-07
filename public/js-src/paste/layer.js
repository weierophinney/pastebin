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
    dojo.require("dojox.grid.Grid");
    dojo.require("dojo.data.ItemFileReadStore");
    dojo.require("dojo.parser");
    dojo.addOnLoad(function() {
        paste.upgrade(); 
    });

    dojo.mixin(paste, {
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
            footer.setContent(metadata);
        }
    });
})();
