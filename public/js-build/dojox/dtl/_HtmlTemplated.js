/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.dtl._HtmlTemplated"]){dojo._hasResource["dojox.dtl._HtmlTemplated"]=true;dojo.provide("dojox.dtl._HtmlTemplated");dojo.require("dijit._Templated");dojo.require("dojox.dtl.html");dojo.require("dojox.dtl.render.html");dojo.require("dojox.dtl.contrib.dijit");dojox.dtl._HtmlTemplated={prototype:{_dijitTemplateCompat:false,buildRendering:function(){this.domNode=this.srcNodeRef;if(!this._render){var _1=dojox.dtl.contrib.dijit;var _2=_1.widgetsInTemplate;_1.widgetsInTemplate=this.widgetsInTemplate;this._template=this._getCachedTemplate(this.templatePath,this.templateString);this._render=new dojox.dtl.render.html.Render(this.domNode,this._template);_1.widgetsInTemplate=_2;}var _3=this;this._rendering=setTimeout(function(){_3.render();},10);},setTemplate:function(_4,_5){if(dojox.dtl.text._isTemplate(_4)){this._template=this._getCachedTemplate(null,_4);}else{this._template=this._getCachedTemplate(_4);}this.render(_5);},render:function(_6){if(this._rendering){clearTimeout(this._rendering);delete this._rendering;}this._render.render(this._getContext(_6));},_getContext:function(_7){if(!(_7 instanceof dojox.dtl.Context)){_7=false;}_7=_7||new dojox.dtl.Context(this);_7.setThis(this);return _7;},_getCachedTemplate:function(_8,_9){if(!this._templates){this._templates={};}var _a=_9||_8.toString();var _b=this._templates;if(_b[_a]){return _b[_a];}return (_b[_a]=new dojox.dtl.HtmlTemplate(dijit._Templated.getCachedTemplate(_8,_9,true)));}}};}