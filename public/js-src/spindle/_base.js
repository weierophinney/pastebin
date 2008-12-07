dojo.provide("spindle._base");

(function() {
    spindle.setTitle = function(title) {
        title += ' - Spindle';
        console.log("Changing title to " + title);
        dojo.doc.title = title;
    };

    spindle.upgrade = function() {
        dojo.style("footer", "visibility", "visible");

        // Detect layout
        var layout = dijit.byId("layout");
        if (layout) {
            // Create navMenu
            spindle.navMenu = new spindle.NavMenu({
                baseUrl: spindle.baseUrl,
            });

            // Create and setup statusbar
            spindle.statusBar = new spindle.StatusBar({
                id:     "status",
                region: "bottom",
                style:  "height: 1.5em;",
            });
            spindle.statusBar.createTextPane("message");
            spindle.statusBar.createTextPane(
                "user", {style: "width: 6em"}
            );
            spindle.statusBar.setTextPane("message", "Ready");
            spindle.statusBar.setTextPane("user", '<a onclick="spindle.loginDialog();">Login</a>');

            // remove footer; will replace with statusbar
            var footer = dijit.byId("footer");
            layout.removeChild(footer);
            footer.destroy();

            // Add navmenu and statusbar to layout
            layout.addChild(spindle.navMenu);
            layout.addChild(spindle.statusBar);
            spindle.statusBar.setHeight();
            layout.layout();
            window.onResize = function() {
                layout.layout();
            };
        }
    };

    spindle.loginDialog = function() {
        if (!spindle._loginDialog) {
            spindle._loginDialog = new dijit.Dialog({
                title:         "Please Login",
                href:          spindle.baseUrl + "/spindle/user?format=html",
                parseOnLoad:   true,
                refreshOnShow: false,
                style:         "height: 375px;",
            });
            dojo.body().appendChild(spindle._loginDialog.domNode);
        }
        spindle._loginDialog.startup();
        spindle._loginDialog.show();
    };
})();
