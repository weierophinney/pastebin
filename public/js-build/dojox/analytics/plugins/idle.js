/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.analytics.plugins.idle"]){dojo._hasResource["dojox.analytics.plugins.idle"]=true;dojo.provide("dojox.analytics.plugins.idle");dojox.analytics.plugins.idle=new (function(){this.addData=dojo.hitch(dojox.analytics,"addData","idle");this.idleTime=dojo.config["idleTime"]||60000;this.idle=true;this.setIdle=function(){this.addData("isIdle");this.idle=true;};dojo.addOnLoad(dojo.hitch(this,function(){var _1=["onmousemove","onkeydown","onclick","onscroll"];for(var i=0;i<_1.length;i++){dojo.connect(dojo.doc,_1[i],this,function(e){if(this.idle){this.idle=false;this.addData("isActive");this.idleTimer=setTimeout(dojo.hitch(this,"setIdle"),this.idleTime);}else{clearTimeout(this.idleTimer);this.idleTimer=setTimeout(dojo.hitch(this,"setIdle"),this.idleTime);}});}}));})();}