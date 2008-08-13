/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.grid._grid.rowbar"]){dojo._hasResource["dojox.grid._grid.rowbar"]=true;dojo.provide("dojox.grid._grid.rowbar");dojo.require("dojox.grid._grid.view");dojo.declare("dojox.GridRowView",dojox.GridView,{defaultWidth:"3em",noscroll:true,padBorderWidth:2,buildRendering:function(){this.inherited("buildRendering",arguments);this.scrollboxNode.style.overflow="hidden";this.headerNode.style.visibility="hidden";},getWidth:function(){return this.viewWidth||this.defaultWidth;},buildRowContent:function(_1,_2){var w=this.contentNode.offsetWidth-this.padBorderWidth;_2.innerHTML="<table style=\"width:"+w+"px;\" role=\"wairole:presentation\"><tr><td class=\"dojoxGrid-rowbar-inner\"></td></tr></table>";},renderHeader:function(){},resize:function(){this.adaptHeight();},adaptWidth:function(){},doStyleRowNode:function(_4,_5){var n=["dojoxGrid-rowbar"];if(this.grid.rows.isOver(_4)){n.push("dojoxGrid-rowbar-over");}if(this.grid.selection.isSelected(_4)){n.push("dojoxGrid-rowbar-selected");}_5.className=n.join(" ");},domouseover:function(e){this.grid.onMouseOverRow(e);},domouseout:function(e){if(!this.isIntraRowEvent(e)){this.grid.onMouseOutRow(e);}}});}