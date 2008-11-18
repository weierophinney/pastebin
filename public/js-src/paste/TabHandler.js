dojo.provide("paste.TabHandler");

dojo.require("dijit.layout.ContentPane");

dojo.declare("paste.TabHandler", null, {
    constructor: function(baseUrl) {
        this.baseUrl     = baseUrl;
        this.pasteTab    = null;
        this.followupTab = null;
    },

    getPasteUrl: function(pasteId) {
        return this.baseUrl + "/paste/display/id/" + pasteId + "/format/ajax";
    },

    getFollowupUrl: function(pasteId) {
        return this.baseUrl + "/paste/followup/id/" + pasteId + "/format/ajax";
    },

    getPasteContainer: function() {
        return dijit.byId("pastebin");
    },

    loadPasteTabs: function(pasteId) {
        if (this.pasteTab == null) {
            this.createPasteTabs(pasteId);
        }

        // Reset paste tab href and title
        this.pasteTab.attr("href", this.getPasteUrl(pasteId));
        this.pasteTab.controlButton.attr("label", pasteId);

        // Reset followup tab href and title
        this.followupTab.attr("href", this.getFollowupUrl(pasteId));
        this.followupTab.controlButton.attr("label", "Followup: " + pasteId);

        this.getPasteContainer().selectChild(this.pasteTab);
    },

    createPasteTabs: function(pasteId, baseUrl) {
        // create tab that remotes to pasteid
        this.pasteTab = new dijit.layout.ContentPane(
            {
                id:          "paste",
                class:       "tab",
                parseOnLoad: true,
            },
            dojo.doc.createElement('div')
        );
        dojo.connect(this.pasteTab, "onLoad", paste.formattedShow);
        dojo.connect(this.pasteTab, "onLoad", paste.setStatusFromMetadata);

        // create tab that remotes to followup for pasteid
        this.followupTab = new dijit.layout.ContentPane(
            {
                id:          "followup",
                class:       "tab",
                parseOnLoad: true,
            },
            dojo.doc.createElement('div')
        );
        dojo.connect(this.followupTab, "onLoad", paste, "prepareFollowupForm");

        // attach tabs to tab container
        this.getPasteContainer().addChild(this.pasteTab);
        this.getPasteContainer().addChild(this.followupTab);
        this.pasteTab.startup();
        this.followupTab.startup();
    },
});
