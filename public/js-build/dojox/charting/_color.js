/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.charting._color"]){dojo._hasResource["dojox.charting._color"]=true;dojo.provide("dojox.charting._color");dojox.charting._color={};dojox.charting._color.fromHsb=function(_1,_2,_3){_1=Math.round(_1);_2=Math.round((_2/100)*255);_3=Math.round((_3/100)*255);var r,g,b;if(_2==0){r=g=b=_3;}else{var _7=_3,_8=(255-_2)*_3/255,_9=(_7-_8)*(_1%60)/60;if(_1<60){r=_7,g=_8+_9,b=_8;}else{if(_1<120){r=_7-_9,g=_7,b=_8;}else{if(_1<180){r=_8,g=_7,b=_8+_9;}else{if(_1<240){r=_8,g=_7-_9,b=_7;}else{if(_1<300){r=_8+_9,g=_8,b=_7;}else{if(_1<360){r=_7,g=_8,b=_7-_9;}}}}}}}r=Math.round(r);g=Math.round(g);b=Math.round(b);return new dojo.Color({r:r,g:g,b:b});};dojox.charting._color.toHsb=function(_a,_b,_c){var r=_a,g=_b,b=_c;if(dojo.isObject(_a)){r=_a.r,g=_a.g,b=_a.b;}var min=Math.min(r,g,b);var max=Math.max(r,g,b);var _12=max-min;var hue=0,_14=(max!=0?_12/max:0),_15=max/255;if(_14==0){hue=0;}else{if(r==max){hue=((max-b)/_12)-((max-g)/_12);}else{if(g==max){hue=2+(((max-r)/_12)-((max-b)/_12));}else{hue=4+(((max-g)/_12)-((max-r)/_12));}}hue/=6;if(hue<0){hue++;}}hue=Math.round(hue*360);_14=Math.round(_14*100);_15=Math.round(_15*100);return {h:hue,s:_14,b:_15,hue:hue,saturation:_14,brightness:_15};};}