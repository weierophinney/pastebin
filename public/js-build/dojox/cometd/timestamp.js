/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.cometd.timestamp"]){dojo._hasResource["dojox.cometd.timestamp"]=true;dojo.provide("dojox.cometd.timestamp");dojo.require("dojox.cometd");dojox.cometd._extendOutList.push(function(_1){_1.timestamp=new Date().toUTCString();return _1;});}