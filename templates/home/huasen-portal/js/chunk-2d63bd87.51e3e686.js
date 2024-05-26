(window.webpackJsonp = window.webpackJsonp || []).push([["chunk-2d63bd87"], {
    5361: function(t, i, e) {},
    a9a8: function(t, i, e) {
        "use strict";
        e.r(i);
        var s = {
            name: "Read",
            data: ()=>({
                article: {
                    title: "文章标题",
                    time: "1979-01-01",
                    tag: "简洁/用心/愉悦",
                    content: "文章内容...."
                }
            }),
            created() {
                this.initData(),
                this.hideSidebar()
            },
            destroyed() {
                this.showSidebar()
            },
            computed: {
                tags() {
                    return this.article.tag ? this.article.tag.split("/") : []
                },
                time() {
                    if (this.article.time) {
                        let t = this.article.time.split("-");
                        return `${t[0]}年${t[1]}月${t[2]}日`
                    }
                    return "1979年01月01日"
                }
            },
            methods: {
                initData() {
                    this.$route.params.id ? this.queryArticleById(this.$route.params.id) : this.$router.push("/article")
                },
                queryArticleById(t) {
                    this.API.getArtcileById({
                        _id: t
                    }).then(t=>{
                        let i = t.data[0];
                        i && (this.article = i)
                    }
                    ).catch(t=>{
                        this.goBack()
                    }
                    )
                },
                goBack() {
                    this.$router.go(-1)
                },
                hideSidebar() {
                    this.$store.commit("commitAll", {
                        showWrapSidebar: !1
                    })
                },
                showSidebar() {
                    this.$store.commit("commitAll", {
                        showWrapSidebar: !0
                    })
                }
            }
        }
          , a = (e("ed8e"),
        e("2877"))
          , r = Object(a.a)(s, (function() {
            var t = this
              , i = t.$createElement
              , e = t._self._c || i;
            return e("div", {
                staticClass: "read"
            }, [e("main", [e("header", [e("div", {
                staticClass: "title-group flex my-px-10"
            }, [e("div", {
                staticClass: "title text-3xl flex-1 text"
            }, [t._v(" " + t._s(t.article.title) + " ")]), e("div", {
                staticClass: "icon-group text-xl pointer",
                on: {
                    click: t.goBack
                }
            }, [t._v(" 返回 "), e("i", {
                staticClass: "iconfont icon-tuichu text-xl"
            })])]), e("div", {
                staticClass: "tag-group text"
            }, t._l(t.tags, (function(i) {
                return e("div", {
                    directives: [{
                        name: "randomColor",
                        rawName: "v-randomColor"
                    }],
                    key: i,
                    staticClass: "text-white inline-block text-xs px-px-8 py-px-2 first:mx-px-0 mx-px-4 rounded-full"
                }, [t._v(" " + t._s(i) + " ")])
            }
            )), 0), e("div", {
                staticClass: "info-group"
            }, [e("div", {
                staticClass: "text"
            }, [t._v(t._s("最后修改于" + t.time))])])]), e("div", {
                staticClass: "content"
            }, [e("HMarkdown", {
                attrs: {
                    value: t.article.content
                }
            }), t._m(0)], 1)])])
        }
        ), [function() {
            var t = this.$createElement
              , i = this._self._c || t;
            return i("footer")
        }
        ], !1, null, "d2207674", null);
        i.default = r.exports
    },
    ed8e: function(t, i, e) {
        "use strict";
        e("5361")
    }
}]);
