/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.collections.Stack"]){dojo._hasResource["dojox.collections.Stack"]=true;dojo.provide("dojox.collections.Stack");dojo.require("dojox.collections._base");dojox.collections.Stack=function(_1){var q=[];if(_1){q=q.concat(_1);}this.count=q.length;this.clear=function(){q=[];this.count=q.length;};this.clone=function(){return new dojox.collections.Stack(q);};this.contains=function(o){for(var i=0;i<q.length;i++){if(q[i]==o){return true;}}return false;};this.copyTo=function(_5,i){_5.splice(i,0,q);};this.forEach=function(fn,_8){dojo.forEach(q,fn,_8);};this.getIterator=function(){return new dojox.collections.Iterator(q);};this.peek=function(){return q[(q.length-1)];};this.pop=function(){var r=q.pop();this.count=q.length;return r;};this.push=function(o){this.count=q.push(o);};this.toArray=function(){return [].concat(q);};};}