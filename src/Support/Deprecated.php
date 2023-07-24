<?php

namespace Rmunate\Php2Js\Support;

class Deprecated
{
    /**
     * Return Script JS
     * Support Version 2.X Library.
     *
     * @return string
     */
    public static function __PHP(): string
    {
        return '<script id="__PHP2JS_PRIVATE">

            sessionStorage.clear();
        
            unique_php2js = Math.random().toString(16).slice(2);
        
            var bridgePHP = {
                get_defined_vars: unique_php2js + "_vars",
                baseUrl: unique_php2js + "_baseUrl",
                fullUrl: unique_php2js + "_fullUrl",
                parameters: unique_php2js + "_parameters",
                uri: unique_php2js + "_uri",
                scheme: unique_php2js + "_scheme",
                token: unique_php2js + "_token",
                tokenMeta: unique_php2js + "_tokenMeta",
                tokenInput: unique_php2js + "_tokenInput",
                agent: unique_php2js + "_agent",
                remote_ip: unique_php2js + "_remote_ip",
                remote_port: unique_php2js + "_remote_port",
                php_version: unique_php2js + "_php_version",
                php_id: unique_php2js + "_php_id",
                php_release: unique_php2js + "_php_release",
                browser: unique_php2js + "_browser",
                is_mobile: unique_php2js + "_is_mobile",
                mobile_os_android: unique_php2js + "_mobile_os_android",
                mobile_os_iphone: unique_php2js + "_mobile_os_iphone",
                os_linux: unique_php2js + "_os_linux",
                os_ios: unique_php2js + "_os_ios",
                os_windows: unique_php2js + "_os_windows",
                user: unique_php2js + "_user",
                debugger: unique_php2js + "_debugger"
            };
            delete unique_php2js; 
        
            sessionStorage.setItem(bridgePHP.get_defined_vars,JSON.stringify(<?php echo json_encode(array_diff_key(get_defined_vars(), array_flip(["__data","__env","__path","__currentLoopData","__file","__dir","__fluent"]))); ?>));
            
            sessionStorage.setItem(bridgePHP.baseUrl,<?php echo json_encode((new \Rmunate\Php2Js\Data\UrlPhp2Js)->getBaseUrl()); ?>);
            
            sessionStorage.setItem(bridgePHP.fullUrl,<?php echo json_encode((new \Rmunate\Php2Js\Data\UrlPhp2Js)->getFullUrl()); ?>);
            
            sessionStorage.setItem(bridgePHP.parameters,JSON.stringify(<?php echo json_encode((new \Rmunate\Php2Js\Data\UrlPhp2Js)->getParametersRoute()); ?>));
            
            sessionStorage.setItem(bridgePHP.uri,<?php echo json_encode((new \Rmunate\Php2Js\Data\UrlPhp2Js)->getUri()); ?>); 
            
            sessionStorage.setItem(bridgePHP.scheme,<?php echo json_encode((new \Rmunate\Php2Js\Data\UrlPhp2Js)->getSchema()); ?>);
            
            sessionStorage.setItem(bridgePHP.token,<?php echo json_encode((new \Rmunate\Php2Js\Data\TokenPhp2Js)->csrfToken()); ?>);
            
            sessionStorage.setItem(bridgePHP.tokenMeta,"<meta name=" + String.fromCharCode(34) + " csrf-token" + String.fromCharCode(34) + " content=" + String.fromCharCode(34) + sessionStorage.getItem(bridgePHP.token) + String.fromCharCode(34) + ">");
            
            sessionStorage.setItem(bridgePHP.tokenInput,"<input type" + String.fromCharCode(34) + "hidden" + String.fromCharCode(34) + " name=" + String.fromCharCode(34) + "_token" + String.fromCharCode(34) + " value=" + String.fromCharCode(34) + sessionStorage.getItem(bridgePHP.token) + String.fromCharCode(34) + "/>");
            
            sessionStorage.setItem(bridgePHP.php_version,<?php echo json_encode((new \Rmunate\Php2Js\Data\ServerPhp2Js)->getPhpVersion()); ?>);
            
            sessionStorage.setItem(bridgePHP.php_id,<?php echo json_encode((new \Rmunate\Php2Js\Data\ServerPhp2Js)->getPhpVersionId()); ?>);
            
            sessionStorage.setItem(bridgePHP.php_release,<?php echo json_encode((new \Rmunate\Php2Js\Data\ServerPhp2Js)->getPhpReleaseVersion()); ?>);
            
            sessionStorage.setItem(bridgePHP.agent,<?php echo json_encode((new \Rmunate\Php2Js\Data\AgentPhp2Js)->getAgent()); ?>);
            
            sessionStorage.setItem(bridgePHP.remote_ip,<?php echo json_encode((new \Rmunate\Php2Js\Data\AgentPhp2Js)->getIpAddress()); ?>);
            
            sessionStorage.setItem(bridgePHP.remote_port,<?php echo json_encode((new \Rmunate\Php2Js\Data\AgentPhp2Js)->getRemotePort()); ?>);
            
            sessionStorage.setItem(bridgePHP.browser,JSON.stringify(<?php echo json_encode((new \Rmunate\Php2Js\Data\AgentPhp2Js)->getDataBrowser()); ?>));
            
            sessionStorage.setItem(bridgePHP.is_mobile,<?php echo json_encode((new \Rmunate\Php2Js\Data\AgentPhp2Js)->isMobileDevice()); ?>);
            
            sessionStorage.setItem(bridgePHP.mobile_os_android,<?php echo json_encode((new \Rmunate\Php2Js\Data\AgentPhp2Js)->validatePlatform(["Android"])); ?>);
            
            sessionStorage.setItem(bridgePHP.mobile_os_iphone,<?php echo json_encode((new \Rmunate\Php2Js\Data\AgentPhp2Js)->validatePlatform(["iPhone","iPhone OS"])); ?>);
            
            sessionStorage.setItem(bridgePHP.os_linux,<?php echo json_encode((new \Rmunate\Php2Js\Data\AgentPhp2Js)->validatePlatform(["Linux"])); ?>);
            
            sessionStorage.setItem(bridgePHP.os_ios,<?php echo json_encode((new \Rmunate\Php2Js\Data\AgentPhp2Js)->validatePlatform(["Macintosh","Intel Mac OS","Mac"])); ?>);
            
            sessionStorage.setItem(bridgePHP.os_windows,<?php echo json_encode((new \Rmunate\Php2Js\Data\AgentPhp2Js)->validatePlatform(["Windows","Win"])); ?>);
            
            sessionStorage.setItem(bridgePHP.user,JSON.stringify(<?php echo json_encode((new \Rmunate\Php2Js\Data\UserPhp2Js)->getDataUser()); ?>));
                
            sessionStorage.setItem(bridgePHP.debugger,<?php echo json_encode((new \Rmunate\Php2Js\Data\LaravelPhp2Js)->getEnvDebug()); ?>);
            
        </script>
        <script id="__PHP2JS_CLASS">
        
            class PHP 
            { 
                #a;
                #b;
                #c;
                #d;
                #e;
                #f;
                #g;
                #h;
                #i;
                #j;
                #k;
                #l;
                #m;
                #n;
                #o;
                #p;
                #q;
                #r;
                #s;
                #t;
                #u;
                #v;
                #w;
                #x;
                
                constructor()
                { 
                    this.#a = PHP.item(bridgePHP.get_defined_vars);
                    this.#b = PHP.item(bridgePHP.baseUrl);
                    this.#c = PHP.item(bridgePHP.fullUrl);
                    this.#d = PHP.item(bridgePHP.parameters);
                    this.#e = PHP.item(bridgePHP.uri);
                    this.#f = PHP.item(bridgePHP.scheme);
                    this.#g = PHP.item(bridgePHP.token);
                    this.#h = PHP.item(bridgePHP.tokenMeta);
                    this.#i = PHP.item(bridgePHP.tokenInput);
                    this.#j = PHP.item(bridgePHP.php_version);
                    this.#k = PHP.item(bridgePHP.php_id);
                    this.#l = PHP.item(bridgePHP.php_release);
                    this.#m = PHP.item(bridgePHP.agent);
                    this.#n = PHP.item(bridgePHP.remote_ip);
                    this.#o = PHP.item(bridgePHP.remote_port);
                    this.#p = PHP.item(bridgePHP.browser);
                    this.#q = "true" === PHP.item(bridgePHP.is_mobile);
                    this.#r = "true" === PHP.item(bridgePHP.mobile_os_android);
                    this.#s = "true" === PHP.item(bridgePHP.mobile_os_iphone);
                    this.#t = "true" === PHP.item(bridgePHP.os_linux);
                    this.#u = "true" === PHP.item(bridgePHP.os_ios);
                    this.#v = "true" === PHP.item(bridgePHP.os_windows);
                    this.#w = PHP.item(bridgePHP.user);
                    this.#x = "true" === PHP.item(bridgePHP.debugger);
                    __eventSafeDataPHP2JS();
                }
                
                groups()
                {
                    return {
                        vars: this.#a,
                        url: {
                            baseUrl: this.#b,
                            fullUrl: this.#c,
                            parameters: this.#d,
                            uri: this.#e,
                            scheme: this.#f
                        },
                        token: {
                            value: this.#g,
                            meta: this.#h,
                            input: this.#i
                        },
                        php: {
                            version: this.#j,
                            id: this.#k,
                            release: this.#l
                        },
                        agent: {
                            value: this.#m,
                            remote_ip: this.#n,
                            remote_port: this.#o,
                            browser: this.#p,
                            is_mobile: this.#q,
                            mobile_os: {
                                android: this.#r,
                                iphone: this.#s
                            },
                            os: {
                                linux: this.#t,
                                ios: this.#u,
                                windows: this.#v
                            }
                        },
                        user: this.#w,
                        debug: this.#x
                    }
                }
                
                all()
                {
                    return {
                        vars: this.#a,
                        baseUrl: this.#b,
                        fullUrl: this.#c,
                        parameters: this.#d,
                        uri: this.#e,
                        scheme: this.#f,
                        token: this.#g,
                        tokenMeta: this.#h,
                        tokenInput: this.#i,
                        php_version: this.#j,
                        php_id: this.#k,
                        php_release: this.#l,
                        agent: this.#m,
                        remote_ip: this.#n,
                        remote_port: this.#o,
                        browser: this.#p,
                        is_mobile: this.#q,
                        mobile_os_android: this.#r,
                        mobile_os_iphone: this.#s,
                        os_linux: this.#t,
                        os_ios: this.#u,
                        os_windows: this.#v,
                        user: this.#w,
                        debug: this.#x 
                    } 
                }
                
                vars()
                {
                    return this.#a
                }
                
                baseUrl()
                {
                    return this.#b
                }
                
                fullUrl()
                {
                    return this.#c
                }
                
                parameters()
                {
                    return this.#d
                }
                
                uri()
                {
                    return this.#e
                }
                
                scheme()
                {
                    return this.#f
                }
                
                token()
                {
                    return this.#g
                }
                
                tokenMeta()
                {
                    return this.#h
                }
                
                tokenInput(){
                    return this.#i
                }
                
                php_version()
                {
                    return this.#j
                }
                
                php_id()
                {
                    return this.#k
                }
                
                php_release()
                {
                    return this.#l
                }
                
                agent(){
                    return this.#m
                }
                
                remote_ip(){
                    return this.#n
                }
                
                remote_port()
                {
                    return this.#o
                }
                
                browser()
                {
                    return this.#p
                }
                
                is_mobile()
                {
                    return this.#q
                }
                
                mobile_os_android()
                {
                    return this.#r
                }
                
                mobile_os_iphone()
                {
                    return this.#s
                }
                
                os_linux()
                {
                    return this.#t
                }
        
                os_ios()
                {
                    return this.#u
                }
                
                os_windows()
                {
                    return this.#v
                }
                
                user(){
                    return this.#w
                }
                
                debug()
                {
                    return this.#x
                }
                
                static item(e)
                { 
                    return __getDataItemPHP2JS(e);
                }
            }
        
        </script>
        <script id="__PHP2JS_FUNCTION_S">
            
            function __getDataItemPHP2JS(e)
            {
                let t = sessionStorage.getItem(e);
                return [
                    bridgePHP.get_defined_vars,
                    bridgePHP.parameters,
                    bridgePHP.user, bridgePHP.browser
                ].includes(e) ? JSON.parse(t) : t 
            }
            
            function __eventSafeDataPHP2JS()
            {
                "true" !== PHP.item(bridgePHP.debugger) && setTimeout(() => { console.clear() }, 50)
            }
            
            function __PHP()
            {
                return new PHP
            }
        
        </script>
        <script id="__PHP2JS_CONST">
            
            const $PHP = __PHP().all();
            const $PHP_GROUPS = __PHP().groups();
            const $PHP_VARS = __PHP().vars();
            const $PHP_BASE_URL = __PHP().baseUrl();
            const $PHP_FULL_URL = __PHP().fullUrl();
            const $PHP_PARAMETERS = __PHP().parameters();
            const $PHP_URI = __PHP().uri();
            const $PHP_SCHEME = __PHP().scheme();
            const $PHP_TOKEN = __PHP().token();
            const $PHP_TOKEN_META = __PHP().tokenMeta();
            const $PHP_TOKEN_INPUT = __PHP().tokenInput();
            const $PHP_VERSION = __PHP().php_version();
            const $PHP_ID = __PHP().php_id();
            const $PHP_RELEASE = __PHP().php_release();
            const $PHP_AGENT = __PHP().agent();
            const $PHP_AGENT_REMOTE_IP = __PHP().remote_ip();
            const $PHP_AGENT_REMOTE_PORT = __PHP().remote_port();
            const $PHP_AGENT_BROWSER = __PHP().browser();
            const $PHP_AGENT_IS_MOBILE = __PHP().is_mobile();
            const $PHP_AGENT_MOBILE_OS_ANDROID = __PHP().mobile_os_android();
            const $PHP_AGENT_MOBILE_OS_IPHONE = __PHP().mobile_os_iphone();
            const $PHP_AGENT_OS_LINUX = __PHP().os_linux();
            const $PHP_AGENT_OS_IOS = __PHP().os_ios();
            const $PHP_AGENT_OS_WINDOWS = __PHP().os_windows();
            const $PHP_USER = __PHP().user();
            const $PHP_DEBUG = __PHP().debug();
        
        </script>
        <script id="__PHP2JS_REMOVE">
        
            setTimeout(() => {
                document.getElementById("__PHP2JS_PRIVATE").remove();
                document.getElementById("__PHP2JS_CLASS").remove();
                document.getElementById("__PHP2JS_FUNCTION_S").remove();
                document.getElementById("__PHP2JS_CONST").remove();
                document.getElementById("__PHP2JS_REMOVE").remove();
            }, 500);
        
        </script>';
    }
}
