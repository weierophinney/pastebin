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
                style:         "height: 375px; width: 450px;",
                onLoad:        function() {
                    var lform = dojo.byId("login");
                    spindle.prepareForm(lform);
                    dojo.connect(lform, "onsubmit", spindle, "processLoginForm");

                    var rform = dojo.byId("register");
                    spindle.prepareForm(rform);
                    dojo.connect(rform, "onsubmit", spindle, "processRegisterForm");
                },
            });
            dojo.body().appendChild(spindle._loginDialog.domNode);
        }
        spindle._loginDialog.startup();
        spindle._loginDialog.show();
    };

    spindle.processLoginForm = function(e) {
        e.preventDefault();
        spindle._processAuthForm(dojo.byId("login"));
    }

    spindle.processRegisterForm = function(e) {
        e.preventDefault();
        spindle._processAuthForm(dojo.byId("register"));
    }

    spindle.prepareForm = function(form) {
        var url  = dojo.attr(form, "action");
        dojo.attr(form, {action: "#", method: "post", url: url});
    };

    spindle.prepareFormElements = function(formNode) {
        // summary:
        //     For forms using array notation, we need to create a nested
        //     object. This code does so, using the form's ID. It only looks one
        //     level deep currently.'
        if (!formNode) {
            return {};
        }

        var formName  = formNode.id;
        var values    = dojo.formToObject(formNode);

        if (!formName) {
            return values;
        }

        var subRegexp = new RegExp(/\[(.*?)\]/);
        var keys      = {};
        dojo.forEach(formNode.elements, function(element) {
            var name       = element.name;
            if (matches = subRegexp.exec(name)) {
                keys[name] = matches[1];
            }
        });
        var mapped   = {};
        for (var name in values) {
            if (keys[name]) {
                var shortName     = keys[name];
                mapped[shortName] = values[name];
            } else {
                mapped[name] = values[name];
            }
        }
        var ret = {};
        ret[formName] = mapped;
        return ret;
    };

    spindle._processAuthForm = function(lform) {
        dojo.xhrPost({
            url:      spindle.baseUrl + dojo.attr(lform, "url") + "?format=json",
            content:  dojo.formToObject(lform),
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
