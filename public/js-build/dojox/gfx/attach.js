/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


dojo.require("dojox.gfx");dojo.requireIf(dojox.gfx.renderer=="svg","dojox.gfx.svg_attach");dojo.requireIf(dojox.gfx.renderer=="vml","dojox.gfx.vml_attach");dojo.requireIf(dojox.gfx.renderer=="silverlight","dojox.gfx.silverlight_attach");dojo.requireIf(dojox.gfx.renderer=="canvas","dojox.gfx.canvas_attach");