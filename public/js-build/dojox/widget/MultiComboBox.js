/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.widget.MultiComboBox"]){dojo._hasResource["dojox.widget.MultiComboBox"]=true;dojo.provide("dojox.widget.MultiComboBox");dojo.experimental("dojox.widget.MultiComboBox");dojo.require("dijit.form.ComboBox");dojo.require("dijit.form.ValidationTextBox");dojo.declare("dojox.widget.MultiComboBox",[dijit.form.ValidationTextBox,dijit.form.ComboBoxMixin],{delimiter:",",_previousMatches:false,setValue:function(_1){if(this.delimiter&&_1.length!=0){_1=_1+this.delimiter+" ";arguments[0]=this._addPreviousMatches(_1);}this.inherited(arguments);},_addPreviousMatches:function(_2){if(this._previousMatches){if(!_2.match(new RegExp("^"+this._previousMatches))){_2=this._previousMatches+_2;}_2=this._cleanupDelimiters(_2);}return _2;},_cleanupDelimiters:function(_3){if(this.delimiter){_3=_3.replace(new RegExp("  +")," ");_3=_3.replace(new RegExp("^ *"+this.delimiter+"* *"),"");_3=_3.replace(new RegExp(this.delimiter+" *"+this.delimiter),this.delimiter);}return _3;},_autoCompleteText:function(_4){arguments[0]=this._addPreviousMatches(_4);this.inherited(arguments);},_startSearch:function(_5){_5=this._cleanupDelimiters(_5);var re=new RegExp("^.*"+this.delimiter+" *");if(this._previousMatches=_5.match(re)){arguments[0]=_5.replace(re,"");}this.inherited(arguments);}});}