/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.lang.functional.sequence"]){dojo._hasResource["dojox.lang.functional.sequence"]=true;dojo.provide("dojox.lang.functional.sequence");dojo.require("dojox.lang.functional.lambda");(function(){var d=dojo,df=dojox.lang.functional;d.mixin(df,{repeat:function(n,f,z,o){o=o||d.global;f=df.lambda(f);var t=new Array(n);t[0]=z;for(var i=1;i<n;t[i]=z=f.call(o,z),++i){}return t;},until:function(pr,f,z,o){o=o||d.global;f=df.lambda(f);pr=df.lambda(pr);var t=[];for(;!pr.call(o,z);t.push(z),z=f.call(o,z)){}return t;}});})();}