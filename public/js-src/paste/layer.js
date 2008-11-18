dojo.provide("paste.layer");

(function() {
    dojo.require("dojo.back");
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
    dojo.require("dojox.dtl.Context");
    dojo.require("dijit.Dialog");
    dojo.require("paste.TabHandler");

    dojo.addOnLoad(function() {
        paste.upgrade(); 
        dojo.connect(dijit.byId("new-paste"), "onLoad", paste, "prepareNewPasteForm");
    });

    dojo.addOnLoad(function() {
        // setup back button handling
        dojo.back.setInitialState({
            handle: paste.urlChangeHandler,
        });

        // set the tab based on any URL at load-time
        paste.urlChangeHandler();
    
        // update the URL hash each time the tab changes
        dojo.connect(dijit.byId("pastebin"), "selectChild", paste.urlUpdateHandler);
    });

    dojo.mixin(paste, {
        activeStatusTabs: ["about", "active", "new-paste"],

        urlChangeHandler: function() {
            if (window.location.hash) {
                var hash = window.location.hash.slice(1);   // strip leading "#"
                if (hash.match(/^(new-paste|about|active)$/i)) {
                    var tab = dijit.byId(hash.toLowerCase());
                    dijit.byId("pastebin").selectChild(tab);
                } else if (hash.match(/^[a-z0-9]{13}$/i)) {
                    tabs.loadPasteTabs(hash.toLowerCase());
                } else if (hash.match(/^followup-([a-z0-9]{13})$/i)) {
                    var followupRegex = new RegExp(/^followup-([a-z0-9]{13})$/);
                    var matches       = followupRegex.exec(hash.toLowerCase());
                    tabs.loadFollowupTab(matches[1], false);
                }
            } else {
                var tab = dijit.byId("about");
                dijit.byId("pastebin").selectChild(tab);
            }
        },

        urlUpdateHandler: function(tab) {
            // update the URL hash to the current tab
            var id = dijit.byId("pastebin").selectedChildWidget.id;
            if (id.match(/^(new-paste|about|active)$/i)) {
                dojo.back.addToHistory({
                    handle:    paste.urlChangeHandler,
                    changeUrl: id,
                });
            } else if ("paste" == id) {
                var pastetab = dijit.byId(id);
                var pasteid  = pastetab.controlButton.attr("label");
                dojo.back.addToHistory({
                    handle:    paste.urlChangeHandler,
                    changeUrl: pasteid,
                });
            } else if ("followup" == id) {
                var followuptab = dijit.byId(id);
                var label       = followuptab.controlButton.attr("label");
                var labelRegex  = new RegExp(/Followup: ([a-z0-9]{13})/);
                var matches     = labelRegex.exec(label);
                dojo.back.addToHistory({
                    handle:    paste.urlChangeHandler,
                    changeUrl: "followup-" + matches[1],
                });
            } else {
                console.log("selecting " + id + " did not update url!");
            }
        },

        errorTemplate: "<dl class=\"error\">{% for item in items %}<dt>{{ item.label }}</dt>{% for message in item.messages %}<dd>{{ message }}</dd>{% endfor %}{% endfor %}</dl>",

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

        createErrorDiv: function(errors) {
            var template = new dojox.dtl.Template(paste.errorTemplate);
            var html     = template.render(new dojox.dtl.Context({items: errors }));
            return html;
        },

        _processForm: function(pasteform) {
            if (!pasteform.isValid()) {
                return;
            }

            dojo.xhrPost({
                url:      dojo.attr(pasteform.domNode, "url") + "/format/ajax",
                form:     pasteform.domNode,
                handleAs: "json",
                load:     function(data) {
                    if (data.success) {
                        tabs.loadPasteTabs(data.success);
                    } else if (data.error) {
                        // display errors...
                        var errorMarkup = paste.createErrorDiv(data.messages);
                        var requestForm;
                        if (data.request.pasteform) {
                            requestForm = "pasteform";
                        } else {
                            requestForm = "followupform";
                        }
                        var dialog = new dijit.Dialog({
                            title: "An Error Occurred",
                            content: errorMarkup,
                        });
                        dojo.body().appendChild(dialog.domNode);
                        dialog.startup();
                        dialog.show();
                    }
                },
                error:    function(data) {
                    // display errors
                    var errors = [
                        {
                            label: "General Transport Error: ", 
                            messages: ["A general error occurred; please try again later."],
                        },
                    ];
                    var errorMarkup = paste.createErrorDiv(errors);
                    var dialog = new dijit.Dialog({
                        title: "An Error Occurred",
                        content: errorMarkup,
                    });
                    dojo.body().appendChild(dialog.domNode);
                    dialog.startup();
                    dialog.show();
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
            dojo.attr(form, "action", "#");
            dojo.attr(form, "method", "");
            dojo.attr(form, "url", url);
        },

        prepareNewPasteForm: function() {
            var pasteform = dojo.byId("pasteform");
            paste._prepareForm(pasteform);
            dojo.connect(pasteform, "onsubmit", paste, "processNewForm");
        },

        prepareFollowupForm: function() {
            var followupform = dojo.byId("followupform");
            paste._prepareForm(followupform);
            dojo.connect(followupform, "onsubmit", paste, "processFollowupForm");
        },
    });
})();
