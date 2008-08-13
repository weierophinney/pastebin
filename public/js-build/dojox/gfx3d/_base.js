/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.gfx3d._base"]){dojo._hasResource["dojox.gfx3d._base"]=true;dojo.provide("dojox.gfx3d._base");dojo.mixin(dojox.gfx3d,{defaultEdges:{type:"edges",style:null,points:[]},defaultTriangles:{type:"triangles",style:null,points:[]},defaultQuads:{type:"quads",style:null,points:[]},defaultOrbit:{type:"orbit",center:{x:0,y:0,z:0},radius:50},defaultPath3d:{type:"path3d",path:[]},defaultPolygon:{type:"polygon",path:[]},defaultCube:{type:"cube",bottom:{x:0,y:0,z:0},top:{x:100,y:100,z:100}},defaultCylinder:{type:"cylinder",center:{x:0,y:0,z:0},height:100,radius:50}});}