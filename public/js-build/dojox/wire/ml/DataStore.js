/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.wire.ml.DataStore"]){dojo._hasResource["dojox.wire.ml.DataStore"]=true;dojo.provide("dojox.wire.ml.DataStore");dojo.require("dijit._Widget");dojo.require("dojox.wire._base");dojo.declare("dojox.wire.ml.DataStore",dijit._Widget,{storeClass:"",postCreate:function(){this.store=this._createStore();},_createStore:function(){if(!this.storeClass){return null;}var _1=dojox.wire._getClass(this.storeClass);if(!_1){return null;}var _2={};var _3=this.domNode.attributes;for(var i=0;i<_3.length;i++){var a=_3.item(i);if(a.specified&&!this[a.nodeName]){_2[a.nodeName]=a.nodeValue;}}return new _1(_2);},getFeatures:function(){return this.store.getFeatures();},fetch:function(_6){return this.store.fetch(_6);},save:function(_7){this.store.save(_7);},newItem:function(_8){return this.store.newItem(_8);},deleteItem:function(_9){return this.store.deleteItem(_9);},revert:function(){return this.store.revert();}});}