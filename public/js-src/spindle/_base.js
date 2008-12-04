dojo.provide("spindle._base");

(function() {
    spindle.setTitle = function(title) {
        title += ' - Spindle';
        console.log("Changing title to " + title);
        dojo.doc.title = title;
    };
})();
