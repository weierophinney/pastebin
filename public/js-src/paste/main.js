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
        dojo.query(".formatted").style("display", "none");
        dojo.query(".unformatted").style("display", "block");
        dojo.query("#format-toggle").forEach(function (node) {
            dojo.attr(node, "onClick", "paste.main.formattedShow()");
            node.innerHTML = "formatted";
        });
    },

    formattedShow: function() {
        dojo.query(".unformatted").style("display", "none");
        dojo.query(".formatted").style("display", "block");
        dojo.query("#format-toggle").forEach(function (node) {
            dojo.attr(node, "onClick", "paste.main.unformattedShow()");
            node.innerHTML = "unformatted";
        });
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
    },

    findParentForm: function(elementNode) {
        while (elementNode.nodeName.toLowerCase() != 'form') {
            elementNode = elementNode.parentNode;
        }
        return elementNode;
    },
};

