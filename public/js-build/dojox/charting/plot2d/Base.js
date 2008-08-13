/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.charting.plot2d.Base"]){dojo._hasResource["dojox.charting.plot2d.Base"]=true;dojo.provide("dojox.charting.plot2d.Base");dojo.require("dojox.charting.Element");dojo.require("dojox.charting.plot2d.common");dojo.declare("dojox.charting.plot2d.Base",dojox.charting.Element,{clear:function(){this.series=[];this._hAxis=null;this._vAxis=null;this.dirty=true;return this;},setAxis:function(_1){if(_1){this[_1.vertical?"_vAxis":"_hAxis"]=_1;}return this;},addSeries:function(_2){this.series.push(_2);return this;},calculateAxes:function(_3){return this;},render:function(_4,_5){return this;},getRequiredColors:function(){return this.series.length;},_calc:function(_6,_7){if(this._hAxis){if(!this._hAxis.initialized()){this._hAxis.calculate(_7.hmin,_7.hmax,_6.width);}this._hScaler=this._hAxis.getScaler();}else{this._hScaler={bounds:{lower:_7.hmin,upper:_7.hmax},scale:_6.width/(_7.hmax-_7.hmin)};}if(this._vAxis){if(!this._vAxis.initialized()){this._vAxis.calculate(_7.vmin,_7.vmax,_6.height);}this._vScaler=this._vAxis.getScaler();}else{this._vScaler={bounds:{lower:_7.vmin,upper:_7.vmax},scale:_6.height/(_7.vmax-_7.vmin)};}}});}