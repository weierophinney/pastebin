dojo.provide("spindle.StatusBar");

dojo.require("dijit.layout._LayoutWidget");
dojo.require("dojox.dtl.Context");

(function() {
    dojo.require("dijit.layout._LayoutWidget");

    dojo.declare("spindle.StatusBar", [dijit.layout._LayoutWidget], {
        identityMetadataTemplate: "<div class=\"dijitInline\"><dl class=\"spindleStatusBarIdentity\">{% for item in user %}<dt>{{ item.label }}</dt><dd>{{ item.value }}</dd>{% endfor %}</dl><a id=\"spindleStatusUserCancel\">[close]</a>",
        identityLoginLink: "<a id=\"spindleStatusUser\">{{ user }}</a>",

        startup: function() {
            if (this._started) {
                return;
            }
            dojo.forEach(this.getChildren(), this._setupChild, this);
            this.inherited(arguments);
        },

        layout: function() {
            this._layoutChildren();
        },

        postCreate: function() {
            this.inherited(arguments);
            dojo.addClass(this.domNode, 'spindleStatus');
        },

        createTextPane: function(paneId, args) {
            args = args || {};
            this[paneId] = new dijit._Widget(args);
            dojo.addClass(this[paneId].domNode, "spindleStatusPane");
            this.addChild(this[paneId]);
        },

        deleteTextPane: function(paneId) {
            var pane = this[paneId];
            if (pane) {
                this.removeChild(pane);
                pane.destroy();
            }
        },

        setTextPane: function(paneId, text) {
            var pane = this[paneId];
            if (pane) {
                pane.domNode.innerHTML = text;
            }
        },

        getPaneNode: function(paneId) {
            var pane = this[paneId];
            if (pane) {
                return pane.domNode;
            }
        },

        addChild: function(child) {
            this.inherited(arguments);
            this._setupChild(child);
            if (this._started) {
                this._layoutChildren();
            }
        },

        removeChild: function(child) {
            this.inherited(arguments);
            if (this._started) {
                this.layoutChildren();
            }
        },

        setHeight: function() {
            var
                height = 0,
                thisNode = this.domNode;

            dojo.forEach(this.getChildren(), function(child) {
                height = Math.max(dojo.marginBox(child.domNode).h, height);
            });

            height = height + dojo._getPadBorderExtents(thisNode).h;

            dojo.marginBox(thisNode, {h:height});
        },

        setStatusIdentity: function(identity) {
            var template = new dojox.dtl.Template(this.identityMetadataTemplate);
            var tplIdentity = [];
            for (var i in identity) {
                tplIdentity.push({label: i, value: identity[i]});
            }
            var dialogContent = template.render(new dojox.dtl.Context({user: tplIdentity}));

            var dialog   = new dijit.TooltipDialog({
                content: dialogContent,
                closable: true,
            });
            dojo.body().appendChild(dialog.domNode);
            dialog.startup();

            var template = new dojox.dtl.Template(this.identityLoginLink);
            var link = template.render(new dojox.dtl.Context({user: identity.username}));
            if (!this.getPaneNode("user")) {
                this.createTextPane("user", link);
            } else {
                this.getPaneNode("user").innerHTML = link;
            }
            var n = this.getPaneNode("user");
            dojo.connect(n, "onclick", function(e){
                e.preventDefault();
                dijit.popup.open({
                    popup: dialog, 
                    x: e.pageX,
                    y: e.pageY,
                });
            });
            dojo.query("#spindleStatusUserCancel").onclick(function(e){
                e.preventDefault();
                dijit.popup.close(dialog);
            });
        },

        _setupChild: function(child) {
            var node = child.domNode;
            if (node) {
                node.style.position = "absolute";
            }
        },

        _layoutChildren: function() {
            var
                thisDomNode = this.domNode,
                children    = this.getChildren(),
                totalWidth  = 0,
                e1          = dojo._getPadBorderExtents(thisDomNode),
                e2          = dojo._getMarginExtents(thisDomNode),
                rightEdge   = dojo.marginBox(thisDomNode).w - (e1.w - e1.l) - (e2.w - e2.l);

            for (var i = children.length - 1; i > 0; i--) {
                var node   = children[i].domNode;
                rightEdge -= dojo.marginBox(node).w;
                dojo.marginBox(node, {l:rightEdge});
            }

            var l = e1.l + e2.l;
            dojo.marginBox(children[0].domNode, {l:l,w:rightEdge-l});
        },
    });
})();
