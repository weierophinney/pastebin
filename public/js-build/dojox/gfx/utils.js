/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.gfx.utils"]){dojo._hasResource["dojox.gfx.utils"]=true;dojo.provide("dojox.gfx.utils");dojo.require("dojox.gfx");dojox.gfx.utils.serialize=function(_1){var t={},v,_4=_1 instanceof dojox.gfx.Surface;if(_4||_1 instanceof dojox.gfx.Group){t.children=[];for(var i=0;i<_1.children.length;++i){t.children.push(dojox.gfx.utils.serialize(_1.children[i]));}if(_4){return t.children;}}else{t.shape=_1.getShape();}if(_1.getTransform){v=_1.getTransform();if(v){t.transform=v;}}if(_1.getStroke){v=_1.getStroke();if(v){t.stroke=v;}}if(_1.getFill){v=_1.getFill();if(v){t.fill=v;}}if(_1.getFont){v=_1.getFont();if(v){t.font=v;}}return t;};dojox.gfx.utils.toJson=function(_6,_7){return dojo.toJson(dojox.gfx.utils.serialize(_6),_7);};dojox.gfx.utils.deserialize=function(_8,_9){if(_9 instanceof Array){var t=[];for(var i=0;i<_9.length;++i){t.push(dojox.gfx.utils.deserialize(_8,_9[i]));}return t;}var _c=("shape" in _9)?_8.createShape(_9.shape):_8.createGroup();if("transform" in _9){_c.setTransform(_9.transform);}if("stroke" in _9){_c.setStroke(_9.stroke);}if("fill" in _9){_c.setFill(_9.fill);}if("font" in _9){_c.setFont(_9.font);}if("children" in _9){for(var i=0;i<_9.children.length;++i){dojox.gfx.utils.deserialize(_c,_9.children[i]);}}return _c;};dojox.gfx.utils.fromJson=function(_d,_e){return dojox.gfx.utils.deserialize(_d,dojo.fromJson(_e));};}