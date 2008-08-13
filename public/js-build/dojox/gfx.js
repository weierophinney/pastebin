/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.gfx"]){dojo._hasResource["dojox.gfx"]=true;dojo.provide("dojox.gfx");dojo.require("dojox.gfx.matrix");dojo.require("dojox.gfx._base");(function(){var _1=(typeof dojo.config["gfxRenderer"]=="string"?dojo.config["gfxRenderer"]:"svg,vml,silverlight,canvas").split(",");for(var i=0;i<_1.length;++i){switch(_1[i]){case "svg":if(!dojo.isIE&&(navigator.userAgent.indexOf("iPhone")<0)&&(navigator.userAgent.indexOf("iPod")<0)){dojox.gfx.renderer="svg";}break;case "vml":if(dojo.isIE!=0){dojox.gfx.renderer="vml";}break;case "silverlight":if(window.Silverlight){dojox.gfx.renderer="silverlight";}break;case "canvas":if(dojo.isIE==0){dojox.gfx.renderer="canvas";}break;}if(dojox.gfx.renderer){break;}}console.log("gfx renderer = "+dojox.gfx.renderer);})();dojo.requireIf(dojox.gfx.renderer=="svg","dojox.gfx.svg");dojo.requireIf(dojox.gfx.renderer=="vml","dojox.gfx.vml");dojo.requireIf(dojox.gfx.renderer=="silverlight","dojox.gfx.silverlight");dojo.requireIf(dojox.gfx.renderer=="canvas","dojox.gfx.canvas");}