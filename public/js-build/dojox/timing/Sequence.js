/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.timing.Sequence"]){dojo._hasResource["dojox.timing.Sequence"]=true;dojo.provide("dojox.timing.Sequence");dojo.experimental("dojox.timing.Sequence");dojo.declare("dojox.timing.Sequence",null,{_defsResolved:[],_goOnPause:0,_running:false,go:function(_1,_2){this._running=true;var _3=this;dojo.forEach(_1,function(_4){if(_4.repeat>1){var _5=_4.repeat;for(var j=0;j<_5;j++){_4.repeat=1;_3._defsResolved.push(_4);}}else{_3._defsResolved.push(_4);}});var _7=_1[_1.length-1];if(_2){_3._defsResolved.push({func:_2});}_3._defsResolved.push({func:[this.stop,this]});this._curId=0;this._go();},_go:function(){if(!this._running){return;}var _8=this._defsResolved[this._curId];this._curId+=1;function resolveAndCallFunc(_9){var _a=null;if(dojo.isArray(_9)){if(_9.length>2){_a=_9[0].apply(_9[1],_9.slice(2));}else{_a=_9[0].apply(_9[1]);}}else{_a=_9();}return _a;};if(this._curId>=this._defsResolved.length){resolveAndCallFunc(_8.func);return;}var _b=this;if(_8.pauseAfter){if(resolveAndCallFunc(_8.func)!==false){window.setTimeout(function(){_b._go();},_8.pauseAfter);}else{this._goOnPause=_8.pauseAfter;}}else{if(_8.pauseBefore){var x=function(){if(resolveAndCallFunc(_8.func)!==false){_b._go();}};window.setTimeout(x,_8.pauseBefore);}else{if(resolveAndCallFunc(_8.func)!==false){this._go();}}}},goOn:function(){if(this._goOnPause){var _d=this;setTimeout(function(){_d._go();},this._goOnPause);this._goOnPause=0;}else{this._go();}},stop:function(){this._running=false;}});}