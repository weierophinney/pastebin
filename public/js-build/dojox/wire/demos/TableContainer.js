/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.wire.demos.TableContainer"]){dojo._hasResource["dojox.wire.demos.TableContainer"]=true;dojo.provide("dojox.wire.demos.TableContainer");dojo.require("dojo.parser");dojo.require("dijit._Widget");dojo.require("dijit._Templated");dojo.declare("dojox.wire.demos.TableContainer",[dijit._Widget,dijit._Templated,dijit._Container],{templateString:"<table class='tablecontainer'><tbody dojoAttachPoint='tableContainer'></tbody></table>",rowCount:0,headers:"",addRow:function(_1){try{var _2=document.createElement("tr");if((this.rowCount%2)===0){dojo.addClass(_2,"alternate");}this.rowCount++;for(var i in _1){var _4=document.createElement("td");var _5=document.createTextNode(_1[i]);_4.appendChild(_5);_2.appendChild(_4);}this.tableContainer.appendChild(_2);}catch(e){console.debug(e);}},clearTable:function(){while(this.tableContainer.firstChild.nextSibling){this.tableContainer.removeChild(this.tableContainer.firstChild.nextSibling);}this.rowCount=0;},postCreate:function(){var _6=this.headers.split(",");var tr=document.createElement("tr");for(i in _6){var _8=_6[i];var th=document.createElement("th");var _a=document.createTextNode(_8);th.appendChild(_a);tr.appendChild(th);}this.tableContainer.appendChild(tr);}});}