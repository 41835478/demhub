// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    /*
     Allows you to add data-method="METHOD to links to automatically inject a form with the method on click
     Example: <a href="{{route('customers.destroy', $customer->id)}}" data-method="delete" name="delete_item">Delete</a>
     Injects a form with that's fired on click of the link with a DELETE request.
     Good because you don't have to dirty your HTML with delete forms everywhere.
     */
    $('[data-method]').append(function(){
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' name='delete_item' style='display:none'>\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "   <input type='hidden' name='_token' value='"+$('meta[name="_token"]').attr('content')+"'>\n"+
        "</form>\n"
    })
        .removeAttr('href')
        .attr('style','cursor:pointer;')
        .attr('onclick','$(this).find("form").submit();');

    /*
     Generic are you sure dialog
     */
    $('form[name=delete_item]').submit(function(){
        return confirm("Are you sure you want to delete this item?");
    });

    /*
     Bind all bootstrap tooltips
     */
    $("[data-toggle=\"tooltip\"]").tooltip();
    $("[data-toggle=\"popover\"]").popover();
    //This closes the popover when its clicked away from
    $('body').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });
});
$(function(){

});
/*! Backstretch - v2.0.4 - 2013-06-19
* http://srobbin.com/jquery-plugins/backstretch/
* Copyright (c) 2013 Scott Robbin; Licensed MIT */
(function(a,d,p){a.fn.backstretch=function(c,b){(c===p||0===c.length)&&a.error("No images were supplied for Backstretch");0===a(d).scrollTop()&&d.scrollTo(0,0);return this.each(function(){var d=a(this),g=d.data("backstretch");if(g){if("string"==typeof c&&"function"==typeof g[c]){g[c](b);return}b=a.extend(g.options,b);g.destroy(!0)}g=new q(this,c,b);d.data("backstretch",g)})};a.backstretch=function(c,b){return a("body").backstretch(c,b).data("backstretch")};a.expr[":"].backstretch=function(c){return a(c).data("backstretch")!==p};a.fn.backstretch.defaults={centeredX:!0,centeredY:!0,duration:5E3,fade:0};var r={left:0,top:0,overflow:"hidden",margin:0,padding:0,height:"100%",width:"100%",zIndex:-999999},s={position:"absolute",display:"none",margin:0,padding:0,border:"none",width:"auto",height:"auto",maxHeight:"none",maxWidth:"none",zIndex:-999999},q=function(c,b,e){this.options=a.extend({},a.fn.backstretch.defaults,e||{});this.images=a.isArray(b)?b:[b];a.each(this.images,function(){a("<img />")[0].src=this});this.isBody=c===document.body;this.$container=a(c);this.$root=this.isBody?l?a(d):a(document):this.$container;c=this.$container.children(".backstretch").first();this.$wrap=c.length?c:a('<div class="backstretch"></div>').css(r).appendTo(this.$container);this.isBody||(c=this.$container.css("position"),b=this.$container.css("zIndex"),this.$container.css({position:"static"===c?"relative":c,zIndex:"auto"===b?0:b,background:"none"}),this.$wrap.css({zIndex:-999998}));this.$wrap.css({position:this.isBody&&l?"fixed":"absolute"});this.index=0;this.show(this.index);a(d).on("resize.backstretch",a.proxy(this.resize,this)).on("orientationchange.backstretch",a.proxy(function(){this.isBody&&0===d.pageYOffset&&(d.scrollTo(0,1),this.resize())},this))};q.prototype={resize:function(){try{var a={left:0,top:0},b=this.isBody?this.$root.width():this.$root.innerWidth(),e=b,g=this.isBody?d.innerHeight?d.innerHeight:this.$root.height():this.$root.innerHeight(),j=e/this.$img.data("ratio"),f;j>=g?(f=(j-g)/2,this.options.centeredY&&(a.top="-"+f+"px")):(j=g,e=j*this.$img.data("ratio"),f=(e-b)/2,this.options.centeredX&&(a.left="-"+f+"px"));this.$wrap.css({width:b,height:g}).find("img:not(.deleteable)").css({width:e,height:j}).css(a)}catch(h){}return this},show:function(c){if(!(Math.abs(c)>this.images.length-1)){var b=this,e=b.$wrap.find("img").addClass("deleteable"),d={relatedTarget:b.$container[0]};b.$container.trigger(a.Event("backstretch.before",d),[b,c]);this.index=c;clearInterval(b.interval);b.$img=a("<img />").css(s).bind("load",function(f){var h=this.width||a(f.target).width();f=this.height||a(f.target).height();a(this).data("ratio",h/f);a(this).fadeIn(b.options.speed||b.options.fade,function(){e.remove();b.paused||b.cycle();a(["after","show"]).each(function(){b.$container.trigger(a.Event("backstretch."+this,d),[b,c])})});b.resize()}).appendTo(b.$wrap);b.$img.attr("src",b.images[c]);return b}},next:function(){return this.show(this.index<this.images.length-1?this.index+1:0)},prev:function(){return this.show(0===this.index?this.images.length-1:this.index-1)},pause:function(){this.paused=!0;return this},resume:function(){this.paused=!1;this.next();return this},cycle:function(){1<this.images.length&&(clearInterval(this.interval),this.interval=setInterval(a.proxy(function(){this.paused||this.next()},this),this.options.duration));return this},destroy:function(c){a(d).off("resize.backstretch orientationchange.backstretch");clearInterval(this.interval);c||this.$wrap.remove();this.$container.removeData("backstretch")}};var l,f=navigator.userAgent,m=navigator.platform,e=f.match(/AppleWebKit\/([0-9]+)/),e=!!e&&e[1],h=f.match(/Fennec\/([0-9]+)/),h=!!h&&h[1],n=f.match(/Opera Mobi\/([0-9]+)/),t=!!n&&n[1],k=f.match(/MSIE ([0-9]+)/),k=!!k&&k[1];l=!((-1<m.indexOf("iPhone")||-1<m.indexOf("iPad")||-1<m.indexOf("iPod"))&&e&&534>e||d.operamini&&"[object OperaMini]"==={}.toString.call(d.operamini)||n&&7458>t||-1<f.indexOf("Android")&&e&&533>e||h&&6>h||"palmGetResource"in d&&e&&534>e||-1<f.indexOf("MeeGo")&&-1<f.indexOf("NokiaBrowser/8.5.0")||k&&6>=k)})(jQuery,window);
$(function () {
	"use strict";

  /* ---------------------------------------------------------
	 * Background (Backstretch)
	 */

	$(".js-fullheight-body").backstretch([
		"../images/backgrounds/dried_earth.jpg"
	]);

	$(".js-landing-hero").backstretch([
			"../images/backgrounds/landing-hero.jpg"
		]);


});

function pageUpdate(){
  if(!$('#user_name').val() || !$('#email').val() || !$('#password').val()) {
  // $("#sign-up-form").slideUp();
  $('#modalErrorButton').click();
  }
  else {
    $('#modalSuccessButton').click();
  }
}
function updateForm(){
  document.getElementById("form-part-1").style.display="none";
  document.getElementById("form-part-2").style.display="";
}

