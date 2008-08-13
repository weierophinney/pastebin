/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.data.CouchDBRestStore"]){dojo._hasResource["dojox.data.CouchDBRestStore"]=true;dojo.provide("dojox.data.CouchDBRestStore");dojo.require("dojox.data.JsonRestStore");dojo.require("dojox.json.ref");dojo.declare("dojox.data.CouchDBRestStore",dojox.data.JsonRestStore,{_commitAppend:function(_1,_2){var _3=this.service.post(_1,_2);var _4=this.service.serviceName+"/";_3.addCallback(function(_5){_2._id=_4+_5.id;_2._rev=_5.rev;return _5;});return _3;},fetch:function(_6){if(typeof _6=="string"){_6={query:"_all_docs?"+_6};}else{if(typeof _6.query=="string"){_6.query="_all_docs?"+_6.query;}else{_6.query="_all_docs?";}}if(_6.start){_6.query=(_6.query?(_6.query+"&"):"")+"skip="+_6.start;delete _6.start;}if(_6.count){_6.query=(_6.query?(_6.query+"&"):"")+"count="+_6.count;delete _6.count;}var _7=this.service.serviceName+"/";var _8=_6.onComplete;_6.onComplete=function(_9){if(_9.rows){for(var i=0;i<_9.rows.length;i++){var _b=_9.rows[i];_b._id=_7+(_b.$ref=_b.id);}}if(_8){_8.apply(this,arguments);}};return dojox.data.JsonRestStore.prototype.fetch.call(this,_6);}});dojox.data.CouchDBRestStore.generateSMD=function(_c){var _d={contentType:"application/json",transport:"REST",envelope:"PATH",services:{},target:_c,};var _e=dojo.xhrGet({url:_c+"_all_dbs",handleAs:"json",sync:true});_e.addCallback(function(_f){for(var i=0;i<_f.length;i++){_d.services[_f[i]]={target:_f[i],returns:{},parameters:[{type:"string"}]};}});return _d;};}