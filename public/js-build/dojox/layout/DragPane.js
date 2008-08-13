/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.layout.DragPane"]){dojo._hasResource["dojox.layout.DragPane"]=true;dojo.provide("dojox.layout.DragPane");dojo.require("dijit._Widget");dojo.declare("dojox.layout.DragPane",dijit._Widget,{invert:true,postCreate:function(){this.inherited(arguments);this.connect(this.domNode,"onmousedown","_down");this.connect(this.domNode,"onmouseup","_up");},_down:function(e){var t=this.domNode;dojo.style(t,"cursor","move");this._x=e.pageX;this._y=e.pageY;if((this._x<t.offsetLeft+t.clientWidth)&&(this._y<t.offsetTop+t.clientHeight)){dojo.setSelectable(t,false);this._mover=dojo.connect(t,"onmousemove",this,"_move");}},_up:function(e){dojo.setSelectable(this.domNode,true);dojo.style(this.domNode,"cursor","pointer");dojo.disconnect(this._mover);},_move:function(e){var _5=this.invert?1:-1;this.domNode.scrollTop+=(this._y-e.pageY)*_5;this.domNode.scrollLeft+=(this._x-e.pageX)*_5;this._x=e.pageX;this._y=e.pageY;}});}