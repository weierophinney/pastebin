/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.sketch._Plugin"]){dojo._hasResource["dojox.sketch._Plugin"]=true;dojo.provide("dojox.sketch._Plugin");dojo.require("dijit.form.Button");dojo.declare("dojox.sketch._Plugin",null,{constructor:function(_1){if(_1){dojo.mixin(this,_1);}this._connects=[];},figure:null,iconClassPrefix:"dojoxSketchIcon",itemGroup:"toolsGroup",button:null,queryCommand:null,shape:"",useDefaultCommand:true,buttonClass:dijit.form.ToggleButton,_initButton:function(){if(this.shape.length){var _2=this.iconClassPrefix+" "+this.iconClassPrefix+this.shape.charAt(0).toUpperCase()+this.shape.substr(1);if(!this.button){var _3={label:this.shape,showLabel:false,iconClass:_2,dropDown:this.dropDown,tabIndex:"-1"};this.button=new this.buttonClass(_3);this.connect(this.button,"onClick","activate");}}},attr:function(_4,_5){if(arguments.length>1){this.button.setAttribute(_4,_5);}else{this.button.getAttribute(_4);}},onActivate:function(){},activate:function(e){this.onActivate();this.figure.setTool(this);this.attr("checked",true);},onMouseDown:function(e){},onMouseMove:function(e){},onMouseUp:function(e){},destroy:function(f){dojo.forEach(this._connects,dojo.disconnect);},connect:function(o,f,tf){this._connects.push(dojo.connect(o,f,this,tf));},setFigure:function(_e){this.figure=_e;this._initButton();},setToolbar:function(_f){if(this.button){_f.addChild(this.button);}if(this.itemGroup){_f.addGroupItem(this,this.itemGroup);}}});}