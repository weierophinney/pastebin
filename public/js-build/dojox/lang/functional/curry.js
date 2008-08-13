/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.lang.functional.curry"]){dojo._hasResource["dojox.lang.functional.curry"]=true;dojo.provide("dojox.lang.functional.curry");dojo.require("dojox.lang.functional.lambda");(function(){var df=dojox.lang.functional;var _2=function(_3){return function(){if(arguments.length+_3.args.length<_3.arity){return _2({func:_3.func,arity:_3.arity,args:Array.prototype.concat.apply(_3.args,arguments)});}return _3.func.apply(this,Array.prototype.concat.apply(_3.args,arguments));};};dojo.mixin(df,{curry:function(f,_5){f=df.lambda(f);_5=typeof _5=="number"?_5:f.length;return _2({func:f,arity:_5,args:[]});},arg:{},partial:function(f){var a=arguments,_8=new Array(a.length-1),p=[];f=df.lambda(f);for(var i=1;i<a.length;++i){var t=a[i];_8[i-1]=t;if(t==df.arg){p.push(i-1);}}return function(){var t=Array.prototype.slice.call(_8,0);for(var i=0;i<p.length;++i){t[p[i]]=arguments[i];}return f.apply(this,t);};},mixer:function(f,_f){f=df.lambda(f);return function(){var t=new Array(_f.length);for(var i=0;i<_f.length;++i){t[i]=arguments[_f[i]];}return f.apply(this,t);};},flip:function(f){f=df.lambda(f);return function(){var a=arguments,l=a.length-1,t=new Array(l+1),i;for(i=0;i<=l;++i){t[l-i]=a[i];}return f.apply(this,t);};}});})();}