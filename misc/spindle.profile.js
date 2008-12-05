/* ./build.sh profile="spindle" */
dependencies = {
    action:        "release",
    version:       "1.3.0-spindle",
    releaseName:   "spindle",
    loader:        "default",
    cssOptimize:   "comments.keepLines",
    optimize:      "shrinksafe",
    layerOptimize: "shrinksafe",
    copyTests:     false,
    layers: [
        {
            name: "../spindle/main.js",
            layerDependencies: [],
            dependencies: [
                "spindle.main",
            ]
        },
        {
            name: "../paste/main.js",
            layerDependencies: ["../spindle/main.js"],
            dependencies: [
                "paste.main",
            ]
        },
    ],
    prefixes: [
        [ "dijit",   "../dijit" ],
        [ "dojox",   "../dojox" ],
        [ "spindle", "../spindle" ],
        [ "paste",   "../paste" ],
    ]
}
