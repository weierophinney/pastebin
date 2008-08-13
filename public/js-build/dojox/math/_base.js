/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.math._base"]){dojo._hasResource["dojox.math._base"]=true;dojo.provide("dojox.math._base");dojo.mixin(dojox.math,{degreesToRadians:function(n){return (n*Math.PI)/180;},radiansToDegrees:function(n){return (n*180)/Math.PI;},factoral:function(n){if(n<1){return 0;}var _4=1;for(var i=1;i<=n;i++){_4*=i;}return _4;},permutations:function(n,k){if(n==0||k==0){return 1;}return (this.factoral(n)/this.factoral(n-k));},combinations:function(n,r){if(n==0||r==0){return 1;}return (this.factoral(n)/(this.factoral(n-r)*this.factoral(r)));},bernstein:function(t,n,i){return (this.combinations(n,i)*Math.pow(t,i)*Math.pow(1-t,n-i));},gaussian:function(){var k=2;do{var i=2*Math.random()-1;var j=2*Math.random()-1;k=i*i+j*j;}while(k>=1);return (i*Math.sqrt((-2*Math.log(k))/k));},sd:function(a){return Math.sqrt(this.variance(a));},variance:function(a){var _12=0,_13=0;dojo.forEach(a,function(_14){_12+=_14;_13+=Math.pow(_14,2);});return (_13/a.length)-Math.pow(_12/a.length,2);},range:function(a,b,_17){if(arguments.length<2){b=a,a=0;}var s=_17||1;var _19=[];if(s>0){for(var i=a;i<b;i+=s){_19.push(i);}}else{if(s<0){for(var i=a;i>b;i+=s){_19.push(i);}}else{throw new Error("dojox.math.range: step must not be zero.");}}return _19;},distance:function(a,b){return Math.sqrt(Math.pow(b[0]-a[0],2)+Math.pow(b[1]-a[1],2));},midpoint:function(a,b){if(a.length!=b.length){console.error("dojox.math.midpoint: Points A and B are not the same dimensionally.",a,b);}var m=[];for(var i=0;i<a.length;i++){m[i]=(a[i]+b[i])/2;}return m;}});}