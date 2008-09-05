/* ./build.sh profile="paste" action="release" version="1.1.1-paste" releaseName="paste" loader="default" optimize="shrinksafe" layerOptimize="shrinksafe" copyTests="false" */
dependencies = {
    layers: [
        {
            name: "../paste/layer.js",
            dependencies: [
                "paste.layer",
                "dijit.layout.ContentPane",
                "dijit.layout.BorderContainer",
                "dijit.layout.TabContainer",
                "dijit.form.FilteringSelect",
                "dijit.form.ValidationTextBox",
                "dijit.form.SimpleTextarea",
                "dijit.form.Button",
                "dijit.form.Form",
                "dojo.data.ItemFileReadStore",
                "dojox.grid.Grid",
                "dojo.parser"
            ]
        },
    ],
    prefixes: [
        [ "dijit", "../dijit" ],
        [ "dojox", "../dojox" ],
        [ "paste", "../paste" ],
    ]
}
