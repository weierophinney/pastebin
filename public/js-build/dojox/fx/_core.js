/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.fx._core"]){dojo._hasResource["dojox.fx._core"]=true;dojo.provide("dojox.fx._core");dojox.fx._Line=function(_1,_2){this.start=_1;this.end=_2;if(dojo.isArray(_1)){var _3=[];dojo.forEach(this.start,function(s,i){_3[i]=this.end[i]-s;},this);this.getValue=function(n){var _7=[];dojo.forEach(this.start,function(s,i){_7[i]=(_3[i]*n)+s;},this);return _7;};}else{var _3=_2-_1;this.getValue=function(n){return (_3*n)+this.start;};}};}