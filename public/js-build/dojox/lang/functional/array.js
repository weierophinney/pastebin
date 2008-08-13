/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.lang.functional.array"]){dojo._hasResource["dojox.lang.functional.array"]=true;dojo.provide("dojox.lang.functional.array");dojo.require("dojox.lang.functional.lambda");(function(){var d=dojo,df=dojox.lang.functional;d.mixin(df,{filter:function(a,f,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);var t=[],v;if(d.isArray(a)){for(var i=0,n=a.length;i<n;++i){v=a[i];if(f.call(o,v,i,a)){t.push(v);}}}else{for(var i=0;a.hasNext();){v=a.next();if(f.call(o,v,i++)){t.push(v);}}}return t;},forEach:function(a,f,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);if(d.isArray(a)){for(var i=0,n=a.length;i<n;f.call(o,a[i],i,a),++i){}}else{for(var i=0;a.hasNext();f.call(o,a.next(),i++)){}}},map:function(a,f,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);var t,n;if(d.isArray(a)){t=new Array(n=a.length);for(var i=0;i<n;t[i]=f.call(o,a[i],i,a),++i){}}else{t=[];for(var i=0;a.hasNext();t.push(f.call(o,a.next(),i++))){}}return t;},every:function(a,f,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);if(d.isArray(a)){for(var i=0,n=a.length;i<n;++i){if(!f.call(o,a[i],i,a)){return false;}}}else{for(var i=0;a.hasNext();){if(!f.call(o,a.next(),i++)){return false;}}}return true;},some:function(a,f,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);if(d.isArray(a)){for(var i=0,n=a.length;i<n;++i){if(f.call(o,a[i],i,a)){return true;}}}else{for(var i=0;a.hasNext();){if(f.call(o,a.next(),i++)){return true;}}}return false;}});})();}