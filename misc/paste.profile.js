/* ./build.sh profile="paste" action="release" version="1.1.1-paste" releaseName="paste" loader="default" optimize="shrinksafe" layerOptimize="shrinksafe" copyTests="false" */
dependencies = {
    layers: [
        {
            name: "../paste/layer.js",
            dependencies: [
                "paste.layer",
            ]
        },
    ],
    prefixes: [
        [ "dijit", "../dijit" ],
        [ "dojox", "../dojox" ],
        [ "paste", "../paste" ],
    ]
}
