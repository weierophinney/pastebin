dojo.provide("spindle.main");

(function() {
    dojo.require("spindle.NavMenu");
    dojo.require("dijit.layout.BorderContainer");
    dojo.require("dijit.layout.ContentPane");
    dojo.require("dojo.parser");

    dojo.addOnLoad(function() {
        spindle.navMenu = new spindle.NavMenu({
            baseUrl: spindle.baseUrl,
        });
        dijit.byId("layout").addChild(spindle.navMenu);
        spindle.navMenu.startup();
    });

    // Derive base URL
    var path      = window.location.pathname;
    var pathRegex = new RegExp(/^(.*?)\/spindle\/paste/);
    var matches   = pathRegex.exec(path);
    var baseUrl   = "";
    if ((null != matches) && (1 < matches.length)) {
        baseUrl = matches[1];
    }
    spindle.baseUrl = baseUrl;
})();
