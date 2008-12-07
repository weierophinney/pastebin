dojo.provide("spindle._base");

(function() {
    spindle.errorTemplate = "<h4>There were one or more errors processing the form:</h4><dl class=\"error\">{% for item in items %}<dt>{{ item.label }}</dt>{% for message in item.messages %}<dd>{{ message }}</dd>{% endfor %}{% endfor %}</dl>";

    spindle.createErrorDialog = function(errors) {
        if (!spindle._errorDialog) {
            spindle._errorDialog = new dijit.Dialog({
                title:   "An Error Occurred",
            });
            dojo.body().appendChild(spindle._errorDialog.domNode);
            spindle._errorDialog.startup();
        }
        var template = new dojox.dtl.Template(spindle.errorTemplate);
        spindle._errorDialog.attr(
            "content", 
            template.render(new dojox.dtl.Context({items: errors }))
        );
        spindle._errorDialog.show();
    };

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

    spindle.loginDialog = function(e) {
        if (!spindle._loginDialog) {
            spindle._loginDialog = new dijit.Dialog({
                title:         "Please Login",
                href:          spindle.baseUrl + "/spindle/user?format=html",
                parseOnLoad:   true,
                refreshOnShow: false,
                style:         "height: 375px;",
                onLoad:        function() {
                    var loginForm = dojo.byId("login");
                    if (loginForm) {
                        dojo.attr(loginForm, {action: "#",method:"post"});
                        dojo.connect(loginForm, "onsubmit", spindle, "processLogin");
                    }
                },
            });
            dojo.body().appendChild(spindle._loginDialog.domNode);
        }
        spindle._loginDialog.startup();
        spindle._loginDialog.show();
    };

    spindle.processLogin = function(e) {
        if (e) {
            e.preventDefault();
        }
        var loginform = dijit.byId("login");
        dojo.xhrPost({
            url:      spindle.baseUrl + "/spindle/user/login?format=json",
            form:     loginform.domNode,
            handleAs: "json",
            error:    function(response, ioArgs) {
                var errors = [{
                    label:    "General Transport Error: ", 
                    messages: ["A general error occurred; please try again later."],
                }];
                spindle.createErrorDialog(errors);
            },
            load: function(response, ioargs) {
                if (response.success) {
                    window.location.reload();
                } else if (response.error) {
                    spindle.createErrorDialog(response.messages);
                } else {
                    var errors = [{
                        label:    "Problem with Submission", 
                        messages: ["An unknown error occurred; please try again later."],
                    }];
                    spindle.createErrorDialog(errors);
                }
            },
        });
    };
})();
