/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["paste.main"]){dojo._hasResource["paste.main"]=true;dojo.provide("paste.main");paste.main={newPasteButton:function(){var _1=dijit.byId("pasteform");if(_1.isValid()){_1.submit();}},followupPasteButton:function(){var _2=dijit.byId("followupform");if(_2.isValid()){_2.submit();}},unformattedShow:function(){dojo.query(".formatted").style("display","none");dojo.query(".unformatted").style("display","block");dojo.query("#format-toggle").forEach(function(_3){dojo.attr(_3,"onClick","paste.main.formattedShow()");_3.innerHTML="formatted";});},formattedShow:function(){dojo.query(".unformatted").style("display","none");dojo.query(".formatted").style("display","block");dojo.query("#format-toggle").forEach(function(_4){dojo.attr(_4,"onClick","paste.main.unformattedShow()");_4.innerHTML="unformatted";});},init:function(){dojo.require("dijit.form.FilteringSelect");dojo.require("dijit.form.ValidationTextBox");dojo.require("dijit.form.SimpleTextarea");dojo.require("dijit.form.Button");dojo.require("dijit.layout.ContentPane");dojo.require("dijit.layout.TabContainer");dojo.require("dijit.form.Form");dojo.require("dojox.grid.Grid");dojo.require("dojo.data.ItemFileReadStore");dojo.require("dojo.parser");dojo.addOnLoad(paste.main.upgrade);},upgrade:function(){dojo.forEach([".new-paste","#paste-nav"],function(_5,_6,_7){dojo.query(_5).style("display","none");});},findParentForm:function(_8){while(_8.nodeName.toLowerCase()!="form"){_8=_8.parentNode;}return _8;},};}