/*!
 * The Final Countdown for jQuery v2.0.3 (http://hilios.github.io/jQuery.countdown/)
 * Copyright (c) 2014 Edson Hilios
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
(function(factory) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "jquery" ], factory);
    } else {
        factory(jQuery);
    }
})(function($) {
    "use strict";
    var PRECISION = 100;
    var instances = [], matchers = [];
    matchers.push(/^[0-9]*$/.source);
    matchers.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source);
    matchers.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source);
    matchers = new RegExp(matchers.join("|"));
    function parseDateString(dateString) {
        if (dateString instanceof Date) {
            return dateString;
        }
        if (String(dateString).match(matchers)) {
            if (String(dateString).match(/^[0-9]*$/)) {
                dateString = Number(dateString);
            }
            if (String(dateString).match(/\-/)) {
                dateString = String(dateString).replace(/\-/g, "http://demo.shnayder.pro/");
            }
            return new Date(dateString);
        } else {
            throw new Error("Couldn't cast `" + dateString + "` to a date object.");
        }
    }
    var DIRECTIVE_KEY_MAP = {
        Y: "years",
        m: "months",
        w: "weeks",
        d: "days",
        D: "totalDays",
        H: "hours",
        M: "minutes",
        S: "seconds"
    };
    function strftime(offsetObject) {
        return function(format) {
            var directives = format.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);
            if (directives) {
                for (var i = 0, len = directives.length; i < len; ++i) {
                    var directive = directives[i].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/), regexp = new RegExp(directive[0]), modifier = directive[1] || "", plural = directive[3] || "", value = null;
                    directive = directive[2];
                    if (DIRECTIVE_KEY_MAP.hasOwnProperty(directive)) {
                        value = DIRECTIVE_KEY_MAP[directive];
                        value = Number(offsetObject[value]);
                    }
                    if (value !== null) {
                        if (modifier === "!") {
                            value = pluralize(plural, value);
                        }
                        if (modifier === "") {
                            if (value < 10) {
                                value = "0" + value.toString();
                            }
                        }
                        format = format.replace(regexp, value.toString());
                    }
                }
            }
            format = format.replace(/%%/, "%");
            return format;
        };
    }
    function pluralize(format, count) {
        var plural = "s", singular = "";
        if (format) {
            format = format.replace(/(:|;|\s)/gi, "").split(/\,/);
            if (format.length === 1) {
                plural = format[0];
            } else {
                singular = format[0];
                plural = format[1];
            }
        }
        if (Math.abs(count) === 1) {
            return singular;
        } else {
            return plural;
        }
    }
    var Countdown = function(el, finalDate, callback) {
        this.el = el;
        this.$el = $(el);
        this.interval = null;
        this.offset = {};
        this.instanceNumber = instances.length;
        instances.push(this);
        this.$el.data("countdown-instance", this.instanceNumber);
        if (callback) {
            this.$el.on("update.countdown", callback);
            this.$el.on("stoped.countdown", callback);
            this.$el.on("finish.countdown", callback);
        }
        this.setFinalDate(finalDate);
        this.start();
    };
    $.extend(Countdown.prototype, {
        start: function() {
            if (this.interval !== null) {
                clearInterval(this.interval);
            }
            var self = this;
            this.update();
            this.interval = setInterval(function() {
                self.update.call(self);
            }, PRECISION);
        },
        stop: function() {
            clearInterval(this.interval);
            this.interval = null;
            this.dispatchEvent("stoped");
        },
        pause: function() {
            this.stop.call(this);
        },
        resume: function() {
            this.start.call(this);
        },
        remove: function() {
            this.stop();
            instances[this.instanceNumber] = null;
            delete this.$el.data().countdownInstance;
        },
        setFinalDate: function(value) {
            this.finalDate = parseDateString(value);
        },
        update: function() {
            if (this.$el.closest("html").length === 0) {
                this.remove();
                return;
            }
            this.totalSecsLeft = this.finalDate.getTime() - new Date().getTime();
            this.totalSecsLeft = Math.ceil(this.totalSecsLeft / 1e3);
            this.totalSecsLeft = this.totalSecsLeft < 0 ? 0 : this.totalSecsLeft;
            this.offset = {
                seconds: this.totalSecsLeft % 60,
                minutes: Math.floor(this.totalSecsLeft / 60) % 60,
                hours: Math.floor(this.totalSecsLeft / 60 / 60) % 24,
                days: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
                totalDays: Math.floor(this.totalSecsLeft / 60 / 60 / 24),
                weeks: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7),
                months: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 30),
                years: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 365)
            };
            if (this.totalSecsLeft === 0) {
                this.stop();
                this.dispatchEvent("finish");
            } else {
                this.dispatchEvent("update");
            }
        },
        dispatchEvent: function(eventName) {
            var event = $.Event(eventName + ".countdown");
            event.finalDate = this.finalDate;
            event.offset = $.extend({}, this.offset);
            event.strftime = strftime(this.offset);
            this.$el.trigger(event);
        }
    });
    $.fn.countdown = function() {
        var argumentsArray = Array.prototype.slice.call(arguments, 0);
        return this.each(function() {
            var instanceNumber = $(this).data("countdown-instance");
            if (instanceNumber !== undefined) {
                var instance = instances[instanceNumber], method = argumentsArray[0];
                if (Countdown.prototype.hasOwnProperty(method)) {
                    instance[method].apply(instance, argumentsArray.slice(1));
                } else if (String(method).match(/^[$A-Z_][0-9A-Z_$]*$/i) === null) {
                    instance.setFinalDate.call(instance, method);
                    instance.start();
                } else {
                    $.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi, method));
                }
            } else {
                new Countdown(this, argumentsArray[0], argumentsArray[1]);
            }
        });
    };
});
/* Placeholders.js v3.0.2 */
(function(t){"use strict";function e(t,e,r){return t.addEventListener?t.addEventListener(e,r,!1):t.attachEvent?t.attachEvent("on"+e,r):void 0}function r(t,e){var r,n;for(r=0,n=t.length;n>r;r++)if(t[r]===e)return!0;return!1}function n(t,e){var r;t.createTextRange?(r=t.createTextRange(),r.move("character",e),r.select()):t.selectionStart&&(t.focus(),t.setSelectionRange(e,e))}function a(t,e){try{return t.type=e,!0}catch(r){return!1}}t.Placeholders={Utils:{addEventListener:e,inArray:r,moveCaret:n,changeType:a}}})(this),function(t){"use strict";function e(){}function r(){try{return document.activeElement}catch(t){}}function n(t,e){var r,n,a=!!e&&t.value!==e,u=t.value===t.getAttribute(V);return(a||u)&&"true"===t.getAttribute(D)?(t.removeAttribute(D),t.value=t.value.replace(t.getAttribute(V),""),t.className=t.className.replace(R,""),n=t.getAttribute(F),parseInt(n,10)>=0&&(t.setAttribute("maxLength",n),t.removeAttribute(F)),r=t.getAttribute(P),r&&(t.type=r),!0):!1}function a(t){var e,r,n=t.getAttribute(V);return""===t.value&&n?(t.setAttribute(D,"true"),t.value=n,t.className+=" "+I,r=t.getAttribute(F),r||(t.setAttribute(F,t.maxLength),t.removeAttribute("maxLength")),e=t.getAttribute(P),e?t.type="text":"password"===t.type&&M.changeType(t,"text")&&t.setAttribute(P,"password"),!0):!1}function u(t,e){var r,n,a,u,i,l,o;if(t&&t.getAttribute(V))e(t);else for(a=t?t.getElementsByTagName("input"):b,u=t?t.getElementsByTagName("textarea"):f,r=a?a.length:0,n=u?u.length:0,o=0,l=r+n;l>o;o++)i=r>o?a[o]:u[o-r],e(i)}function i(t){u(t,n)}function l(t){u(t,a)}function o(t){return function(){m&&t.value===t.getAttribute(V)&&"true"===t.getAttribute(D)?M.moveCaret(t,0):n(t)}}function c(t){return function(){a(t)}}function s(t){return function(e){return A=t.value,"true"===t.getAttribute(D)&&A===t.getAttribute(V)&&M.inArray(C,e.keyCode)?(e.preventDefault&&e.preventDefault(),!1):void 0}}function d(t){return function(){n(t,A),""===t.value&&(t.blur(),M.moveCaret(t,0))}}function g(t){return function(){t===r()&&t.value===t.getAttribute(V)&&"true"===t.getAttribute(D)&&M.moveCaret(t,0)}}function v(t){return function(){i(t)}}function p(t){t.form&&(T=t.form,"string"==typeof T&&(T=document.getElementById(T)),T.getAttribute(U)||(M.addEventListener(T,"submit",v(T)),T.setAttribute(U,"true"))),M.addEventListener(t,"focus",o(t)),M.addEventListener(t,"blur",c(t)),m&&(M.addEventListener(t,"keydown",s(t)),M.addEventListener(t,"keyup",d(t)),M.addEventListener(t,"click",g(t))),t.setAttribute(j,"true"),t.setAttribute(V,x),(m||t!==r())&&a(t)}var b,f,m,h,A,y,E,x,L,T,N,S,w,B=["text","search","url","tel","email","password","number","textarea"],C=[27,33,34,35,36,37,38,39,40,8,46],k="#ccc",I="placeholdersjs",R=RegExp("(?:^|\\s)"+I+"(?!\\S)"),V="data-placeholder-value",D="data-placeholder-active",P="data-placeholder-type",U="data-placeholder-submit",j="data-placeholder-bound",q="data-placeholder-focus",z="data-placeholder-live",F="data-placeholder-maxlength",G=document.createElement("input"),H=document.getElementsByTagName("head")[0],J=document.documentElement,K=t.Placeholders,M=K.Utils;if(K.nativeSupport=void 0!==G.placeholder,!K.nativeSupport){for(b=document.getElementsByTagName("input"),f=document.getElementsByTagName("textarea"),m="false"===J.getAttribute(q),h="false"!==J.getAttribute(z),y=document.createElement("style"),y.type="text/css",E=document.createTextNode("."+I+" { color:"+k+"; }"),y.styleSheet?y.styleSheet.cssText=E.nodeValue:y.appendChild(E),H.insertBefore(y,H.firstChild),w=0,S=b.length+f.length;S>w;w++)N=b.length>w?b[w]:f[w-b.length],x=N.attributes.placeholder,x&&(x=x.nodeValue,x&&M.inArray(B,N.type)&&p(N));L=setInterval(function(){for(w=0,S=b.length+f.length;S>w;w++)N=b.length>w?b[w]:f[w-b.length],x=N.attributes.placeholder,x?(x=x.nodeValue,x&&M.inArray(B,N.type)&&(N.getAttribute(j)||p(N),(x!==N.getAttribute(V)||"password"===N.type&&!N.getAttribute(P))&&("password"===N.type&&!N.getAttribute(P)&&M.changeType(N,"text")&&N.setAttribute(P,"password"),N.value===N.getAttribute(V)&&(N.value=x),N.setAttribute(V,x)))):N.getAttribute(D)&&(n(N),N.removeAttribute(V));h||clearInterval(L)},100)}M.addEventListener(t,"beforeunload",function(){K.disable()}),K.disable=K.nativeSupport?e:i,K.enable=K.nativeSupport?e:l}(this);
//============================================================
//
// Flat Surface Shader
//
// Copyright (C) 2013 Matthew Wagerfield
//
// Twitter: https://twitter.com/mwagerfield
//
// Permission is hereby granted, free of charge, to any
// person obtaining a copy of this software and associated
// documentation files (the "Software"), to deal in the
// Software without restriction, including without limitation
// the rights to use, copy, modify, merge, publish, distribute,
// sublicense, and/or sell copies of the Software, and to
// permit persons to whom the Software is furnished to do
// so, subject to the following conditions:
//
// The above copyright notice and this permission notice
// shall be included in all copies or substantial portions
// of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY
// OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
// LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
// FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO
// EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE
// FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN
// AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE
// OR OTHER DEALINGS IN THE SOFTWARE.
//
//============================================================

