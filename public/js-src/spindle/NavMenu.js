dojo.provide("spindle.NavMenu");

dojo.require("dojo.parser");
dojo.require("dojox.layout.ExpandoPane");
dojo.require("dijit.layout.AccordionContainer");

dojo.declare("spindle.NavMenu", dojox.layout.ExpandoPane,
{
    // User definable parameters
    baseUrl         : "",
    id              : "navPane",
    title           : "Applications",
    duration        : 125,
    maxWidth        : 200,
    splitter        : true,
    region          : "right",

    // Templated parameters
    templateString  : null,
    templatePath    : dojo.moduleUrl('spindle', 'templates/NavMenu.html'),

    postCreate: function() {
        this.inherited(arguments);
        dojo.parser.parse(this.containerNode);
    },

    _setContentAttr: function() {
    },
});
