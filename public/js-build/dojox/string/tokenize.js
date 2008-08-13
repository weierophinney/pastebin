/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.string.tokenize"]){dojo._hasResource["dojox.string.tokenize"]=true;dojo.provide("dojox.string.tokenize");dojox.string.tokenize=function(_1,re,_3,_4){var _5=[];var _6,_7,_8=0;while(_6=re.exec(_1)){_7=_1.slice(_8,re.lastIndex-_6[0].length);if(_7.length){_5.push(_7);}if(_3){if(dojo.isOpera){var _9=_6.slice(0);while(_9.length<_6.length){_9.push(null);}_6=_9;}var _a=_3.apply(_4,_6.slice(1).concat(_5.length));if(typeof _a!="undefined"){_5.push(_a);}}_8=re.lastIndex;}_7=_1.slice(_8);if(_7.length){_5.push(_7);}return _5;};}