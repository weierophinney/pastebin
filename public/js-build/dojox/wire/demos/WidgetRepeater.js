/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.wire.demos.WidgetRepeater"]){dojo._hasResource["dojox.wire.demos.WidgetRepeater"]=true;dojo.provide("dojox.wire.demos.WidgetRepeater");dojo.require("dojo.parser");dojo.require("dijit._Widget");dojo.require("dijit._Templated");dojo.require("dijit._Container");dojo.declare("dojox.wire.demos.WidgetRepeater",[dijit._Widget,dijit._Templated,dijit._Container],{templateString:"<div class='WidgetRepeater' dojoAttachPoint='repeaterNode'></div>",widget:null,repeater:null,createNew:function(_1){try{if(dojo.isString(this.widget)){dojo.require(this.widget);this.widget=dojo.getObject(this.widget);}this.addChild(new this.widget(_1));this.repeaterNode.appendChild(document.createElement("br"));}catch(e){console.debug(e);}}});}