function initPlugin() {
  FSS={FRONT:0,BACK:1,DOUBLE:2,SVGNS:"http://www.w3.org/2000/svg"},FSS.Array="function"==typeof Float32Array?Float32Array:Array,FSS.Utils={isNumber:function(t){return!isNaN(parseFloat(t))&&isFinite(t)}},function(){for(var t=0,e=["ms","moz","webkit","o"],i=0;e.length>i&&!window.requestAnimationFrame;++i)window.requestAnimationFrame=window[e[i]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[e[i]+"CancelAnimationFrame"]||window[e[i]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(e){var i=(new Date).getTime(),r=Math.max(0,16-(i-t)),s=window.setTimeout(function(){e(i+r)},r);return t=i+r,s}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(t){clearTimeout(t)})}(),Math.PIM2=2*Math.PI,Math.PID2=Math.PI/2,Math.randomInRange=function(t,e){return t+(e-t)*Math.random()},Math.clamp=function(t,e,i){return t=Math.max(t,e),t=Math.min(t,i)},FSS.Vector3={create:function(t,e,i){var r=new FSS.Array(3);return this.set(r,t,e,i),r},clone:function(t){var e=this.create();return this.copy(e,t),e},set:function(t,e,i,r){return t[0]=e||0,t[1]=i||0,t[2]=r||0,this},setX:function(t,e){return t[0]=e||0,this},setY:function(t,e){return t[1]=e||0,this},setZ:function(t,e){return t[2]=e||0,this},copy:function(t,e){return t[0]=e[0],t[1]=e[1],t[2]=e[2],this},add:function(t,e){return t[0]+=e[0],t[1]+=e[1],t[2]+=e[2],this},addVectors:function(t,e,i){return t[0]=e[0]+i[0],t[1]=e[1]+i[1],t[2]=e[2]+i[2],this},addScalar:function(t,e){return t[0]+=e,t[1]+=e,t[2]+=e,this},subtract:function(t,e){return t[0]-=e[0],t[1]-=e[1],t[2]-=e[2],this},subtractVectors:function(t,e,i){return t[0]=e[0]-i[0],t[1]=e[1]-i[1],t[2]=e[2]-i[2],this},subtractScalar:function(t,e){return t[0]-=e,t[1]-=e,t[2]-=e,this},multiply:function(t,e){return t[0]*=e[0],t[1]*=e[1],t[2]*=e[2],this},multiplyVectors:function(t,e,i){return t[0]=e[0]*i[0],t[1]=e[1]*i[1],t[2]=e[2]*i[2],this},multiplyScalar:function(t,e){return t[0]*=e,t[1]*=e,t[2]*=e,this},divide:function(t,e){return t[0]/=e[0],t[1]/=e[1],t[2]/=e[2],this},divideVectors:function(t,e,i){return t[0]=e[0]/i[0],t[1]=e[1]/i[1],t[2]=e[2]/i[2],this},divideScalar:function(t,e){return 0!==e?(t[0]/=e,t[1]/=e,t[2]/=e):(t[0]=0,t[1]=0,t[2]=0),this},cross:function(t,e){var i=t[0],r=t[1],s=t[2];return t[0]=r*e[2]-s*e[1],t[1]=s*e[0]-i*e[2],t[2]=i*e[1]-r*e[0],this},crossVectors:function(t,e,i){return t[0]=e[1]*i[2]-e[2]*i[1],t[1]=e[2]*i[0]-e[0]*i[2],t[2]=e[0]*i[1]-e[1]*i[0],this},min:function(t,e){return e>t[0]&&(t[0]=e),e>t[1]&&(t[1]=e),e>t[2]&&(t[2]=e),this},max:function(t,e){return t[0]>e&&(t[0]=e),t[1]>e&&(t[1]=e),t[2]>e&&(t[2]=e),this},clamp:function(t,e,i){return this.min(t,e),this.max(t,i),this},limit:function(t,e,i){var r=this.length(t);return null!==e&&e>r?this.setLength(t,e):null!==i&&r>i&&this.setLength(t,i),this},dot:function(t,e){return t[0]*e[0]+t[1]*e[1]+t[2]*e[2]},normalise:function(t){return this.divideScalar(t,this.length(t))},negate:function(t){return this.multiplyScalar(t,-1)},distanceSquared:function(t,e){var i=t[0]-e[0],r=t[1]-e[1],s=t[2]-e[2];return i*i+r*r+s*s},distance:function(t,e){return Math.sqrt(this.distanceSquared(t,e))},lengthSquared:function(t){return t[0]*t[0]+t[1]*t[1]+t[2]*t[2]},length:function(t){return Math.sqrt(this.lengthSquared(t))},setLength:function(t,e){var i=this.length(t);return 0!==i&&e!==i&&this.multiplyScalar(t,e/i),this}},FSS.Vector4={create:function(t,e,i){var r=new FSS.Array(4);return this.set(r,t,e,i),r},set:function(t,e,i,r,s){return t[0]=e||0,t[1]=i||0,t[2]=r||0,t[3]=s||0,this},setX:function(t,e){return t[0]=e||0,this},setY:function(t,e){return t[1]=e||0,this},setZ:function(t,e){return t[2]=e||0,this},setW:function(t,e){return t[3]=e||0,this},add:function(t,e){return t[0]+=e[0],t[1]+=e[1],t[2]+=e[2],t[3]+=e[3],this},multiplyVectors:function(t,e,i){return t[0]=e[0]*i[0],t[1]=e[1]*i[1],t[2]=e[2]*i[2],t[3]=e[3]*i[3],this},multiplyScalar:function(t,e){return t[0]*=e,t[1]*=e,t[2]*=e,t[3]*=e,this},min:function(t,e){return e>t[0]&&(t[0]=e),e>t[1]&&(t[1]=e),e>t[2]&&(t[2]=e),e>t[3]&&(t[3]=e),this},max:function(t,e){return t[0]>e&&(t[0]=e),t[1]>e&&(t[1]=e),t[2]>e&&(t[2]=e),t[3]>e&&(t[3]=e),this},clamp:function(t,e,i){return this.min(t,e),this.max(t,i),this}},FSS.Color=function(t,e){this.rgba=FSS.Vector4.create(),this.hex=t||"#000000",this.opacity=FSS.Utils.isNumber(e)?e:1,this.set(this.hex,this.opacity)},FSS.Color.prototype={set:function(t,e){t=t.replace("#","");var i=t.length/3;return this.rgba[0]=parseInt(t.substring(0*i,1*i),16)/255,this.rgba[1]=parseInt(t.substring(1*i,2*i),16)/255,this.rgba[2]=parseInt(t.substring(2*i,3*i),16)/255,this.rgba[3]=FSS.Utils.isNumber(e)?e:this.rgba[3],this},hexify:function(t){var e=Math.ceil(255*t).toString(16);return 1===e.length&&(e="0"+e),e},format:function(){var t=this.hexify(this.rgba[0]),e=this.hexify(this.rgba[1]),i=this.hexify(this.rgba[2]);return this.hex="#"+t+e+i,this.hex}},FSS.Object=function(){this.position=FSS.Vector3.create()},FSS.Object.prototype={setPosition:function(t,e,i){return FSS.Vector3.set(this.position,t,e,i),this}},FSS.Light=function(t,e){FSS.Object.call(this),this.ambient=new FSS.Color(t||"#FFFFFF"),this.diffuse=new FSS.Color(e||"#FFFFFF"),this.ray=FSS.Vector3.create()},FSS.Light.prototype=Object.create(FSS.Object.prototype),FSS.Vertex=function(t,e,i){this.position=FSS.Vector3.create(t,e,i)},FSS.Vertex.prototype={setPosition:function(t,e,i){return FSS.Vector3.set(this.position,t,e,i),this}},FSS.Triangle=function(t,e,i){this.a=t||new FSS.Vertex,this.b=e||new FSS.Vertex,this.c=i||new FSS.Vertex,this.vertices=[this.a,this.b,this.c],this.u=FSS.Vector3.create(),this.v=FSS.Vector3.create(),this.centroid=FSS.Vector3.create(),this.normal=FSS.Vector3.create(),this.color=new FSS.Color,this.polygon=document.createElementNS(FSS.SVGNS,"polygon"),this.polygon.setAttributeNS(null,"stroke-linejoin","round"),this.polygon.setAttributeNS(null,"stroke-miterlimit","1"),this.polygon.setAttributeNS(null,"stroke-width","1"),this.computeCentroid(),this.computeNormal()},FSS.Triangle.prototype={computeCentroid:function(){return this.centroid[0]=this.a.position[0]+this.b.position[0]+this.c.position[0],this.centroid[1]=this.a.position[1]+this.b.position[1]+this.c.position[1],this.centroid[2]=this.a.position[2]+this.b.position[2]+this.c.position[2],FSS.Vector3.divideScalar(this.centroid,3),this},computeNormal:function(){return FSS.Vector3.subtractVectors(this.u,this.b.position,this.a.position),FSS.Vector3.subtractVectors(this.v,this.c.position,this.a.position),FSS.Vector3.crossVectors(this.normal,this.u,this.v),FSS.Vector3.normalise(this.normal),this}},FSS.Geometry=function(){this.vertices=[],this.triangles=[],this.dirty=!1},FSS.Geometry.prototype={update:function(){if(this.dirty){var t,e;for(t=this.triangles.length-1;t>=0;t--)e=this.triangles[t],e.computeCentroid(),e.computeNormal();this.dirty=!1}return this}},FSS.Plane=function(t,e,i,r){FSS.Geometry.call(this),this.width=t||100,this.height=e||100,this.segments=i||4,this.slices=r||4,this.segmentWidth=this.width/this.segments,this.sliceHeight=this.height/this.slices;var s,n,o,h,a,l,u,c=[],S=this.width*-.5,f=.5*this.height;for(s=0;this.segments>=s;s++)for(c.push([]),n=0;this.slices>=n;n++)u=new FSS.Vertex(S+s*this.segmentWidth,f-n*this.sliceHeight),c[s].push(u),this.vertices.push(u);for(s=0;this.segments>s;s++)for(n=0;this.slices>n;n++)o=c[s+0][n+0],h=c[s+0][n+1],a=c[s+1][n+0],l=c[s+1][n+1],t0=new FSS.Triangle(o,h,a),t1=new FSS.Triangle(a,h,l),this.triangles.push(t0,t1)},FSS.Plane.prototype=Object.create(FSS.Geometry.prototype),FSS.Material=function(t,e){this.ambient=new FSS.Color(t||"#444444"),this.diffuse=new FSS.Color(e||"#FFFFFF"),this.slave=new FSS.Color},FSS.Mesh=function(t,e){FSS.Object.call(this),this.geometry=t||new FSS.Geometry,this.material=e||new FSS.Material,this.side=FSS.FRONT,this.visible=!0},FSS.Mesh.prototype=Object.create(FSS.Object.prototype),FSS.Mesh.prototype.update=function(t,e){var i,r,s,n,o;if(this.geometry.update(),e)for(i=this.geometry.triangles.length-1;i>=0;i--){for(r=this.geometry.triangles[i],FSS.Vector4.set(r.color.rgba),s=t.length-1;s>=0;s--)n=t[s],FSS.Vector3.subtractVectors(n.ray,n.position,r.centroid),FSS.Vector3.normalise(n.ray),o=FSS.Vector3.dot(r.normal,n.ray),this.side===FSS.FRONT?o=Math.max(o,0):this.side===FSS.BACK?o=Math.abs(Math.min(o,0)):this.side===FSS.DOUBLE&&(o=Math.max(Math.abs(o),0)),FSS.Vector4.multiplyVectors(this.material.slave.rgba,this.material.ambient.rgba,n.ambient.rgba),FSS.Vector4.add(r.color.rgba,this.material.slave.rgba),FSS.Vector4.multiplyVectors(this.material.slave.rgba,this.material.diffuse.rgba,n.diffuse.rgba),FSS.Vector4.multiplyScalar(this.material.slave.rgba,o),FSS.Vector4.add(r.color.rgba,this.material.slave.rgba);FSS.Vector4.clamp(r.color.rgba,0,1)}return this},FSS.Scene=function(){this.meshes=[],this.lights=[]},FSS.Scene.prototype={add:function(t){return t instanceof FSS.Mesh&&!~this.meshes.indexOf(t)?this.meshes.push(t):t instanceof FSS.Light&&!~this.lights.indexOf(t)&&this.lights.push(t),this},remove:function(t){return t instanceof FSS.Mesh&&~this.meshes.indexOf(t)?this.meshes.splice(this.meshes.indexOf(t),1):t instanceof FSS.Light&&~this.lights.indexOf(t)&&this.lights.splice(this.lights.indexOf(t),1),this}},FSS.Renderer=function(){this.width=0,this.height=0,this.halfWidth=0,this.halfHeight=0},FSS.Renderer.prototype={setSize:function(t,e){return this.width!==t||this.height!==e?(this.width=t,this.height=e,this.halfWidth=.5*this.width,this.halfHeight=.5*this.height,this):void 0},clear:function(){return this},render:function(){return this}},FSS.CanvasRenderer=function(){FSS.Renderer.call(this),this.element=document.createElement("canvas"),this.element.style.display="block",this.context=this.element.getContext("2d"),this.setSize(this.element.width,this.element.height)},FSS.CanvasRenderer.prototype=Object.create(FSS.Renderer.prototype),FSS.CanvasRenderer.prototype.setSize=function(t,e){return FSS.Renderer.prototype.setSize.call(this,t,e),this.element.width=t,this.element.height=e,this.context.setTransform(1,0,0,-1,this.halfWidth,this.halfHeight),this},FSS.CanvasRenderer.prototype.clear=function(){return FSS.Renderer.prototype.clear.call(this),this.context.clearRect(-this.halfWidth,-this.halfHeight,this.width,this.height),this},FSS.CanvasRenderer.prototype.render=function(t){FSS.Renderer.prototype.render.call(this,t);var e,i,r,s,n;for(this.clear(),this.context.lineJoin="round",this.context.lineWidth=1,e=t.meshes.length-1;e>=0;e--)if(i=t.meshes[e],i.visible)for(i.update(t.lights,!0),r=i.geometry.triangles.length-1;r>=0;r--)s=i.geometry.triangles[r],n=s.color.format(),this.context.beginPath(),this.context.moveTo(s.a.position[0],s.a.position[1]),this.context.lineTo(s.b.position[0],s.b.position[1]),this.context.lineTo(s.c.position[0],s.c.position[1]),this.context.closePath(),this.context.strokeStyle=n,this.context.fillStyle=n,this.context.stroke(),this.context.fill();return this},FSS.WebGLRenderer=function(){FSS.Renderer.call(this),this.element=document.createElement("canvas"),this.element.style.display="block",this.vertices=null,this.lights=null;var t={preserveDrawingBuffer:!1,premultipliedAlpha:!0,antialias:!0,stencil:!0,alpha:!0};return this.gl=this.getContext(this.element,t),this.unsupported=!this.gl,this.unsupported?"WebGL is not supported by your browser.":(this.gl.clearColor(0,0,0,0),this.gl.enable(this.gl.DEPTH_TEST),this.setSize(this.element.width,this.element.height),void 0)},FSS.WebGLRenderer.prototype=Object.create(FSS.Renderer.prototype),FSS.WebGLRenderer.prototype.getContext=function(t,e){var i=!1;try{if(!(i=t.getContext("experimental-webgl",e)))throw"Error creating WebGL context."}catch(r){console.error(r)}return i},FSS.WebGLRenderer.prototype.setSize=function(t,e){return FSS.Renderer.prototype.setSize.call(this,t,e),this.unsupported?void 0:(this.element.width=t,this.element.height=e,this.gl.viewport(0,0,t,e),this)},FSS.WebGLRenderer.prototype.clear=function(){return FSS.Renderer.prototype.clear.call(this),this.unsupported?void 0:(this.gl.clear(this.gl.COLOR_BUFFER_BIT|this.gl.DEPTH_BUFFER_BIT),this)},FSS.WebGLRenderer.prototype.render=function(t){if(FSS.Renderer.prototype.render.call(this,t),!this.unsupported){var e,i,r,s,n,o,h,a,l,u,c,S,f,m,g,d=!1,p=t.lights.length,F=0;if(this.clear(),this.lights!==p){if(this.lights=p,!(this.lights>0))return;this.buildProgram(p)}if(this.program){for(e=t.meshes.length-1;e>=0;e--)i=t.meshes[e],i.geometry.dirty&&(d=!0),i.update(t.lights,!1),F+=3*i.geometry.triangles.length;if(d||this.vertices!==F){this.vertices=F;for(a in this.program.attributes){for(u=this.program.attributes[a],u.data=new FSS.Array(F*u.size),f=0,e=t.meshes.length-1;e>=0;e--)for(i=t.meshes[e],r=0,s=i.geometry.triangles.length;s>r;r++)for(n=i.geometry.triangles[r],m=0,g=n.vertices.length;g>m;m++){switch(vertex=n.vertices[m],a){case"side":this.setBufferData(f,u,i.side);break;case"position":this.setBufferData(f,u,vertex.position);break;case"centroid":this.setBufferData(f,u,n.centroid);break;case"normal":this.setBufferData(f,u,n.normal);break;case"ambient":this.setBufferData(f,u,i.material.ambient.rgba);break;case"diffuse":this.setBufferData(f,u,i.material.diffuse.rgba)}f++}this.gl.bindBuffer(this.gl.ARRAY_BUFFER,u.buffer),this.gl.bufferData(this.gl.ARRAY_BUFFER,u.data,this.gl.DYNAMIC_DRAW),this.gl.enableVertexAttribArray(u.location),this.gl.vertexAttribPointer(u.location,u.size,this.gl.FLOAT,!1,0,0)}}for(this.setBufferData(0,this.program.uniforms.resolution,[this.width,this.height,this.width]),o=p-1;o>=0;o--)h=t.lights[o],this.setBufferData(o,this.program.uniforms.lightPosition,h.position),this.setBufferData(o,this.program.uniforms.lightAmbient,h.ambient.rgba),this.setBufferData(o,this.program.uniforms.lightDiffuse,h.diffuse.rgba);for(l in this.program.uniforms)switch(u=this.program.uniforms[l],S=u.location,c=u.data,u.structure){case"3f":this.gl.uniform3f(S,c[0],c[1],c[2]);break;case"3fv":this.gl.uniform3fv(S,c);break;case"4fv":this.gl.uniform4fv(S,c)}}return this.gl.drawArrays(this.gl.TRIANGLES,0,this.vertices),this}},FSS.WebGLRenderer.prototype.setBufferData=function(t,e,i){if(FSS.Utils.isNumber(i))e.data[t*e.size]=i;else for(var r=i.length-1;r>=0;r--)e.data[t*e.size+r]=i[r]},FSS.WebGLRenderer.prototype.buildProgram=function(t){if(!this.unsupported){var e=FSS.WebGLRenderer.VS(t),i=FSS.WebGLRenderer.FS(t),r=e+i;if(!this.program||this.program.code!==r){var s=this.gl.createProgram(),n=this.buildShader(this.gl.VERTEX_SHADER,e),o=this.buildShader(this.gl.FRAGMENT_SHADER,i);if(this.gl.attachShader(s,n),this.gl.attachShader(s,o),this.gl.linkProgram(s),!this.gl.getProgramParameter(s,this.gl.LINK_STATUS)){var h=this.gl.getError(),a=this.gl.getProgramParameter(s,this.gl.VALIDATE_STATUS);return console.error("Could not initialise shader.\nVALIDATE_STATUS: "+a+"\nERROR: "+h),null}return this.gl.deleteShader(o),this.gl.deleteShader(n),s.code=r,s.attributes={side:this.buildBuffer(s,"attribute","aSide",1,"f"),position:this.buildBuffer(s,"attribute","aPosition",3,"v3"),centroid:this.buildBuffer(s,"attribute","aCentroid",3,"v3"),normal:this.buildBuffer(s,"attribute","aNormal",3,"v3"),ambient:this.buildBuffer(s,"attribute","aAmbient",4,"v4"),diffuse:this.buildBuffer(s,"attribute","aDiffuse",4,"v4")},s.uniforms={resolution:this.buildBuffer(s,"uniform","uResolution",3,"3f",1),lightPosition:this.buildBuffer(s,"uniform","uLightPosition",3,"3fv",t),lightAmbient:this.buildBuffer(s,"uniform","uLightAmbient",4,"4fv",t),lightDiffuse:this.buildBuffer(s,"uniform","uLightDiffuse",4,"4fv",t)},this.program=s,this.gl.useProgram(this.program),s}}},FSS.WebGLRenderer.prototype.buildShader=function(t,e){if(!this.unsupported){var i=this.gl.createShader(t);return this.gl.shaderSource(i,e),this.gl.compileShader(i),this.gl.getShaderParameter(i,this.gl.COMPILE_STATUS)?i:(console.error(this.gl.getShaderInfoLog(i)),null)}},FSS.WebGLRenderer.prototype.buildBuffer=function(t,e,i,r,s,n){var o={buffer:this.gl.createBuffer(),size:r,structure:s,data:null};switch(e){case"attribute":o.location=this.gl.getAttribLocation(t,i);break;case"uniform":o.location=this.gl.getUniformLocation(t,i)}return n&&(o.data=new FSS.Array(n*r)),o},FSS.WebGLRenderer.VS=function(t){var e=["precision mediump float;","#define LIGHTS "+t,"attribute float aSide;","attribute vec3 aPosition;","attribute vec3 aCentroid;","attribute vec3 aNormal;","attribute vec4 aAmbient;","attribute vec4 aDiffuse;","uniform vec3 uResolution;","uniform vec3 uLightPosition[LIGHTS];","uniform vec4 uLightAmbient[LIGHTS];","uniform vec4 uLightDiffuse[LIGHTS];","varying vec4 vColor;","void main() {","vColor = vec4(0.0);","vec3 position = aPosition / uResolution * 2.0;","for (int i = 0; i < LIGHTS; i++) {","vec3 lightPosition = uLightPosition[i];","vec4 lightAmbient = uLightAmbient[i];","vec4 lightDiffuse = uLightDiffuse[i];","vec3 ray = normalize(lightPosition - aCentroid);","float illuminance = dot(aNormal, ray);","if (aSide == 0.0) {","illuminance = max(illuminance, 0.0);","} else if (aSide == 1.0) {","illuminance = abs(min(illuminance, 0.0));","} else if (aSide == 2.0) {","illuminance = max(abs(illuminance), 0.0);","}","vColor += aAmbient * lightAmbient;","vColor += aDiffuse * lightDiffuse * illuminance;","}","vColor = clamp(vColor, 0.0, 1.0);","gl_Position = vec4(position, 1.0);","}"].join("\n");return e},FSS.WebGLRenderer.FS=function(){var t=["precision mediump float;","varying vec4 vColor;","void main() {","gl_FragColor = vColor;","}"].join("\n");return t},FSS.SVGRenderer=function(){FSS.Renderer.call(this),this.element=document.createElementNS(FSS.SVGNS,"svg"),this.element.setAttribute("xmlns",FSS.SVGNS),this.element.setAttribute("version","1.1"),this.element.style.display="block",this.setSize(300,150)},FSS.SVGRenderer.prototype=Object.create(FSS.Renderer.prototype),FSS.SVGRenderer.prototype.setSize=function(t,e){return FSS.Renderer.prototype.setSize.call(this,t,e),this.element.setAttribute("width",t),this.element.setAttribute("height",e),this},FSS.SVGRenderer.prototype.clear=function(){FSS.Renderer.prototype.clear.call(this);for(var t=this.element.childNodes.length-1;t>=0;t--)this.element.removeChild(this.element.childNodes[t]);return this},FSS.SVGRenderer.prototype.render=function(t){FSS.Renderer.prototype.render.call(this,t);var e,i,r,s,n,o;for(e=t.meshes.length-1;e>=0;e--)if(i=t.meshes[e],i.visible)for(i.update(t.lights,!0),r=i.geometry.triangles.length-1;r>=0;r--)s=i.geometry.triangles[r],s.polygon.parentNode!==this.element&&this.element.appendChild(s.polygon),n=this.formatPoint(s.a)+" ",n+=this.formatPoint(s.b)+" ",n+=this.formatPoint(s.c),o=this.formatStyle(s.color.format()),s.polygon.setAttributeNS(null,"points",n),s.polygon.setAttributeNS(null,"style",o);return this},FSS.SVGRenderer.prototype.formatPoint=function(t){return this.halfWidth+t.position[0]+","+(this.halfHeight-t.position[1])},FSS.SVGRenderer.prototype.formatStyle=function(t){var e="fill:"+t+";";return e+="stroke:"+t+";"};
}

function initBackground() {
  var container = document.getElementById('background-container');
  var output = document.getElementById('background-output');

  if (!config.background.enabled) {
    return;
  }

  initPlugin();

  config.background.LIGHT.bounds = FSS.Vector3.create(),
  config.background.LIGHT.step = FSS.Vector3.create(
      Math.randomInRange(0.2, 1.0),
      Math.randomInRange(0.2, 1.0),
      Math.randomInRange(0.2, 1.0)
  )

  //------------------------------
  // Global Properties
  //------------------------------
  var now, start = Date.now();
  var center = FSS.Vector3.create();
  var attractor = FSS.Vector3.create();
  var renderer, scene, mesh, geometry, material;
  var webglRenderer, canvasRenderer, svgRenderer;
  var gui, autopilotController;


  //------------------------------
  // Methods
  //------------------------------
  function initialise() {
    createRenderer();
    createScene();
    createMesh();
    createLights();
    addEventListeners();
    resize(container.offsetWidth, container.offsetHeight);
    animate();
  }

  function createRenderer() {
    webglRenderer = new FSS.WebGLRenderer();
    canvasRenderer = new FSS.CanvasRenderer();
    svgRenderer = new FSS.SVGRenderer();
    setRenderer(config.background.RENDER.renderer);
  }

  function setRenderer(index) {
    if (renderer) {
      output.removeChild(renderer.element);
    }

    renderer = canvasRenderer;
    renderer.setSize(container.offsetWidth, container.offsetHeight);
    output.appendChild(renderer.element);
  }

  function createScene() {
    scene = new FSS.Scene();
  }

  function createMesh() {
    scene.remove(mesh);
    renderer.clear();
    geometry = new FSS.Plane(config.background.MESH.width * renderer.width, config.background.MESH.height * renderer.height, config.background.MESH.segments, config.background.MESH.slices);
    material = new FSS.Material(config.background.MESH.ambient, config.background.MESH.diffuse);
    mesh = new FSS.Mesh(geometry, material);
    scene.add(mesh);

    // Augment vertices for animation
    var v, vertex;
    for (v = geometry.vertices.length - 1; v >= 0; v--) {
      vertex = geometry.vertices[v];
      vertex.anchor = FSS.Vector3.clone(vertex.position);
      vertex.step = FSS.Vector3.create(
        Math.randomInRange(0.2, 1.0),
        Math.randomInRange(0.2, 1.0),
        Math.randomInRange(0.2, 1.0)
      );
      vertex.time = Math.randomInRange(0, Math.PIM2);
    }
  }

  function createLights() {
    var l, light;
    for (l = scene.lights.length - 1; l >= 0; l--) {
      light = scene.lights[l];
      scene.remove(light);
    }
    renderer.clear();
    for (l = 0; l < config.background.LIGHT.count; l++) {
      light = new FSS.Light(config.background.LIGHT.ambient, config.background.LIGHT.diffuse);
      light.ambientHex = light.ambient.format();
      light.diffuseHex = light.diffuse.format();
      scene.add(light);

      // Augment light for animation
      light.mass = Math.randomInRange(0.5, 1);
      light.velocity = FSS.Vector3.create();
      light.acceleration = FSS.Vector3.create();
      light.force = FSS.Vector3.create();

      // Ring SVG Circle
      light.ring = document.createElementNS(FSS.SVGNS, 'circle');
      light.ring.setAttributeNS(null, 'stroke', light.ambientHex);
      light.ring.setAttributeNS(null, 'stroke-width', '0.5');
      light.ring.setAttributeNS(null, 'fill', 'none');
      light.ring.setAttributeNS(null, 'r', '10');

      // Core SVG Circle
      light.core = document.createElementNS(FSS.SVGNS, 'circle');
      light.core.setAttributeNS(null, 'fill', light.diffuseHex);
      light.core.setAttributeNS(null, 'r', '4');
    }
  }

  function resize(width, height) {
    renderer.setSize(width, height);
    FSS.Vector3.set(center, renderer.halfWidth, renderer.halfHeight);
    createMesh();
  }

  function animate() {
    now = Date.now() - start;
    update();
    render();
    requestAnimationFrame(animate);
  }

  function update() {
    var ox, oy, oz, l, light, v, vertex, offset = config.background.MESH.depth/2;

    // Update Bounds
    FSS.Vector3.copy(config.background.LIGHT.bounds, center);
    FSS.Vector3.multiplyScalar(config.background.LIGHT.bounds, config.background.LIGHT.xyScalar);

    // Update Attractor
    FSS.Vector3.setZ(attractor, config.background.LIGHT.zOffset);

    // Overwrite the Attractor position
    if (config.background.LIGHT.autopilot) {
      ox = Math.sin(config.background.LIGHT.step[0] * now * config.background.LIGHT.speed);
      oy = Math.cos(config.background.LIGHT.step[1] * now * config.background.LIGHT.speed);
      FSS.Vector3.set(attractor,
        config.background.LIGHT.bounds[0]*ox,
        config.background.LIGHT.bounds[1]*oy,
        config.background.LIGHT.zOffset);
    }

    // Animate Lights
    for (l = scene.lights.length - 1; l >= 0; l--) {
      light = scene.lights[l];

      // Reset the z position of the light
      FSS.Vector3.setZ(light.position, config.background.LIGHT.zOffset);

      // Calculate the force Luke!
      var D = Math.clamp(FSS.Vector3.distanceSquared(light.position, attractor), config.background.LIGHT.minDistance, config.background.LIGHT.maxDistance);
      var F = config.background.LIGHT.gravity * light.mass / D;
      FSS.Vector3.subtractVectors(light.force, attractor, light.position);
      FSS.Vector3.normalise(light.force);
      FSS.Vector3.multiplyScalar(light.force, F);

      // Update the light position
      FSS.Vector3.set(light.acceleration);
      FSS.Vector3.add(light.acceleration, light.force);
      FSS.Vector3.add(light.velocity, light.acceleration);
      FSS.Vector3.multiplyScalar(light.velocity, config.background.LIGHT.dampening);
      FSS.Vector3.limit(light.velocity, config.background.LIGHT.minLimit, config.background.LIGHT.maxLimit);
      FSS.Vector3.add(light.position, light.velocity);
    }

    // Animate Vertices
    for (v = geometry.vertices.length - 1; v >= 0; v--) {
      vertex = geometry.vertices[v];
      ox = Math.sin(vertex.time + vertex.step[0] * now * config.background.MESH.speed);
      oy = Math.cos(vertex.time + vertex.step[1] * now * config.background.MESH.speed);
      oz = Math.sin(vertex.time + vertex.step[2] * now * config.background.MESH.speed);
      FSS.Vector3.set(vertex.position,
        config.background.MESH.xRange*geometry.segmentWidth*ox,
        config.background.MESH.yRange*geometry.sliceHeight*oy,
        config.background.MESH.zRange*offset*oz - offset);
      FSS.Vector3.add(vertex.position, vertex.anchor);
    }

    // Set the Geometry to dirty
    geometry.dirty = true;
  }

  function render() {
    renderer.render(scene);

    // Draw Lights
    if (config.background.LIGHT.draw) {
      var l, lx, ly, light;
      for (l = scene.lights.length - 1; l >= 0; l--) {
        light = scene.lights[l];
        lx = light.position[0];
        ly = light.position[1];
        switch(config.background.RENDER.renderer) {
          case CANVAS:
            renderer.context.lineWidth = 0.5;
            renderer.context.beginPath();
            renderer.context.arc(lx, ly, 10, 0, Math.PIM2);
            renderer.context.strokeStyle = light.ambientHex;
            renderer.context.stroke();
            renderer.context.beginPath();
            renderer.context.arc(lx, ly, 4, 0, Math.PIM2);
            renderer.context.fillStyle = light.diffuseHex;
            renderer.context.fill();
            break;
          case SVG:
            lx += renderer.halfWidth;
            ly = renderer.halfHeight - ly;
            light.core.setAttributeNS(null, 'fill', light.diffuseHex);
            light.core.setAttributeNS(null, 'cx', lx);
            light.core.setAttributeNS(null, 'cy', ly);
            renderer.element.appendChild(light.core);
            light.ring.setAttributeNS(null, 'stroke', light.ambientHex);
            light.ring.setAttributeNS(null, 'cx', lx);
            light.ring.setAttributeNS(null, 'cy', ly);
            renderer.element.appendChild(light.ring);
            break;
        }
      }
    }
  }

  function addEventListeners() {
    window.addEventListener('resize', onWindowResize);
    container.addEventListener('click', onMouseClick);
    container.addEventListener('mousemove', onMouseMove);
  }

  //------------------------------
  // Callbacks
  //------------------------------

  function onMouseClick(event) {
    if (config.background.LIGHT.followMouseClicks) {
      FSS.Vector3.set(attractor, event.x, renderer.height - event.y);
      FSS.Vector3.subtract(attractor, center);
      config.background.LIGHT.autopilot = !config.background.LIGHT.autopilot;
      autopilotController.updateDisplay();
    }
  }

  function onMouseMove(event) {
    FSS.Vector3.set(attractor, event.x, renderer.height - event.y);
    FSS.Vector3.subtract(attractor, center);
  }

  function onWindowResize(event) {
    resize(container.offsetWidth, container.offsetHeight);
    render();
  }



  // Let there be light!
  initialise();
}

/* ========================================================================
 * Bootstrap (plugin): validator.js v0.9.0
 * ========================================================================
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Cina Saffary.
 * Made by @1000hz in the style of Bootstrap 3 era @fat
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * ======================================================================== */


+function ($) {
  'use strict';

  // VALIDATOR CLASS DEFINITION
  // ==========================

  var Validator = function (element, options) {
    this.$element = $(element)
    this.options  = options

    options.errors = $.extend({}, Validator.DEFAULTS.errors, options.errors)

    for (var custom in options.custom) {
      if (!options.errors[custom]) throw new Error('Missing default error message for custom validator: ' + custom)
    }

    $.extend(Validator.VALIDATORS, options.custom)

    this.$element.attr('novalidate', true) // disable automatic native validation
    this.toggleSubmit()

    this.$element.on('input.bs.validator change.bs.validator focusout.bs.validator', $.proxy(this.validateInput, this))
    this.$element.on('submit.bs.validator', $.proxy(this.onSubmit, this))

    this.$element.find('[data-match]').each(function () {
      var $this  = $(this)
      var target = $this.data('match')

      $(target).on('input.bs.validator', function (e) {
        $this.val() && $this.trigger('input.bs.validator')
      })
    })
  }

  Validator.INPUT_SELECTOR = ':input:not([type="submit"], button):enabled:visible'

  Validator.DEFAULTS = {
    delay: 500,
    html: false,
    disable: true,
    custom: {},
    errors: {
      match: 'Does not match',
      minlength: 'Not long enough'
    },
    feedback: {
      success: 'glyphicon-ok',
      error: 'glyphicon-remove'
    }
  }

  Validator.VALIDATORS = {
    'native': function ($el) {
      var el = $el[0]
      return el.checkValidity ? el.checkValidity() : true
    },
    'match': function ($el) {
      var target = $el.data('match')
      return !$el.val() || $el.val() === $(target).val()
    },
    'minlength': function ($el) {
      var minlength = $el.data('minlength')
      return !$el.val() || $el.val().length >= minlength
    }
  }

  Validator.prototype.validateInput = function (e) {
    var $el        = $(e.target)
    var prevErrors = $el.data('bs.validator.errors')
    var errors

    if ($el.is('[type="radio"]')) $el = this.$element.find('input[name="' + $el.attr('name') + '"]')

    this.$element.trigger(e = $.Event('validate.bs.validator', {relatedTarget: $el[0]}))

    if (e.isDefaultPrevented()) return

    var self = this

    this.runValidators($el).done(function (errors) {
      $el.data('bs.validator.errors', errors)

      errors.length ? self.showErrors($el) : self.clearErrors($el)

      if (!prevErrors || errors.toString() !== prevErrors.toString()) {
        e = errors.length
          ? $.Event('invalid.bs.validator', {relatedTarget: $el[0], detail: errors})
          : $.Event('valid.bs.validator', {relatedTarget: $el[0], detail: prevErrors})

        self.$element.trigger(e)
      }

      self.toggleSubmit()

      self.$element.trigger($.Event('validated.bs.validator', {relatedTarget: $el[0]}))
    })
  }


  Validator.prototype.runValidators = function ($el) {
    var errors   = []
    var deferred = $.Deferred()
    var options  = this.options

    $el.data('bs.validator.deferred') && $el.data('bs.validator.deferred').reject()
    $el.data('bs.validator.deferred', deferred)

    function getErrorMessage(key) {
      return $el.data(key + '-error')
        || $el.data('error')
        || key == 'native' && $el[0].validationMessage
        || options.errors[key]
    }

    $.each(Validator.VALIDATORS, $.proxy(function (key, validator) {
      if (($el.data(key) || key == 'native') && !validator.call(this, $el)) {
        var error = getErrorMessage(key)
        !~errors.indexOf(error) && errors.push(error)
      }
    }, this))

    if (!errors.length && $el.val() && $el.data('remote')) {
      this.defer($el, function () {
        var data = {}
        data[$el.attr('name')] = $el.val()
        $.get($el.data('remote'), data)
          .fail(function (jqXHR, textStatus, error) { errors.push(getErrorMessage('remote') || error) })
          .always(function () { deferred.resolve(errors)})
      })
    } else deferred.resolve(errors)

    return deferred.promise()
  }

  Validator.prototype.validate = function () {
    var delay = this.options.delay

    this.options.delay = 0
    this.$element.find(Validator.INPUT_SELECTOR).trigger('input.bs.validator')
    this.options.delay = delay

    return this
  }

  Validator.prototype.showErrors = function ($el) {
    var method = this.options.html ? 'html' : 'text'

    this.defer($el, function () {
      var $group = $el.closest('.form-group')
      var $block = $group.find('.help-block.with-errors')
      var $feedback = $group.find('.form-control-feedback')
      var errors = $el.data('bs.validator.errors')

      if (!errors.length) return

      errors = $('<ul/>')
        .addClass('list-unstyled')
        .append($.map(errors, function (error) { return $('<li/>')[method](error) }))

      $block.data('bs.validator.originalContent') === undefined && $block.data('bs.validator.originalContent', $block.html())
      $block.empty().append(errors)
      $group.addClass('has-error')

      $feedback.length
        && $feedback.removeClass(this.options.feedback.success)
        && $feedback.addClass(this.options.feedback.error)
        && $group.removeClass('has-success')
    })
  }

  Validator.prototype.clearErrors = function ($el) {
    var $group = $el.closest('.form-group')
    var $block = $group.find('.help-block.with-errors')
    var $feedback = $group.find('.form-control-feedback')

    $block.html($block.data('bs.validator.originalContent'))
    $group.removeClass('has-error')

    $feedback.length
      && $feedback.removeClass(this.options.feedback.error)
      && $feedback.addClass(this.options.feedback.success)
      && $group.addClass('has-success')
  }

  Validator.prototype.hasErrors = function () {
    function fieldErrors() {
      return !!($(this).data('bs.validator.errors') || []).length
    }

    return !!this.$element.find(Validator.INPUT_SELECTOR).filter(fieldErrors).length
  }

  Validator.prototype.isIncomplete = function () {
    function fieldIncomplete() {
      return this.type === 'checkbox' ? !this.checked                                   :
             this.type === 'radio'    ? !$('[name="' + this.name + '"]:checked').length :
                                        $.trim(this.value) === ''
    }

    return !!this.$element.find(Validator.INPUT_SELECTOR).filter('[required]').filter(fieldIncomplete).length
  }

  Validator.prototype.onSubmit = function (e) {
    this.validate()
    if (this.isIncomplete() || this.hasErrors()) e.preventDefault()
  }

  Validator.prototype.toggleSubmit = function () {
    if(!this.options.disable) return

    var $btn = $('button[type="submit"], input[type="submit"]')
      .filter('[form="' + this.$element.attr('id') + '"]')
      .add(this.$element.find('input[type="submit"], button[type="submit"]'))

    $btn.toggleClass('disabled', this.isIncomplete() || this.hasErrors())
  }

  Validator.prototype.defer = function ($el, callback) {
    callback = $.proxy(callback, this)
    if (!this.options.delay) return callback()
    window.clearTimeout($el.data('bs.validator.timeout'))
    $el.data('bs.validator.timeout', window.setTimeout(callback, this.options.delay))
  }

  Validator.prototype.destroy = function () {
    this.$element
      .removeAttr('novalidate')
      .removeData('bs.validator')
      .off('.bs.validator')

    this.$element.find(Validator.INPUT_SELECTOR)
      .off('.bs.validator')
      .removeData(['bs.validator.errors', 'bs.validator.deferred'])
      .each(function () {
        var $this = $(this)
        var timeout = $this.data('bs.validator.timeout')
        window.clearTimeout(timeout) && $this.removeData('bs.validator.timeout')
      })

    this.$element.find('.help-block.with-errors').each(function () {
      var $this = $(this)
      var originalContent = $this.data('bs.validator.originalContent')

      $this
        .removeData('bs.validator.originalContent')
        .html(originalContent)
    })

    this.$element.find('input[type="submit"], button[type="submit"]').removeClass('disabled')

    this.$element.find('.has-error').removeClass('has-error')

    return this
  }

  // VALIDATOR PLUGIN DEFINITION
  // ===========================


  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var options = $.extend({}, Validator.DEFAULTS, $this.data(), typeof option == 'object' && option)
      var data    = $this.data('bs.validator')

      if (!data && option == 'destroy') return
      if (!data) $this.data('bs.validator', (data = new Validator(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  var old = $.fn.validator

  $.fn.validator             = Plugin
  $.fn.validator.Constructor = Validator


  // VALIDATOR NO CONFLICT
  // =====================

  $.fn.validator.noConflict = function () {
    $.fn.validator = old
    return this
  }


  // VALIDATOR DATA-API
  // ==================

  $(window).on('load', function () {
    $('form[data-toggle="validator"]').each(function () {
      var $form = $(this)
      Plugin.call($form, $form.data())
    })
  })

}(jQuery);

var config = {
    countdown: {
        year: 2015,
        month: 11,
        day: 10,
        hour: 0,
        minute: 0,
        second: 0
    },

    subscription_form_tooltips: {
        success: 'You have been subscribed!',
        already_subscribed: 'You are already subscribed',
        empty_email: 'Please, Enter your email',
        invalid_email: 'Email is invalid. Enter valid email address',
        default_error: 'Error! Contact administration'
    }
}

$(function() {
    var $body = $(document.body),
        $window = $(window);



    // Background

    var canvas = document.createElement('canvas');

    backgroundEnabled = canvas.getContext && canvas.getContext('2d') && $('#background-container').css('display') != 'none';

    if (backgroundEnabled) {
        config.background = {
            enabled: true,

            RENDER: {
                renderer: 'canvas'
            },

            MESH: {
                width: 1.2,
                height: 1.2,
                depth: 10,
                segments: 16,
                slices: 8,
                xRange: 0.8,
                yRange: 0.1,
                zRange: 1.0,
                ambient: '#555555',
                diffuse: '#FFFFFF',
                speed: 0.0005
            },

            LIGHT: {
                count: 2,
                xyScalar: 1,
                zOffset: 150,
                ambient: '#880066',
                diffuse: '#D77600',
                speed: 0.001,
                gravity: 1200,
                dampening: 0.15,
                minLimit: 8,
                maxLimit: null,
                minDistance: 20,
                maxDistance: 400,
                autopilot: true,
                draw: false
            }
        }


        if ($body.hasClass('theme-ice')) {
            config.background.LIGHT.ambient = '#1165A4';
            config.background.LIGHT.diffuse = '#514311';
        } else if ($body.hasClass('theme-nature')) {
            config.background.LIGHT.ambient = '#00935B';
            config.background.LIGHT.diffuse = '#02480A';
        } else if ($body.hasClass('theme-sea')) {
            config.background.LIGHT.ambient = '#76E4CE';
            config.background.LIGHT.diffuse = '#0E411F';
            config.background.LIGHT.zOffset = 100;
        } else if ($body.hasClass('theme-candy')) {
            config.background.LIGHT.ambient = '#A42D71';
            config.background.LIGHT.diffuse = '#4E2F1B';
        } else if ($body.hasClass('theme-peach')) {
            config.background.LIGHT.ambient = '#FF7171';
            config.background.LIGHT.diffuse = '#895321';
            config.background.LIGHT.zOffset = 100;
        } else if ($body.hasClass('theme-light')) {
            config.background.LIGHT.ambient = '#DBAA95';
            config.background.LIGHT.diffuse = '#4F460B';
        } else if ($body.hasClass('theme-darkness')) {
            config.background.LIGHT.ambient = '#3C3C3C';
            config.background.LIGHT.diffuse = '#494949';
            config.background.LIGHT.zOffset = 200;
        }

        initBackground();
    }



    // Countdown

    var date = new Date(config.countdown.year,
                        config.countdown.month - 1,
                        config.countdown.day,
                        config.countdown.hour,
                        config.countdown.minute,
                        config.countdown.second),
        $countdownNumbers = {
            days: $('#countdown-days'),
            hours: $('#countdown-hours'),
            minutes: $('#countdown-minutes'),
            seconds: $('#countdown-seconds')
        };

    $('#countdown').countdown(date).on('update.countdown', function(event) {
        $countdownNumbers.days.text(event.offset.totalDays);
        $countdownNumbers.hours.text(('0' + event.offset.hours).slice(-2));
        $countdownNumbers.minutes.text(('0' + event.offset.minutes).slice(-2));
        $countdownNumbers.seconds.text(('0' + event.offset.seconds).slice(-2));
    });



    // Subscription form

    var messages = config.subscription_form_tooltips,
        error = false,
        $form = $('#subscription-form'),
        $email = $('#subscription-form-email'),
        $button = $('#subscription-form-submit'),
        $tooltip;

    function renderTooltip(type, message) {
        var offset;

        if (!$tooltip) {
            $tooltip = $('<p class="subscription-form-tooltip"></p>').appendTo($form);
        }

        if (type == 'success') {
            $tooltip.removeClass('error').addClass('success');
        } else {
            $tooltip.removeClass('success').addClass('error');
        }

        $tooltip.text(message).fadeTo(0, 0);
        offset = $tooltip.outerWidth() / 2;
        $tooltip.css('margin-left', -offset).animate({top: '100%'}, 200).dequeue().fadeTo(200, 1);
    }

    function hideTooltip() {
        if ($tooltip) {
            $tooltip.animate({top: '120%'}, 200).dequeue().fadeTo(100, 0);
        }
    }

    function changeFormState(type, message) {
        $email.removeClass('success error');

        if (type == 'normal') {
            hideTooltip();
        } else {
            renderTooltip(type, message);
            $email.addClass(type);
        }
    }

    $form.submit(function(event) {
        event.preventDefault();

        var email = $email.val();

        if (email.length == 0) {
            changeFormState('error', messages['empty_email']);
        } else {
            $.post('subscribe.html', {
                'email': email,
                'ajax': 1
            }, function(data) {
                if (data.status == 'success') {
                    changeFormState('success', messages['success']);
                } else {
                    switch(data.error) {
                        case 'empty_email':
                        case 'invalid_email':
                        case 'already_subscribed':
                            changeFormState('error', messages[data.error]);
                            break;

                        default:
                            changeFormState('error', messages['default_error'])
                            break;
                    }
                }
            }, 'json');
        }
    });

    // Remove tooltip on text change
    $email.on('change focus click keydown', function() {
        if ($email.val().length > 0) {
            changeFormState('normal');
        }
    });
});
$(function() {
    var $html = $('html'),
        $demo_panel = $('#demo-panel'),
        $themeSwitchers = $('.demo-panel-themes li');

    $('#demo-panel-activator').on('click', function(e) {
        e.preventDefault();

        $demo_panel.toggleClass('active');
    });

    $themeSwitchers.on('click', function() {
        var $this = $(this);

        $themeSwitchers.filter('.active').removeClass('active');
        $this.toggleClass('active');
    });
});
//# sourceMappingURL=frontend.js.map
