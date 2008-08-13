/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


dojox.av.flash.place=function(_1,_2){_1=dojo.byId(_1);var o=dojox.av.flash.__ie_markup__(_2);if(o){_1.innerHTML=o.markup;return window[o.id];}return null;};if(dojo._initFired){dojox.av.flash.onInitialize();}else{dojo.addOnLoad(function(){dojox.av.flash.onInitialize();});}