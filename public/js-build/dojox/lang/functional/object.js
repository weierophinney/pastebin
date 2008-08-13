/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.lang.functional.object"]){dojo._hasResource["dojox.lang.functional.object"]=true;dojo.provide("dojox.lang.functional.object");dojo.require("dojox.lang.functional.lambda");(function(){var d=dojo,df=dojox.lang.functional,_3={};d.mixin(df,{forIn:function(_4,f,o){o=o||d.global;f=df.lambda(f);for(var i in _4){if(i in _3){continue;}f.call(o,_4[i],i,_4);}},keys:function(_8){var t=[];for(var i in _8){if(i in _3){continue;}t.push(i);}return t;},values:function(_b){var t=[];for(var i in _b){if(i in _3){continue;}t.push(_b[i]);}return t;}});})();}