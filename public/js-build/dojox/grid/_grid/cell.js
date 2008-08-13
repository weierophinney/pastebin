/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.grid._grid.cell"]){dojo._hasResource["dojox.grid._grid.cell"]=true;dojo.provide("dojox.grid._grid.cell");dojo.declare("dojox.grid.cell",null,{styles:"",constructor:function(_1){dojo.mixin(this,_1);if(this.editor){this.editor=new this.editor(this);}},format:function(_2){var f,i=this.grid.edit.info,d=this.get?this.get(_2):this.value;if(this.editor&&(this.editor.alwaysOn||(i.rowIndex==_2&&i.cell==this))){return this.editor.format(d,_2);}else{return (f=this.formatter)?f.call(this,d,_2):d;}},getNode:function(_6){return this.view.getCellNode(_6,this.index);},isFlex:function(){var uw=this.unitWidth;return uw&&(uw=="auto"||uw.slice(-1)=="%");},applyEdit:function(_8,_9){this.grid.edit.applyCellEdit(_8,this,_9);},cancelEdit:function(_a){this.grid.doCancelEdit(_a);},_onEditBlur:function(_b){if(this.grid.edit.isEditCell(_b,this.index)){this.grid.edit.apply();}},registerOnBlur:function(_c,_d){if(this.commitOnBlur){dojo.connect(_c,"onblur",function(e){setTimeout(dojo.hitch(this,"_onEditBlur",_d),250);});}}});}