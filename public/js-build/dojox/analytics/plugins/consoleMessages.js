/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.analytics.plugins.consoleMessages"]){dojo._hasResource["dojox.analytics.plugins.consoleMessages"]=true;dojo.provide("dojox.analytics.plugins.consoleMessages");dojox.analytics.plugins.consoleMessages=new (function(){this.addData=dojo.hitch(dojox.analytics,"addData","consoleMessages");var _1=dojo.config["consoleLogFuncs"]||["error","warn","info","rlog"];if(!console){console={};}for(var i=0;i<_1.length;i++){if(console[_1[i]]){dojo.connect(console,_1[i],dojo.hitch(this,"addData",_1[i]));}else{console[_1[i]]=dojo.hitch(this,"addData",_1[i]);}}})();}