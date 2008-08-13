/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.crypto.MD5"]){dojo._hasResource["dojox.crypto.MD5"]=true;dojo.provide("dojox.crypto.MD5");dojo.require("dojox.encoding.digests.MD5");dojo.deprecated("dojox.crypto.MD5.compute","DojoX cryptography has been merged into DojoX Encoding. To use MD5, include dojox.encoding.digests.MD5.","1.2");dojox.crypto.MD5.compute=dojox.encoding.digests.MD5;}