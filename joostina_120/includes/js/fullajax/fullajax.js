/**
* Fullajax = AJAX & AHAH library
* http://www.fullajax.ru
* SiRusAjaX - SRAX v1.0.2 build 1
* Copyright(c) 2007-2008, Ruslan Sinitskiy.
* http://fullajax.ru/#:license
**/

if (!window.SRAX || window.SRAX.TYPE != 'full'){

/**
* ������� �����������
* @param {Any} any ��������
**/
function log(){
    SRAX.debug('log', arguments);
}

function info(){
    SRAX.debug('info', arguments);
}

function error(){
    SRAX.debug('error', arguments);
}

function warn(){
    SRAX.debug('warn', arguments);
}

/**
* ������� ������ �������� �� ��� id
* @param {String} idElem id ��������
* @return {Element} ��������� �������
**/
function id(idElem){
    return SRAX.get(idElem);
}

/**
* ������� ��� ���������� ��������� �� ������� ����� 
* @param {String} id id ������������� ��������
**/
function back(id) {
  SRAX.Html.thread[id].go(-1);
}

/**
* ������� ��� ���������� ���������  �� ������� ������
* @param {String} id id ������������� ��������
**/
function forward(id) {
  SRAX.Html.thread[id].go(1);
}

/**
* ������� ��� ���������� ��������� �� ������� �� �������� ���������� ����� 
* @param {String} val ���������� ����� ������(+)/�����(-)
* @param {String} id id ��������
**/
function go(val, id) {
  SRAX.Html.thread[id].go(val);
}

/**
* ������� ��������� ������� �������� � ��������� ������
* @return {String} ������
**/
String.prototype.trim = function(){ return this.replace(/\s*((\S+\s*)*)/, "$1").replace(/((\s*\S+)*)\s*/, "$1");}

/**
* ������� ������ ���� ��������� ���������� ��������
* @param {String} s1 ������� ���������� ��������
* @param {String} s2 ����� ��������
* @return {String} ������
**/
String.prototype.replaceAll = function(s1, s2) {return this.split(s1).join(s2)}

/**
* ������� �������� ������������� �� ������ �� ��������� ��������
* @param {String} value ��������� ��������
* @param {Boolean} caseSensitive ���� == true �� ������������ � ��������
* @return {Boolean} ��������� ��������
**/
String.prototype.endWith=function(value, caseSensitive){
    return caseSensitive ? (this.toLowerCase().substring(this.length-value.length,this.length)==value.toLowerCase()) : (this.substring(this.length-value.length,this.length)==value);
}
      
/**
* ������� �������� ���������� �� ������ � ���������� ��������
* @param {String} value ��������� ��������
* @param {Boolean} caseSensitive ���� == true �� ������������ � ��������
* @return {Boolean} ��������� ��������
**/
String.prototype.startWith=function(str, caseSensitive){
    return caseSensitive ? (this.toLowerCase().substring(0,str.length)==str.toLowerCase()) : (this.substring(0,str.length)==str);
}

/**
* ������� ��� ���������� ������� HTML
* @param {String} id �������
**/ 
function abort(id){
    if (SRAX.Html.thread[id]) SRAX.Html.thread[id].abort();
}

/**
* ������� ��� ������� HTML
* @param {String} url URL ����� �������
* @param {Object} options ������ ������������ <br> ������: {callback:myfunction, id:'myid', method:'post', form:'id-from'} <br><br>
* 
* ��������� ��������� options: <br>
* url/src - URL ������� <br>
* id - id ������������� �������� <br>
* method - ������ ������� ������ post ��� get (�� ���������) <br>
* form - id �����, ���� �����, id �������� ��� ��� �������, � �������� ���������� ������� ��������� <br>
* params - ������ ����������, ������� ���������� ��������� � ������ (name=val1&name=val2) <br>
* callback (cb) - ������� ��������� ������ <br>
* callbackOps (cbo) - �����, ������� ����������� � ������� ��������� ������ <br>
* nohistory (noHistory)- ���� ������������� ���������� �������, �� ��������� false - �.�. ������� �������� <br>
* cut - id ����� ����������� ����� - ������������ ��� ��������� �� ������� �� ������ �������� ����� � ��������� id - ������ �������� ���������� � ������� ������� AJAX_CUT_BLOCK <br>
* rc - ������������ (true) ��� �� ������������ (false - �� ���������) ��������� ������������� ������ <br>
* overwrite - ���� ���������� ���������� ������� true ��� false (�� ��������� - ������� �� �������� onclick � onsubmit - �� ����������������, � �����������)<br>
* destroy - ���� ���� �������� �������� ����� ��������� ������� <br>
* url - URL ����� ������� (��� ������������� ���������� hax(options)) <br>
* html - HTML �����, �������� �������-������, ��� ������� ������� ��������� ������ ������ c ������� �� �������������� <br>
* anticache/nocache - ���� ��������������� true ��� false (�� ���������) <br>
* startpage - ������� ������ �������� ������� true ��� false (�� ���������) <br>
* async - ���� ���������� ������������ ������� true (�� ���������) ��� false <br>
* historycache - ���� ������������� ���� ������� true ��� false (�� ��������� ������������ USE_HISTORY_CACHE) <br>
* seal - ���� "��������" true ��� false (�� ���������) - ������������ ��� ������� ���������� css ������
* user - username, ��� ����������� ���������� ��� �����
* pswd - password, ��� ����������� ���������� ������
* storage - ���� ������������� ���������� ��������� true (�� ���������) ��� false - ��������� ������ ��� ����������� SRAX.Storage
* etag - ���� ������������� Etag ��� ������������� ������� ������ � ��������� ��������� true (�� ���������) ��� false - ��������� ������ ��� ����������� SRAX.Storage
* headers - ������ header-�� �� �������� {���� : ��������}, ������� ���������� �������� �� ������. ������ -> headers:[{Etag: '123'}, {'Accept-Encoding': 'gzip,deflate'}]
* add - ���� true ��� false (�� ���������), ���������� ������� ���������� ������������� �������� � ������������ �������: ���������� (false) ��� ���������� (false)
* onload - �������, ������� ���������� ����� ������ �������� �������� � �������
* loader - ������-���������, ���� �� ��������� - ������������ ������ �� ��������� 
*
* @return {HTMLThread} ������ �������� ������� HTML
**/
function hax(url, options){
    if (!options) options = {};
    if (typeof url == 'string') options.url = url; else options = url;    
    if (options.nohistory == null) options.nohistory = options.noHistory;
    var thread = SRAX.Html.thread[options.id] ? SRAX.Html.thread[options.id] : new SRAX.HTMLThread(options.id);        
    thread.setOptions(options, 1);
    if (SRAX.Html.ASYNCHRONOUS){
        thread.request();
    } else {
        SRAX.Html.storage.push(thread.id);
        if (SRAX.Html.storage.length == 1) thread.request();
    }
    return thread;
}

/**
* ������� ������� HTML ������� GET
* @param {String} url URL ����� �������
* @param {String/Object} id_or_options
*                        ���� == Object -> ������ ������������ (������: {'callback':myfunction, 'id':'myid', 'method':'post', 'form':'id-from'}) <br>
*                        ���� == String -> id ������������� ��������, � ������� ����������� ��������� ������� HTML (���� null - ����� body)
* @param {String/Element} form id ����� ��� ���� �����
* @param {Function} cb callback ������� ��������� ������
* @param {Object} cbo ������ ����� ����������� � callback �������
* @return {Object} HTMLThread ������ �������� ������� HTML
**/
function get(url, id_or_options, form, cb, cbo){
    if (typeof id_or_options == 'object') return hax(url, id_or_options);
    return hax(url, {
        id: id_or_options,
        form: form,
        cb: cb,
        cbo:cbo
    });
}

/**
* ������� ������� HTML ������� POST
* @param {String} url URL ����� �������
* @param {String/Object} id_or_options 
*                        ���� == Object -> ������ ������������ (������: {'callback':myfunction, 'id':'myid', 'method':'post', 'form':'id-from'}) <br> 
*                        ���� == String -> id ������������� ��������, � ������� ����������� ��������� ������� HTML (���� null - ����� body)
* @param {String/Element} form id ����� ��� ���� �����
* @param {Function} cb callback ������� ��������� ������
* @param {Object} cbo ������ ����� ����������� � callback �������
* @return {Object} HTMLThread ������ �������� ������� HTML
**/
function post(url, id_or_options, form, cb, cbo){
    if (typeof id_or_options == 'object') {
        id_or_options.method = 'post';
        return hax(url, id_or_options);
    }
    return hax(url, {
        method: 'post',
        id: id_or_options,
        form: form,
        cb: cb,
        cbo:cbo
    });
}

/**
* ������� ��� ������� ������
* @param {String} url URL ����� �������
* @param {Object} options ������ ������������ <br> ������: {callback:myfunction, id:'myid', method:'post', params:'name1=value1&name2=value2'} <br><br>
* 
* ��������� ��������� options: <br>
* url/src - URL ������� <br>
* id - id ������ <br>
* method - ������ ������� ������ post ��� get (�� ���������) <br>
* form - id �����, ���� �����, id �������� ��� ��� �������, � �������� ���������� ������� ��������� <br>
* params - ������ ����������, ������� ���������� ��������� � ������ (name=val1&name=val2) <br>
* callback (cb) - ������� ��������� ������ <br>
* callbackOps (cbo) - �����, ������� ����������� � ������� ��������� ������ <br>
* destroy - ���� ���� �������� �������� ����� ��������� ������� true ��� false (�� ���������) <br>
* url - URL ����� ������� (��� ������������� ���������� dax(options)) <br>
* anticache/nocache - ���� ��������������� true ��� false (�� ���������) <br>
* async - ���� ���������� ������������ ������� true (�� ���������) ��� false <br>
* xml - XML, �������� �������-������, ��� ������� ������� ��������� ������ ������ c ������� �� �������������� <br>
* text - �����, �������� �������-������, ��� ������� ������� ��������� ������ ������ c ������� �� �������������� <br>
* user - username, ��� ����������� ���������� ��� �����
* pswd - password, ��� ����������� ���������� ������
* storage - ���� ������������� ���������� ��������� true (�� ���������) ��� false - ��������� ������ ��� ����������� SRAX.Storage
* etag - ���� ������������� Etag ��� ������������� ������� ������ � ��������� ��������� true (�� ���������) ��� false - ��������� ������ ��� ����������� SRAX.Storage
* headers - ������ header-�� �� �������� {���� : ��������}, ������� ���������� �������� �� ������. ������ -> headers:[{Etag: '123'}, {'Accept-Encoding': 'gzip,deflate'}]
* loader - ������-���������, ���� �� ��������� - ������������ ������ �� ��������� 
* 
* @return {Object} DATAThread ������ �������� ������� ������
**/
function dax(url, options){
    if (!options) options = {};
    if (typeof url == 'string') options.url = url; else options = url;
    if (!options.id) options.id = 'undefined';
    var thread = SRAX.Data.thread[options.id] ? SRAX.Data.thread[options.id] : new SRAX.DATAThread(options.id);
    thread.setOptions(options, 1);
    thread.request();
    return thread;
}

/**
* ������� ��� ���������� ������� ������
* @param {String} id id �������
**/
function abortData(id){
    if (SRAX.Data.thread[id]) SRAX.Data.thread[id].abort();
}

/**
* ������� ������� ������ ������� GET
* @param {String} url URL ����� �������
* @param {Function} cb callback ������� ��������� ������
* @param {String} idThread id �������
* @param {Object} cbo ������ ����� ����������� � callback �������
* @param {Boolean} destroy ���� ���� �������� �������� ����� ��������� ������� 
* @return {Object} DATAThread ������ �������� ������� ������
**/
function getData(url, cb, idThread, cbo, anticache, destroy){
    return dax(url, {
        cb: cb,
        id: idThread,
        cbo: cbo,
        anticache: anticache,
        destroy: destroy
    });
}

/**
* ������� ������� ������ ������� POST
* @param {String} url URL ����� �������
* @param {String} body ��������� ������� (������: 'name1=value1&name2=value2') 
* @param {Function} cb callback ������� ��������� ������
* @param {String} idThread id �������
* @param {Object} cbo ������ ����� ����������� � callback �������
* @param {Boolean} destroy ���� ���� �������� �������� ����� ��������� ������� 
* @return {Object} DATAThread ������ �������� ������� ������
**/
function postData(url, params, cb, idThread, cbo, anticache, destroy){
    return dax(url, {
        method: 'post',
        params: params,
        cb: cb,
        id: idThread,
        cbo: cbo,
        anticache: anticache,
        destroy: destroy
    });
}

/**
* ������� ������-���������� 
**/
if (!window.SRAX) SRAX = {};

/**
* ������� ��� ���������� ������������
**/
SRAX.extend = function(dest, src, skipexist){
    var overwrite = !skipexist; 
    for (var i in src) 
        if (overwrite || !dest.hasOwnProperty(i)) dest[i] = src[i];
    return dest;
};

(function($){

$.extend($, {
    
    
    /**
    * ������������� ������ ����������
    **/
    version : 'SRAX v1.0.2 build 1',       
    
    /**
    * ������������� ������ ����������, ��� ������� ������� ����������� ������������� ������ ������ SRAX ����������
    **/
    TYPE : 'full',       

    /**
    * ��������� �� ��������� 
    **/
    Default : {        
        /**
        * ������� �� ���������
        **/
        prefix: 'ax',

        /**
        * ����������� �������� �� ��������� 
        **/
        sprt: ':',

        /**
        * id ��������-������� �� ��������� - ������������� �������� HTML 
        **/
        loader : 'loading',

        /**
        * id ��������-������� �� ��������� - ������������� �������� ������ 
        **/
        loader2 : 'loading2',

        /**
        * ������ ��������-������� ��� ������� ������ 
        **/
        loaderSufix : '_loading',

        /**
        * ���� ��������� AJAX ��������
        * @type Boolean 
        **/
        DEBUG_AJAX : 0,

        /**
        * ���� ��������� �������� �������� &lt;script>
        * @type Boolean 
        **/
        DEBUG_SCRIPT : 0,

        /**
        * ���� ��������� �������� ������ &lt;link>
        * @type Boolean 
        **/
        DEBUG_LINK : 0,

        /**
        * ���� ��������� �������� ������ &lt;style>
        * @type Boolean 
        **/
        DEBUG_STYLE : 0,

        /**
        * ���� ������������� ����-���� �������
        * @type Boolean 
        **/
        USE_FILTER_WRAP : 1,

        /**
        * ���� ���������� ������� ���������
        * @type Boolean 
        **/
        NO_HISTORY : 0,

        /**
        * ���� ������������� ���� ������� HTML
        * @type Boolean 
        **/
        USE_HISTORY_CACHE : 1,

        /**
        * ����� ���� ������� HTML (�� ��������� = 100)
        * @type Boolean 
        **/
        LENGTH_HISTORY_CACHE : 100,

        /**
        * ���� ��������� ����������������� ������ &lt;link>
        * @type Boolean 
        **/
        LINK_REPEAT : 0,

        /**
        * ���� ������������� ���� �������� &lt;script>
        * @type Boolean 
        **/
        USE_SCRIPT_CACHE : 1,

        /**
        * ���� ��������� ����������������� �������� &lt;script> � ��������� src
        * @type Boolean 
        **/
        SCRIPT_SRC_REPEAT_APPLY : 1,

        /**
        * ���� ���������� �������� �������� � ������� AJAX
        * @type Boolean 
        **/
        SCRIPT_NOAX : 0,

        /**
        * ���� ��������� ������������� ������ ��� href � src
        * @type Boolean 
        **/
        RELATIVE_CORRECTION : 0,

        /**
        * ���� ���������� ������� ��� ���������� Filter.wrap
        * @type Boolean 
        **/
        OVERWRITE : 0,

        /**
        * ����� ����� ��� ������ ������� #2
        **/
        model2Marker : {
            ax : '<!-- :ax:',
            begin : ':begin: //-->',
            end : ':end: //-->'
        },
        
        /**
        * ���� ���� �������� HTMLThread �������� ����� ��������� �������
        * @type Boolean 
        **/
        HAX_AUTO_DESTROY : 0,

        /**
        * ���� ������� ��� HTMLThread 
        * @type Boolean 
        **/
        HAX_ANTICACHE : 0,

        /**
        * ���� ���� �������� DATAThread �������� ����� ��������� �������
        * @type Boolean 
        **/
        DAX_AUTO_DESTROY : 0,

        /**
        * ���� ������� ��� DATAThread 
        * @type Boolean 
        **/
        DAX_ANTICACHE : 0,

        /**
        * ��������� �������� (�� ��������� = 'UTF-8')
        * @type String 
        **/
        CHARSET : 'UTF-8'  

    },

    /**
    * ������� �����������
    * @param {String} type ��� (log, warn, info, error)
    * @param {Array} ���������
    **/
    debug : function (type, args){
        var c = window.console;
        if (c && c[type]) {
          try{
            c[type].apply(c, args); 
          } catch (ex){
            c[type](args.length == 1 ? args[0] : args);
          }
          //if (SRAX.browser.mozilla) c[type].apply(c, args); else c[type](args.length == 1 ? args[0] : args);
        } else if (window.runtime){
            var arr = [type + ': ' + args[0]];
            for (var i = 1, len = args.length; i < len; i++) arr.push(args[i]);
            runtime.trace(arr);
        } 
    },
    
    /**
    * ����� ��� ��������� �������� ������� � �������������
    **/
    getTime : function(){
      return new Date().getTime();
    },    

    /**
    * ������ ��������, ������� �� ������ ������������ 
    * @type Array 
    **/
    LIST_NO_CACHE_SCRIPTS : [],

    /**
    * C����� ��������, ������� �� ������ �����������
    * @type Array 
    **/
    LIST_NO_LOAD_SCRIPTS : [],

    /**
    * C����� ������, ������� �� ������ �����������
    * @type Array
    **/
    LIST_NO_LOAD_LINKS : [],

    /**
    * ����� ������������� �������� ����������� � �������
    **/
    init : function(){
        var agent = navigator.userAgent.toLowerCase();
        $.browser = {
            version: (agent.match( /.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/ ) || [])[1],
            webkit: /webkit/.test(agent),
            safari: /safari/.test(agent),
            opera: /opera/.test(agent),
            msie: /msie/.test(agent) && !/opera/.test(agent),
            mozilla: /mozilla/.test(agent) && !/(compatible|webkit)/.test(agent),
            air: /adobeair/.test(agent)
        }

        var n = 'addEventsListener';

        $[n]($.HTMLThread);
        $[n]($.History);

        $[n]($.DATAThread);

        n = 'addContainerListener';

        $[n]($.Html);

        $[n]($.Data);

        /**
        * ��������� ��� body onload & unload
        **/
        $.LoadUnloadContainer = {};

        /**
        * ��� ��������
        **/
        $.scriptsCache = [[],[]];
 
        /**
        * ��������� ��� �������� - ��� �������� ��������� ��������
        **/
        $.scriptsTemp = [[],[]];

        /**
        * ��� ������
        **/
        $.linksCache = [];
        $.History.prefixListener.ax = $.go2Hax;
        $.readyHndlr = [];
        $.onReady(function(){
            if (D.USE_FILTER_WRAP) $.Filter.wrap();
            setInterval($.History.check, 200);
            $.initCPLNLS();
            $.initCPLNLL();
            if ($.browser.opera){
                var img = document.createElement('img');
                img.setAttribute('style','position:absolute;left:-1px;top:-1px;opacity:0;width:0px;height:0px');
                img.setAttribute('alt','');
                img.setAttribute('src','javascript:location.href="javascript:SRAX.xssLoading=0;SRAX.History.check()"');
                document.body.appendChild(img);
            }
            $.Include.parse();
        });
        document._write = document.write;
        document._writeln = document.writeln;
        $.write = function(val){
            document._write(val)
        }
        $.writeln = function(val){
            document._writeln(val)
        }

    },

    /**
    * ������������� �������-�������� ����������� ���������
    **/
    initOnReady : function(){
        if ($.isReadyInited) return;
        $.isReadyInited = 1;
        //������� ����������� ����� ������� ���������� DOM, �� ������ ��� ������� window.onload 
	      if ($.browser.mozilla || $.browser.opera) {
            $.addEvent(document, 'DOMContentLoaded', $.ready);
        } else 
        if ($.browser.msie) {
            (function () {
                try {
                    document.documentElement.doScroll('left');
                } catch (e) {
                    setTimeout(arguments.callee, 50);
                    return;
                }
                $.ready();
            })();            
            /*            
            document.write('<s'+'cript id="ie-srax-loader" defer="defer" src="/'+'/:"></s'+'cript>');
            var defer = document.getElementById("ie-srax-loader");
            defer.onreadystatechange = function(){
                if(this.readyState == "complete") {
                    this.parentNode.removeChild(this);
                    $.ready();
                }
            };
            defer = null;
            **/
	} else 
        if ($.browser.safari){
		$.safariTimer = setInterval(function(){
			if (document.readyState == "loaded" || 
				document.readyState == "complete") {
				clearInterval($.safariTimer);
				$.safariTimer = null;
				$.ready();
			}
		}, 10); 
         }
         $.addEvent(window, 'load', $.ready);
    },
    /**
    * ����������� ������� �� ������� onReady 
    * @param {Function} handler �������, ������� ������ �����������
    **/
    onReady : function(handler){
        if ($.isReady) {
            handler();
        } else {
            $.readyHndlr.push(handler);        
            $.initOnReady();
        }
    },

    /**
    * ����� ��� ���������� ������������������ ������� �� ������� onReady 
    **/
    ready : function(){
        if ($.isReady) return;
        $.isReady = 1;
        for (var i = 0, len = $.readyHndlr.length; i < len; i++){
            try{
                $.readyHndlr[i]();
            } catch(ex){
                error(ex);
            }
        }
        $.readyHndlr = null;
    },

    /**
    * ������� ������������ ������� � ������� 
    * ������: SRAX.addEvent(window, 'load', function() {alert('onload')})
    * @param {Object} obj ������ � �������� �������������� �������
    * @param {String} name ��� ������� (��� �������� on)
    * @param {Function} handler �������, ������� ������ �����������
    **/
    addEvent : function(obj, name, handler) {
	     if (obj.attachEvent) obj.attachEvent('on' + name, handler);
	     else obj.addEventListener(name, handler, false);
    },

    /**
    * ������� ����������� ������� � ������� 
    * ������: SRAX.delEvent(window, 'load', function() {alert('onload')})
    * @param {Object} obj ������ �� �������� ������������ �������
    * @param {String} name ��� ������� (��� �������� on)
    * @param {Function} handler �������, ������� ������ ����������
    **/
    delEvent : function(obj, name, handler) {
	     if (obj.detachEvent) obj.detachEvent('on' + name, handler);
	     else obj.removeEventListener(name, handler, false);
    },

    /**
    * ������� ��������� �������
    * @param {String/Object} obj id ������� ��� ��� ������
    * @return {Object} ������
    **/
    get : function(obj){
        if (typeof obj == 'string') obj = document.getElementById(obj);
        return obj;
    },

    /**
    * List No Load Scripts - LNLS <br>
    * ������� ������� LIST_NO_LOAD_SCRIPTS <br>
    * ��������� (�������) �������� ������
    **/
    clearLNLS: function(){
        $.LIST_NO_LOAD_SCRIPTS = [];
    },

    /**
    * Current Page List No Load Scripts - CPLNLS <br>
    * ������������� LIST_NO_LOAD_SCRIPTS <br>
    * ��� ������� �� <head> ������� �������� �������� � ������ ��������, ������� �������� �� �����������
    * @param {Boolean} clear �������� ���������������� ��������� (�������) �������� ������
    **/
    initCPLNLS: function(clear){
        if (clear) $.clearLNLS();
        var head = document.getElementsByTagName('head')[0];
        var scripts = head.getElementsByTagName('script');
        for (var i = 0, len = scripts.length; i < len; i++){
            if (!scripts[i].src) continue;
            $.LIST_NO_LOAD_SCRIPTS.push(scripts[i].src);
        }        
    },

    /**
    * List No Load Links - LNLL <br>
    * ������� ������� LIST_NO_LOAD_LINKS <br>
    * ��������� (�������) �������� ������
    **/
    clearLNLL: function(){
        $.LIST_NO_LOAD_LINKS = [];
    },

    /**
    * Current Page List No Load links - CPLNLL <br>
    * ������������� LIST_NO_LOAD_LINKS <br>
    * ��� ����� �� <head> ������� �������� �������� � ������ ������, ������� �������� �� �����������
    * @param {Boolean} clear �������� ���������������� ��������� (�������) �������� ������
    **/
    initCPLNLL: function(clear){
        if (clear) $.clearLNLL();
        var head = document.getElementsByTagName('head')[0];
        var links = head.getElementsByTagName('link');
        for (var i = 0, len = links.length; i < len; i++){
            if (!links[i].href) continue;
            $.LIST_NO_LOAD_LINKS.push(links[i].href);
        }
    },

    /**
    * �������� : ���������� - �� ��� ���� �������� � hash ������ (������������ ��� ���������� ������), ������ ���
    **/
    linkEqual : {
        // ��� ��� ����� - ����� �� ������������ � location.hash ��� ��� ����� ? � ������ � # 
        // � ������� http://cold.udelau.ru/index.php#:ax:center:/ajax.php?block=passport&module=showfolders
        // ��� ���� location.hash ����� ����� #:ax:center:/ajax.php - �.�. ������� �� ����� �����������
         '?':'[~q~]'
    },

    /**
    * ������� ��� ������ (��������) ������ linkEqual �������� � ������ �� �� ������������� �������� <br> 
    * @param {String} url URL ������
    * @param {Boolean} reverse ������ (false) ��� �������� (true) ������ 
    * @return {String} ��������� ������
    **/
    replaceLinkEqual : function(url, reverse){
        for (var i in $.linkEqual)
            url = reverse ? url.replaceAll($.linkEqual[i],i) : url.replaceAll(i, $.linkEqual[i]);
        return url;
    },

    /**
    * ������-��������� - ��� ������������� ������ ������� #2 (���� �� ������ - ���� ������, ����� ������) - ������������ �� ������ ������ ������� - �� ������ ������� <br><br>
    * ������:<br>
    * SRAX.Model2Blocks['id-all-layer'] = {'block-m-left':'left','block-content':'all'}; <br>
    **/
    Model2Blocks : {},

    /**
    * ������ XMLHTTP ActiveXObject �������
    **/
    IE_XHR_ENGINE : ['Msxml2.XMLHTTP', 'Microsoft.XMLHTTP'],

    /**
    * ������� ������������� XMLHttpRequest �������  
    * @return {Object} XMLHttpRequest ������
    **/
    getXHR : function() {
        if (window.XMLHttpRequest && !(window.ActiveXObject && location.protocol == 'file:')) {
            return new XMLHttpRequest();
        } else 
        if (window.ActiveXObject){
          for (var i = 0; i < $.IE_XHR_ENGINE.length; i++){
            try {
                return new ActiveXObject($.IE_XHR_ENGINE[i]);
            } catch (e){}
          }
        }
    },
    
    /**
    * �������� + ����  
    **/
    host : location.protocol + '//' + location.host,

    /**
    * ������� ��������������� ��������� ������, 
    * ���� �������������� ���������� ����� ������� callback �������,
    * ���� ��� ���� �������� ������
    * @param {Object} ops �������� ��������� (ops.xhr - ������ XmlHttpRequest, thread - ������� ��������)
    * @return {Boolean} ��������� ���������
    **/
    DaxPreprocessor : function(ops){
    },

    /**
    * ������� ��������������� ��������� HTML, 
    * ���� �������������� ���������� ����� ������� callback �������,
    * ���� ��� ���� �������� HTML
    * @param {Object} ops �������� ��������� (ops.xhr - ������ XmlHttpRequest, thread - ������� ��������)
    * @return {Boolean} ��������� ���������
    **/
    HtmlPreprocessor : function (ops){
    },

    /**
    * ������ �������� ������� ������
    * @param {Object} idThread id �������
    **/
    DATAThread : function(idThread) {
        var xhr, startTime, loader;
        var _this = this;
        this.inprocess = 0;
        this.id = idThread;
        var ops = this.options = {};

        $.Data.thread[idThread] = this;
        $.Data.register(this);

        this.repeat = function(params){
            ops.params = params;
            _this.request();
        }

        this.setOptions = function(options, overwrite){
            if (!options.url) options.url = options.src;    
            if (!options.cb) options.cb = options.callback;    
            if (options.cbo == null) options.cbo = options.callbackOps;    
            if (options.anticache == null) options.anticache = options.nocache;
            if (overwrite) ops = {};
            $.extend(ops, options);
            if (ops.async == null) ops.async = true;
            if (ops.url && ops.url.startWith($.host)) ops.url = ops.url.replace($.host, '');
            this.loader = loader = ops.loader == null ? $.getLoader(idThread, 1) : $.get(ops.loader);   
            this.options = ops;
        }

        this.getOptions = function(){
            return ops;
        }

    
        function processRequest(obj) {
          if (!obj || !obj.readyState) obj = xhr;
          try{
            if (obj.readyState == 4) {
              _this.inprocess = 0;
              $.showLoading(_this.inprocess, loader, 1);
              var status = obj.isAbort ? -1 : obj.status;

              var success = (status >= 200 && status < 300) || status == 304 || (status == 0 && location.protocol == 'file:');
              var text = obj.responseText;
              var xml = obj.responseXML;
              var o = {
                   xhr:obj,
                   url:ops.url,
                   id:idThread,
                   status:status,
                   success:success, 
                   cbo:ops.cbo, callbackOps:ops.cbo,
                   options:ops,
                   text:text,
                   xml:xml,
                   thread:_this,
                   /**
                   * responseText � responseXML - deprecated, ��������� ��� ������������� � ����������� �������� - ������ ������������� ����� ����� ������������ text � xml �������������
                   **/
                   responseText:text,
                   responseXML:xml,
                   time: $.getTime() - startTime                   
               }
              _this.fireEvent('response', o);
              if (status > -1 && $.DaxPreprocessor(o) !== false && ops.cb) {
                   ops.cb(o, idThread, success, ops.cbo);
                   if (D.DEBUG_AJAX) log('callback id:' + idThread);                   
              }

              if ((ops.destroy != null) ? ops.destroy : D.DAX_AUTO_DESTROY){
                   _this.destroy();
              }
            }
          } catch (ex){
              error(ex);
              _this.fireEvent('exception',
                   {xhr:obj,
                   url:ops.url,
                   id:idThread,
                   exception:ex,
                   options:ops}
              )
              _this.inprocess = 0;
              $.showLoading(_this.inprocess, loader, 1);
              if ((ops.destroy != null) ? ops.destroy : D.DAX_AUTO_DESTROY){
                   _this.destroy();
              }
          }
        }
        
        this.isProcess = function (){
            return _this.inprocess;
        }
        
        this.request = function(){
            var m = ops.method ? ops.method : (ops.form ? ops.form.method : 'get');
            var method = (m && m.toLowerCase() == 'post') ? 'post':'get';
            try{
                var options = {
                    url:ops.url,
                    id:idThread,
                    options:ops
                }

                if (_this.fireEvent('beforerequest', options) !== false){
                    startTime = $.getTime();
                    var body = $.createQuery(ops.form);
                    if (ops.params) {
                        if (body != '' && !ops.params.startWith('&')) body += '&';
                        body += ops.params; 
                    }
                    if (method != 'post' && body != '') {
                        if (ops.url.indexOf('?') == -1){
                            ops.url += '?' + body
                        } else {
                            ops.url += ((ops.url.endWith('?') || ops.url.endWith('&')) ? '' : '&') + body
                        }
                    }
                    if (_this.inprocess) _this.abort();
                    _this.inprocess = 1;
                    
                    if (ops.text || ops.xml){
                        processRequest({readyState:4,status:ops.status == null ? 200:ops.status, responseText:ops.text, responseXML:ops.xml})
                        ops.text = ops.xml = null;
                    } else {
                        if (!xhr) xhr = $.getXHR();
                        
                        if (ops.user) xhr.open(method.toUpperCase(), ops.url, ops.async, ops.user, ops.pswd);
                        else xhr.open(method.toUpperCase(), ops.url, ops.async);

                        xhr.onreadystatechange = ops.async ? processRequest : function(){};
                        var rh = 'setRequestHeader';
                        xhr[rh]('AJAX_ENGINE', 'Fullajax');
                        if (ops.anticache != null ? ops.anticache : D.DAX_ANTICACHE) xhr[rh]('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT');
                        xhr[rh]('HTTP_X_REQUESTED_WITH', 'XMLHttpRequest');
                        if (ops.headers){
                            for (var i in ops.headers){
                                xhr[rh](i, ops.headers[i]);
                            }
                        }
                        if (method == 'post') xhr[rh]('Content-Type', 'application/x-www-form-urlencoded; Charset=' + D.CHARSET);            
                        $.showLoading(_this.inprocess, loader, 1);
                        xhr.send((method == 'post') ? body : null);
                        if (!ops.async) processRequest();
                    }
                    if (D.DEBUG_AJAX) log(method + ' ' + ops.url + ' params:' + body + ' id:' + idThread);
                    _this.fireEvent('afterrequest', options);                    
                }
            } catch (ex){
                _this.abort();
                error(ex);
                throw ex;
            }
        }

        this.abort = function(){
            _this.inprocess = 0;
            if (!xhr) return;
            try{
                xhr.isAbort = 1;
                xhr.abort();
            } catch (ex){}
            xhr = null;
            $.showLoading(0, loader, 1);
        }

        this.destroy = function(){
            $.Data.thread[idThread] = null;
            delete $.Data.thread[idThread];
        }
    },

    /**
    * ������� �����������/������� ������� ������-������������ ������� HTML (�������� � �������� ���������)
    * @param {Boolean} show ��������/������
    * @param {Boolean} isdax ���� = false ��� null ������ HTML, ���� = true - ������ ������    
    * @param {String} obj id �������� ������� HTML 
    **/
    showLoading : function(show, obj, isdax){
        var s = obj ? obj.style : 0;
        if (s){
          if (show) {
              if (s.visibility) s.visibility = 'visible'; else s.display = 'block';
          } else {
            var th = $[isdax?'Data':'Html'].thread;
            for (var i in th) {
                if (th[i] && th[i].isProcess()) break;
                if (s.visibility) s.visibility = 'hidden'; else s.display = 'none';
            }
          }
        } 
    },

    /**
    * ������� ������� � ������� ������-������������ ������� (�������� � �������� ���������)
    * @param {String} obj id ������������� ��������
    * @param {Boolean} isdax ���� = false ��� null ������ HTML, ���� = true - ������ ������    
    * @return {Object} ������ ������-������������ ������� HTML 
    **/
    getLoader : function(obj, isdax){        
        var g = $.get;
        if (obj) obj = g((typeof obj == 'string' ? obj : obj.id) + D.loaderSufix);
        return obj || g(isdax ? D.loader2 : D.loader) || g(isdax ? D.loader : D.loader2);
    },

    /**
    * ������� ��� ����������� ��������
    * @param {String} text �����
    * @return {String} �������������� �����
    **/
    encode : encodeURIComponent,

    /**
    * ������� ��� ������������� ��������
    * @param {String} text �������������� �����
    * @return {String} �������������� �����
    **/
    decode : decodeURIComponent,

    /**
    * ������� ����-������ ����������
    * @param {String/Element} obj id ����� ��� ���� ����� 
    * @return {String} ������ ���������� ���������� (������: 'name1=value1&name2=value2')
    **/
    createQuery : function(obj, ops) {
        obj = $.get(obj);
        if (!obj) return '';
        if (!ops) ops = {};
        var names = [];
        var vals = [];
        var e = $.encode;
        var inputs = obj.getElementsByTagName("input");       
        for(var i = 0; i < inputs.length; i++ ) {
          var inp = inputs[i];
          var type = inp.type.toLowerCase();
          var name = inp.name ? inp.name : inp.id;
          if (!name) continue;
          var value = e(inp.value);
          var name = e(name);
          switch(type){
              case "text":
              case "password":
              case "hidden":
              case "button":
                names.push(name);
                vals.push(value);
                break;
              case "checkbox":
              case "radio":
                if (inp.checked) {
                  names.push(name);
                  vals.push((value == null || value == '') ? inp.checked : value);
                }
                break;                
          }
        }

        var selects = obj.getElementsByTagName("select");       
        for(var i = 0; i < selects.length; i++ ) {
            var sel = selects[i];
            var type = sel.type.toLowerCase();
            var name = sel.name ? sel.name : sel.id;
            if (!name || sel.selectedIndex == -1) continue;
            if (type == 'select-multiple'){
                for (var j = 0, len = sel.options.length; j < len; j++){
                    if (sel.options[j].selected) {
                        names.push(name);
                        vals.push(e(sel.options[j].value));
                    }
                }
            } else {            
              names.push(e(name));
              vals.push(e(sel.options[sel.selectedIndex].value));
            }
        }   

        var textareas = obj.getElementsByTagName("textarea");       
        for(var i = 0; i < textareas.length; i++) {
            var ta = textareas[i];
            var name = ta.name ? ta.name : ta.id;
            if (!name) continue;
            names.push(e(name));
            vals.push(e(ta.value));
        }
        var query = [];
        for (var i = 0, len = names.length; i < len; i++){ 
            if (ops.skipEmpty && vals[i] == '') continue;
            query.push(names[i] + '=' + vals[i]);
        }
        var params = query.join('&') + (obj.submitValue || '');
        obj.submitValue = null;
        return params;
    },

    /**
    * ������� ���������� � ������� obj ��������� ���������� �� ������ ���������� params
    * @param {String} params ������ ���������� ����������� ��������� (� ������� &lt;link href="/path/style.css" type="text/css">)
    * @param {Object} obj ������, �������� ��������� ������������ ���������
    **/
    applyParams : function(params, obj){
        var arr = params.split(' ');
        for (var i = 0, len = arr.length; i < len; i++){
            var el = arr[i];
            var ind1 = el.indexOf("=");
            if (ind1 > -1){
                var ind = $.indexOfAttrMarks(el,ind1+1);
                var name = el.substring(0, ind1).trim(); 
                var val = el.substring(ind[0] + 1, ind[1]).trim(); 
                obj[name] = val;
            } else if (el.indexOf('<') == -1 && el.indexOf('>') == -1){
                obj[el] = el;
            }            
        }
        return obj;
    },
    
    /**
    * ������� ��������� �������� (' ��� ") �������� ��������
    * @param {String} str ������
    * @return {Array} arr ������ �� 2-� �������� (������ - ��������� �������, ������ - �������� �������)
    **/
    indexOfAttrMarks : function(str, start){
        if (start == null) start = 0;
        var m = "'";
        var ind1 = str.indexOf(m, start);
        var ind2 = str.indexOf('"', start);
        if (ind2 > -1 && (ind2 < ind1 || ind1 == -1)) {
            ind1 = ind2; 
            m = '"';
        }
        if (ind1 > -1){
            ind2 = str.indexOf(m, ind1 + 1);
        } else {
            ind1 = str.indexOf('=');
            ind1++;
            while (str.substring(ind1).startWith(' ')) ind1++;
            str = str.replaceAll('>','');
            ind2 = str.length-1;
            while (str.substring(ind2,1).endWith(' ')) ind2--;
            ind1--;
            ind2++;
        }
        return [ind1, ind2];
    },
    
    /**
    * ������� ��������� �������� ������������ ��������� �� ������ ����������
    * @param {String} params ������ ���������� ���������� (������: 'name1=value1&name2=value2')
    * @param {String} name ��� ������������ ���������
    * @return {String} �������� ������������ ���������
    **/
    getParam : function(params, name){
        var ind1 = params.toLowerCase().indexOf(' ' + name);
        if (ind1 > -1){
            var ind = $.indexOfAttrMarks(params, ind1 + name.length + 1);
            return params.substring(ind[0] + 1, ind[1]); 
        }
    },
    
    /**
    * ������� ��� �������������� ����������������� � HTML �������� (ampl; &lt; � ������)
    * @param {String} str ����� ��� ������������� 
    * @return {String} ��������� ������������� 
    * 
    **/
    entitiesConvertor : function(str){
        if (str == null) return str;
        if (!$.tempDiv) $.tempDiv = document.createElement('div');
        $.tempDiv.innerHTML = str;
        return $.tempDiv[this.browser.msie ? 'innerText' : 'textContent'];
    },

    /**
    * ������� �������� ������� &lt;script>
    * @param {String} text �����-���� �������
    * @return {Object} ������ &lt;script>
    **/
    makeScript : function(text){
        if (text.indexOf('SRAX.init()') > -1) text = '<script type="text/javascript"></'+'script>';
        var script = document.createElement('script');
        var ind1 = text.toLowerCase().indexOf('<script');
        var ind2 = text.indexOf('>', ind1 + 1);
        var ind3 = text.toLowerCase().lastIndexOf('</'+'script>');

        if(ind1 > -1 && ind2 > -1){
            var params = text.substring(ind1, ind2 + 1);
            $.applyParams(params, script);
        }

        if (script.src) script.src = $.entitiesConvertor(script.src);
        if (ind3 > -1) text = text.substring(ind2 + 1, ind3); else text = '';

        var src = (script.src ? script.src : '').trim().toLowerCase();
        var bool = src.startWith('javascript:');
        if (src == '//:' || bool){
            if (bool) text += '\n' + src.substring(11);            
            script.src = '';
        }

        if (text.length > 0)
            if ($.browser.msie) {
                script.text = text; 
            } else {
                script.appendChild(document.createTextNode(text)); 
            }

        if (!script.id) script.id = script.src;                
        return script;
    },
    
    /**
    * ������� ���������� �����
    * @param {String} url ���� � css ����� ��� ��������������� ��� �����
    * @param {String} seal id ������������ ��� �������� �����
    **/
    addCss : function(url, seal){
        if (url.indexOf('{') > -1){
             $.addStyle('<style>'+url+'</style>', seal, seal);
        } else {                
             $.addLink('<link rel="stylesheet" href="'+url+'">', seal, seal);
        }
    },
    
    /**
    * ������� ��������� � ���������� ������� &lt;style>
    * @param {String} text �����-���� �����
    * @param {String} idLayer id ������������� �������� 
    * @param {Boolean} seal ���� ������������� �������� �����
    **/
    addStyle : function(text, idLayer, seal){
        text = text.toLowerCase();
        var ind1 = text.indexOf('<style');
        var ind2 = text.indexOf('>', ind1 + 1);
        var ind3 = text.indexOf('</style>', ind2 + 1);
        var params = text.substring(ind1, ind2+1);
        var obj = $.applyParams(params, {});
        var skip = obj[X('skip')];
        if (skip == 'true' || skip == '1') return;        

        text = text.substring(ind2 + 1, ind3);

        ind1 = text.indexOf('@import ');
        while (ind1 > -1){
            ind2 = text.indexOf('(', ind1 + 1);
            ind3 = text.indexOf(')', ind2 + 1);
            var href = text.substring(ind2 + 1, ind3);
            href = '<link rel="stylesheet" type="text/css" href="' + href + '"/>';
            $.addLink(href, idLayer, seal);
            text = text.substring(0,ind1)+text.substring(ind3+1);
            ind1 = text.indexOf('@import ');
        }
        if (seal && typeof idLayer == 'string') text = $.sealStyle(text, idLayer);
        if (text.length > 0){
            var style = document.createElement('style');
            style.type = 'text/css';
            if (style.styleSheet) {
                style.styleSheet.cssText = text;
            } else {
                if ($.browser.mozilla || $.browser.opera){
                    style.innerHTML = text;
                } else {
                    var cssText = document.createTextNode(text);
                    style.appendChild(cssText);
                }                        
            }
            var head = document.getElementsByTagName('head')[0];
            head.appendChild(style);  
            if (D.DEBUG_STYLE) log('Style ' + text);
        }
    },

    /**
    * ������� �������� css<br>
    * ������������ ��� ������� ���������� ����� ������������� �������
    * 
    * @param {String} text �����-���� �����
    * @return {String} ����������� �����-���� �����
    **/
    sealStyle : function(text, idLayer){
        var ind1 = -1;
        var ind2 = text.indexOf('{');
        idLayer = idLayer.trim();
        var mark = ((idLayer.startWith('.') || idLayer.startWith('#')) ? '' : '#') + idLayer+' ';
        var res = '';
        while (ind2 > -1){
            res += mark + text.substring(ind1+1, ind2).trim().replaceAll(',',','+mark);
            ind1 = text.indexOf('}', ind2);
            if (ind1 > -1) res += text.substring(ind2, ind1+1);
            ind2 = ind1 == -1 ? -1 : text.indexOf('{', ind1);
        }        
        return res;
    },

    /**
    * ������� ��������� � ���������� ������� &lt;link>
    * @param {String} text �����-���� �����
    **/
    addLink : function(text, idLayer, seal){
        text = text.toLowerCase();
        var ind1 = text.indexOf('<link');
        var ind2 = text.indexOf('>', ind1 + 1);
        if(ind1 > -1 && ind2 > -1){
            var params = text.substring(ind1, ind2 + 1);
            var link = document.createElement('link');
            $.applyParams(params, link);
            if (link.href) link.href = $.entitiesConvertor(link.href);
            var skip = link[X('skip')];
            if (skip == 'true' || skip == '1') return;

            var href = (seal && typeof idLayer == 'string') ? (idLayer + ':'+link.href) : link.href;
            if ($.indexOfCacheSrc($.linksCache, href) > -1) {
                var repeat = link[X('repeat')];
                if (!D.LINK_REPEAT || repeat == 'false' || repeat == '0'){
                        return; 
                }
            } else {
                $.linksCache.push(href);
            }

            if ($.indexOfCacheSrc($.LIST_NO_LOAD_LINKS, href) > -1) return;
            
            if (seal && link.rel == 'stylesheet') {
                try {
                    dax(link.href, {
                        cb:function(resp, id, status, idLayer) {
                            var text = status ? resp.responseText : '';  
                            $.addStyle('<style>'+text+'</style>', idLayer, 1);
                        },
                        id: (idLayer ? idLayer + ':' : '') + link.href,
                        cbo: idLayer                        
                    })
                    return;
                } catch(ex){
                    error('error seal ' + link.href)
                }
            }

            if (document.createStyleSheet) {
                document.createStyleSheet(link.href);
            } else {
                var head = document.getElementsByTagName('head')[0];
                head.appendChild(link);  
            }

            if (D.DEBUG_LINK) log('append LINK ' + link.href);
                        
        }
    },

    /**
    * ������� ����������� �������������� � HTML �����������,<br>
    * ������������ ��� ����������� ���� ��� ����� ������������� �� ���������� text �������������� ��� ���
    * 
    * @param {String} text ����� HTML
    * @return {Boolean} ��������� �������� �������������� (true - ��, false - ���)
    **/
    isHTMLComment : function(text){  
        var ind1 = text.lastIndexOf('<!--');
        var ind2 = text.indexOf('-->', ind1 + 1);
        return (ind1 > -1 && ind2 == -1);
    },

    /**
    * ������� ����������� ��������������� � HTML ����� (�.�. ��� �� ����������� �� ������� � �� �����),<br>
    * ������������ ��� ����������� � ���� ��������� ������������� �� ���������� text
    * 
    * @param {String} text ����� HTML
    * @return {Boolean} ��������� �������� �������������� (true - ��, false - ���)
    **/
    isHTML : function(text){        
        text = text.toLowerCase();
        function isNoEntry(type){
            var ind1 = text.lastIndexOf('<'+type);
            var ind2 = text.indexOf('</'+type+'>', ind1 + 1);
            var ind3 = text.indexOf('>', ind1 + 1);
            var ind4 = text.indexOf('/>', ind1 + 1);
            return !(ind1 > -1 && ind3 > -1 && ind2 == -1 && ind4 != ind3+1);
        }
        return isNoEntry('script') && isNoEntry('style');
    },
    
    /**
    * ������� ��������� ������������� ������ ��� href � src<br><br>
    * 
    * @param {String} text ����� HTML
    * @param {String} url URL ����� HTML
    * @param {String} type ��� (href ��� src)
    * @return {String} ����� HTML
    **/
    relativeCorrection : function(text, url, type){
        if (url.indexOf('/') == -1) url = location.pathname;
        var ind1 = url.lastIndexOf('/');
        url = url.substring(0, ind1+1);
        
        ind1 = text.toLowerCase().indexOf(' ' + type);
        while (ind1 > -1){
            var ind = $.indexOfAttrMarks(text, ind1 + 2);
            if ($.isHTML(text.substring(0, ind1 + 2)) && ind[0] > -1 && ind[1] > -1){
                var val = text.substring(ind[0] + 1, ind[1]); 
                if (!val.startWith('/') && !val.startWith('#') && $.parseUri(val).protocol == ''){
                        text = text.substring(0, ind[0] + 1) + url + text.substring(ind[0] + 1); 
                  }
            }
            ind1 = text.toLowerCase().indexOf(type, ind1 + 2);
        }
        return text;
    },
    
    /**
    * ������� ������ ������� �������� � ��������� �������
    * @param {Array} arr ������
    * @param {String/Element/Function/Object/Any} el �������
    * @param {Integer} start ������ ������ ������
    * @return {Integer} ������ �������� (= -1 ���� �� ������)
    **/
    arrayIndexOf : function(arr, el, start){
        var ind = -1;
        for(var i = (start || 0); i < arr.length; i++){
            if(arr[i] == el) {
                ind = i;
                break;
            }
        }
        return ind;
    },

    /**
    * ����������� ������������ ��������, ���������� ��� ��������� ���������� ��������
    * @param {String/Array/Object/Function} obj ������
    * @return {String} ���������������� ������
    **/
    toSource : function(obj){
         switch (typeof obj){
            case 'function': return obj.toString();
            case 'string': return "'" + obj + "'";
            case 'object': 
              if (obj.toSource) return  obj.toSource();
              if (obj instanceof Array) return '[' + obj.toString() + ']'; 
              var str = '';
              for (var i in obj) str += ',' + i + ':' + $.toSource(obj[i]);
              return '{' + (str.length > 0 ? str.substring(1) : str) + '}';
         }
         return obj;
    },
    
    /**
    * ������� �������� �������� � ��������� �������
    * @param {Array} arr ������
    * @param {String/Element/Function/Object/Any} el �������
    * @param {Boolean} source true ��� false (�� ���������) - ���� ������������ ��� ���������� �-��� toSource()  
    * @return {Array} ����� ������
    **/
    arrayRemoveOf : function(arr, el, source){
      if (source) el = $.toSource(el);
      for (var i = 0; i < arr.length; i++) if ((source && el == $.toSource(arr[i])) || el == arr[i]) arr.splice(i, 1);
      return arr;
    },
    
    /**
    * ������� �������������� Collection � Array 
    * @param {Collection} col �������� Collection 
    * @return {Array} ������
    **/
    collectionToArray :function (col){
    	var arr = [];
    	for (var i = 0, len = col.length; i < len; i++) arr[i] = col[i];
    	return arr;
    },
        
    /**
    * ������� �������� �������� �� ���-������ ��������� ����
    * @param {Array} arr ���-������
    * @param {String} src src ��� href ����
    * @return {Integer} ��������� �������� (-1 = �� ��������)
    **/
    indexOfCacheSrc : function(arr, src){
        var ind = $.arrayIndexOf(arr,src);
        if (ind == -1){
            src = src.startWith(location.protocol) ? src.replace(location.protocol + '//' + location.host,'') :  location.protocol + '//' + location.host + src;
            ind = $.arrayIndexOf(arr,src);
        }
        return ind;
    },
    
    /**
    * ���������� ������� �������� � ���������� �������� &lt;link>,&lt;style>,&lt;title>,&lt;script><br><br>
    * 
    * ������ ����������: <br>
    * text - ����� HTML <br>
    * idLayer - id ������������� ��������<br>
    * url - URL ����� �������
    * add - ���������� (true) ��� ���������� (false)
    * owner - ������-�������� (� �������� ������) ������� ������� (������ ��� ������������ ��������� document.write)
    * rc - ������������ (true) ��� �� ������������ (false - �� ���������) ��������� ������������� ������ <br>
    * 
    * @param {Object} options ����� �������� HTML
    **/
    parsingText : function(options){
        if (!options) options = {};
        var owner = options.owner;
        if ($.Html.fireEvent(options.id, 'beforeload', options) === false) {
            owner.inprocess = 0;
            return
        }
        var text = options.text;
        text = $.Include.fix(text);
        var idLayer = options.id;
        var url = options.url;
        var add = options.add; 
        var n = 'relativeCorrection';
        if (options.rc == null ? D.RELATIVE_CORRECTION : options.rc) {
            text = $[n](text, url, 'src'); 
            text = $[n](text, url, 'href'); 
            text = $[n](text, url, 'action'); 
        }

        text = $.parsingLinkAndStyle(text, idLayer, options.seal);        
        text = $.parsingFrameset(text);

        n = 'substring';
        var ind01 = text.toLowerCase().indexOf('<head>');
        var start = '';
        if (ind01 > -1)  {
            start += text[n](0, ind01);
            text = text[n](ind01);
        } else {
            start = text;
            text = '';
        }
        var ind02 = text.toLowerCase().indexOf('</head>');
        var end = '';
        if (ind02 > -1) {
            end += text[n](ind02+7);
            text = text[n](0,ind02+7);
        }

        
        var o = $.parsingTitle(text, idLayer);

        text = start + o.text + end;
        if (!add) text = $.parsingLoadUnload(text, idLayer);
        var obj = $.parsingScript(text, idLayer, owner && owner[X('noax')]);

        new $.loadHtml(idLayer, obj.scripts, obj.html, url, add, owner, options.onload, options.scope, o.title);
    },
    
    /**
    * ������� �������� ������� body -> onload & onunload
    * @param {String} text ����� HTML
    * @param {String} idLayer id ������������� ��������
    * @return {String} ����� HTML
    **/    
    parsingLoadUnload : function(text, idLayer){
        var onload, onunload;
        var ind1 = text.toLowerCase().indexOf('<body');
        if (ind1 > -1){
            var ind2 = text.indexOf('>', ind1+1);
            if (ind2 > -1){
                var body = text.substring(ind1, ind2 + 1);
                onload = $.getParam(body, 'onload'); 
                onunload = $.getParam(body, 'onunload');
                text = text.substring(0, ind1) + body.replaceAll('load', '') + text.substring(ind2 + 1);
            }
        }
        
        var n = 'LoadUnloadContainer';
        if (!$[n][idLayer]) $[n][idLayer] = {};
        $[n][idLayer].onload = onload;
        $[n][idLayer].onunload = $[n][idLayer].nextonunload;
        $[n][idLayer].nextonunload = onunload;

        return text;
    },

    /**
    * ������� �������� &lt;title>
    * @param {String} text ����� HTML
    * @param {idLayer} id ������������� ��������
    * @return {Object} ����� HTML � title
    **/
    parsingTitle : function(text, idLayer){
        var tmp = text.toLowerCase();
        var ind1 = tmp.indexOf('<title>');
        var ind2 = tmp.indexOf('</title>', ind1 + 1);
        var title;
        while (ind1 > -1 && ind2 > -1) {
            if (!$.isHTMLComment(text.substring(0, ind1)) && !title) 
                title = $.titleChange(text.substring(ind1 + 7, ind2), idLayer);
            text = text.substring(0,ind1) + text.substring(ind2+8);
            tmp = text;
            ind1 = tmp.indexOf('<title>', ind1+1);
            ind2 = tmp.indexOf('</title>', ind1 + 1);
        }
        return {text:text, title:title};
    },

    /**
    * ������� ��������� &lt;title>
    * @param {String} text ����� HTML
    * @param {idLayer} id ������������� ��������
    * @return {Boolean} ��������� ���������
    **/
    titleChange : function(title, idLayer){
        var oldTitle = document.title;
        if ($.Html.fireEvent(idLayer, 'beforetitlechange', {oldTitle:oldTitle, newTitle:title}) !== false){
            document.title = title;
            $.Html.fireEvent(idLayer, 'titlechange', {oldTitle:oldTitle, newTitle:title});
            return title;
        }
        return false;
    },

    /**
    * ������� �������� &lt;frameset>
    * @param {String} text ����� HTML
    * @return {String} ����� HTML
    **/
    parsingFrameset : function(text){
        var ind1 = text.toLowerCase().indexOf('<frameset');
        if (ind1 > -1){
            var ind2 = text.toLowerCase().indexOf('>', ind1);
            var ind3 = text.toLowerCase().indexOf('</frameset>');
            if (ind2 > -1 && ind3 > -1){
                var tmp = text.substring(ind1,ind3+11);
                var gid = $.genId();
                tmp = "<iframe style='height:100%;width:100%;border:0' href='javascript:true' id='"+gid+"'></iframe><script>var obj = SRAX.get('"+gid+"');var doc = obj[obj.contentWindow ? 'contentWindow' : 'contentDocument'].document;doc.open();doc.write('"+tmp.replaceAll('\n','').replaceAll('\r','').trim()+"');doc.close()</script>";
                text = text.substring(0,ind1)+tmp+text.substring(ind3+11);
            }
        }
        return text;
    },

    /**
    * ������� ����������������� �������� &lt;link> � &lt;style>
    * @param {String} text ����� HTML
    * @return {String} ����� HTML
    **/
    parsingLinkAndStyle : function(text, idLayer, seal){
        var l1 = text.toLowerCase().indexOf('<link');
        var s1 = text.toLowerCase().indexOf('<style');
        var html = '';
        var ind1 = -1;
        var ind2 = -1;
        
        if ((l1 < s1 && l1 > -1) || s1 == -1){
            ind1 = l1;
            ind2 = text.indexOf('>', ind1 + 1);            
        } else {
            ind1 = s1;
            ind2 = text.toLowerCase().indexOf('</style>', ind1 + 1);    
        }

        while(ind1 > -1 && ind2 > -1){
            if (ind1 > 0) html += text.substring(0, ind1);

            if ((l1 < s1 && l1 > -1) || s1 == -1) {
                if (!$.isHTMLComment(text.substring(0, ind1))) $.addLink(text.substring(ind1, ind2 + 1), idLayer, seal);
                text = text.substring(ind2 + 1);
            } else {
                if (!$.isHTMLComment(text.substring(0, ind1))) $.addStyle(text.substring(ind1, ind2 + 8), idLayer, seal);
                text = text.substring(ind2 + 8);
            }
            l1 = text.toLowerCase().indexOf('<link');
            s1 = text.toLowerCase().indexOf('<style');

            
            if ((l1 < s1 && l1 > -1) || s1 == -1){
                ind1 = l1;
                ind2 = text.indexOf('>', ind1 + 1);
            } else {
                ind1 = s1;
                ind2 = text.toLowerCase().indexOf('</style>', ind1 + 1);    
            }

        }

        if (text.length > 0) html += text;
        return html; 
        
    },

    /**
    * ������� �������� &lt;script>
    * @param {String} text ����� HTML
    * @param {String} idLayer id ������������� ��������
    * @return {String} ����� HTML
    **/
    parsingScript : function(text, idLayer, noax){        
        var ind1 = text.toLowerCase().indexOf('<script');
        var ind2 = text.toLowerCase().indexOf('</'+'script>', ind1 + 1);
        var n = 9;
        var ind3 = text.indexOf('>', ind1 + 1);
        var ind4 = text.indexOf('/>', ind1 + 1);
        if (ind3 > -1 && ind4 !=- 1 && ind3 == ind4 + 1) {
            ind2 = ind4; 
            n = 2;
        }

        var html = [];
        var scripts = [];
        var placeScript = 0;
        while(ind1 > -1 && ind2 > -1){    
            if (ind1 > 0) html.push(text.substring(0, ind1));
            var script = $.makeScript(text.substring(ind1, ind2 + n));                
            if (noax) script[X('noax')] = 1;
            text = text.substring(ind2 + n);
            ind1 = text.toLowerCase().indexOf('<script');
            ind2 = text.toLowerCase().indexOf('</'+'script>', ind1 + 1);
            n = 9;
            ind3 = text.indexOf('>', ind1 + 1);
            ind4 = text.indexOf('/>', ind1 + 1);
            if (ind3 > -1 && ind4 !=- 1 && ind3 == ind4 + 1) {
                ind2 = ind4; 
                n = 2;
            }
            

            if (html.length == 0 || !$.isHTMLComment(html.join(''))){
                if (true || text.toLowerCase().indexOf('<body') == -1) {
                    if (html.length == 0 || html[html.length - 1].indexOf('_place_of_script_') == -1) {
                        html.push('<span id="'+idLayer+'_place_of_script_'+placeScript+'" style="display:none"><!--place of script # ' + placeScript + '//--></span>');
                        placeScript++;
                    }
                    script.place = idLayer+'_place_of_script_'+(placeScript-1);
                    var old_place = $.get(script.place);
                    if (old_place) old_place.id += 'old'; 
                }

                var skip = script[X('skip')];
                if (skip == 'true' || skip == '1') continue;
                if (script.src) {
                    if (script.src.indexOf('fullajax.js') > -1 || //script.src.indexOf('linker.js') > -1 ||
                    $.indexOfCacheSrc($.LIST_NO_LOAD_SCRIPTS, script.src) > -1) continue;
                    var ind = $.indexOfCacheSrc($.scriptsCache[0],script.src);
                    if (ind > -1) {
                        var repeat = script[X('repeat')];
                        if ((repeat == null || (repeat != 'false' && repeat != '0')) && D.SCRIPT_SRC_REPEAT_APPLY){
                            $.scriptsCache[1][ind].place = script.place;
                            script = $.cloneScript($.scriptsCache[1][ind]);                    
                        } else {
                            script = $.makeScript('<script type="text/javascript">//no repeat '+script.src+'</'+'script>');
                        }
                    } else {
                        try{
                            if ($.Data.thread[script.src] && $.Data.thread[script.src].isProcess()) {
                                script = $.Data.thread[script.src].options.cbo;
                            } else {
                                if (D.SCRIPT_NOAX || script[X('noax')]) script.xss = 1; else new $.startLoadScript(script);
                            }
                        } catch (ex){
                            error(ex);
                        }
                    }
                }
                var h = X('head');
                var head = script[h];
                script[h] = head == null ? text.toLowerCase().indexOf('</head>') > -1 : (head == '1' || head == 'true');
                scripts.push(script);
            }
        }

        if (text.length > 0) html.push(text);

        return {
            scripts:scripts,
            html:html
        }
    },


    /**
    * ������� ���������� �������� ������� &lt;script>
    * @param {Object} resp ������ �����
    * @param {String} id id �������� �������� �������
    **/
    finishLoadScript : function(resp, id, status, oldScript) {
        var text = status ? resp.responseText : '';  
        var script = $.makeScript('<script type="text/javascript">'+text+'</'+'script>');
        script.place = oldScript.place;
        script.id = oldScript.id ? oldScript.id : id;
        var ind = $.indexOfCacheSrc($.scriptsTemp[0],id);
        if (ind == -1) ind = $.scriptsTemp[0].length;
        $.scriptsTemp[0][ind] = id;
        $.scriptsTemp[1][ind] = script;

        if (D.USE_SCRIPT_CACHE && $.indexOfCacheSrc($.LIST_NO_CACHE_SCRIPTS,id) == -1 && !oldScript[X('nocache')]) {
            ind = $.indexOfCacheSrc($.scriptsCache[0],id);
            if (ind == -1) ind = $.scriptsCache[0].length;
            $.scriptsCache[0][ind] = id;
            $.scriptsCache[1][ind] = $.cloneScript(script);
        }


    },

    /**
    * ������� ������ �������� ������� &lt;script>
    * @param {String} url URL ����� ������� 
    **/
    startLoadScript : function(script) {
        try{
            dax(script.src, {
                cb:$.finishLoadScript,
                id:script.src,
                cbo: script,
                anticache: script[X('nocache')]                
            })
        } catch (ex){
            if (!script.id) script.id = script.src;
            script.xss = script.src;
            //log(ex);
        }
    },
    

    /**
    * ������� ������������ ��������
    * @param {Object} old ������ ������
    * @return {Object} script ������ ������
    **/
    cloneScript : function(old, options){
        if (!options) options = {};
        var script = document.createElement('script');        
        var params = ['src','type','language','defer','text','id','place', X('repeat'),X('noax'),X('skip'),X('head'), X('noblock')];
        for (var i = 0, len = params.length; i < len; i++){
            try{
                var val = old[params[i]];
                if (options[params[i]] != null) val = options[params[i]];
                if (val != null && val != '') script[params[i]] = val;        
            } catch (ex){}
        }
        return script;
    },

    /**
    * ������� ����������������� ���������� ��������
    * @param {Array} scripts �������
    * @param {String} idLayer id ������������� ��������
    * @param {String} url URL ����� �������
    * @param {Function} func �������, ������� ���������� ����� ���������
    **/
    serialApplyScripts : function(scripts, idLayer, url, func){	
        var i = 0;        
        this.checkload = function() {
            if (i >= scripts.length) {
                $.docWriteTraper.apply(idLayer);
                if (!$.xssLoading && !(i >= 1 ? (scripts[i-1].inprocess || scripts[i-1].countproc) : 0)) {
                    return func ? func() : null;
                }
            } else {
                if (scripts[i].src) {
                    var ind = $.indexOfCacheSrc($.scriptsTemp[0],scripts[i].src);
                    if (ind > -1 && !(scripts[i][X('noax')] && scripts[i][X('nocache')])) {
                        var place = scripts[i].place;
                        scripts[i] = $.cloneScript($.scriptsTemp[1][ind]);
                        scripts[i].place = place;
                    }
                }

                if (!scripts[i].src && (i > 0 ? !scripts[i-1].inprocess : 1)) {
                    new $.addScript(scripts[i], idLayer, url);
                    $.docWriteTraper.apply(idLayer)
                    i++;
                } else {
                    if (scripts[i].src && !$.xssLoading){
                         if (scripts[i].loaded){
                            $.docWriteTraper.apply(idLayer)
                            i++;
                         } else {
                            if (scripts[i].xss) {
                                scripts[i].xss = 0;
                                new $.addScript(scripts[i], idLayer, url);
                            }
                         }
                    }
                }
            }
            var _this = this;
            this.recall = function() {_this.checkload()};
            setTimeout(this.recall, 10);
        }
        this.checkload();			
    },
	  
    /**
    * ������� ���������� ���� � �������� ��������
    * @param {idLayer} id ������������� ��������
    * @param {Array} scripts ������� ����� <body>
    * @param {Array} html ����� HTML
    * @param {String} url URL ����� ������� 
    * @param {Boolean} add ���������� (true) ��� ���������� (false)
    * @param {Object} owner ������-�������� ������� �������
    * @param {Array/Function/String} onload �������, ������� ���������� ����� ������ �������� ��������
    * @param {String} title ���������
    **/
    loadHtml : function(idLayer, scripts, html, url, add, owner, onload, scope, title){
        $.removeScripts(scripts);
        $.Html.fireEvent(idLayer,'unload');
        if (!add) $.onUnloadBody(idLayer, url);
        
        var head = [], other = [];
        for (var i = 0; i < scripts.length; i++){
            var arr = scripts[i][X('head')] ? head : other;
            arr.push(scripts[i]);
        }
        new $.serialApplyScripts(head, idLayer, url, function(){
            $[$.Model2Blocks[idLayer] ? 'paintHtml2' : 'paintHtml'](html.join(''), idLayer, url, add);        
            if (!add) $.Effect.use(idLayer);
          
            new $.serialApplyScripts(other, idLayer, url, function(){
                    if (D.USE_FILTER_WRAP) {
                        var model2 = $.Model2Blocks[idLayer];
                        if (model2){
                            for (var n in model2){
                                var layer = $.get(model2[n]);
                                if (layer) $.Filter.wrap(layer, url);
                            }
                        } else $.Filter.wrap(idLayer, url);
                    }
                    $.Include.parse();                    
                    if (owner) {
                        owner.inprocess = 0;
                        if (owner.countproc) owner.countproc--;
                    }
                    var ops = {
                        id: idLayer,
                        scripts: scripts, 
                        html: html, 
                        url: url, 
                        add: add, 
                        owner: owner, 
                        scope: scope,
                        title: title
                    }
                    if (!add) {
                      $.onLoadBody(idLayer, url);
                      $.execFunc(onload, [ops], scope);
                    }
                    $.Html.fireEvent(idLayer, 'load', ops);
                    $.ContentTrigger.use(idLayer, url);
                    if (!$.Html.ASYNCHRONOUS && $.Html.storage[0] == idLayer){
                        $.Html.storage.splice(0,1);
                        if ($.Html.storage.length > 0) {                            
                            $.Html.thread[idLayer].request();
                        }
                    }
                    $.showLoading(0, $.Html.thread[idLayer].loader);
            })          
        })
    },

    /**
    * ������� ��� �������� ������� onload
    * @param {String} idLayer id ������������� ��������
    * @param {String} url URL ����� ������� 
    **/
    onLoadBody : function(idLayer, url){
        if ($.LoadUnloadContainer[idLayer].onload) {
            $.parsingText({id:idLayer, url:url, text:'<script id="'+X('script'+D.sprt+'temp')+'" type="text/javascript">'+$.LoadUnloadContainer[idLayer].onload+'</'+'script>', add:1});
        }
        if ($.isCOL){
            window._onload(); 
        }
    },
    
    
    /**
    * ������� ��� ������� ������� window.onload, ������������� � ������� javascript <br>
    * ���������� �������� ������ ������� ����� ����������� ����� </body>, �.�. � ����� ��������� �������
    **/
    captureOnLoad : function(){
        window.onloadHandlers = [];
        window._onload = function(){
            var arr = window.onloadHandlers;
            window.onloadHandlers = [];
            arr.push(window.onload);
            window.onload = null;
            for (var i = 0, len = arr.length; i < len; i++){
                try{
                    if (arr[i]) arr[i]();
                } catch (ex){
                    error(ex);
                }
            }            
        }
        window.onloadHandlers.push(window.onload);
        window.onload = function(){
            window.onload = null;
            window._onload();
        }
        
        window._addEvent = window[window.attachEvent ? 'attachEvent' : 'addEventListener'];

        window.addEventListener = window.attachEvent = function(name, handler, bool){
            if (name == 'load'){
                window.onloadHandlers.push(handler);
            } else {
                window._addEvent(name, handler, bool);
            }
        }
                
        $.isCOL = 1;
    },

    /**
    * ������� ��� �������� ������� onload
    * ���������� ���������� - ����������� ��������� �������� ��������, ������� ������������ ����� document.write
    * @param {String} idLayer id ������������� ��������
    * @param {String} url URL ����� ������� 
    **/
    onUnloadBody : function(idLayer, url){
        $.execFunc($.LoadUnloadContainer[idLayer].onunload);
    },

    /**
    * ������� ��� ���������� HTML � �������� �������� - ��� ������� ������� ����� �� ����������� 
    * @param {String} html ����� HTML
    * @param {String} idLayer id ������������� ��������
    * @param {Boolean} add ���������� (true) ��� ���������� (false)
    **/
    paintHtml : function(html, idLayer, url, add){
        var options = {
            html: html, 
            id: idLayer,
            url: url,
            add: add 
        }
        if (add) {
            if ($.Html.fireEvent(idLayer,'beforepaintadd', options) !== false){
                $.addTo(html, idLayer);
                $.Html.fireEvent(idLayer,'afterpaintadd', options);
            }
        } else {
            if ($.Html.fireEvent(idLayer,'beforepaint', options) !== false){
                $.PaintHtmlEvent.use(idLayer);
                $.writeTo(html, idLayer);
                $.Html.fireEvent(idLayer,'afterpaint', options);
                $.PaintHtmlEvent.use(idLayer, 1);
            }
        }
    },

    /**
    * ������� ��� ���������� HTML � �������� �������� - ��� ������� ���� ������ � ����� ������ (������ ������� #2 - ���������� ������������ ��� Joomla)
    * @param {String} html ����� HTML
    * @param {String} idLayer id ������������� ��������
    * @param {Boolean} add ���������� (true) ��� ���������� (false)
    **/
    paintHtml2 : function(html, idLayer, url, add){
        var blocks = $.Model2Blocks[idLayer];
        var m = D.model2Marker;
        var ind1 = html.indexOf(m.ax);
        var ind2 = html.indexOf(m.begin, ind1+1);
        var ind3 = html.indexOf(m.ax, ind2+1);
        var ind4 = html.indexOf(m.end, ind3+1);
        while (ind1 > -1 && ind2 > -1 && ind3 > -1 && ind4 > -1){
            var id = html.substring(ind1 + m.ax.length, ind2);
            var text = html.substring(ind2 + m.begin.length, ind3);
            if (blocks[id]) {
                var options = {
                    html: text, 
                    id: id,
                    url: url,
                    block: blocks[id],
                    add: add
                }
                if (add){
                    if ($.Html.fireEvent(idLayer,'beforepaintadd', options) !== false){
                        $.addTo(text, blocks[id]);
                        $.Html.fireEvent(idLayer,'afterpaintadd');
                    }
                } else {
                    if ($.Html.fireEvent(idLayer,'beforepaint', options) !== false){
                        $.PaintHtmlEvent.use(blocks[id]);
                        $.writeTo(text, blocks[id]);
                        $.Html.fireEvent(idLayer,'afterpaint');
                        $.PaintHtmlEvent.use(blocks[id], 1);
                    }
                }
            }
            ind1 = html.indexOf(m.ax, ind4+1);
            ind2 = html.indexOf(m.begin, ind1+1);
            ind3 = html.indexOf(m.ax, ind2+1);
            ind4 = html.indexOf(m.end, ind3+1);
        }

    },

    /**
    * ������-������� ��� ��������� document.write � document.writeln
    **/
    docWriteTraper : new function(){
        var scripts = {};
        var urls = {};
        var texts = {};
        
        this.add = function(text, id, url, script){
            if (script.inprocessTO) clearTimeout(script.inprocessTO);
            script.inprocess = 1;
            scripts[id] = script;
            urls[id] = url;
            if (!texts[id]) texts[id] = '';
            texts[id] += text;
            this.checkMutiLine(id);
        }

        //�������� �� ����������� ��������������� ������������� write ��� ��������� � ���������� �����
        //������ ��������� ���������� - ����� ���������
        this.checkMutiLine = function(id){
            var text = texts[id];
            var ind1 = text.indexOf('<');
            while (ind1 > -1){
                var n = 1;
                var s = text.charAt(ind1+n).trim();
                while(s != '' && s != '>'){
                    if (s == '/' && text.charAt(ind1+n+1) == '>') {
                        this.apply(id);
                        return;
                    }
                    s = text.charAt(ind1+(++n)).trim();
                }
                var tag = text.substring(ind1+1,ind1+n);
                var ind2 = text.indexOf('</'+tag+'>', ind1);
                if (ind2 > -1) {
                    this.apply(id);
                    break;
                } else {
                    var ind3 = text.indexOf('>', ind1+1+tag.length);
                    if (ind3 > -1 && (tag == 'img' || tag == 'input' || tag == 'br' || tag == 'hr')){
                        this.apply(id);
                        return;
                    }
                    ind1 = text.indexOf('<', ind1+1);
                }
            }
        }

        this.apply = function(id){
            if (!texts[id]) return;
            var text = texts[id];
            delete texts[id];
            if (!scripts[id].countproc) scripts[id].countproc = 1; else scripts[id].countproc++;
            PM($.get(scripts[id].place), 1);
            $.parsingText({text:text, id:scripts[id].place, url:urls[id], add:1, owner:scripts[id]});
            /*
            if (layer) {
                var parent = layer.parentNode;
                while (layer.childNodes.length > 0){
                    parent.insertBefore(layer.firstChild, layer);
                }
            }
            */
        }

        this.applyAll = function(){
            for (var i in texts){
                if (texts[i]) $.docWriteTraper.apply(i);
            }
        }
    },

    /**
    * ������� ���������� �������
    * @param {Object/String} script ������ ������ / ������� �������� ���� String, ����� ���������� URL ����� �������
    * @param {String/Function} idLayer id ������������� �������� / ���� ������� �������� script ���� String, ����� idLayer ���������� callback �������, ������� ���������� ����� �������� �������
    * @param {String/Boolean} url URL ����� ������� / ���� ������� �������� script ���� String, ����� url ���������� ���� ���������� ������������� AJAX �������� �������
    * @param {-/Boolean} nocache ���� ���������� �������������� ��� AJAX �������� �������
    * @param {-/String} place ������������� ��������, � ������� ����� ���������� ����������� � ������ document.write
    * @param {-/String} place ������������� ��������, � ������� ����� ���������� ����������� � ������ document.write
    * @param {-/Boolean} storage ���� ������������� ���������� ��������� true (�� ���������) ��� false - ��������� ������ ��� ����������� SRAX.Storage
    * @param {-/Boolean} noblock ���� ��� ������������� �������� �������������� ������� true ��� false (�� ���������)
    **/
    addScript : function(script, idLayer, url, nocache, place, storage, noblock) {
        if (typeof script == 'object' && script.nodeName != 'SCRIPT'){
            idLayer = script.callback || script.cb;
            url = script.noax;
            place = script.place;
            nocache = script.anticache == null ? script.nocache : script.anticache; 
            storage = script.storage;
            noblock = script.noblock;
            script = script.src ? script.src : script.url;
        }    
        if ($.Storage && (storage == null ? D.USE_STORAGE : storage) && $.Storage.isPosible() && !$.Storage.isReady){
            $.Storage.onReady(function(){$.addScript(script, idLayer, url, nocache, place, storage)});
            return;
        }
        if (typeof script == 'string'){
            var span = document.createElement('span');
            span.cb = idLayer ? idLayer : function(){};
            span.id = $.genId();
            span.style.display = 'none';
            PM(span, 1);
            
            var scripts = document.getElementsByTagName('script');
            place = $.get(place);
            if (place){
              place.innerHTML = '';
              place = place.appendChild(span);
            } else { 
              for (var i = 0, len = scripts.length; i < len; i++){
                  var text = scripts[i].innerHTML;
                  var ind1 = text.indexOf('SRAX.addScript');
                  if (ind1 > -1){
                      var ind2 = text.indexOf(script);
                      if (ind2 > ind1){
                          place = scripts[i].place ? $.get(scripts[i].place) : scripts[i];
                          break;
                      }
                  }
              }
            }
            if (place) place.parentNode.insertBefore(span, place); else document.body.appendChild(span);
            hax({id:span.id, url:script, html:'<body onload="SRAX.get(\''+span.id+'\').cb()"><script type="text/javascript" src="'+script+'"'+(url?' '+X('noax')+'="1"':'')+(nocache?' '+X('nocache')+'="1"':'')+(noblock?' '+X('noblock')+'="1"':'')+'></script></body>', nohistory:1, storage:storage});
            return;
        }
        /**
        * ������� ��� ��������� document.write � document.writeln
        * @param {text} �����-���� �������
        * @return {text} �����-���� �������
        **/
        $.docWriteTraper.apply(idLayer);
        document.write = function(text){
            $.docWriteTraper.add(text, idLayer, url, script);
        }

        document.writeln = function(text){
            document.write(text+'\n');
        }

        if (D.DEBUG_SCRIPT) {
            var ids = script.id;
            if (!ids || ids == '') ids = script.innerHTML.trim().substring(0,100) + '\n...';
            log('append script -> ' + ids);
        }

        if (script.src) {
            script.inprocess = 1; 
            $.xssLoading = !script[X('noblock')];
            script.onerror = script.onload = script.onreadystatechange = function(){
                var t = this;
                if (!t.loaded && (!t.readyState || t.readyState == 'loaded' || t.readyState == 'complete')){
                    t.loaded = 1;
                    t.onerror = t.onload = t.onreadystatechange = null;
                    $.xssLoading = 0;
                    t.inprocessTO = setTimeout(function(){
                        t.inprocess = 0;
                    }, 100);
                }
            }
        }
        
        var head = document.getElementsByTagName('head')[0];
        head.appendChild(script); 
    },   

    /**
    * ������� ������������ ���������� ������� ����� eval
    * @param {String} text ����� �������
    **/
    evalScript : function(text) {
        try{
            if ($.browser.safari){
                window._evalCode = text;
                new $.addScript($.makeScript('<script type="text/javascript">eval(window._evalCode)</script>'));
            } else
            if (window.execScript) window.execScript(text); else window['eval'](text);
        } catch (ex){
            error(ex);
            return 0;
        }
        return 1;
    },
    
    /**
    * ������� �������� ��������
    * @param {Array} scripts ������� �������
    **/
    removeScripts : function(scripts) {
        var head = document.getElementsByTagName('head')[0];
        var s = head.getElementsByTagName('script');
        var arr = [];
        for (var i = 0, len = scripts.length; i <= len; i++){
            if (i < scripts.length && typeof scripts[i] == 'string') continue;
            var id = i < scripts.length ? scripts[i].id : X('script'+D.sprt+'temp');
            for (var j = 0, len = s.length; j < len; j++){
                if (id ? s[j].id == id : s[j].innerHTML == scripts[i].innerHTML) {
                  arr.push(s[j]);                    
                  break;
                }
            }
        }
        for (var i = 0, len = arr.length; i < len; i++){
            if (arr[i].parentNode) {
                if (D.DEBUG_SCRIPT) log('remove script ' + (arr[i].id ? arr[i].id : arr[i].innerHTML));
                arr[i].parentNode.removeChild(arr[i]);
            }
        }
    },
   
    /**
    * ������� ��������� ������� :)
    * @param {Function/String} func - ������-������� ��� ������� � ������� String
    * @param {Array} args - ������ ����������, ������� ���������� �������� � �������
    **/   
    execFunc : function(func, args, scope){
        if (func instanceof Array) {
            for (var i = 0, l = func.length; i < l; i++) $.execFunc(func[i], args, scope);
        } else    
        if (func){
            try{
                if (!scope) scope = window;
                if (typeof func == 'string'){
                    func = func.trim();
                    if (func.startWith('function') && func.endWith('}')) {
                        func = $.browser.msie ? 'SRAX.tmp=' + func : '(' + func + ')';
                     }  
                    (function(){
                      func = window['eval'](func)
                    }).call(scope)                
                    if (typeof func != 'function') return;
                }
                func.apply(scope, args);
            } catch (ex){
                error(ex);
            }
        }        
    },
   
    /**
    * ������ �������� ������� HTML
    * @param {String} idLayer id ������������� ��������, � ������� ����������� ��������� ������� HTML (���� null - ����� � document.body)
    **/
    HTMLThread : function(idLayer){
        var xhr, startTime, loader;
        var _this = this;

        this.inprocess = 0;
        this.id = idLayer;
        var ops = this.options = {};

        $.Html.thread[idLayer] = this;
        $.Html.register(this);

        this.repeat = function(form, nohistory, params){
            ops.form = form;
            ops.nohistory = nohistory;
            ops.params = params;
            _this.request();
        }

        this.setOptions = function(options, overwrite){
            if (!options.url) options.url = options.src;    
            if (!options.cb) options.cb = options.callback;    
            if (options.cbo == null) options.cbo = options.callbackOps;    
            if (options.anticache == null) options.anticache = options.nocache;
            if (overwrite) ops = {};
            $.extend(ops, options);
            if (ops.async == null) ops.async = true;
            if (ops.url && ops.url.startWith($.host)) ops.url = ops.url.replace($.host, '');   
            this.loader = loader = ops.loader == null ? $.getLoader(idLayer, 1) : $.get(ops.loader);   
            this.options = ops;
        }

        this.getOptions = function(){
            return ops;
        }
        
        this.isProcess = function (){
            return _this.inprocess;
        }       
        
        this.request = function(){
            var m = ops.method ? ops.method : (ops.form ? ops.form.method : 'get');
            var method = (m && m.toLowerCase() == 'post') ? 'post':'get';
            try{
                var options = {
                    url:ops.url,
                    id:idLayer,
                    options:ops
                }
                if (_this.fireEvent('beforerequest', options) !== false){
                    var action = function() {
                        startTime = $.getTime();
                        var body = $.createQuery(ops.form);
                        if (ops.params) {
                            if (body != '' && !ops.params.startWith('&')) body += '&';
                            body += ops.params; 
                        }
                        if (method != 'post' && body != '') {
                            if (ops.url.indexOf('?') == -1){
                                ops.url += '?' + body
                            } else {
                                ops.url += ((ops.url.endWith('?') || ops.url.endWith('&')) ? '' : '&') + body
                            }
                        }
                        if (_this.inprocess) _this.abort();
                        _this.inprocess = 1;
                        var ind = location.href.indexOf('#');
                        var href = (ind == -1) ? location.href : location.href.substring(0, ind);
                        var useAnticache = ops.html != null || (href.endWith(ops.url) || (ops.anticache != null ? ops.anticache : D.HAX_ANTICACHE));
                        ind = HTMLHistory.getIndex(ops.url);
                        if (!useAnticache && ind > -1 && method != 'post'){
                            ops.html = HTMLHistory.storage[ind][1];
                        }
                        if (ops.html){
                            processRequest({readyState:4,status:200,responseText:ops.html})
                            ops.html = null;
                        } else {
                            if (!xhr) xhr = $.getXHR();

                            if (ops.user) xhr.open(method.toUpperCase(), ops.url, ops.async, ops.user, ops.pswd);
                            else xhr.open(method.toUpperCase(), ops.url, ops.async);

                            xhr.onreadystatechange = ops.async ? processRequest : function(){};
                            var rh = 'setRequestHeader';
                            if (ops.cut) xhr[rh]('AJAX_CUT_BLOCK', ops.cut);
                            if (useAnticache) xhr[rh]('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT');
                            xhr[rh]('AJAX_ENGINE', 'Fullajax');
                            xhr[rh]('HTTP_X_REQUESTED_WITH', 'XMLHttpRequest');
                            if (ops.headers){
                                for (var i in ops.headers){
                                    xhr[rh](i, ops.headers[i]);
                                }
                            }
                            if (method == 'post') xhr[rh]('Content-Type', 'application/x-www-form-urlencoded; Charset=' + D.CHARSET);                                        
                            xhr.send((method == 'post') ? body : null);
                            if (!ops.async) processRequest();
                        }
                        $.showLoading(_this.inprocess, loader);
                        if (D.DEBUG_AJAX) log(method + ' ' + ops.url + ' params:' + body + ' id:' + idLayer);
                    };
                    if (!$.Effect.use(idLayer, 1, action)) action();
                    _this.fireEvent('afterrequest', options)
                }
            } catch (ex){
                _this.abort();
                error(ex);
                throw ex;
            }
        }
  
        this.abort = function(){
            _this.inprocess = 0;
            if (!xhr) return;
            try{
                xhr.isAbort = 1;
                xhr.abort();
            } catch (ex){}
            xhr = null;
            $.showLoading(0, loader);
        }
        
        this.destroy = function(){
            $.Html.thread[idLayer] = null;
            delete $.Html.thread[idLayer];
        }

        function processRequest(obj) {   
          if (!obj || !obj.readyState) obj = xhr;
            try{
                if (obj.readyState == 4) {
                    var status = obj.isAbort ? -1 : obj.status;
                    var success = (status >= 200 && status < 300) || status == 304 || (status == 0 && location.protocol == 'file:');
                    var text = obj.responseText;
                    
                    try{
                        var all = obj.getAllResponseHeaders().split('\n');
                        var headers = {};
                        for (var i = 0, len = all.length; i < len; i++){
                            var ind = all[i].indexOf(':');
                            if (ind > -1) headers[all[i].substring(0,ind).toLowerCase()] = all[i].substring(ind+2);                        
                        }                        
                        var ct = headers['content-type']; 
                        if (ct) {
                            var arr = ['application/x-javascript', 'application/javascript', 'text/javascript', 'application/json', 'text/json'];
                            for (var i = 0, len = arr.length; i < len; i++){
                                if (ct.indexOf(arr[i]) > -1){
                                   text = '<script>' + text + '</script>';
                                   ops.add = 1;
                                   break;
                                }
                            }
                        }
                    } catch (ex){}
                    var o = {
                         xhr:obj,
                         url:ops.url,
                         id:idLayer,
                         status:status,
                         success:success, 
                         cbo:ops.cbo, callbackOps:ops.cbo,
                         options:ops,
                         text:text,
                         thread:_this,
                         /**
                         * responseText - deprecated, ��������� ��� ������������� � ����������� �������� - ������ ������������� ����� ����� ������������ text
                         **/
                         responseText:text,
                         time: $.getTime() - startTime
                    }
                    _this.fireEvent('response', o);
                    
                    if (status > -1 && $.HtmlPreprocessor(o) !== false) {
                        if (ops.cb) {
                            $.execFunc(ops.cb, [o, idLayer, success, ops.cbo], ops.scope);
                            if (D.DEBUG_AJAX) log('callback id:' + idLayer);
                        }
                        _this.inprocess = 0;
                        if (success) {
                            if (o.text) {
                                HTMLHistory.add(ops.url, o.text, ops);
                                _this.inprocess = 1;
                                $.parsingText({owner:_this, text:o.text, id:idLayer, url:ops.url, add:ops.add, rc:ops.rc, seal:ops.seal, onload:ops.onload, scope:ops.scope})
                            } else {
                                warn('empty response: ' + idLayer + ' => ' + ops.url);
                                $.Effect.use(idLayer);
                            }
                            if (D.DEBUG_AJAX) log('response ok:' + ops.url);
                        } else {
                            $.showMessage(ops.url, obj.status, obj.statusText);
                            $.Effect.use(idLayer);
                        }
                    }

                    $.showLoading(_this.inprocess, loader);
                    if ((ops.destroy != null) ? ops.destroy : D.HAX_AUTO_DESTROY){
                         _this.destroy();
                    }
                } 
            } catch (ex){
                error(ex);
                _this.fireEvent('exception',
                     {xhr:obj,
                     url:ops.url,
                     id:idLayer,
                     exception:ex,
                     options:ops}
                )
                $.Effect.use(idLayer);
                _this.inprocess = 0;
                $.showLoading(_this.inprocess, loader);
                if ((ops.destroy != null) ? ops.destroy : D.HAX_AUTO_DESTROY){
                     _this.destroy();
                }
            }
        }
        
        var HTMLHistory = this.history = {
            storage : [],        
            
            startPageHtml : null,
            
            startPageOps : null,

            startPageUrl : null,

            current : 0,

            currentUrl : function(){
                if (this.storage.length == 0 || this.current <= 0) return null;
                return this.storage[HTMLHistory.current][0]
            },
            
            add : function (loc, data, o) {
                this.current++;
                var host = location.host;
                if (loc.href) loc = loc.href;
                var ind = loc.indexOf(host);
                if (ind > -1) loc = loc.substring(ind + host.length);
                    
                loc = $.replaceLinkEqual(loc);
                if (ops.startpage){
                    ops.startpage = 0;
                    HTMLHistory.startPageHtml = data;
                    HTMLHistory.startPageUrl = loc;
                    HTMLHistory.startPageOps = $.extend({}, ops);
                    $.History.setCurrent($.getHash());
                }
                var useHist = !(ops.nohistory != null ? ops.nohistory : D.NO_HISTORY);
                if (useHist) {
                    if (HTMLHistory.startPageHtml == null) {
                        var html = ['<head><title>'+document.title+'</title></head>']; 
                        var model2 = $.Model2Blocks[idLayer];
                        if (model2){
                            for (var i in model2){
                                var layer = $.get(model2[i]);
                                if (layer) html.push(D.model2Marker.ax + i + D.model2Marker.begin + layer.innerHTML + D.model2Marker.ax + i + D.model2Marker.end);                                
                            }
                        } else {
                            var layer = $.get(idLayer);
                            if (!layer) layer = document.body;
                            html.push(layer.innerHTML);
                        }
                        HTMLHistory.startPageHtml = html.join('');
                        HTMLHistory.startPageUrl = location.href;
                    }
                    $.History.add(idLayer, loc);
                }


                if (this.current > D.LENGTH_HISTORY_CACHE){
                    this.current--;
                    this.storage.splice(0,1);
                }

                this.storage.length = this.current; 
                this.storage.push([$.replaceLinkEqual(loc, 1), data, o]);
            }, 

            get : function (val) {
                return this.storage[val];
            },

            getIndex : function(loc, ind){
                for (var i = ind || 0, len = this.storage.length; i < len; i++)                
                    if (this.storage[i] != null && loc == this.storage[i][0]) 
                        return i;
                return -1;
            }

        }
  
        this.go2History = function(loc){
            if (HTMLHistory.currentUrl() != loc) {
                var uhc = ops.historycache != null ? ops.historycache : D.USE_HISTORY_CACHE;
                if (!uhc || !this.go2UrlHistory(loc)) {
                    loc = $.replaceLinkEqual(loc, 1);                    
                    var ind = HTMLHistory.getIndex(loc, 2);
                    var o = {
                        url: loc,
                        nohistory:1
                    }
                    if (ind > -1) $.extend(o, HTMLHistory.storage[ind][2], 1);
                    this.setOptions(o, ind > -1);
                    this.request();
                }
            }
        }
        
        this.go2UrlHistory = function(loc) {
            var ind = HTMLHistory.getIndex(loc);
            if (ind > -1) {
                this.go(ind - HTMLHistory.current);
                $.History.setCurrent($.getHash());
                return true;
            }
        }

        this.go = function(val) {   
            var curr = HTMLHistory.current + val; 
            if (curr < 0) curr = 0; else if (curr > HTMLHistory.storage.length - 1) curr = HTMLHistory.storage.length - 1;
            if (curr == 0) return HTMLHistory.go2StartPage();
            HTMLHistory.current = curr;
            var arr = HTMLHistory.storage[curr];
            var url = arr[0];
            var text = arr[1];
            var o = arr[2] || ops;
            if (url && text) {
                //HTMLHistory.add(url, text, o);
                $.parsingText({owner:_this, text:text, id:idLayer, url:HTMLHistory.storage[curr][0], add:o.add, rc:o.rc, seal:o.seal, onload:o.onload, scope:o.scope});
            }
        },

        this.go2StartPage = function(){
            var h = HTMLHistory;            
            if (h.startPageHtml) {
              var o = $.extend({
                    owner:_this, 
                    text:h.startPageHtml, 
                    id:idLayer, 
                    url:h.startPageUrl 
                  }, h.startPageOps || ops, 1)
              $.parsingText(o);
            }
            HTMLHistory.current = 0;
        }

        this.getSrartPageUrl = function(){
            return HTMLHistory.startPageUrl;
        }
    },

    /**
    * ������� ��� ������ ������ ������ � ������� href �� �� �����������
    **/
    replaceHref: function(){
        var l = location;
        var h = l.href;
        var ind = h.indexOf('#');
        if (ind > -1 && h.length > ind + 1){
            l.replace(h.substring(0, ind) + $.replaceLinkEqual(h.substring(ind)))
        }
    },
    
    /**
    * ������� �������� ������� ������ ������
    * @return {Boolean} ��������� ��������
    **/
    directLink: function(){
        $.replaceHref();
        var hash = $.getHash();
        $.History.setCurrent(hash);
        return $.go2Hax(1, hash);
    },

    /**
    * ������� �������� �� ���� ������
    * @return {Object} ������ ���� ������
    **/
    go2Hax : function(startPage, href){
        var prevAx = $.parseAxHash($.History.previous);
        if (!href) href = $.History.current;
        var curAx = $.parseAxHash(href);
        var i = 0;
        var options = {
            oldHash:$.History.previous,
            newHash:$.History.current
        }
        for (var id in curAx){
            i++;
            if (prevAx[id] == curAx[id]) {
                prevAx[id] = null;
                continue;
            }
            prevAx[id] = null;
            options.id = id;
            options.url = curAx[id];
            if ($.Html.fireEvent(id, 'beforehistorychange', options) === false) continue;
            if ($.Html.thread[id]) {
                var action = function(){
                    $.Html.thread[id].go2History(curAx[id]);
                }
                if (!$.Effect.use(id, 1, action)) action();
            } else {
                var url = $.replaceLinkEqual(curAx[id], 1);
                var obj = $.parseUri(url);
                var options = $.Filter.getOptions(obj.path, obj.query);
                if (!options) options = {};
                hax(url, {id:id, nohistory:startPage, startPage:startPage, rc:options.rc});
            }
        }
        
        for (var id in prevAx){
            if (prevAx[id] && $.Html.thread[id]) {
                options.id = id;
                options.url = $.Html.thread[id].getSrartPageUrl();
                options.startpage = 1;
                if ($.Html.fireEvent(id, 'beforehistorychange', options) === false) continue;
                var action = $.Html.thread[id].go2StartPage;
                if (!$.Effect.use(id, 1, action)) action();
            }
        }
        curAx.size = i;
        return curAx;
    },

    /**
    * ������� ������������ ax ������
    * @param {String} hash ������-����� ������ 
    * @param {String/Object} el �������������� ���������� ��� ��� ������� ���������
    * @param {String} url URL ������
    * @param {String} prefix ������� ������
    * @return {String} �������������� hash
    **/
    makeAxHash : function(hash, el, url, prefix){
        if (!prefix) prefix = 'ax';
        var axid = ':'+prefix+':' + (el.id ? el.id : el) + ':';
        var ind2 = hash.indexOf(axid);
        if (ind2 > -1) {
            var oldUrl = hash.substring(ind2);
            var ind3 = oldUrl.indexOf(':',ind2+axid.length+1);
            while (ind3 > -1 && oldUrl.substring(ind3, ind3+2) == ':/'){
                ind3 = oldUrl.indexOf(':',ind3+1);
            }
            if (ind3 > -1) oldUrl = oldUrl.substring(0,ind3);
            hash = hash.replace(oldUrl,axid + url);
        } else {
            hash += axid + url;
        }
        return (hash.startWith('#') ? '' : '#') + hash;
    },
    
    /**
    * ������ ��������� ������������ ���������� (������������ ��� ����������� �������� ���������� � IE (attributes.length >= 109) � ���������� ���� � IE8beta1 � attributes.length)
    **/
    attrs : ['id', 'src', 'url', 'method', 'form', 'params', 'callback', 'cb', 'callbackOps', 'cbo','nohistory', 'cut', 'rc', 'overwrite',  'destroy', 'html',
      'anticache', 'nocache', 'startpage', 'async', 'historycache', 'seal' , 'user', 'pswd', 'storage', 'etag', 'headers', 'add', 'target', 'onload', 'loader'],
        
    /**
    * ������� �������� ���������
    * @param {Node} �������
    * @return {Object} ������ �����
    **/
    parseAtrr : function(obj, prefix){
        var ops = null;
        var attrs = obj.attributes;
        if (!attrs) return ops;
        if (!prefix) prefix = '';
        for (var i = 0, len = ($.browser.msie ? $.attrs : attrs).length; i < len; i++){
            var attr = $.browser.msie ? attrs[prefix + $.attrs[i]] : attrs[i];
            if (attr && attr.nodeName.startWith(prefix)){
                var name = attr.nodeName.substring(prefix.length);
                var val = attr.nodeValue;
                val = (val == '1' || val == 'true') ? 1 : ((val == '0' || val == 'false') ? 0 : val);
                if (!ops) ops = {}; 
                ops[name] = val;
            }
        }
        return ops;
    },

    /**
    * ������� �������� ax ������
    * @param {String} href �����    
    * @param {String} prefix ������� ������
    * @return {Object} ������ ����-������
    **/
    parseAxHash : function (href, prefix){
        if (!prefix) prefix = 'ax';
        var locAx = {};
        if (!href) return locAx;
        href = $.replaceLinkEqual(href, 1);
        var ind1 = href.indexOf(':'+prefix+':');
        while (ind1 > -1){
            var idLayer, ind2 = href.indexOf(':', ind1+prefix.length+2);
            if (ind2 > -1) idLayer = href.substring(ind1 + prefix.length+2, ind2); else ind2 = ind1;
            ind1 = href.indexOf(':'+prefix+':',ind2 + 1);
            var loc = href.substring(ind2+1);
            var ind3 = loc.indexOf(':');
            while (ind3 > -1 && loc.substring(ind3, ind3+2) == ':/'){
                ind3 = loc.indexOf(':',ind3+1);
            }            
            if (ind3 > -1) loc = loc.substring(0,ind3);
            if (loc && idLayer) {
                locAx[idLayer] = loc;
            }
        }
        return locAx;
    },

    /**
    * �����-������ ��� ��������� location.hash
    * @return {Object} location.hash
    **/
    getHash : function(){
        return location.hash2 || location.hash;
    },

    /**
    * �����-������ ��� ���������� ������ �������� ��� location.hash
    * ������������ ��� ���������� ���� � ���������������� location.hash 
    * � ��������� ������� �� ������������� ��������� ������ ��������
    *         
    * @param {String} hash ����� ��������    
    **/
    setHash : function(hash){
        var l = location;
        //if (!l.hash2) 
        l.hash = hash;
        if (l.hash2 || l.hash != hash) l.hash2 = hash;
    },
    
    /**
    * ������ - �������� �������
    **/
    History : {
        /**
        * ���������� hash ����� �������� 
        **/
        previous:null,

        /**
        * ������� hash ����� �������� 
        **/
        current:null,

        /**
        * ����� ��� ��������� �������� hash ������ 
        * @param {hash} ������� hash ����� �������� 
        **/
        setCurrent : function(hash){
            $.History.previous = $.History.current;
            $.History.current = hash;
        },

        prefixListener : {
        },

        check : function(){   
            var hash = $.getHash();
            if ($.browser.msie) {
                if ($.History.frame) {
                    var inner = $.replaceLinkEqual($.History.frame.contentWindow.document.body.innerText);
                    if (inner != $.History.current){
                        //location.href = inner;
                        hash = inner;
                        $.setHash(hash);
                    }
                }
            }

            var hash = $.replaceLinkEqual(hash);
            if ($.History.current != null && hash != $.History.current){
                $.History.setCurrent(hash);
                for (var i in $.History.prefixListener){
                    $.History.prefixListener[i]();
                }
            }
        }, 

        add : function(id, loc, prefix){
            var hash = $.replaceLinkEqual($.getHash(), 1);
            hash = $.makeAxHash(hash, id, loc, prefix);
            var rhash = $.replaceLinkEqual(hash);
            var res = $.History.fireEvent('beforeadd', {
                hash:hash,
                rhash:rhash,
                id:id,
                url:loc,                
                loc:loc, //deprecated
                prefix:prefix
            })
            if (res === false) return; else
            if (typeof res == 'string') rhash = $.replaceLinkEqual(res);
            $.setHash(rhash);
            if ($.browser.msie || $.browser.safari){
                var frame = $.History.frame;
                if (!frame) {
                    //�������� ��� ������� ��� Safari, ������ ��� � ������ Safari 3.0.4 ������� �������� ���������� Firefox
                    /*
                    if ($.browser.safari){
                        frame = document.createElement('form');
                        frame.method = 'get';
                        document.body.insertBefore(frame,document.body.firstChild);                        

                        var action = '';
                        if ($.History.previous) action = $.History.previous;

                        frame.action = action;
                        frame.submit();
                    } else 
                    **/
                    if ($.browser.msie) {                  
                        frame = document.createElement('iframe');
                        frame.style.display = 'none';
                        frame.src = 'javascript:true';
                        document.body.appendChild(frame);

                        var content = frame.contentWindow ? frame.contentWindow : frame.contentDocument;
                        var doc = content.document;
                        doc.open();
                        var inner = $.History.previous || '';
                        //if (!inner.startWith('#')) inner = '#' + inner;
                        doc.write(inner);
                        doc.close();
                        //doc.body.innerHTML = inner;
                    }
                    $.History.frame = frame;
                }         
                /*
                if ($.browser.safari && false){
                    frame.action = rhash;
                    frame.submit();
                } else 
                **/
                if ($.browser.msie) {
                    var content = frame.contentWindow ? frame.contentWindow : frame.contentDocument;
                    var doc = content.document;
                    doc.open();
                    doc.write(rhash);
                    doc.close();
                    //doc.body.innerHTML = rhash;
                }
            }
            $.History.setCurrent(rhash);
        }

    },

    /**
    * ������ ������� ���������<br><br>
    *
    * ������: <br>
    * SRAX.ContentTrigger.add({id:'header', handler:myFunction, options:{'opt1':'val1'}});
    *
    **/
    ContentTrigger : {
        triggers : {},
        
        add : function(options){
            if (!options) options = {};
            if (!options.id) options.id = 'document.body';

            var arr = $.ContentTrigger.triggers[options.id];
            if (!arr) arr = [];
            arr.push(options);
            $.ContentTrigger.triggers[options.id] = arr;
        },

        get : function(id){
            if (!id) id = 'document.body';
            for (var el in $.ContentTrigger.triggers){
                if (el == id || el == '*') return $.ContentTrigger.triggers[el];
            }        
        }, 

        use : function(id, url){
            var trigger = $.ContentTrigger.get(id);
            if (trigger) {
                for (var i = 0, len = trigger.length; i < len; i++){
                    if (trigger[i] && trigger[i].handler) trigger[i].handler(url, trigger[i].options);
                }
            }
        }
        
    },
    
    /**
    * ������ ������ - ��� ���������� ������� ��������� �������� <br><br>
    *
    * ������: <br>
    * <pre>
    * SRAX.Effect.add({id:'center',
    *   start:function(id, options){
    *       Ext.get(id).fadeOut({ endOpacity: .25, duration: 2});
    *   },
    *   end:function(id, options){
    *       Ext.get(id).fadeIn({ endOpacity: .75, duration: 2});
    *   }
    * });
    * </pre>
    *
    * ������ ����������: <br>
    * id - id ����� <br>
    * start - ������� ������� ��� ������ ������� ��������  <br>
    * end - ������� ������ ����� ��������� ������� ��������  <br>
    *
    **/

    Effect : {
        effects : {},
        
        add : function(options){
            if (!options) options = {};
            if (!options.id) options.id = 'document.body';

            var arr = $.Effect.effects[options.id];
            if (!arr) arr = [];
            arr.push(options);
            $.Effect.effects[options.id] = arr;
        },

        get : function(id){
            if (!id) id = 'document.body';
            for (var el in $.Effect.effects){
                if (el == id || el == '*') return $.Effect.effects[el];
            }        
        }, 

        use : function(id, start, cb){
            try{
                var effect = $.Effect.get(id);
                if (effect) {
                    for (var i = 0, len = effect.length; i < len; i++){
                        var func = (i == effect.length - 1) ? cb : null;
                        if (start) {                
                            if (effect[i] && effect[i].start) effect[i].start(id, func);
                        } else {
                            if (effect[i] && effect[i].end) effect[i].end(id, func);
                        }
                    }
                }
                return !!effect;
            } catch (ex){
                error(ex);
            }
        }

    },

    /**
    * �������� ������� ���������� HTML �������� <br><br>
    *
    * ������: <br>
    * SRAX.PaintHtmlEvent.add({id:'menu', handler:function(options){alert('Menu Update')}, after:true}); <br><br>
    *
    * ������ ����������: <br>
    * id - id ����� <br>
    * handler - �������, ���������� ��� ������ ������� <br>
    * after - false (�� ���������) - ��������� ����� ���������� ��� false - ��������� ����� ��������� �������� <br>
    *
    **/
    PaintHtmlEvent : {
        events : {},

        add : function(options){
            if (!options) options = {};
            if (!options.id) options.id = 'document.body';

            var arr = $.PaintHtmlEvent.events[options.id];
            if (!arr) arr = [];
            arr.push(options);
            $.PaintHtmlEvent.events[options.id] = arr;
        },

        get : function(id){
            if (!id) id = 'document.body';
            for (var el in $.PaintHtmlEvent.events){
                if (el == id || el == '*') return $.PaintHtmlEvent.events[el];
            }        
        }, 

        use : function(id, after){
            var events = $.PaintHtmlEvent.get(id);
            if (events) {
                for (var i = 0, len = events.length; i < len; i++){
                    if (events[i] && events[i].handler) {
                        if ((!after && !events[i].after) || (after && events[i].after)) events[i].handler(events[i].options);
                    }
                }
            }
        }

    },

    /**
    * ������ ������ ������ - ��� "����-�������������" � AJAX <br><br>
    *
    * ������: <br>
    * SRAX.Filter.add({'id':'header','url':'header'});  <br><br>
    *
    * ������ ����������: <br>
    * id - id �����  <br>
    * url - ������ ��� ������ ������ <br>
    * urlType - 'contain' (�� ���������) ��� 'start' ��� 'end' - ������������� ��������, ���������� ��� �������������  <br>
    * query - ������ ��� ������ ����� �������  <br>
    * queryType - 'contain' (�� ���������) ��� 'start' ��� 'end' - ������������� ��������, ���������� ��� �������������  <br>
    * join (joinLogic) - ������ ����������� url � query - 'or' (�� ���������) ��� 'and'  <br>
    * changer (urlChanger) - ������� ��������� �������������� ������ urlChanger: function(url, owner){return url.replace('index.php', 'mypage.php')}  <br>
    * target - true ������������ ������ � ��������� target (_self,  _parent, _top, _blank) ��� false - �� ������������ (�� ���������) <br>
    * type - ���� = 'data', ����� ��� ������� ������������ dax, ����� ������������ hax <br>
    * handler - ������� ��������� �����, ���� �� �������, ����� ������������ ������� � ����������� � type <br>
    * + ��� ����� �� hax   
    *    
    **/
    Filter : {
        schema : {},
        
        add : function(options){
            if (!options) options = {};
            if (!options.id) options.id = 'document.body';
            this.remove(options);
            var arr = this.schema[options.id];
            if (!arr) arr = [];
            arr.push(options);
            this.schema[options.id] = arr;
            return this;
        },

        remove : function (options){
            if (!options) options = {};
            if (!options.id) options.id = 'document.body';            
            var arr = this.schema[options.id];
            if (!arr) return;
            $.arrayRemoveOf(arr, options, 1);
            this.schema[options.id] = arr;
        },
        
        clear : function(id){
            this.schema[id ? id : 'document.body'] = null;
        },

        clearAll : function(){
            for (var el in this.schema) delete this.schema[el];
        },

        getOptions : function(url, query, owner){
            var options = null;
            var lengthEquals = 0;
            for (var el in this.schema){
                var arr = this.schema[el];
                if (!arr) continue;
                
                function getLength(arr, path, type){
                    var pathLength = 0;                
                    for (var j = 0, l = arr.length; j < l; j++){
                        var p = arr[j];                     
                        var bool = p && path && (p == '*' || 
                        ((!type || type == 'contain') && path.indexOf(p) > -1) || 
                        (type == 'start' && path.startWith(p)) ||
                        (type == 'end' && path.endWith(p)))
                        if (bool && pathLength < p.length) pathLength = p.length;
                    }
                    return pathLength;
                }
                for (var i = 0, len = arr.length; i < len; i++){
                    var ua = arr[i].url instanceof Array ? arr[i].url : [arr[i].url];
                    var urlLength = getLength(ua, url, arr[i].urlType);

                    var qa = arr[i].query instanceof Array ? arr[i].query : [arr[i].query];
                    var queryLength = getLength(qa, query, arr[i].queryType);
                    var jl = arr[i].join || arr[i].joinLogic;
                    var length = jl == 'and' ? urlLength + queryLength : (urlLength > queryLength ? urlLength : queryLength);
                    if (lengthEquals < length) {
                        lengthEquals = length;     
                        options = {};
                        for(var j in arr[i]) options[j] = arr[i][j];
                        options.filterSchemaId = el;
                        if (owner && owner.nodeName == 'FORM') {
                            if (owner.attributes['method']) options.method = owner.attributes['method'].nodeValue;
                            options.form = owner;
                        }                            
                    }
                }
            }
            return options;
        },
        
        parseStartUrl : function(url){
            return url.substring(0, url.indexOf('/', 1));
        },

        getParentPath : function(){
            var p = location.pathname, ind = p.lastIndexOf('/');
            return ind > -1 ? p.substring(0, ind+1) : '';
        },	

        parseAxAtrr : function(owner){
            if (owner.iswrapped) return;
            var ops = $.parseAtrr(owner, X(''));
            if (ops){
              if (owner.nodeName == 'FORM') {
                  if (owner.attributes['method']) ops.method = owner.attributes['method'].nodeValue;
                  ops.form = owner;
              }
              ops.scope = owner;
            }            
            return ops;
        },

        wrapAnchor : function (owner, options){
            if (owner.protocol == 'mailto:' || owner.protocol == 'javascript:') return;
            if (owner.iswrapped) return;
            var url, query;
            if (owner.nodeName == 'FORM') {
                if(owner.attributes['action']) url = owner.attributes['action'].nodeValue;
                if (!url) url = location.href;
                var a = document.createElement('a');
                a.href = url;
                var uri = $.parseUri(a.href);
                url = uri.path;
                query = uri.query;
                delete a;
            } else {
                if (!owner.href) return;
                var uri = $.parseUri(owner.href);
                url = uri.path;
                query = uri.query;
                //var parent = this.getParentPath();            
                //if (url.substring(0,parent.length) == parent) url = url.substring(parent.length);
                //var startUrl = this.parseStartUrl(url);
            }
            if (query && query.startWith('?')) query = query.substring(1);            
            if ($.browser.opera || $.browser.msie) url = '/' + url;
            var ops = this.getOptions(url, query, owner);
            if (!ops && !options) return;
            if (!ops) ops = {};
            if (!options) options = {};
            $.extend(options, ops, 1);

            if (!options.target && owner.attributes['target'] && owner.attributes['target'].nodeValue != '') return;

            //if (options.filterSchemaId == 'document.body') options.id = null;
            if (options.id == null) return;
            this.wrapOps(owner, options);
        },
        
        /**
        * ������� ���������� ������ �� ������ �����<br>
        * ������������ ��� ���������� ������ ���� href="#" ��� ���� ����� ��� �� ������� �������
        * 
        * @param {layer} layer id �������� ��� ��� ��������
        **/
        wrapSharp : function(owner, options, url){
            if (owner.iswrapped) return;
            var protocol = location.protocol, host = location.host;
            var current = protocol + '//' + host + location.pathname + location.search + '#';
            var href = owner.nodeName == 'FORM' ? (owner.attributes['action'] ? owner.attributes['action'].nodeValue : 0) : owner.href;
            if ($.browser.opera && href+'#' == current) href += '#';
            if (href && href.endWith('#')){
                if (!href.startWith(protocol)) href = protocol + '//' + host + href;
                if (url){
                  var a = document.createElement('a');
                  a.href = url + '#';
                  url = a.href;
                  delete a;
                  if (!url.startWith(protocol)) {
                      var dir = url.startWith('/') ? '' : $.parseUri(location.href).directory;
                      url = protocol + '//' + host + dir + url;
                  }
                }
                if (href == current || href == url){
                    if (!options) options = {}; 
                    owner.sharp = options.sharp = 1;
                    this.wrapOps(owner, options);
                }
            }
        },

        wrapOps : function(owner, options){
                if (!options) return;
                owner.options = options;
                owner.iswrapped = 1;
                var wrapped = document.createAttribute("iswrapped");
                wrapped.nodeValue = 1;
                owner.setAttributeNode(wrapped);
                var event = owner.nodeName == 'FORM' ? 'submit' : 'click'; 
                var onprevevent = 'onprev' + event;
                var onevent = 'on' + event;
                if (!options.overwrite && !D.OVERWRITE){
                    if ($.browser.msie){
                        if (owner[onevent]) {
                            var onprev = document.createAttribute(onprevevent);
                            onprev.nodeValue = owner.attributes[onevent].nodeValue || owner[onevent];
                            owner.setAttributeNode(onprev);
                        }
                    } else owner[onprevevent] = owner[onevent];
                }                    
                
                if (event == 'submit'){
                    var inputs = owner.getElementsByTagName('input');                    
                    for (var i = 0, l = inputs.length; i < l; i++){
                        var type = inputs[i].type;
                        if (type != 'image' && type != 'submit') continue;
                        SRAX.addEvent(inputs[i], 'click', type == 'image' ? 
                            function(e){
                                if (!e) e = window.event;
                                var trgt = e.target || e.srcElement;
                                var x = e.offsetX != null ? e.offsetX : e.pageX - trgt.offsetLeft + 1;
                                var y = e.offsetY != null ? e.offsetY : e.pageY - trgt.offsetTop + 1;
                                var param = '';
                                var name = trgt.getAttribute('name');
                                var value = trgt.getAttribute('value');
                                var prefix = name || '';
                                if (prefix) prefix += '.';
                                if (value && name != null) param += name + '=' + value + '&';
                                param = '&' + param + prefix + 'x='+x + '&' + prefix + 'y=' + y;
                                owner.submitValue = param; 
                            } 
                            : 
                            function(e){
                                if (!e) e = window.event;
                                var trgt = e.target || e.srcElement;
                                var name = trgt.getAttribute('name');
                                var value = trgt.getAttribute('value');
                                var param = '';
                                if (name != null) param += '&' + name + '=' + value;
                                owner.submitValue = param; 
                            }
                        )
                    }
                }
                
                owner[onevent] = function(e){
                    try{
                        var res = null;
                        if ($.browser.msie){
                            if (this.attributes[onprevevent]) {
                                var func = this.attributes[onprevevent].nodeValue;
                                if (func){
                                    if (typeof func == 'string') func = window['eval']('SRAX.tmp=function(e){' + func + '}');
                                    res = func.call(this, e);
                                }
                            }
                        } else {
                            if (this[onprevevent] && (typeof this[onprevevent] == 'function')) res =  this[onprevevent](e);
                        }
                        if (res === false) return false;
                    } catch (ex){
                        error(ex);
                    }
                    
                    var o = this.options;
                    if (this.nodeName == 'FORM' && this.enctype == 'multipart/form-data'){
                        if (o.multipart) o.multipart(this);
                        return true;
                    } else
                    if (!o.sharp){
                        try{
                            var url = this.attributes['action'] ? this.attributes['action'].nodeValue : this.href;
                            if (!url) url = location.href;
                            if (this.nodeName == 'FORM'){
                                var uri = $.parseUri(url);
                                url = url.replace('?' + uri.query, '').replace('#' + uri.anchor, '');
                            }
                            var changer = o.changer || o.urlChanger;
                            var u = changer ? changer(url, this) : 0;
                            if (o.handler) o.handler(this, o); else window[o.type == 'data' ? 'dax' : 'hax'](u ? u : url, o);
                        } catch (ex){
                            error(ex);
                        }
                    }
                    return false;                    
                }
                
                if (event == 'submit'){
                    owner.submit = owner.onsubmit;
                }            
        },

        wrap : function(layer, url){
            if (!layer) {
                layer = document;
                for (var blockId in this.schema) this.wrap(blockId, url);
            }
            var a;
            var nn = layer.nodeName;
            if (nn == 'A' || nn == 'FORM' || nn == 'AREA') a = [layer]; else {
                layer = $.get(layer);
                if (!layer) return;            
                if (PM(layer)) layer = document;
                var c2a = $.collectionToArray;
                var gebtn = 'getElementsByTagName'; 
                a = c2a(layer[gebtn]('a')).concat(c2a(layer[gebtn]('form')), c2a(layer[gebtn]('area')));
            }
            for (var i = 0, len = a.length; i < len; i++){
                var obj = a[i];
                var axWrap = obj.attributes[X('wrap')];
                var noWraped = axWrap == null || (axWrap.nodeValue != 'false' && axWrap.nodeValue != '0' && axWrap.nodeValue != false);
                if (obj.iswrapped) obj.iswrapped = !!(obj.onclick || obj.onsubmit);
                if (!obj.iswrapped && noWraped) {            
                    var options = this.parseAxAtrr(obj);
                    this.wrapSharp(obj, options, url);
                    this.wrapAnchor(obj, options);
                }
                obj = null;
            }
            a = null; 
        }
                
    },


    /**
    * ������ Include - ��� ���������� ��������������� ����������� �������, ������ HTML <br><br>
    *
    * ������: 
    * <body>
    *    <include src="header.html"></include> 
    *    <include src="middle.html"></include> 
    *    <include src="footer.html"></include> 
    * </body> 
    *
    **/

    Include : {
        /**
        * ������� ��� �������� ����� &lt;include>
        **/
        parse : function(el){
            if (el) el = $.get(el); else el = document;
            var include = el.getElementsByTagName('include');
            while (include.length > 0) $.Include.apply(include[0]);
        },
        
        /**
        * ���������� include
        * @param {String/Object} el �������������� �������� include ��� ��� ������� include
        **/
        apply : function(el){
            el = $.get(el);        
            var ops = $.parseAtrr(el);
            var o = $.parseAtrr(el, X(''));
            $.extend(ops, o);            
            if (ops && (ops.url || ops.src)){
                var a = document.createElement('a');
                if (!ops.url) ops.url = ops.src;
                a.href = ops.url;
                o = $.Filter.getOptions(a.pathname, a.search);
                delete a;
                if (o) $.extend(ops, o, 1);

                var span = document.createElement('span');
                span.style.display = 'none';
                span.id = ops.id = el.id ? el.id : $.genId();
                PM(span, 1);
                el.parentNode.replaceChild(span, el);
                if (ops.nohistory == null) ops.nohistory = 1; 
                hax(ops);
            } 
        },
        
        /**
        * ������� ��� �������� ���� <include> 
        * IE ���������� ���� ���, ���� �� ��� ���� <body> � ���� ����� <include> ��� ������
        * FF ���������� ���� ���, ���� ��� �������� ���������� <INCLUDE>
        * @param {String} text �����
        * @return {String} ������������ �����
        **/
        fix : function(text){
            if ($.browser.msie && /<include/i.test(text)) {
                text = '<div style="display:none">&nbsp;</div>'+text;
            } else if ($.browser.mozilla) {
                text = text.replaceAll('<INCLUDE', '<include');
            }
            return text;
        }
        
    }, 


    /**
    * ������ �����-AJAX �������� ������<br><br>
    *
    * ������ ������������� <br>
    * &lt;form action="/upload.jsp" method="post" enctype="multipart/form-data" onsubmit="new SRAX.Uploader(this, startCallback, finishCallback)"> <br>
    * &nbsp;&nbsp;&nbsp;&nbsp;  &lt;input type="file" name="form[file]" /> <br>
    * &lt;/form>
    *
    * @param {String/Element} form id ����� ��� ���� ����� 
    * @param {Function} beforeStart ����������� ������� �� ������ ��������
    * @return {Function} afterFinish ����������� ������� ����� ��������� ��������
    * @param {Boolean} manual ���� ������ �������� ������� (form.submit())
    **/
    Uploader : function(form, beforeStart, afterFinish, manual){
        var container; 
        var iframe = null;
        var _this = this;
        this.init = function() {
            form = $.get(form);
            var id = $.genId();
            form.setAttribute('target', id);
            container = document.createElement('div');
            container.innerHTML = '<iframe style="display:none" src="javascript:true" onload="this._onload()" id="'+id+'" name="'+id+'"></iframe>';
            this.iframe = iframe = container.firstChild;

            this.setAfterFinish = setAfterFinish = function(afterFinish){
                iframe._onload = function(){
                    var content = this.contentWindow ? this.contentWindow : this.contentDocument;
                    var body = content.document.body;
                    var text = body[$.browser.msie ? 'innerText' : 'textContent'];
                    afterFinish(text, _this);
                }
            }

            if (afterFinish) {
                var set = function(){
                    setAfterFinish(afterFinish);
                    if (manual) form.submit()
                }
                if (manual) iframe._onload = set; else set(); 
            } else iframe._onload = function(){}
            form.appendChild(container);
            form.setAttribute('target', id);
            if (beforeStart) beforeStart(_this);
        }
        
        this.init();

        this.getIframe = function(){
            return iframe;
        }

        this.cancel = function(){
            form.reset();
            iframe.src = 'javascript:true';
            _this.destroy();
        }

        this.destroy = function(){
            if (container){
                form.removeChild(container);
                container = null;
            }
        }
        
    },

    /**
    * ����� ��� ��������� ������� ���������� ������ �������
    *
    * @param {obj} ������ ��� ����������� �������
    *
    **/
    addEventsListener : function(obj){
        if (obj.prototype) obj = obj.prototype;
        obj.on = function(arr,func,skipun){
            if (!(arr instanceof Array)) arr = [arr];
            for (var i = 0, l = arr.length; i < l; i++){
                var event = arr[i];
                if (!skipun) this.un(event,func);
                if(!this.events) this.events = {};
                if (!this.events[event]) this.events[event] = [];
                this.events[event].push(func);
            }
        }
        obj.un = function(arr, func, equal){        
            if (!(arr instanceof Array)) arr = [arr];
            for (var i = 0, l = arr.length; i < l; i++){
                var event = arr[i];
                if (!func) return this.unall(event);
                var arrev = this.events ? this.events[event]:null;
                if (arrev) {
                    $.arrayRemoveOf(arrev, func, !equal);
                    this.events[event] = arrev;
                }
            }
        }
        obj.unall = function(event){
            if (this.events) {
                if (event) delete this.events[event]; else delete this.events;
            }
        }
        obj.fireEvent = function(event, options){
            var arr = this.events ? this.events[event] : null;
            if (arr) {
                //if (!options) options = {};
                var res = null;
                var args = [].slice.call(arguments);
                args.shift();
                args.push(event);
                for (var i = 0; i < arr.length; i++){
                    try{
                        var r = arr[i].apply(this, args);//arr[i](options)
                        if (r != null) res = res == null ? r : res * r;
                    } catch (ex){
                        error(ex);
                    }
                }
                return res;
            } 
        }
        return obj;
    },

    addContainerListener : function(obj){
        if (obj.prototype) obj = obj.prototype;
        var registered = {}; 
        var toall = {};
        obj.register = function(thread){
            var events = registered[thread.id];
            if (events){
                for (var i in events){
                    for (var j = 0, len = events[i].length; j < len; j++)
                        thread.on(i,events[i][j]);
                }
            }
            for (var i in toall){
                var events = toall[i];
                for (var j = 0, len = events.length; j < len; j++)
                    thread.on(i,events[j]);
            }
        }

        obj.on = function(arr, event, func, skipun){
            if (!(arr instanceof Array)) arr = [arr];
            for (var i = 0, l = arr.length; i < l; i++){
                var id = arr[i];
                if (!registered[id]) registered[id] = {};
                if (!registered[id][event]) registered[id][event] = [];
                registered[id][event].push(func);
                if (this.thread[id]) this.thread[id].on(event, func, skipun);
            }
        }

        obj.onall = function(event, func, skipun){
            if (!toall[event]) toall[event] = [];
            toall[event].push(func);
            var th = this.thread;
            for (var i in th)
                if (th[i]) th[i].on(event, func, skipun);
        }

        obj.unall = function(event, func, equal){
            if (event){
                if (func) {
                    var arr = toall[event];
                    $.arrayRemoveOf(arr, func, !equal);
                    toall[event] = arr;
                } else 
                   toall[event] = [];
            } else
                toall = {};
            var th = this.thread;
            for (var i in th)
                if (th[i]) th[i].un(event, func, equal);
        }


        obj.un = function(arr, event, func, equal){
            if (!(arr instanceof Array)) arr = [arr];
            for (var i = 0, l = arr.length; i < l; i++){
                var id = arr[i];        
                if (!func) {
                    if (id){
                        if (registered[id]) {
                            if (event) delete registered[id][event]; else delete registered[id];
                        }
                    } else
                        registered = {};
    
                    var list = {};            
                    if (id) list[id] = this.thread[id]; else list = this.thread;
                    for (var j in list)
                        if (list[j]) list[j].unall(event);
                } else {
                    var arrev = registered[id] ? registered[id][event] : null;
                    if (arrev) {
                        $.arrayRemoveOf(arrev, func, !equal);
                        registered[id][event] = arrev;
                    }
                    if (this.thread[id]) this.thread[id].un(event, func, equal);
                }
            }
        }

        obj.fireEvent = function(id, event, options){
            if (this.thread[id]) return this.thread[id].fireEvent(event, options);
        }
        
        return obj;
    },


    /**
    * ��������� �������� �������� ������� HTML
    **/
    Html : {
        thread : {},

        /**
        * ���� ������������ ���������� hax
        * @type Boolean 
        **/
        ASYNCHRONOUS : 1,

        /**
        * ��������� ��� ���������� ���������� hax
        * @type Array
        **/
        storage :[]

    },

    /**
    * ��������� �������� �������� ������� ������
    **/
    Data : {
        thread : {}
    },

    /**
    * ������� ������������ �������� ������
    * 
    * @param {src} ���� � ��������� �����
    * @param {timeout} �������� � ��������, ����� ������� ���������� �������� �������� - �� ��������� 10���( ���� timeout <= 0 �������� ��������)
    **/
    playsound : function(src, timeout){
        var div = document.createElement('div');
        if (timeout == null) timeout = 10;
        div.setAttribute('style','position:absolute;top:-1000px;left:-1000px');
        if (window.ActiveXObject){   
            var sound = document.createElement('bgsound');sound.src = src;div.appendChild(sound);
        } else {
            div.innerHTML = '<embed src="'+src+'" loop="false" autostart="true" hidden="true" mastersound>';
        } 
        document.body.appendChild(div);
        if (timeout > 0)
            setTimeout(function(){div.firstChild.src = '';document.body.removeChild(div)}, timeout*1000);
    },

    /**
    * ����������������� ����� ��������� ������ ������ � ������ ������� (��� �� ���������) <br>
    * UniversalBrowserRead
    *  
    **/    
    enableUBR : function(){
        netscape.security.PrivilegeManager.enablePrivilege ("UniversalBrowserRead"); //for Firefox
    },

    /**
    * ����������������� ������ �������� ��������-��������������
    **/
    Loader : {
        show: function(){
            $.showLoading(1, $.getLoader());
        },
        
        hide: function(){
            $.showLoading(0, $.getLoader());
        }
    },

    parseUri : function (source, ops) { 
        var options = { 
            strictMode: 0, 
            key: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"], 
            q: { 
                name: "queryKey", 
                parser: /(?:^|&)([^&=]*)=?([^&]*)/g 
            }, 
            parser: { 
                strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/, 
                loose: /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/ 
            } 
        }
        var o = ops ? ops : options, value = o.parser[o.strictMode ? "strict" : "loose"].exec(source); 
        for (var i = 0, uri = {}; i < 14; i++) { uri[o.key[i]] = value[i] || ""; } 
        uri[o.q.name] = {}; 
        uri[o.key[12]].replace(o.q.parser, function ($0, $1, $2) { if ($1) uri[o.q.name][$1] = $2; }); return uri;         
    },

    /**
    * ������� ��� ����������� ������ ������� HTML �������
    * @param {String} url URL ����� �������
    * @param {Integer} status ��� ���������
    * @return {String} statusText ����� ���������
    **/
    showMessage : function(url, status, statusText){
        if (status == 0) return;
        alert('Error ' + status + ' : ' + url + '\n' + statusText);
    },

    /**
    * ������� replaceHtml �� ����������� �� ��������� ������� ��� innerHTML
    * @param {String/Element} el ������������ �������
    * @param {String} html ����� HTML
    *
    * <br>
    * <a href="http://blog.stevenlevithan.com/archives/faster-than-innerhtml">http://blog.stevenlevithan.com/archives/faster-than-innerhtml</a>
    * <br>
    * This is much faster than using (el.innerHTML = value) when there are many
    * existing descendants, because in some browsers, innerHTML spends much longer
    * removing existing elements than it does creating new ones. 
    **/
    replaceHtml : function (el, html) {
            var oldEl = (typeof el === "string" ? document.getElementById(el) : el);
            /* Pure innerHTML is slightly faster in IE
            oldEl.innerHTML = html;
            return oldEl; **/

            var newEl = oldEl.cloneNode(false);
            newEl.innerHTML = html;
            oldEl.parentNode.replaceChild(newEl, oldEl);
            /* Since we just removed the old element from the DOM, return a reference
            to the new element, which can be used to restore variable references. **/
            return newEl;
    },

    /**
    * ������� ���������� HTML � ������������ �������
    * @param {String/Element} elem ������������ �������
    * @param {String} html ����� HTML
    **/
    addTo : function(html, elem){
        var x = elem ? x = $.get(elem) : x = document.body;
        if (!x) return warn('Warning => addTo : element = ' + elem + ' not found');
            
        var div = document.createElement('div');        
        div.innerHTML = html;    
        var asm = PM(x);
        while (div.childNodes.length > 0)
            if(asm) x.parentNode.insertBefore(div.childNodes[0],x); else x.appendChild(div.childNodes[0]);
    },

    /**
    * ������� ���������� HTML � ������������ ��������
    * @param {String/Element} elem ������������ �������
    * @param {String} html ����� HTML
    **/
    writeTo : function(html, elem){
        var x = elem ? x = $.get(elem) : x = document.body;
        if (!x) return warn('Warning => writeTo : element = ' + elem + ' not found');
        if (PM(x)) $.addTo(html,x); else x.innerHTML = html;
    },
    
    /**
    * ������� �������� �������� �� ������������� ��������
    * @param {String/Element} el ��������� �������
    **/
    remove : function(arr){
        arr = arr instanceof Array ? arr : [arr];
        for (var i = 0, l = arr.length; i < l; i++){
            var el = $.get(arr[i]);
            if (el) el.parentNode.removeChild(el);
        }
    },

    /**
    * ������� ������ �������� ������ ���������
    * @param {String/Element} nEl ����� �������
    * @param {String/Element} oEl ��������� �������
    **/
    replace : function(nEl,oEl){
        nEl = $.get(nEl);
        oEl = $.get(oEl);
        return oEl.parentNode.replaceChild(nEl,oEl);
    },

    /**
    * ������� ��������� ����������� Id
    **/
    genId : function(){
        return X('genid'+D.sprt) + ($.lastGenId ? ++$.lastGenId : $.lastGenId=1);
    }
})
var D = $.Default;
/**
* ������� ��� ������������ ����� �������� � ��������� 
**/ 
var X = function(str){
    return D.prefix+D.sprt+str;
}
/**
* ������� ��� ������������ ����� ���������/������ � �������� ���������/���������� �������� ��������� 'ax:place:mark' - ����������� ��� �������� ����� ������� HTML 
**/ 
var PM = $.placeMark = function(el, bool){
    var pm = X('place'+D.sprt+'mark');
    if (el && bool != null) el[pm] = bool; 
    return el ? (bool == null ? el[pm] : el) : pm; 
}

//deprecated methods
$.escape = $.encode;
$.appendScript = $.addScript;
$.appendLink = $.addLink;
$.appendStyle = $.addStyle;
arrayIndexOf = $.arrayIndexOf;
arrayRemoveOf = $.arrayRemoveOf;

})(SRAX)

SRAX.init();
} 
