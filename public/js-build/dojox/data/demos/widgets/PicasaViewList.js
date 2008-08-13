/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.data.demos.widgets.PicasaViewList"]){dojo._hasResource["dojox.data.demos.widgets.PicasaViewList"]=true;dojo.provide("dojox.data.demos.widgets.PicasaViewList");dojo.require("dijit._Templated");dojo.require("dijit._Widget");dojo.require("dojox.data.demos.widgets.PicasaView");dojo.declare("dojox.data.demos.widgets.PicasaViewList",[dijit._Widget,dijit._Templated],{templateString:"<div dojoAttachPoint=\"list\"></div>\n\n",listNode:null,postCreate:function(){this.fViewWidgets=[];},clearList:function(){while(this.list.firstChild){this.list.removeChild(this.list.firstChild);}for(var i=0;i<this.fViewWidgets.length;i++){this.fViewWidgets[i].destroy();}this.fViewWidgets=[];},addView:function(_2){var _3=new dojox.data.demos.widgets.PicasaView(_2);this.fViewWidgets.push(_3);this.list.appendChild(_3.domNode);}});}