/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.dtl.filter.htmlstrings"]){dojo._hasResource["dojox.dtl.filter.htmlstrings"]=true;dojo.provide("dojox.dtl.filter.htmlstrings");dojo.require("dojox.dtl._base");dojo.mixin(dojox.dtl.filter.htmlstrings,{_escapeamp:/&/g,_escapelt:/</g,_escapegt:/>/g,_escapeqt:/'/g,_escapedblqt:/"/g,_linebreaksrn:/(\r\n|\n\r)/g,_linebreaksn:/\n{2,}/g,_linebreakss:/(^\s+|\s+$)/g,_linebreaksbr:/\n/g,_removetagsfind:/[a-z0-9]+/g,_striptags:/<[^>]*?>/g,escape:function(_1){var dh=dojox.dtl.filter.htmlstrings;return _1.replace(dh._escapeamp,"&amp;").replace(dh._escapelt,"&lt;").replace(dh._escapegt,"&gt;").replace(dh._escapedblqt,"&quot;").replace(dh._escapeqt,"&#39;");},linebreaks:function(_3){var _4=[];var dh=dojox.dtl.filter.htmlstrings;_3=_3.replace(dh._linebreaksrn,"\n");var _6=_3.split(dh._linebreaksn);for(var i=0;i<_6.length;i++){var _8=_6[i].replace(dh._linebreakss,"").replace(dh._linebreaksbr,"<br />");_4.push("<p>"+_8+"</p>");}return _4.join("\n\n");},linebreaksbr:function(_9){var dh=dojox.dtl.filter.htmlstrings;return _9.replace(dh._linebreaksrn,"\n").replace(dh._linebreaksbr,"<br />");},removetags:function(_b,_c){var dh=dojox.dtl.filter.htmlstrings;var _e=[];var _f;while(_f=dh._removetagsfind.exec(_c)){_e.push(_f[0]);}_e="("+_e.join("|")+")";return _b.replace(new RegExp("</?s*"+_e+"s*[^>]*>","gi"),"");},striptags:function(_10){return _10.replace(dojox.dtl.filter.htmlstrings._striptags,"");}});}