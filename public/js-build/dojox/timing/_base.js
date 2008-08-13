/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.timing._base"]){dojo._hasResource["dojox.timing._base"]=true;dojo.provide("dojox.timing._base");dojo.experimental("dojox.timing");dojox.timing.Timer=function(_1){this.timer=null;this.isRunning=false;this.interval=_1;this.onStart=null;this.onStop=null;};dojo.extend(dojox.timing.Timer,{onTick:function(){},setInterval:function(_2){if(this.isRunning){window.clearInterval(this.timer);}this.interval=_2;if(this.isRunning){this.timer=window.setInterval(dojo.hitch(this,"onTick"),this.interval);}},start:function(){if(typeof this.onStart=="function"){this.onStart();}this.isRunning=true;this.timer=window.setInterval(dojo.hitch(this,"onTick"),this.interval);},stop:function(){if(typeof this.onStop=="function"){this.onStop();}this.isRunning=false;window.clearInterval(this.timer);}});}