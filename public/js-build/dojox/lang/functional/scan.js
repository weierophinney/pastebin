/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.lang.functional.scan"]){dojo._hasResource["dojox.lang.functional.scan"]=true;dojo.provide("dojox.lang.functional.scan");dojo.require("dojox.lang.functional.lambda");(function(){var d=dojo,df=dojox.lang.functional;d.mixin(df,{scanl:function(a,f,z,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);var t,n;if(d.isArray(a)){t=new Array((n=a.length)+1);t[0]=z;for(var i=0;i<n;z=f.call(o,z,a[i],i,a),t[++i]=z){}}else{t=[z];for(var i=0;a.hasNext();t.push(z=f.call(o,z,a.next(),i++))){}}return t;},scanl1:function(a,f,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);var t,n,z;if(d.isArray(a)){t=new Array(n=a.length);t[0]=z=a[0];for(var i=1;i<n;t[i]=z=f.call(o,z,a[i],i,a),++i){}}else{if(a.hasNext()){t=[z=a.next()];for(var i=1;a.hasNext();t.push(z=f.call(o,z,a.next(),i++))){}}}return t;},scanr:function(a,f,z,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);var n=a.length,t=new Array(n+1);t[n]=z;for(var i=n;i>0;--i,z=f.call(o,z,a[i],i,a),t[i]=z){}return t;},scanr1:function(a,f,o){if(typeof a=="string"){a=a.split("");}o=o||d.global;f=df.lambda(f);var n=a.length,t=new Array(n),z=a[n-1];t[n-1]=z;for(var i=n-1;i>0;--i,z=f.call(o,z,a[i],i,a),t[i]=z){}return t;}});})();}