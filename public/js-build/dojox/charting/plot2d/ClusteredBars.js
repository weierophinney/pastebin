/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.charting.plot2d.ClusteredBars"]){dojo._hasResource["dojox.charting.plot2d.ClusteredBars"]=true;dojo.provide("dojox.charting.plot2d.ClusteredBars");dojo.require("dojox.charting.plot2d.common");dojo.require("dojox.charting.plot2d.Bars");dojo.require("dojox.lang.functional");dojo.require("dojox.lang.functional.reversed");(function(){var df=dojox.lang.functional,dc=dojox.charting.plot2d.common,_3=df.lambda("item.purgeGroup()");dojo.declare("dojox.charting.plot2d.ClusteredBars",dojox.charting.plot2d.Bars,{render:function(_4,_5){if(this.dirty){dojo.forEach(this.series,_3);this.cleanGroup();var s=this.group;df.forEachRev(this.series,function(_7){_7.cleanGroup(s);});}var t=this.chart.theme,_9,_a,_b,f,_d=this.opt.gap<this._vScaler.scale/3?this.opt.gap:0,_e=(this._vScaler.scale-2*_d)/this.series.length;for(var i=this.series.length-1;i>=0;--i){var run=this.series[i];if(!this.dirty&&!run.dirty){continue;}run.cleanGroup();var s=run.group;if(!run.fill||!run.stroke){_9=run.dyn.color=new dojo.Color(t.next("color"));}_a=run.stroke?run.stroke:dc.augmentStroke(t.series.stroke,_9);_b=run.fill?run.fill:dc.augmentFill(t.series.fill,_9);var _11=Math.max(0,this._hScaler.bounds.lower),_12=_5.l+this._hScaler.scale*(_11-this._hScaler.bounds.lower),_13=_4.height-_5.b-this._vScaler.scale*(1.5-this._vScaler.bounds.lower)+_d+_e*(this.series.length-i-1);for(var j=0;j<run.data.length;++j){var v=run.data[j],_16=this._hScaler.scale*(v-_11),_17=_e,w=Math.abs(_16);if(w>=1&&_17>=1){var _19=s.createRect({x:_12+(_16<0?_16:0),y:_13-this._vScaler.scale*j,width:w,height:_17}).setFill(_b).setStroke(_a);run.dyn.fill=_19.getFill();run.dyn.stroke=_19.getStroke();}}run.dirty=false;}this.dirty=false;return this;}});})();}