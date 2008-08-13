/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.analytics.plugins.window"]){dojo._hasResource["dojox.analytics.plugins.window"]=true;dojo.provide("dojox.analytics.plugins.window");dojox.analytics.plugins.window=new (function(){this.addData=dojo.hitch(dojox.analytics,"addData","window");this.windowConnects=dojo.config["windowConnects"]||["open","onerror"];for(var i=0;i<this.windowConnects.length;i++){dojo.connect(window,this.windowConnects[i],dojo.hitch(this,"addData",this.windowConnects[i]));}dojo.addOnLoad(dojo.hitch(this,function(){var _2={};for(var i in window){if(dojo.isObject(window[i])){switch(i){case "location":case "console":_2[i]=window[i];break;default:break;}}else{_2[i]=window[i];}}this.addData(_2);}));})();}