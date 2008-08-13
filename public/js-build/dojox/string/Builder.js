/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.string.Builder"]){dojo._hasResource["dojox.string.Builder"]=true;dojo.provide("dojox.string.Builder");(function(){dojox.string.Builder=function(_1){this.b=dojo.isIE?[]:"";if(_1){this.append(_1);}};var m={append:function(s){return this.appendArray(dojo._toArray(arguments));},concat:function(s){return this.append(s);},appendArray:function(_5){this.b=String.prototype.concat.apply(this.b,_5);return this;},clear:function(){this._clear();this.length=0;return this;},replace:function(_6,_7){var s=this.toString();s=s.replace(_6,_7);this._reset(s);this.length=s.length;return this;},remove:function(_9,_a){if(_a==0){return this;}var s=this.toString();this.clear();if(_9>0){this.append(s.substring(0,_9));}if(_9+_a<s.length){this.append(s.substring(_9+_a));}return this;},insert:function(_c,_d){var s=this.toString();this.clear();if(_c==0){this.append(_d);this.append(s);return this;}else{this.append(s.substring(0,_c));this.append(_d);this.append(s.substring(_c));}return this;},toString:function(){return this.b;},_clear:function(){this.b="";},_reset:function(s){this.b=s;}};if(dojo.isIE){dojo.mixin(m,{toString:function(){return this.b.join("");},appendArray:function(_10){this.b=this.b.concat(_10);return this;},_clear:function(){this.b=[];},_reset:function(s){this.b=[s];}});}dojo.extend(dojox.string.Builder,m);})();}