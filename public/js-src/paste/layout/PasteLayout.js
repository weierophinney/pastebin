dojo.provide("paste.layout.PasteLayout");

(function(){
    dojo.require("dijit.layout.TabContainer");
    dojo.require("paste.layout.AboutPane");
    dojo.require("paste.layout.ActivePane");
    dojo.require("paste.layout.NewPane");

    dojo.declare("paste.layout.PasteLayout", dijit.layout.TabContainer, {
        postMixInProperties: function() {
            this.inherited(arguments);
            this.id    = "pastebin";
            this.class = "paste-tab";
        },

        postCreate: function() {
            this.aboutPane  = new paste.layout.AboutPane();
            this.newPane    = new paste.layout.NewPane();
            this.activePane = new paste.layout.ActivePane();

            this.addChild(this.aboutPane);
            this.addChild(this.newPane);
            this.addChild(this.activePane);
            this.inherited(arguments);
        }
    });
})();
