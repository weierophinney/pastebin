/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.data.demos.stores.LazyLoadJSIStore"]){dojo._hasResource["dojox.data.demos.stores.LazyLoadJSIStore"]=true;dojo.provide("dojox.data.demos.stores.LazyLoadJSIStore");dojo.require("dojo.data.ItemFileReadStore");dojo.declare("dojox.data.demos.stores.LazyLoadJSIStore",dojo.data.ItemFileReadStore,{constructor:function(_1){},isItemLoaded:function(_2){if(this.getValue(_2,"type")==="stub"){return false;}return true;},loadItem:function(_3){var _4=_3.item;this._assertIsItem(_4);var _5=this.getValue(_4,"name");var _6=this.getValue(_4,"parent");var _7="";if(_6){_7+=(_6+"/");}_7+=_5+"/data.json";var _8=this;var _9=function(_a){delete _4.type;delete _4.parent;for(i in _a){if(dojo.isArray(_a[i])){_4[i]=_a[i];}else{_4[i]=[_a[i]];}}_8._arrayOfAllItems[_4[_8._itemNumPropName]]=_4;var _b=_8.getAttributes(_4);for(i in _b){var _c=_8.getValues(_4,_b[i]);for(var j=0;j<_c.length;j++){var _e=_c[j];if(typeof _e==="object"){if(_e["stub"]){var _f={type:["stub"],name:[_e["stub"]],parent:[_5]};if(_6){_f.parent[0]=_6+"/"+_f.parent[0];}_8._arrayOfAllItems.push(_f);_f[_8._storeRefPropName]=_8;_f[_8._itemNumPropName]=(_8._arrayOfAllItems.length-1);_c[j]=_f;}}}}if(_3.onItem){var _10=_3.scope?_3.scope:dojo.global;_3.onItem.call(_10,_4);}};var _11=function(_12){if(_3.onError){var _13=_3.scope?_3.scope:dojo.global;_3.onError.call(_13,_12);}};var _14={url:_7,handleAs:"json-comment-optional"};var d=dojo.xhrGet(_14);d.addCallback(_9);d.addErrback(_11);}});}