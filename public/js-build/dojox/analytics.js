/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.analytics"]){dojo._hasResource["dojox.analytics"]=true;dojo.provide("dojox.analytics");dojo.require("dojox.analytics._base");dojo.require("dojo._base.connect");dojo.require("dojo._base.Deferred");dojo.require("dojo._base.json");dojo.require("dojo._base.array");dojo.requireIf(dojo.isBrowser,"dojo._base.window");dojo.requireIf(dojo.isBrowser,"dojo._base.event");dojo.requireIf(dojo.isBrowser,"dojo._base.html");dojo.requireIf(dojo.isBrowser,"dojo._base.NodeList");dojo.requireIf(dojo.isBrowser,"dojo._base.query");dojo.requireIf(dojo.isBrowser,"dojo._base.xhr");}