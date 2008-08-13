/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.dtl.render.html"]){dojo._hasResource["dojox.dtl.render.html"]=true;dojo.provide("dojox.dtl.render.html");dojo.require("dojox.dtl.Context");dojox.dtl.render.html.sensitivity={NODE:1,ATTRIBUTE:2,TEXT:3};dojox.dtl.render.html.Render=function(_1,_2){this._tpl=_2;this.domNode=_1;this._swap=dojo.hitch(this,function(){if(this.domNode===this._tpl.getRootNode()){var _3=this.domNode;this.domNode=this.domNode.cloneNode(true);_3.parentNode.replaceChild(this.domNode,_3);}});};dojo.extend(dojox.dtl.render.html.Render,{sensitivity:dojox.dtl.render.html.sensitivity,setAttachPoint:function(_4){this.domNode=_4;},render:function(_5,_6,_7){if(!this.domNode){throw new Error("You cannot use the Render object without specifying where you want to render it");}_6=_6||this._tpl;_7=_7||_6.getBuffer();_5=_5||new dojox.dtl.Context();if(_5.getThis()&&_5.getThis().buffer==this.sensitivity.NODE){var _8=dojo.connect(_7,"onAddNode",this,"_swap");var _9=dojo.connect(_7,"onRemoveNode",this,"_swap");}if(this._tpl&&this._tpl!==_6){this._tpl.unrender(_5,_7);}this._tpl=_6;var _a=_6.render(_5,_7).getParent();if(!_a){throw new Error("Rendered template does not have a root node");}dojo.disconnect(_8);dojo.disconnect(_9);if(this.domNode!==_a){this.domNode.parentNode.replaceChild(_a,this.domNode);dojo._destroyElement(this.domNode);this.domNode=_a;}}});}