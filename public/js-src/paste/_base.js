dojo.provide("paste._base");

(function() {
    paste.activeStatusTabs = ["about", "active", "new-paste"];

    paste.errorTemplate = "<h4>There were one or more errors processing the form:</h4><dl class=\"error\">{% for item in items %}<dt>{{ item.label }}</dt>{% for message in item.messages %}<dd>{{ message }}</dd>{% endfor %}{% endfor %}</dl>";

    paste.createErrorDialog = function(errors) {
        var template = new dojox.dtl.Template(paste.errorTemplate);
        var dialog = new dijit.Dialog({
            title:   "An Error Occurred",
            content: template.render(new dojox.dtl.Context({items: errors })),
        });
        dojo.body().appendChild(dialog.domNode);
        dialog.startup();
        dialog.show();
    };

    paste.findParentForm = function(elementNode) {
        while (elementNode.nodeName.toLowerCase() != 'form') {
            elementNode = elementNode.parentNode;
        }
        return elementNode;
    };

    paste.formattedShow = function() {
        dojo.toggleClass("pastecode", "highlight", true);
        dojo.query("#pastecode pre code").forEach(function(node) {
            dojox.highlight.init(node);
        });

        var linkNode = dojo.byId("format-toggle");
        dojo.attr(linkNode, "onClick", "paste.unformattedShow()");
        linkNode.innerHTML = "unformatted";
    };

    paste.prepareFollowupForm = function() {
        var followupform = dojo.byId("followupform");
        paste._prepareForm(followupform);
        dojo.connect(followupform, "onsubmit", paste, "processFollowupForm");
    };

    paste.prepareNewPasteForm =  function() {
        var pasteform = dojo.byId("pasteform");
        paste._prepareForm(pasteform);
        dojo.connect(pasteform, "onsubmit", paste, "processNewForm");
    };

    paste.processFollowupForm = function(e) {
        e.preventDefault();
        var form = dijit.byId("followupform");
        return paste._processForm(form);
    };    

    paste.processNewForm = function(e) {
        e.preventDefault();
        var form = dijit.byId("pasteform");
        return paste._processForm(form);
    };

    paste.setStatusFromMetadata = function() {
        var metadata = dojo.byId("metadata");
        if (!metadata) {
            return;
        }
        var footer = dijit.byId("footer");
        footer.attr('content', "<p>" + metadata.innerHTML + "</p>");
    };

    paste.unformattedShow = function() {
        dojo.toggleClass("pastecode", "highlight", false);
        var linkNode = dojo.byId("format-toggle");
        dojo.attr(linkNode, "onClick", "paste.formattedShow()");
        linkNode.innerHTML = "formatted";
    };

    paste.updateStatus = function(tab) {
        var id = tab.domNode.id;
        if (-1 != paste.activeStatusTabs.indexOf(id)) {
            dojo.xhrGet({
                url:      "/paste/active-data-count/format/ajax",
                handleAs: "text",
                load:     function(count) {
                    var footer = dijit.byId("footer");
                    footer.attr('content', '<p>' + count + " active pastes</p>");
                },
            });
        } else {
            paste.setStatusFromMetadata();
        }
    };

    paste.upgrade = function() {
        dojo.forEach([".new-paste", "#paste-nav"],
            function(query, index, array) {
                dojo.query(query).style("display", "none");
            }
        );
        dojo.style("footer", "visibility", "visible");
        dojo.subscribe("pastebin-selectChild", paste, "updateStatus");
    };

    paste._prepareForm = function(form) {
        var url  = dojo.attr(form, "action");
        dojo.attr(form, "action", "#");
        dojo.attr(form, "method", "");
        dojo.attr(form, "url", url);
    };

    paste._processForm = function(pasteform) {
        dojo.xhrPost({
            url:      dojo.attr(pasteform.domNode, "url") + "/format/ajax",
            form:     pasteform.domNode,
            handleAs: "json",
            load:     function(data) {
                if (data.success) {
                    paste.tabs.loadPasteTabs(data.success);
                } else if (data.error) {
                    // display errors...
                    var errorMarkup = paste.createErrorDialog(data.messages);
                }
            },
            error:    function(data) {
                // display errors
                var errors = [
                    {
                        label:    "General Transport Error: ", 
                        messages: ["A general error occurred; please try again later."],
                    },
                ];
                var errorMarkup = paste.createErrorDialog(errors);
            },
        });
    };
})();
