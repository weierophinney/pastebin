/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.grid._grid.layout"]){dojo._hasResource["dojox.grid._grid.layout"]=true;dojo.provide("dojox.grid._grid.layout");dojo.require("dojox.grid._grid.cell");dojo.declare("dojox.grid.layout",null,{constructor:function(_1){this.grid=_1;},cells:[],structure:null,defaultWidth:"6em",setStructure:function(_2){this.fieldIndex=0;this.cells=[];var s=this.structure=[];for(var i=0,_5,_6;(_5=_2[i]);i++){s.push(this.addViewDef(_5));}this.cellCount=this.cells.length;},addViewDef:function(_7){this._defaultCellProps=_7.defaultCell||{};return dojo.mixin({},_7,{rows:this.addRowsDef(_7.rows||_7.cells)});},addRowsDef:function(_8){var _9=[];for(var i=0,_b;_8&&(_b=_8[i]);i++){_9.push(this.addRowDef(i,_b));}return _9;},addRowDef:function(_c,_d){var _e=[];for(var i=0,def,_11;(def=_d[i]);i++){_11=this.addCellDef(_c,i,def);_e.push(_11);this.cells.push(_11);}return _e;},addCellDef:function(_12,_13,_14){var w=0;if(_14.colSpan>1){w=0;}else{if(!isNaN(_14.width)){w=_14.width+"em";}else{w=_14.width||this.defaultWidth;}}var _16=_14.field!=undefined?_14.field:(_14.get?-1:this.fieldIndex);if((_14.field!=undefined)||!_14.get){this.fieldIndex=(_14.field>-1?_14.field:this.fieldIndex)+1;}return new dojox.grid.cell(dojo.mixin({},this._defaultCellProps,_14,{grid:this.grid,subrow:_12,layoutIndex:_13,index:this.cells.length,fieldIndex:_16,unitWidth:w}));}});}