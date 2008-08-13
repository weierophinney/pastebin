/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.rpc.JsonRPC"]){dojo._hasResource["dojox.rpc.JsonRPC"]=true;dojo.provide("dojox.rpc.JsonRPC");dojox.rpc.envelopeRegistry.register("JSON-RPC-1.0",function(_1){return _1=="JSON-RPC-1.0";},{serialize:function(_2,_3,_4,_5){var d=dojox.rpc.toOrdered(_3,_4);d=dojox.rpc.toJson({id:this._requestId++,method:_3.name,params:d});return {data:d,contentType:"application/json",transport:"POST"};},deserialize:function(_7){var _8=dojox.rpc.resolveJson(_7);if(_8.error){var e=new Error(_8.error);e._rpcErrorObject=_8.error;return e;}return _8.result||true;}});dojox.rpc.envelopeRegistry.register("JSON-RPC-1.2",function(_a){return _a=="JSON-RPC-1.2";},{serialize:function(_b,_c,_d,_e){var _f=_c.transport||_b.transport||"POST";var d=dojox.rpc.toNamed(_c,_d);d=dojox.rpc.toJson({id:this._requestId++,method:_c.name,params:_d});return {data:d,contentType:"application/json",transport:"POST"};},deserialize:function(_11){var obj=dojox.rpc.resolveJson(_11);if(obj.error){var e=new Error(obj.error.message);e._rpcErrorObject=obj.error;return e;}return obj.result||true;}});}