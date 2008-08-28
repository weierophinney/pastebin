dojo.provide("paste.main");
paste.main = {
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
        dojo.attr(linkNode, "onClick", "paste.main.formattedShow()");
        linkNode.innerHTML = "formatted";
    },

    formattedShow: function() {
        dojo.toggleClass("pastecode", "highlight", true);
        dojo.query("#pastecode pre code").forEach(function(node) {
            dojox.highlight.init(node);
        });

        var linkNode = dojo.byId("format-toggle");
        dojo.attr(linkNode, "onClick", "paste.main.unformattedShow()");
        linkNode.innerHTML = "unformatted";
    },

    init: function() {
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
        dojo.addOnLoad(paste.main.upgrade);
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
};
