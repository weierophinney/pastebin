/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.dtl.contrib.data"]){dojo._hasResource["dojox.dtl.contrib.data"]=true;dojo.provide("dojox.dtl.contrib.data");dojo.require("dojox.dtl._base");(function(){var dd=dojox.dtl;var _2=dd.contrib.data;_2._BoundItem=dojo.extend(function(_3,_4){this.item=_3;this.store=_4;},{get:function(_5){var _6=this.store;var _7=this.item;if(_5=="getLabel"){return _6.getLabel(_7);}else{if(_5=="getAttributes"){return _6.getAttributes(_7);}else{if(_5=="getIdentity"){if(_6.getIdentity){return _6.getIdentity(_7);}return "Store has no identity API";}else{if(_6.hasAttribute(_7,_5)){var _8=_6.getValue(_7,_5);return (dojo.isObject(_8)&&_6.isItem(_8))?new _2._BoundItem(_8,_6):_8;}else{if(_5.slice(-1)=="s"&&_6.hasAttribute(_7,_5.slice(0,-1))){return dojo.map(_6.getValues(_7,_5.slice(0,-1)),function(_9){return (dojo.isObject(_9)&&_6.isItem(_9))?new _2._BoundItem(_9,_6):_9;});}}}}}}});_2.BindDataNode=dojo.extend(function(_a,_b,_c){this.items=new dd._Filter(_a);this.store=new dd._Filter(_b);this.alias=_c;},{render:function(_d,_e){var _f=this.items.resolve(_d);var _10=this.store.resolve(_d);if(!_10){throw new Error("data_bind didn't receive a store");}var _11=[];if(_f){for(var i=0,_13;_13=_f[i];i++){_11.push(new _2._BoundItem(_13,_10));}}_d[this.alias]=_11;return _e;},unrender:function(_14,_15){return _15;},clone:function(){return this;}});dojo.mixin(_2,{bind_data:function(_16,_17){var _18=dd.text.pySplit(_17);if(_18[2]!="to"||_18[4]!="as"||!_18[5]){throw new Error("data_bind expects the format: 'data_bind items to store as varName'");}return new _2.BindDataNode(_18[1],_18[3],_18[5]);}});dd.register.tags("dojox.dtl.contrib",{"data":["bind_data"]});})();}