"use strict";
if (!MediaPlayerAPI) var MediaPlayerAPI = function(n, t, i, r) {
    var o, s, nt, g, c, e, f, u, b, yi, w, p, y, vi = "1.1.0",
        pt = function() {
            typeof n.mpAsyncInit == "function" && n.mpAsyncInit()
        },
        ai = function() {
            s = !0, nt = !1, g = !1, ni(), o = {}, f = [], w = new it, y = new li, p = new tt, e = {
                base: "http://localhost",
                baseSecure: "http://localhost",
                locale: "",
                path: "lego",
                api: ""
            }, u = {
                componentEl: {
                    cssClass: "mediaplayer-component",
                    attrs: {
                        baseUrl: "data-baseurl",
                        instanceName: "data-instancename",
                        recommendationServiceUrl: "data-recommendationurl"
                    }
                },
                allInstancesKey: ":all",
                excludeKey: ":exclude:"
            }, b = {
                instanceNameInvalid: "instanceNameInvalidError: You provided an instanceName of: [{0}].(excluding brackets) \nThat value is not a valid javascript variable name. \n",
                instanceNameDuplicate: "instanceNameDuplicateError: You provided an instanceName of: [{0}].(excluding brackets) \nThis value is identical to an earlier created instance. \n",
                instanceNotFound: "instanceNotFoundError: no instance named [{0}] (excluding brackets) was found.",
                instanceInsertedMultipleTimes: "instanceInsertedMultipleTimesError: each player instance is unique and cannot be inserted on the same page multiple times. \nplease request a new instance from the API with a new instanceName.",
                sendFailed: "Unable to send message [{0}] to the player. Instance: [{1}]"
            }, yi = {
                instanceAdded: "InstanceAdded: the instance: [{0}].(excluding brackets)  has been added\n",
                instanceRemoved: "InstanceRemoved: the instance: [{0}].(excluding brackets)  has been removed\n"
            }, hi(), ut()
        },
        li = function() {
            var i, r, u;
            typeof t.fullscreenElement != "object" && (t.fullscreenElement = []), u = {}, u.onFullScreen = function(n) {
                n ? wi() : oi()
            }, u.legacyOpenFullscreen = function(n) {
                r = n, e()
            }, u.legacyCloseFullscreen = function(n) {
                r = n, o()
            }, u.isIframePositionFixed = function(t) {
                if (r = t, i = i || f(), i)
                    if (n.getComputedStyle) {
                        var u = n.getComputedStyle(i);
                        u && u.position === "fixed" && h("receiveIsIframePositionFixed", !0)
                    } else i.style.position === "fixed" && h("receiveIsIframePositionFixed", !0);
                h("receiveIsIframePositionFixed", !1)
            };
            var e = function() {
                    i = f(), i && (t.fullscreenElement[r] = i, i.style.position = "fixed", i.style.left = "0px", i.style.top = "0px", i.style.zIndex = "10000")
                },
                o = function() {
                    typeof i == "undefined" && (i = f()), i && (i.style.position = "static", i.style.left = "", i.style.top = "", i.style.zIndex = "auto"), r ? delete t.fullscreenElement[r] : t.fullscreenElement = null
                },
                f = function() {
                    var n = r ? ".mediaplayer-component." + r + " > iframe" : ".mediaplayer-component > iframe";
                    return t.querySelector ? t.querySelectorAll(n)[0] : !1
                };
            return u
        },
        ci = function(n) {
            for (var t in n) n.hasOwnProperty(t) && vt(t, n[t]);
            c.warn("The createReceiver method has been deprecated and will be removed in the next major release")
        },
        vt = function(n, t) {
            o[n] || (o[n] = []), o[n].push(t)
        },
        h = function(n, r, u) {
            var f, a, s, e, h, o;
            if (u && (u = u), f = l(u), ct(f) > 0) {
                e = {
                    methodname: n
                }, h = yt(r), h && (e.args = h);
                for (o in f) f.hasOwnProperty(o) && (a = f[o], e.instanceName = o, s = t.querySelectorAll("[data-instancename=" + o + "]")[0].querySelector("iframe"), s && s.contentWindow ? s.contentWindow.postMessage(i.stringify(e), "*") : c.warn(v(b.sendFailed, e, a.iframeEl)))
            }
        },
        at = function(t) {
            if (t = t || n.event, t.data) try {
                var r = i.parse(t.data),
                    u = o[r.method];
                r.args = yt(r.args) || [], r.instanceName && r.args.push(r.instanceName), u && (Array.isArray(u) ? u.forEach(function(n) {
                    n.apply(o, r.args)
                }) : u.apply(o, r.args)), p[r.method] && p[r.method].apply(p, r.args), w[r.method] && w[r.method].apply(w, r.args), y[r.method] && y[r.method].apply(y, r.args)
            } catch (t) {}
        },
        hi = function() {
            n.addEventListener ? n.addEventListener("message", at, !1) : n.attachEvent("onmessage", at)
        },
        tt = function() {
            function h() {
                return i === r && typeof n.TrackMan != "undefined" && n.TrackMan.LoadedModules.MediaTracking ? n.TrackMan.LoadedModules.MediaTracking : i === r && typeof n.LEGOSiteStats != "undefined" && n.LEGOSiteStats.newMediaTracking ? n.LEGOSiteStats.newMediaTracking : r
            }
            if (this instanceof tt == !1) return new tt;
            var t = {},
                e = 0,
                f = 0,
                i, u = !1,
                c = function(n, t) {
                    return n + "-" + t
                },
                o = function() {
                    return e
                },
                s = function() {
                    return f
                };
            return t.setup = function(n, t, c, l, a, v) {
                if (u = !1, i === r && (i = h()), i) {
                    u = !0, e = v, f = 0, a === r && (a = "unknown");
                    var y = {
                        name: n,
                        subType: c,
                        franchise: l
                    };
                    i.setup(y, a, o, s, !1)
                }
            }, t.videoTimeUpdate = function(n) {
                f = n > 0 ? Math.ceil(n) : 0
            }, t.videoPlaying = function() {
                u && (Math.ceil(o()) === s() && t.videoTimeUpdate(0), i.play())
            }, t.videoSeeked = function(n) {
                u && (t.videoTimeUpdate(n), i.seeked())
            }, t.videoSeeking = function(n) {
                u && (t.videoTimeUpdate(n), i.seekStart())
            }, t.videoPaused = function() {
                u && i.pause()
            }, t.videoEnded = function() {
                u && i.done()
            }, t.videoMouseDown = function() {
                u && i.mouseDown()
            }, t.videoMouseUp = function() {
                u && i.mouseUp()
            }, t
        },
        it = function() {
            if (this instanceof it == !1) return new it;
            var n = {};
            return n.changeVideo = function(n, t, i) {
                ht(n, i || u.allInstancesKey, t)
            }, n.videoPlaying = function() {}, n.controllerReady = function(n) {
                ri(n), pt()
            }, n
        },
        si = function(n) {
            if (ft(n), t && t.querySelector) {
                var i = t.querySelector(".mediaplayer-component." + n);
                i && i.parentNode.removeChild(i)
            }
        },
        ti = function(n, i, r) {
            var s, e, h, o, l;
            return (r = r || {}, n = n, i = k(i), f[n]) ? (c.error(v(b.instanceNameDuplicate, n)), !1) : !n || !ui(n) ? (c.error(v(b.instanceNameInvalid, n)), !1) : (s = {
                componentEl: {
                    tagName: "div",
                    attrs: {
                        style: "width: 100%; height: 100%;"
                    }
                },
                iframeEl: {
                    attrs: {
                        style: "width: 100%; height: 100%;",
                        allowfullscreen: "allowfullscreen",
                        webkitallowfullscreen: "webkitallowfullscreen",
                        scrolling: "no",
                        frameborder: 0,
                        seamless: "seamless"
                    }
                },
                urlParams: {
                    autoplay: !0,
                    activateLargeScreen: !1,
                    forceNativeOnIPad: !1,
                    showControls: !0,
                    forceSubtitles: !1,
                    controlsAlwaysOn: !1
                },
                recommendationServiceUrl: null
            }, rt(r, s), e = t.createElement(r.componentEl.tagName), lt(e, r.componentEl.attrs), e.setAttribute(u.componentEl.attrs.baseUrl, ot()), e.setAttribute(u.componentEl.attrs.instanceName, n), e.setAttribute(u.componentEl.attrs.recommendationServiceUrl, r.recommendationServiceUrl), h = v("{0} {1} {2}", u.componentEl.cssClass, n, e.getAttribute("class") || ""), e.setAttribute("class", h), o = t.createElement("iframe"), lt(o, r.iframeEl.attrs), typeof r.urlParamOptions == "undefined" && (r.urlParamOptions = {}), l = bt(n, i, r.urlParams), o.setAttribute("src", l), e.appendChild(o), st(n, i, o, e, r.recommendationServiceUrl, !0), e)
        },
        ut = function() {
            for (var r, f, h, n, e, i, c = "?", s = t.querySelectorAll("." + u.componentEl.cssClass), o = 0, l = s.length; o < l; o++) i = s[o], f = i.getAttribute(u.componentEl.attrs.baseUrl), r = i.getAttribute(u.componentEl.attrs.instanceName), h = i.getAttribute(u.componentEl.attrs.recommendationServiceUrl), r || (r = "instance" + pi()), f && f.length > 0 && r.length > 0 && (e = kt(i), e && (n = e.getAttribute("src").replace(f, ""), n = n.substr(0, n.indexOf(c)).replace("/", "").replace(" ", ""), n && n.length > 0 && st(r, n, e, i, h, !1)))
        },
        ht = function(n, t, i) {
            var u, o, f, r, e;
            if (!n) {
                c.warn("videoId is required");
                return
            }
            t = t, u = l(t), n = k(n);
            for (f in u) u.hasOwnProperty(f) && (r = u[f], r.isReady = !1, o = u[f].iframeEl, o.contentWindow.location = bt(t, n, i), r.videoId = n, e = r.recommendationServiceUrl, e && (r.readyQueue = r.readyQueue || [], r.readyQueue.push(function() {
                d(e, t)
            })))
        },
        ei = function(n) {
            var t = l(n),
                i, r;
            for (i in t)
                if (t.hasOwnProperty(i) && (r = t[i], r.videoId)) return r.videoId;
            return null
        },
        fi = function(n) {
            s = n
        },
        st = function(n, i, r, u, e, o) {
            if (i = k(i), f[n] = {
                    iframeEl: r,
                    videoId: i,
                    readyQueue: [],
                    isReady: !1,
                    recommendationServiceUrl: e
                }, t.addEventListener) {
                var s = function() {
                        ft(n)
                    },
                    h = function() {
                        et(u, o, function() {
                            u.addEventListener("DOMNodeRemoved", s)
                        }), et(r, o, function() {
                            u.addEventListener("DOMNodeRemoved", s)
                        })
                    };
                f[n].readyQueue.push(h)
            }
            e && f[n].readyQueue.push(function() {
                d(e, n)
            }), nt === !1 && (f[n].readyQueue.push(function() {
                ii()
            }), nt = !0)
        },
        ui = function(n) {
            if (typeof n != "string") return !1;
            var t = "^(?!(?:do|if|in|for|let|new|try|var|case|else|enum|eval|false|null|this|true|void|with|break|catch|class|const|super|throw|while|yield|delete|export|import|public|return|static|switch|typeof|default|extends|finally|package|private|continue|debugger|function|arguments|interface|protected|implements|instanceof)$)[$A-Z_a-zªµºÀ-ÖØ-öø-ˁˆ-ˑˠ-ˤˬˮͰ-ʹͶͷͺ-ͽΆΈ-ΊΌΎ-ΡΣ-ϵϷ-ҁҊ-ԧԱ-Ֆՙա-ևא-תװ-ײؠ-يٮٯٱ-ۓەۥۦۮۯۺ-ۼۿܐܒ-ܯݍ-ޥޱߊ-ߪߴߵߺࠀ-ࠕࠚࠤࠨࡀ-ࡘࢠࢢ-ࢬऄ-हऽॐक़-ॡॱ-ॷॹ-ॿঅ-ঌএঐও-নপ-রলশ-হঽৎড়ঢ়য়-ৡৰৱਅ-ਊਏਐਓ-ਨਪ-ਰਲਲ਼ਵਸ਼ਸਹਖ਼-ੜਫ਼ੲ-ੴઅ-ઍએ-ઑઓ-નપ-રલળવ-હઽૐૠૡଅ-ଌଏଐଓ-ନପ-ରଲଳଵ-ହଽଡ଼ଢ଼ୟ-ୡୱஃஅ-ஊஎ-ஐஒ-கஙசஜஞடணதந-பம-ஹௐఅ-ఌఎ-ఐఒ-నప-ళవ-హఽౘౙౠౡಅ-ಌಎ-ಐಒ-ನಪ-ಳವ-ಹಽೞೠೡೱೲഅ-ഌഎ-ഐഒ-ഺഽൎൠൡൺ-ൿඅ-ඖක-නඳ-රලව-ෆก-ะาำเ-ๆກຂຄງຈຊຍດ-ທນ-ຟມ-ຣລວສຫອ-ະາຳຽເ-ໄໆໜ-ໟༀཀ-ཇཉ-ཬྈ-ྌက-ဪဿၐ-ၕၚ-ၝၡၥၦၮ-ၰၵ-ႁႎႠ-ჅჇჍა-ჺჼ-ቈቊ-ቍቐ-ቖቘቚ-ቝበ-ኈኊ-ኍነ-ኰኲ-ኵኸ-ኾዀዂ-ዅወ-ዖዘ-ጐጒ-ጕጘ-ፚᎀ-ᎏᎠ-Ᏼᐁ-ᙬᙯ-ᙿᚁ-ᚚᚠ-ᛪᛮ-ᛰᜀ-ᜌᜎ-ᜑᜠ-ᜱᝀ-ᝑᝠ-ᝬᝮ-ᝰក-ឳៗៜᠠ-ᡷᢀ-ᢨᢪᢰ-ᣵᤀ-ᤜᥐ-ᥭᥰ-ᥴᦀ-ᦫᧁ-ᧇᨀ-ᨖᨠ-ᩔᪧᬅ-ᬳᭅ-ᭋᮃ-ᮠᮮᮯᮺ-ᯥᰀ-ᰣᱍ-ᱏᱚ-ᱽᳩ-ᳬᳮ-ᳱᳵᳶᴀ-ᶿḀ-ἕἘ-Ἕἠ-ὅὈ-Ὅὐ-ὗὙὛὝὟ-ώᾀ-ᾴᾶ-ᾼιῂ-ῄῆ-ῌῐ-ΐῖ-Ίῠ-Ῥῲ-ῴῶ-ῼⁱⁿₐ-ₜℂℇℊ-ℓℕℙ-ℝℤΩℨK-ℭℯ-ℹℼ-ℿⅅ-ⅉⅎⅠ-ↈⰀ-Ⱞⰰ-ⱞⱠ-ⳤⳫ-ⳮⳲⳳⴀ-ⴥⴧⴭⴰ-ⵧⵯⶀ-ⶖⶠ-ⶦⶨ-ⶮⶰ-ⶶⶸ-ⶾⷀ-ⷆⷈ-ⷎⷐ-ⷖⷘ-ⷞⸯ々-〇〡-〩〱-〵〸-〼ぁ-ゖゝ-ゟァ-ヺー-ヿㄅ-ㄭㄱ-ㆎㆠ-ㆺㇰ-ㇿ㐀-䶵一-鿌ꀀ-ꒌꓐ-ꓽꔀ-ꘌꘐ-ꘟꘪꘫꙀ-ꙮꙿ-ꚗꚠ-ꛯꜗ-ꜟꜢ-ꞈꞋ-ꞎꞐ-ꞓꞠ-Ɦꟸ-ꠁꠃ-ꠅꠇ-ꠊꠌ-ꠢꡀ-ꡳꢂ-ꢳꣲ-ꣷꣻꤊ-ꤥꤰ-ꥆꥠ-ꥼꦄ-ꦲꧏꨀ-ꨨꩀ-ꩂꩄ-ꩋꩠ-ꩶꩺꪀ-ꪯꪱꪵꪶꪹ-ꪽꫀꫂꫛ-ꫝꫠ-ꫪꫲ-ꫴꬁ-ꬆꬉ-ꬎꬑ-ꬖꬠ-ꬦꬨ-ꬮꯀ-ꯢ가-힣ힰ-ퟆퟋ-ퟻ豈-舘並-龎ﬀ-ﬆﬓ-ﬗיִײַ-ﬨשׁ-זּטּ-לּמּנּסּףּפּצּ-ﮱﯓ-ﴽﵐ-ﶏﶒ-ﷇﷰ-ﷻﹰ-ﹴﹶ-ﻼＡ-Ｚａ-ｚｦ-ﾾￂ-ￇￊ-ￏￒ-ￗￚ-ￜ][$A-Z_a-zªµºÀ-ÖØ-öø-ˁˆ-ˑˠ-ˤˬˮͰ-ʹͶͷͺ-ͽΆΈ-ΊΌΎ-ΡΣ-ϵϷ-ҁҊ-ԧԱ-Ֆՙա-ևא-תװ-ײؠ-يٮٯٱ-ۓەۥۦۮۯۺ-ۼۿܐܒ-ܯݍ-ޥޱߊ-ߪߴߵߺࠀ-ࠕࠚࠤࠨࡀ-ࡘࢠࢢ-ࢬऄ-हऽॐक़-ॡॱ-ॷॹ-ॿঅ-ঌএঐও-নপ-রলশ-হঽৎড়ঢ়য়-ৡৰৱਅ-ਊਏਐਓ-ਨਪ-ਰਲਲ਼ਵਸ਼ਸਹਖ਼-ੜਫ਼ੲ-ੴઅ-ઍએ-ઑઓ-નપ-રલળવ-હઽૐૠૡଅ-ଌଏଐଓ-ନପ-ରଲଳଵ-ହଽଡ଼ଢ଼ୟ-ୡୱஃஅ-ஊஎ-ஐஒ-கஙசஜஞடணதந-பம-ஹௐఅ-ఌఎ-ఐఒ-నప-ళవ-హఽౘౙౠౡಅ-ಌಎ-ಐಒ-ನಪ-ಳವ-ಹಽೞೠೡೱೲഅ-ഌഎ-ഐഒ-ഺഽൎൠൡൺ-ൿඅ-ඖක-නඳ-රලව-ෆก-ะาำเ-ๆກຂຄງຈຊຍດ-ທນ-ຟມ-ຣລວສຫອ-ະາຳຽເ-ໄໆໜ-ໟༀཀ-ཇཉ-ཬྈ-ྌက-ဪဿၐ-ၕၚ-ၝၡၥၦၮ-ၰၵ-ႁႎႠ-ჅჇჍა-ჺჼ-ቈቊ-ቍቐ-ቖቘቚ-ቝበ-ኈኊ-ኍነ-ኰኲ-ኵኸ-ኾዀዂ-ዅወ-ዖዘ-ጐጒ-ጕጘ-ፚᎀ-ᎏᎠ-Ᏼᐁ-ᙬᙯ-ᙿᚁ-ᚚᚠ-ᛪᛮ-ᛰᜀ-ᜌᜎ-ᜑᜠ-ᜱᝀ-ᝑᝠ-ᝬᝮ-ᝰក-ឳៗៜᠠ-ᡷᢀ-ᢨᢪᢰ-ᣵᤀ-ᤜᥐ-ᥭᥰ-ᥴᦀ-ᦫᧁ-ᧇᨀ-ᨖᨠ-ᩔᪧᬅ-ᬳᭅ-ᭋᮃ-ᮠᮮᮯᮺ-ᯥᰀ-ᰣᱍ-ᱏᱚ-ᱽᳩ-ᳬᳮ-ᳱᳵᳶᴀ-ᶿḀ-ἕἘ-Ἕἠ-ὅὈ-Ὅὐ-ὗὙὛὝὟ-ώᾀ-ᾴᾶ-ᾼιῂ-ῄῆ-ῌῐ-ΐῖ-Ίῠ-Ῥῲ-ῴῶ-ῼⁱⁿₐ-ₜℂℇℊ-ℓℕℙ-ℝℤΩℨK-ℭℯ-ℹℼ-ℿⅅ-ⅉⅎⅠ-ↈⰀ-Ⱞⰰ-ⱞⱠ-ⳤⳫ-ⳮⳲⳳⴀ-ⴥⴧⴭⴰ-ⵧⵯⶀ-ⶖⶠ-ⶦⶨ-ⶮⶰ-ⶶⶸ-ⶾⷀ-ⷆⷈ-ⷎⷐ-ⷖⷘ-ⷞⸯ々-〇〡-〩〱-〵〸-〼ぁ-ゖゝ-ゟァ-ヺー-ヿㄅ-ㄭㄱ-ㆎㆠ-ㆺㇰ-ㇿ㐀-䶵一-鿌ꀀ-ꒌꓐ-ꓽꔀ-ꘌꘐ-ꘟꘪꘫꙀ-ꙮꙿ-ꚗꚠ-ꛯꜗ-ꜟꜢ-ꞈꞋ-ꞎꞐ-ꞓꞠ-Ɦꟸ-ꠁꠃ-ꠅꠇ-ꠊꠌ-ꠢꡀ-ꡳꢂ-ꢳꣲ-ꣷꣻꤊ-ꤥꤰ-ꥆꥠ-ꥼꦄ-ꦲꧏꨀ-ꨨꩀ-ꩂꩄ-ꩋꩠ-ꩶꩺꪀ-ꪯꪱꪵꪶꪹ-ꪽꫀꫂꫛ-ꫝꫠ-ꫪꫲ-ꫴꬁ-ꬆꬉ-ꬎꬑ-ꬖꬠ-ꬦꬨ-ꬮꯀ-ꯢ가-힣ힰ-ퟆퟋ-ퟻ豈-舘並-龎ﬀ-ﬆﬓ-ﬗיִײַ-ﬨשׁ-זּטּ-לּמּנּסּףּפּצּ-ﮱﯓ-ﴽﵐ-ﶏﶒ-ﷇﷰ-ﷻﹰ-ﹴﹶ-ﻼＡ-Ｚａ-ｚｦ-ﾾￂ-ￇￊ-ￏￒ-ￗￚ-ￜ0-9̀-ͯ҃-֑҇-ׇֽֿׁׂׅׄؐ-ًؚ-٩ٰۖ-ۜ۟-۪ۤۧۨ-ۭ۰-۹ܑܰ-݊ަ-ް߀-߉߫-߳ࠖ-࠙ࠛ-ࠣࠥ-ࠧࠩ-࡙࠭-࡛ࣤ-ࣾऀ-ःऺ-़ा-ॏ॑-ॗॢॣ०-९ঁ-ঃ়া-ৄেৈো-্ৗৢৣ০-৯ਁ-ਃ਼ਾ-ੂੇੈੋ-੍ੑ੦-ੱੵઁ-ઃ઼ા-ૅે-ૉો-્ૢૣ૦-૯ଁ-ଃ଼ା-ୄେୈୋ-୍ୖୗୢୣ୦-୯ஂா-ூெ-ைொ-்ௗ௦-௯ఁ-ఃా-ౄె-ైొ-్ౕౖౢౣ౦-౯ಂಃ಼ಾ-ೄೆ-ೈೊ-್ೕೖೢೣ೦-೯ംഃാ-ൄെ-ൈൊ-്ൗൢൣ൦-൯ංඃ්ා-ුූෘ-ෟෲෳัิ-ฺ็-๎๐-๙ັິ-ູົຼ່-ໍ໐-໙༘༙༠-༩༹༵༷༾༿ཱ-྄྆྇ྍ-ྗྙ-ྼ࿆ါ-ှ၀-၉ၖ-ၙၞ-ၠၢ-ၤၧ-ၭၱ-ၴႂ-ႍႏ-ႝ፝-፟ᜒ-᜔ᜲ-᜴ᝒᝓᝲᝳ឴-៓៝០-៩᠋-᠍᠐-᠙ᢩᤠ-ᤫᤰ-᤻᥆-᥏ᦰ-ᧀᧈᧉ᧐-᧙ᨗ-ᨛᩕ-ᩞ᩠-᩿᩼-᪉᪐-᪙ᬀ-ᬄ᬴-᭄᭐-᭙᭫-᭳ᮀ-ᮂᮡ-ᮭ᮰-᮹᯦-᯳ᰤ-᰷᱀-᱉᱐-᱙᳐-᳔᳒-᳨᳭ᳲ-᳴᷀-ᷦ᷼-᷿‌‍‿⁀⁔⃐-⃥⃜⃡-⃰⳯-⵿⳱ⷠ-〪ⷿ-゙゚〯꘠-꘩꙯ꙴ-꙽ꚟ꛰꛱ꠂ꠆ꠋꠣ-ꠧꢀꢁꢴ-꣄꣐-꣙꣠-꣱꤀-꤉ꤦ-꤭ꥇ-꥓ꦀ-ꦃ꦳-꧀꧐-꧙ꨩ-ꨶꩃꩌꩍ꩐-꩙ꩻꪰꪲ-ꪴꪷꪸꪾ꪿꫁ꫫ-ꫯꫵ꫶ꯣ-ꯪ꯬꯭꯰-꯹ﬞ︀-️︠-︦︳︴﹍-﹏０-９＿]*$",
                i = new RegExp(t);
            return i.test(n)
        },
        ri = function(n) {
            var u = l(n),
                f, t, i, r, e;
            for (f in u)
                if (u.hasOwnProperty(f)) {
                    if (t = u[f], i = t.readyQueue, i) {
                        for (r = 0, e = i.length; r < e; r++) i[r]();
                        delete t.readyQueue
                    }
                    t.isReady = !0
                }
        },
        l = function(n) {
            var t, i, e, r;
            return (t = ct(f), i = [], t === 0 && g === !1 && (ut(), g = !0), n && f[n]) ? (i[n] = f[n], i) : n === u.allInstancesKey || !n ? f : n.indexOf(u.excludeKey) !== -1 ? t.length <= 1 ? !1 : (e = n.replace(u.excludeKey, ""), r = rt({}, f), delete r[e], r) : !1
        },
        d = function(n, t) {
            var i = l(t),
                r;
            for (r in i) i.hasOwnProperty(r) && (i[r] = n);
            h("setRecommendationServiceUrl", [n], t)
        },
        et = function(n, t, i) {
            t === !1 ? i() : n.addEventListener("DOMNodeInserted", function() {
                setTimeout(function() {
                    i()
                }, 0)
            })
        },
        ft = function(n) {
            f[n] && delete f[n]
        },
        ii = function() {
            var i = function() {
                h("blur", [], u.allInstancesKey)
            };
            n.addEventListener ? t.addEventListener("click", i) : n.attachEvent && t.attachEvent("onclick", i)
        },
        pi = function() {
            return Math.floor((1 + Math.random()) * 16777216).toString(16).substring(1)
        },
        bt = function(n, t, i) {
            var f = "instancename=" + n,
                r, u;
            for (u in i) i.hasOwnProperty(u) && (r = i[u], (typeof r == "string" || typeof r == "number" || typeof r == "boolean") && (f = f + "&" + u.toLowerCase() + "=" + r));
            return ot() + "/" + t + "?" + f
        },
        gt = function(n) {
            e.locale = n
        },
        dt = function() {
            return e.locale
        },
        ot = function() {
            var t = e.base;
            return n.location.protocol === "https:" && (t = e.baseSecure), e.locale !== "" && (t += "/" + e.locale), e.path !== "" && (t += "/" + e.path), t + "/" + e.api
        },
        kt = function(n) {
            for (var t, u, r = n.childNodes, i = 0, f = r.length; i < f; i++)
                if (t = r[i], t.tagName && t.tagName.toLowerCase() === "iframe" && (u = t.getAttribute("src"), u && u.indexOf(e.api) !== -1)) return t;
            return !1
        },
        rt = function(n, t) {
            var i, u, f;
            for (i in t) t.hasOwnProperty(i) && (u = n[i], f = t[i], u === r ? n[i] = f : (typeof u == "object" || typeof f == "object") && rt(n[i], t[i]));
            return n
        },
        ni = function() {
            var t = n.console;
            c = {
                log: function(n) {
                    t && s && t.log(n)
                },
                dir: function(n) {
                    t && s && t.dir(n)
                },
                warn: function(n) {
                    t && s && t.warn(n)
                },
                error: function(n) {
                    t && s && t.error(n)
                }
            }
        },
        lt = function(n, t) {
            for (var i in t) t.hasOwnProperty(i) && n.setAttribute(i, t[i]);
            return n
        },
        v = function(n) {
            for (var i = n, r, t = 1; t < arguments.length; t++) r = new RegExp("\\{" + (t - 1) + "\\}", "gm"), i = i.replace(r, arguments[t]);
            return i
        },
        ct = function(n) {
            var t = 0,
                i;
            for (i in n) n.hasOwnProperty(i) && t++;
            return t
        },
        yt = function(n) {
            return n === r || n === null ? !1 : Object.prototype.toString.call(n) !== "[object Array]" ? [n] : n
        },
        k = function(n) {
            return n.replace(/-/g, "")
        },
        wt = function(n) {
            var t = navigator.userAgent;
            return t.match(new RegExp(n, "i")) !== null
        },
        a, oi = function() {
            wt("ipad") && (typeof a != "undefined" && clearTimeout(a), a = setTimeout(function() {
                var n = t.getElementById("GFSticky");
                n !== r && (n.style.display = "block")
            }, 2e3))
        },
        wi = function() {
            if (wt("ipad")) {
                typeof a != "undefined" && clearTimeout(a);
                var n = t.getElementById("GFSticky");
                n !== r && (n.style.display = "none")
            }
        };
    return ai(), {
        ready: pt,
        createReceiver: ci,
        setListener: vt,
        send: h,
        createNewMediaPlayer: ti,
        removeMediaPlayer: si,
        addMediaPlayersFromPage: ut,
        changeVideo: ht,
        getVideoId: ei,
        setLocale: gt,
        getLocale: dt,
        setRecommendationServiceUrl: d,
        enableDebug: fi,
        version: vi
    }
}(window, document, JSON)