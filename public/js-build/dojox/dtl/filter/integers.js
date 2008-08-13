/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.dtl.filter.integers"]){dojo._hasResource["dojox.dtl.filter.integers"]=true;dojo.provide("dojox.dtl.filter.integers");dojo.mixin(dojox.dtl.filter.integers,{add:function(_1,_2){_1=parseInt(_1);_2=parseInt(_2);return isNaN(_2)?_1:_1+_2;},get_digit:function(_3,_4){_3=parseInt(_3);_4=parseInt(_4)-1;if(_4>=0){_3+="";if(_4<_3.length){_3=parseInt(_3.charAt(_4));}else{_3=0;}}return (isNaN(_3)?0:_3);}});}