/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.dtl.tag.date"]){dojo._hasResource["dojox.dtl.tag.date"]=true;dojo.provide("dojox.dtl.tag.date");dojo.require("dojox.dtl._base");dojo.require("dojox.dtl.utils.date");dojox.dtl.tag.date.NowNode=function(_1,_2){this.format=new dojox.dtl.utils.date.DateFormat(_1);this.contents=new _2("");};dojo.extend(dojox.dtl.tag.date.NowNode,{render:function(_3,_4){this.contents.set(this.format.format(new Date()));return this.contents.render(_3,_4);}});dojox.dtl.tag.date.now=function(_5,_6){var _7=_6.split((_6.substring(0,5)=="now '")?"'":"\"");if(_7.length!=3){throw new Error("'now' statement takes one argument");}var _8=_7[1];return new dojox.dtl.tag.date.NowNode(_8,_5.getTextNodeConstructor());};}