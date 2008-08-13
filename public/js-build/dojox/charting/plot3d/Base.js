/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.charting.plot3d.Base"]){dojo._hasResource["dojox.charting.plot3d.Base"]=true;dojo.provide("dojox.charting.plot3d.Base");dojo.require("dojox.charting.Chart3D");dojo.declare("dojox.charting.plot3d.Base",null,{constructor:function(_1,_2,_3){this.width=_1;this.height=_2;},setData:function(_4){this.data=_4?_4:[];return this;},getDepth:function(){return this.depth;},generate:function(_5,_6){}});}