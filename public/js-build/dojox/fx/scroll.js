/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.fx.scroll"]){dojo._hasResource["dojox.fx.scroll"]=true;dojo.provide("dojox.fx.scroll");dojo.experimental("dojox.fx.scroll");dojo.require("dojox.fx._core");dojox.fx.smoothScroll=function(_1){if(!_1.target){_1.target=dojo.coords(_1.node,true);}var _2=dojo[(dojo.isIE?"isObject":"isFunction")](_1["win"].scrollTo);var _3=(_2)?(function(_4){_1.win.scrollTo(_4[0],_4[1]);}):(function(_5){_1.win.scrollLeft=_5[0];_1.win.scrollTop=_5[1];});var _6=new dojo._Animation(dojo.mixin({beforeBegin:function(){if(this.curve){delete this.curve;}var _7=_2?dojo._docScroll():{x:_1.win.scrollLeft,y:_1.win.scrollTop};_6.curve=new dojox.fx._Line([_7.x,_7.y],[_1.target.x,_1.target.y]);},onAnimate:_3},_1));return _6;};}