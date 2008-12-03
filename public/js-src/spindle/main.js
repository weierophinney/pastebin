dojo.provide("spindle.main");

(function() {
    dojo.require("dijit.layout.BorderContainer");
    dojo.require("dijit.layout.ContentPane");
    dojo.require("dojox.layout.ExpandoPane");
    dojo.require("dijit.layout.AccordionContainer");
    dojo.require("dojo.parser");

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
