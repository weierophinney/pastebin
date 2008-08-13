/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.charting.Series"]){dojo._hasResource["dojox.charting.Series"]=true;dojo.provide("dojox.charting.Series");dojo.require("dojox.charting.Element");dojo.declare("dojox.charting.Series",dojox.charting.Element,{constructor:function(_1,_2,_3){dojo.mixin(this,_3);if(typeof this.plot!="string"){this.plot="default";}this.data=_2;this.dirty=true;this.clear();},clear:function(){this.dyn={};}});}