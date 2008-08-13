/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.lang.functional.fold"]){dojo._hasResource["dojox.lang.functional.fold"]=true;dojo.provide("dojox.lang.functional.fold");dojo.require("dojox.lang.functional.lambda");(function(){var d=dojo,df=dojox.lang.functional;d.mixin(df,{foldl:function(a,f,z,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);if(d.isArray(a)){for(var i=0,n=a.length;i<n;z=f.call(o,z,a[i],i,a),++i){}}else{for(var i=0;a.hasNext();z=f.call(o,z,a.next(),i++)){}}return z;},foldl1:function(a,f,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);var z;if(d.isArray(a)){z=a[0];for(var i=1,n=a.length;i<n;z=f.call(o,z,a[i],i,a),++i){}}else{if(a.hasNext()){z=a.next();for(var i=1;a.hasNext();z=f.call(o,z,a.next(),i++)){}}}return z;},foldr:function(a,f,z,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);for(var i=a.length;i>0;--i,z=f.call(o,z,a[i],i,a)){}return z;},foldr1:function(a,f,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);var n=a.length,z=a[n-1];for(var i=n-1;i>0;--i,z=f.call(o,z,a[i],i,a)){}return z;},reduce:function(a,f,z){return arguments.length<3?df.foldl1(a,f):df.foldl(a,f,z);},reduceRight:function(a,f,z){return arguments.length<3?df.foldr1(a,f):df.foldr(a,f,z);}});})();}