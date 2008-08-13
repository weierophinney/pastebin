/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.widget.FisheyeLite"]){dojo._hasResource["dojox.widget.FisheyeLite"]=true;dojo.provide("dojox.widget.FisheyeLite");dojo.experimental("dojox.widget.FisheyeLite");dojo.require("dijit._Widget");dojo.require("dojox.fx.easing");dojo.declare("dojox.widget.FisheyeLite",dijit._Widget,{durationIn:350,easeIn:dojox.fx.easing.backOut,durationOut:1420,easeOut:dojox.fx.easing.elasticOut,properties:{fontSize:2.75},unit:"px",postCreate:function(){this.inherited(arguments);this._target=dojo.query(".fisheyeTarget",this.domNode)[0]||this.domNode;this._makeAnims();this.connect(this.domNode,"onmouseover","show");this.connect(this.domNode,"onmouseout","hide");this.connect(this._target,"onclick","onClick");},show:function(){this._runningOut.stop();this._runningIn.play();},hide:function(){this._runningIn.stop();this._runningOut.play();},_makeAnims:function(){var _1={};var _2={};var cs=dojo.getComputedStyle(this._target);for(var p in this.properties){var v=parseInt(cs[p]);_2[p]={end:v,unit:this.unit};_1[p]={end:(this.properties[p]*v),unit:this.unit};}this._runningIn=dojo.animateProperty({node:this._target,easing:this.easeIn,duration:this.durationIn,properties:_1});this._runningOut=dojo.animateProperty({node:this._target,duration:this.durationOut,easing:this.easeOut,properties:_2});this.connect(this._runningIn,"onEnd",dojo.hitch(this,"onSelected",this));},onClick:function(e){},onSelected:function(e){}});}