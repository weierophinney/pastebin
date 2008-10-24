/* ./build.sh profile="paste" */
dependencies = {
    action:        "release",
    version:       "1.2.1-paste",
    releaseName:   "paste",
    loader:        "default",
    cssOptimize:   "comments.keepLines",
    optimize:      "shrinksafe",
    layerOptimize: "shrinksafe",
    copyTests:     false,
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
