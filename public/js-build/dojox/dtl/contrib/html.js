/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.dtl.contrib.html"]){dojo._hasResource["dojox.dtl.contrib.html"]=true;dojo.provide("dojox.dtl.contrib.html");dojo.require("dojox.dtl.html");(function(){var dd=dojox.dtl;var _2=dd.contrib.html;_2.HtmlNode=dojo.extend(function(_3){this.contents=new dd._Filter(_3);this._div=document.createElement("div");this._lasts=[];},{render:function(_4,_5){var _6=this.contents.resolve(_4);if(_6){_6=_6.replace(/<(\/?script)/ig,"&lt;$1").replace(/\bon[a-z]+\s*=/ig,"");if(this._rendered&&this._last!=_6){_5=this.unrender(_4,_5);}this._last=_6;if(!this._rendered){this._rendered=true;var _7=this._div;_7.innerHTML=_6;var _8=_7.childNodes;while(_8.length){var _9=_7.removeChild(_8[0]);this._lasts.push(_9);_5=_5.concat(_9);}}}return _5;},unrender:function(_a,_b){if(this._rendered){this._rendered=false;this._last="";for(var i=0,_d;_d=this._lasts[i++];){_b=_b.remove(_d);dojo._destroyElement(_d);}this._lasts=[];}return _b;},clone:function(_e){return new this.constructor(this.contents.getExpression());}});_2.StyleNode=dojo.extend(function(_f){this.contents={};this._styles=_f;for(var key in _f){this.contents[key]=new dd.Template(_f[key]);}},{render:function(_11,_12){for(var key in this.contents){dojo.style(_12.getParent(),key,this.contents[key].render(_11));}return _12;},unrender:function(_14,_15){return _15;},clone:function(_16){return new this.constructor(this._styles);}});dojo.mixin(_2,{html:function(_17,_18){var _19=_18.split(" ",2);return new _2.HtmlNode(_19[1]);},tstyle:function(_1a,_1b){var _1c={};_1b=_1b.replace(/^tstyle\s+/,"");var _1d=_1b.split(/\s*;\s*/g);for(var i=0,_1f;_1f=_1d[i];i++){var _20=_1f.split(/\s*:\s*/g);var key=_20[0];var _22=_20[1];if(_22.indexOf("{{")==0){_1c[key]=_22;}}return new _2.StyleNode(_1c);}});dd.register.tags("dojox.dtl.contrib",{"html":["html","attr:tstyle"]});})();}