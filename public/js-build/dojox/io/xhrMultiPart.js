/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.io.xhrMultiPart"]){dojo._hasResource["dojox.io.xhrMultiPart"]=true;dojo.provide("dojox.io.xhrMultiPart");dojo.require("dojo._base.xhr");dojo.require("dojox.uuid.generateRandomUuid");(function(){function _createPart(_1,_2){if(!_1["name"]&&!_1["content"]){throw new Error("Each part of a multi-part request requires 'name' and 'content'.");}var _3=[];_3.push("--"+_2,"Content-Disposition: form-data; name=\""+_1.name+"\""+(_1["filename"]?"; filename=\""+_1.filename+"\"":""));if(_1["contentType"]){var ct="Content-Type: "+_1.contentType;if(_1["charset"]){ct+="; Charset="+_1.charset;}_3.push(ct);}if(_1["contentTransferEncoding"]){_3.push("Content-Transfer-Encoding: "+_1.contentTransferEncoding);}_3.push("",_1.content);return _3;};function _needIframe(_5){return (!!(dojo.query("input[type=file]",_5).length));};function _partsFromNode(_6,_7){var _8=[];return _8;};dojox.io.xhrMultiPart=function(_9){if(!_9["file"]&&!_9["form"]){throw new Error("file or form must be provided to dojox.io.xhrMultiPart's arguments");}var _a=dojox.uuid.generateRandomUuid();var _b=[];var _c="";if(_9["file"]){var d=(dojo.isArray(_9.file)?_9.file:[_9.file]);for(var i=0;i<d.length;i++){_b=_b.concat(_createPart(d[i],_a));}}if(_9["form"]){_b=_b.concat(_partsFromNode(_9["form"],_a));}if(_b.length){_b.push("--"+_a+"--","");_c=_b.join("\r\n");}return dojo.rawXhrPost(dojo.mixin(_9,{contentType:"multipart/form-data; boundary="+_a,postData:_c}));};})();}