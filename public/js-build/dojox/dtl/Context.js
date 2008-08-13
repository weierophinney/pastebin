/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.dtl.Context"]){dojo._hasResource["dojox.dtl.Context"]=true;dojo.provide("dojox.dtl.Context");dojo.require("dojox.dtl._base");dojox.dtl.Context=dojo.extend(function(_1){this._this={};dojox.dtl._Context.call(this,_1);},dojox.dtl._Context.prototype,{extend:function(_2){var _3=new dojox.dtl.Context();var _4=this.getKeys();var i,_6;for(i=0;_6=_4[i];i++){if(typeof _2[_6]!="undefined"){_3[_6]=_2[_6];}else{_3[_6]=this[_6];}}if(_2 instanceof dojox.dtl.Context){_4=_2.getKeys();}else{if(typeof _2=="object"){_4=[];for(_6 in _2){_4.push(_6);}}}for(i=0;_6=_4[i];i++){_3[_6]=_2[_6];}return _3;},filter:function(_7){var _8=new dojox.dtl.Context();var _9=[];var i,_b;if(_7 instanceof dojox.dtl.Context){_9=_7.getKeys();}else{if(typeof _7=="object"){for(var _c in _7){_9.push(_c);}}else{for(i=0;_b=arguments[i];i++){if(typeof _b=="string"){_9.push(_b);}}}}for(i=0,_c;_c=_9[i];i++){_8[_c]=this[_c];}return _8;},setThis:function(_d){this._this=_d;},getThis:function(){return this._this;},hasKey:function(_e){if(typeof this[_e]!="undefined"){return true;}for(var i=0,_10;_10=this._dicts[i];i++){if(typeof _10[_e]!="undefined"){return true;}}return false;}});}