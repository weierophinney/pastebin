/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.rpc.Rest"]){dojo._hasResource["dojox.rpc.Rest"]=true;dojo.provide("dojox.rpc.Rest");dojo.require("dojox.rpc.Service");dojox.rpc._restMethods={put:function(r){r.url=r.target+"?"+r.data;r.putData=dojox.rpc._restMethods.sendData;return dojo.rawXhrPut(r);},post:function(r){r.url=r.target+"?"+r.data;r.postData=dojox.rpc._restMethods.sendData;var _3=dojo.rawXhrPost(r);var _4=dojox.rpc._restMethods.sendObj;return _3;},"delete":function(r){r.url=r.target+"?"+r.data;return dojo.xhrDelete(r);}};dojox.rpc._restMethods.put.sender=dojox.rpc._restMethods.post.sender=true;dojox.rpc.transportRegistry.register("REST",function(_6){return _6=="REST";},{fire:function(r){r.url=r.target+(r.data?"?"+r.data:"");var _8=dojo.xhrGet(r);var _9=dojox.rpc._restQuery;_8.addCallback(function(_a){dojox._newId=_9;delete dojox.rpc._restQuery;return _a;});return _8;},getExecutor:function(_b,_c,_d){var _e=function(id){dojox.rpc._restQuery=id;return _b.apply(this,arguments);};var _10=dojox.rpc._restMethods;for(var i in _10){_e[i]=(function(){var _12=_10[i];return function(){if(_12.sender){var _13=dojox.rpc._restMethods.sendObj=arguments[--arguments.length];var _14=((_c.contentType||_d._smd.contentType)+"").match(/application\/json/);dojox.rpc._restMethods.sendData=_14?dojox.rpc.toJson(_13,false,_c._schema||_c.returns):_13;}for(var j=arguments.length++;j>0;j--){arguments[j]=arguments[j-1];}arguments[0]=dojo.mixin({restMethod:_12},_c);return _d._executeMethod.apply(_d,arguments);};})();}_e.contentType=_c.contentType||_d._smd.contentType;return _e;},restMethods:dojox.rpc._restMethods});}