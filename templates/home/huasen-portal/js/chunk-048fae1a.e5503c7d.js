(window.webpackJsonp = window.webpackJsonp || []).push([["chunk-048fae1a", "chunk-67cc8328", "chunk-d7daa0f4", "chunk-10941450", "chunk-b8c40a10"], {
    "0159": function(e, t, s) {
        "use strict";
        s.r(t);
        var i = s("2f62")
          , a = s("dc92")
          , o = {
            name: "DialogForm",
            components: {
                HsDialog: s("af63").a
            },
            props: {
                formData: {
                    type: Object,
                    default: ()=>({
                        name: "杭州",
                        area: "1"
                    })
                },
                formMap: {
                    type: Array,
                    default: ()=>[{
                        label: "输入框示例",
                        key: "name",
                        type: "input"
                    }, {
                        label: "下拉选择",
                        key: "area",
                        type: "select",
                        selectOptions: [{
                            label: "滨江区",
                            value: 1
                        }, {
                            label: "萧山区",
                            value: 2
                        }]
                    }]
                },
                formRule: {
                    type: Object,
                    default: ()=>({
                        name: [{
                            required: !0,
                            message: "必填项",
                            trigger: "blur"
                        }]
                    })
                }
            },
            methods: {
                comfirmDialog() {
                    this.$refs.form.validate(e=>{
                        e && this.$emit("comfirmForm")
                    }
                    )
                },
                closeDialog() {
                    this.$refs.form.resetFields(),
                    this.$emit("cancelForm")
                },
                resetFormFields() {
                    this.$refs.form.resetFields()
                }
            }
        }
          , n = (s("47cf"),
        s("2877"))
          , r = Object(n.a)(o, (function() {
            var e = this
              , t = e.$createElement
              , s = e._self._c || t;
            return s("HsDialog", e._g(e._b({
                staticClass: "dialog-form",
                on: {
                    comfirmDialog: e.comfirmDialog,
                    closeDialog: e.closeDialog,
                    close: e.closeDialog
                }
            }, "HsDialog", e.$attrs, !1), e.$listeners), [s("el-form", {
                ref: "form",
                staticClass: "form-group",
                attrs: {
                    model: e.formData,
                    rules: e.formRule,
                    "label-position": "top"
                }
            }, e._l(e.formMap, (function(t, i) {
                return s("el-form-item", {
                    key: i,
                    attrs: {
                        label: t.label,
                        prop: t.key
                    }
                }, ["input" === t.type ? s("el-input", {
                    model: {
                        value: e.formData[t.key],
                        callback: function(s) {
                            e.$set(e.formData, t.key, s)
                        },
                        expression: "formData[item.key]"
                    }
                }) : e._e(), "select" === t.type ? s("el-select", {
                    attrs: {
                        "popper-append-to-body": !1
                    },
                    model: {
                        value: e.formData[t.key],
                        callback: function(s) {
                            e.$set(e.formData, t.key, s)
                        },
                        expression: "formData[item.key]"
                    }
                }, e._l(t.selectOptions, (function(e, t) {
                    return s("el-option", {
                        key: t,
                        attrs: {
                            label: e.label,
                            value: e.value
                        }
                    })
                }
                )), 1) : e._e(), "textarea" === t.type ? s("el-input", {
                    attrs: {
                        type: "textarea"
                    },
                    model: {
                        value: e.formData[t.key],
                        callback: function(s) {
                            e.$set(e.formData, t.key, s)
                        },
                        expression: "formData[item.key]"
                    }
                }) : e._e()], 1)
            }
            )), 1)], 1)
        }
        ), [], !1, null, "7550ec75", null).exports
          , l = {
            name: "CustomWallpaperDrawer",
            components: {
                HsDrawer: s("f8b1").a
            },
            data: ()=>({
                show: !1,
                activeName: "1",
                bg: "",
                sliderFilter: 0,
                sliderLightness: 0,
                pures: [{
                    color: "#FFFFFF",
                    background: "#9CA3AF"
                }, {
                    color: "#FFFFFF",
                    background: "#F87171"
                }, {
                    color: "#FFFFFF",
                    background: "#FBBF24"
                }, {
                    color: "#FFFFFF",
                    background: "#34D399"
                }, {
                    color: "#FFFFFF",
                    background: "#60A5FA"
                }, {
                    color: "#FFFFFF",
                    background: "#A78BFA"
                }],
                wallpaperImages: [{
                    headerFontColor: "#FFFFFF",
                    background: s("a13d")
                }, {
                    headerFontColor: "#FFFFFF",
                    background: s("6e73")
                }, {
                    headerFontColor: "#FFFFFF",
                    background: s("aee4")
                }, {
                    headerFontColor: "#000000",
                    background: s("63cd")
                }, {
                    headerFontColor: "#FFFFFF",
                    background: s("0a8c")
                }, {
                    headerFontColor: "#000000",
                    background: s("bd9f")
                }]
            }),
            computed: {
                ...Object(i.d)(["user", "themeConfig"]),
                displayPure() {
                    let e = this.themeConfig.pure ? this.themeConfig.pure : [];
                    return [...this.pures.concat(e)]
                },
                displayWallpaperImages() {
                    let e = this.themeConfig.wallpaper ? this.themeConfig.wallpaper : [];
                    return [...this.wallpaperImages.concat(e)]
                }
            },
            mounted() {
                this.bg = this.user.config.bg,
                this.sliderFilter = this.user.config.bgFilter,
                this.sliderLightness = this.user.config.bgLightness
            },
            methods: {
                ...Object(i.c)(["commitAll"]),
                changeFilter(e) {
                    this.initCustomStyle({
                        user: {
                            config: {
                                bgFilter: e
                            }
                        }
                    })
                },
                changeShadow(e) {
                    this.initCustomStyle({
                        user: {
                            config: {
                                bgLightness: e
                            }
                        }
                    })
                },
                beforeUpload(e) {
                    return e.size <= 2097152 ? this.TOOL.getBase64(e, e=>{
                        this.initCustomStyle({
                            user: {
                                config: {
                                    bg: e
                                }
                            }
                        })
                    }
                    ) : this.$tips("error", "图片大小已超过 2MB", null, 2e3),
                    !1
                },
                changeBg(e, t) {
                    this.initCustomStyle({
                        user: {
                            config: {
                                bg: "pick" == t ? e : e.background
                            }
                        }
                    })
                },
                initCustomStyle(e) {
                    this.commitAll(e),
                    this.$store.dispatch("snapshoot"),
                    this.$store.dispatch("initLocalUserInfo")
                }
            }
        }
          , c = (s("872e"),
        {
            name: "HomeRecord",
            components: {
                DialogForm: r,
                CustomWallpaperDrawer: Object(n.a)(l, (function() {
                    var e = this
                      , t = e.$createElement
                      , s = e._self._c || t;
                    return s("HsDrawer", e._g(e._b({}, "HsDrawer", e.$attrs, !1), e.$listeners), [s("div", {
                        staticClass: "custom-wallpaper-drawer"
                    }, [s("el-collapse", {
                        staticClass: "collapse",
                        attrs: {
                            accordion: ""
                        },
                        model: {
                            value: e.activeName,
                            callback: function(t) {
                                e.activeName = t
                            },
                            expression: "activeName"
                        }
                    }, [s("el-collapse-item", {
                        attrs: {
                            name: "1"
                        }
                    }, [s("template", {
                        slot: "title"
                    }, [s("div", {
                        staticClass: "title"
                    }, [e._v("基础设置")])]), s("div", {
                        staticClass: "collapse-content"
                    }, [s("section", {
                        staticClass: "other"
                    }, [s("div", [e._v("纯色背景")]), s("ul", [e._l(e.displayPure, (function(t, i) {
                        return s("li", {
                            key: i,
                            style: {
                                backgroundColor: t.background
                            },
                            on: {
                                click: function(s) {
                                    return e.changeBg(t)
                                }
                            }
                        })
                    }
                    )), s("li", [s("el-color-picker", {
                        attrs: {
                            size: "mini"
                        },
                        on: {
                            change: function(t) {
                                return e.changeBg(t, "pick")
                            }
                        },
                        model: {
                            value: e.bg,
                            callback: function(t) {
                                e.bg = t
                            },
                            expression: "bg"
                        }
                    })], 1)], 2)]), s("section", {
                        staticClass: "other"
                    }, [s("div", [e._v("背景模糊度")]), s("el-slider", {
                        staticClass: "w-px-380 pl-px-8",
                        attrs: {
                            "show-tooltip": !1,
                            min: 0,
                            max: 10,
                            step: .5
                        },
                        on: {
                            change: e.changeFilter
                        },
                        model: {
                            value: e.sliderFilter,
                            callback: function(t) {
                                e.sliderFilter = t
                            },
                            expression: "sliderFilter"
                        }
                    })], 1), s("section", {
                        staticClass: "other"
                    }, [s("div", [e._v("遮罩浓度")]), s("el-slider", {
                        staticClass: "w-px-380 pl-px-8",
                        attrs: {
                            "show-tooltip": !1,
                            min: 0,
                            max: 1,
                            step: .1
                        },
                        on: {
                            change: e.changeShadow
                        },
                        model: {
                            value: e.sliderLightness,
                            callback: function(t) {
                                e.sliderLightness = t
                            },
                            expression: "sliderLightness"
                        }
                    })], 1)])], 2), s("el-collapse-item", {
                        attrs: {
                            name: "2"
                        }
                    }, [s("template", {
                        slot: "title"
                    }, [s("div", {
                        staticClass: "title"
                    }, [e._v("图片背景")])]), s("div", {
                        staticClass: "collapse-content"
                    }, [s("ul", {
                        staticClass: "image"
                    }, e._l(e.displayWallpaperImages, (function(t, i) {
                        return s("li", {
                            key: i,
                            style: {
                                backgroundImage: "url(" + t.background + ")"
                            },
                            on: {
                                click: function(s) {
                                    return e.changeBg(t)
                                }
                            }
                        }, [s("div", {
                            staticClass: "setting"
                        }, [e._v(" 立即设置 ")])])
                    }
                    )), 0)])], 2), s("el-collapse-item", {
                        attrs: {
                            name: "3"
                        }
                    }, [s("template", {
                        slot: "title"
                    }, [s("div", {
                        staticClass: "title"
                    }, [e._v("自定义上传")])]), s("div", {
                        staticClass: "collapse-content flex justify-center items-center"
                    }, [s("el-upload", {
                        staticClass: "upload py-px-10",
                        attrs: {
                            accept: ".png,.jpg,.git",
                            "before-upload": e.beforeUpload,
                            action: "",
                            drag: ""
                        }
                    }, [s("i", {
                        staticClass: "el-icon-upload"
                    }), s("div", {
                        staticClass: "el-upload__text"
                    }, [e._v("拖拽上传 · "), s("em", [e._v("点击上传")])])])], 1)], 2)], 1)], 1)])
                }
                ), [], !1, null, "047973aa", null).exports
            },
            data: ()=>({
                isEditMode: !1,
                isDeleteMode: !1,
                showForm: !1,
                showCustom: !1,
                title: "",
                formData: {
                    name: "",
                    url: "",
                    remark: ""
                },
                formMap: [{
                    key: "name",
                    label: "站点名称",
                    type: "input"
                }, {
                    key: "url",
                    label: "站点链接",
                    type: "input"
                }, {
                    key: "remark",
                    label: "备注",
                    type: "textarea"
                }],
                formRule: {
                    name: [{
                        validator: Object(a.a)(["isNoEmpty::必填项", "isChinese::请输入汉字/英文/数字"]),
                        trigger: "blur"
                    }],
                    url: [{
                        validator: Object(a.a)(["isNoEmpty::必填项", "isUrl::请输入正确的网址"]),
                        trigger: "blur"
                    }]
                }
            }),
            computed: {
                ...Object(i.d)(["user", "config"])
            },
            methods: {
                ...Object(i.c)(["commitAll"]),
                openAddMode() {
                    this.title = "添加网站",
                    this.isEditMode = !1,
                    this.isDeleteMode = !1,
                    this.showForm = !0
                },
                openEditMode() {
                    this.isEditMode = !this.isEditMode
                },
                openDeleteMode() {
                    this.isDeleteMode = !this.isDeleteMode
                },
                handleEdit(e, t) {
                    this.title = "编辑网站",
                    this.showForm = !0,
                    this.$nextTick(()=>{
                        this.formData = Object.assign(this.formData, e)
                    }
                    )
                },
                openSimpleMode() {
                    this.handleCommit({
                        user: {
                            config: {
                                simpleMode: !this.user.config.simpleMode
                            }
                        }
                    })
                },
                handleDelete(e) {
                    let t = [...this.user.records];
                    t.map((s,i)=>{
                        s.id == e.id && t.splice(i, 1)
                    }
                    ),
                    this.handleCommit({
                        user: {
                            records: t
                        }
                    })
                },
                save() {
                    let e = [...this.user.records]
                      , t = Object.assign({
                        id: "",
                        name: "",
                        url: "",
                        remark: ""
                    }, {
                        ...this.formData
                    });
                    if (this.isEditMode)
                        for (let s = 0; s < e.length; s++)
                            e[s].id == t.id && (e[s] = t);
                    else
                        t.id = this.TOOL.getUid(16, 8),
                        e.push(t);
                    this.handleCommit({
                        user: {
                            records: e
                        }
                    }),
                    this.cancel()
                },
                cancel() {
                    this.$refs.dialogForm && this.$refs.dialogForm.resetFormFields(),
                    this.showForm = !1
                },
                handleCommit(e) {
                    0 !== Object.keys(e).length && (this.commitAll(e),
                    this.$store.dispatch("snapshoot"))
                },
                handleCopy() {
                    let {records: e, config: t} = this.$store.state.user
                      , s = {
                        records: e,
                        config: t
                    };
                    this.TOOL.copyTextToClip(JSON.stringify(s), "已复制到剪贴板，请立即粘贴保存！")
                },
                async handleRecovery() {
                    try {
                        let e;
                        e = navigator.clipboard && window.isSecureContext ? await navigator.clipboard.readText() : prompt("请粘贴之前拷贝保存的数据进行恢复");
                        let t = JSON.parse(e)
                          , {records: s, config: i} = t;
                        if (!Array.isArray(s))
                            throw new Error;
                        if ("[object Object]" !== Object.prototype.toString.call(i))
                            throw new Error;
                        this.handleCommit({
                            user: {
                                records: s,
                                config: i
                            }
                        }),
                        this.$tips("success", "数据恢复成功", "top-right", 2e3, ()=>{
                            window.location.reload()
                        }
                        )
                    } catch (e) {
                        this.$tips("error", "恢复数据失败", "top-right", 2e3)
                    }
                },
                openCustomWallpaper() {
                    this.showCustom = !0
                }
            }
        })
          , d = (s("3e09"),
        Object(n.a)(c, (function() {
            var e = this
              , t = e.$createElement
              , s = e._self._c || t;
            return s("div", {
                directives: [{
                    name: "rightMenu",
                    rawName: "v-rightMenu"
                }],
                staticClass: "home-record"
            }, [s("header", [e._m(0), s("ul", [s("li", {
                on: {
                    click: e.openAddMode
                }
            }, [s("i", {
                staticClass: "iconfont icon-tianjia"
            }), s("span", {
                staticClass: "sm:hidden"
            }, [e._v("添加")])]), s("li", {
                class: {
                    active: e.isEditMode
                },
                on: {
                    click: e.openEditMode
                }
            }, [s("i", {
                staticClass: "iconfont icon-md-settings"
            }), s("span", {
                staticClass: "sm:hidden"
            }, [e._v("编辑")])]), s("li", {
                class: {
                    active: e.isDeleteMode
                },
                on: {
                    click: e.openDeleteMode
                }
            }, [s("i", {
                staticClass: "iconfont icon-md-trash"
            }), s("span", {
                staticClass: "sm:hidden"
            }, [e._v("管理")])]), s("li", {
                on: {
                    click: e.handleCopy
                }
            }, [s("i", {
                staticClass: "iconfont icon-md-cut"
            }), s("span", {
                staticClass: "sm:hidden"
            }, [e._v("拷贝")])]), s("li", {
                on: {
                    click: e.handleRecovery
                }
            }, [s("i", {
                staticClass: "iconfont icon-md-sync"
            }), s("span", {
                staticClass: "sm:hidden"
            }, [e._v("恢复")])]), s("li", {
                on: {
                    click: e.openCustomWallpaper
                }
            }, [s("i", {
                staticClass: "iconfont icon-md-happy"
            }), s("span", {
                staticClass: "sm:hidden"
            }, [e._v("墙纸")])]), s("li", {
                on: {
                    click: e.openSimpleMode
                }
            }, [s("i", {
                staticClass: "iconfont icon-md-qr-scanner"
            }), s("span", {
                staticClass: "sm:hidden"
            }, [e._v("全屏")])])])]), s("main", {
                directives: [{
                    name: "rightMenu",
                    rawName: "v-rightMenu"
                }]
            }, [s("ul", {
                directives: [{
                    name: "balance",
                    rawName: "v-balance"
                }]
            }, e._l(e.user.records, (function(t, i) {
                return s("li", {
                    key: t + "-" + i,
                    staticClass: "record-item"
                }, [e.isEditMode ? s("a", {
                    staticClass: "pointer text",
                    class: {
                        "edit-mode": e.isEditMode
                    },
                    on: {
                        click: function(s) {
                            return e.handleEdit(t, i)
                        }
                    }
                }, [e._v(" 点击编辑 ")]) : s("a", {
                    staticClass: "inherit-text text",
                    attrs: {
                        href: t.url,
                        target: "_blank"
                    }
                }, [e._v(" " + e._s(t.name) + " ")]), e.isDeleteMode ? s("i", {
                    staticClass: "iconfont icon-md-close-circle delete-icon",
                    on: {
                        click: function(s) {
                            return e.handleDelete(t)
                        }
                    }
                }) : e._e()])
            }
            )), 0)]), e.showForm ? s("DialogForm", {
                ref: "dialogForm",
                attrs: {
                    visible: e.showForm,
                    width: "400",
                    buttons: {
                        comfirm: "确 认",
                        cancel: "取 消"
                    },
                    title: e.title,
                    formData: e.formData,
                    formMap: e.formMap,
                    formRule: e.formRule
                },
                on: {
                    "update:visible": function(t) {
                        e.showForm = t
                    },
                    comfirmForm: e.save,
                    cancelForm: e.cancel
                }
            }) : e._e(), e.showCustom ? s("CustomWallpaperDrawer", {
                attrs: {
                    title: "个性墙纸",
                    visible: e.showCustom,
                    direction: "rtl",
                    size: 435
                },
                on: {
                    "update:visible": function(t) {
                        e.showCustom = t
                    }
                }
            }) : e._e()], 1)
        }
        ), [function() {
            var e = this.$createElement
              , t = this._self._c || e;
            return t("div", {
                staticClass: "title"
            }, [this._v(" 自定义网站 "), t("i", {
                staticClass: "iconfont icon-md-attach"
            })])
        }
        ], !1, null, "029ebbfc", null));
        t.default = d.exports
    },
    "0a8c": function(e, t, s) {
        e.exports = s.p + "./templates/home/huasen-portal/img/5.4eeaa603.jpeg"
    },
    "0ed7": function(e, t, s) {
        "use strict";
        s("48e7")
    },
    "103c": function(e, t, s) {},
    "1b8b": function(e, t, s) {
        "use strict";
        s.r(t);
        var i = s("6f90")
          , a = s("934a")
          , o = s("2f62")
          , n = {
            name: "HomeNav",
            computed: {
                ...Object(o.d)(["categorySites"])
            },
            methods: {
                changeAnchorPosition(e) {
                    let t = document.getElementById("site-anchor-" + encodeURI(e));
                    t && (t.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    }),
                    [...t.parentNode.children].map(e=>{
                        e.classList.remove("active-anchor")
                    }
                    ),
                    t.className = t.className + " active-anchor",
                    this.$nextTick(()=>{
                        i.a.pubEv(a.a, t.offsetTop)
                    }
                    ))
                }
            }
        }
          , r = (s("2b08"),
        s("2877"))
          , l = Object(r.a)(n, (function() {
            var e = this
              , t = e.$createElement
              , s = e._self._c || t;
            return s("div", {
                directives: [{
                    name: "rightMenu",
                    rawName: "v-rightMenu"
                }],
                staticClass: "home-nav"
            }, [s("header"), s("main", {
                directives: [{
                    name: "rightMenu",
                    rawName: "v-rightMenu"
                }]
            }, [s("ul", {
                directives: [{
                    name: "balance",
                    rawName: "v-balance"
                }, {
                    name: "rightMenu",
                    rawName: "v-rightMenu"
                }]
            }, e._l(e.categorySites, (function(t, i) {
                return s("li", {
                    key: i,
                    staticClass: "record-item",
                    on: {
                        click: function(t) {
                            return e.changeAnchorPosition(i)
                        }
                    }
                }, [s("div", {
                    staticClass: "pointer text"
                }, [e._v(" " + e._s(t.typeName) + " ")])])
            }
            )), 0)])])
        }
        ), [], !1, null, "512f0134", null);
        t.default = l.exports
    },
    "1fe2": function(e, t, s) {
        "use strict";
        var i = [function() {
            var e = this.$createElement
              , t = this._self._c || e;
            return t("main", [t("img", {
                staticClass: "w-full",
                attrs: {
                    src: s("653f")
                }
            }), t("div", {
                staticClass: "w-full text"
            }, [this._v("空空如也")])])
        }
        ]
          , a = {
            name: "Empty",
            props: {
                width: {
                    type: [Number, String],
                    default: "100%"
                },
                height: {
                    type: [Number, String],
                    default: "100%"
                }
            },
            computed: {
                style() {
                    return {
                        "--emptyWidth": this.TOOL.handleSize(this.width),
                        "--emptyHeight": this.TOOL.handleSize(this.height)
                    }
                }
            }
        }
          , o = (s("7c22"),
        s("2877"))
          , n = Object(o.a)(a, (function() {
            var e = this.$createElement;
            return (this._self._c || e)("div", {
                directives: [{
                    name: "rightMenu",
                    rawName: "v-rightMenu"
                }],
                staticClass: "empty",
                style: this.style
            }, [this._m(0)])
        }
        ), i, !1, null, "05ccee16", null);
        t.a = n.exports
    },
    "2b08": function(e, t, s) {
        "use strict";
        s("8013")
    },
    "2b6f": function(e, t, s) {},
    "2e70": function(e, t, s) {},
    "32ec": function(e, t, s) {
        "use strict";
        s("d808")
    },
    "3e09": function(e, t, s) {
        "use strict";
        s("103c")
    },
    "47cf": function(e, t, s) {
        "use strict";
        s("c489")
    },
    "48e7": function(e, t, s) {},
    "63cd": function(e, t, s) {
        e.exports = s.p + "./templates/home/huasen-portal/img/4.ad66b67a.jpeg"
    },
    6409: function(e, t, s) {},
    "653f": function(e, t, s) {
        e.exports = s.p + "./templates/home/huasen-portal/img/empty.ef9dd5f7.png"
    },
    "6e73": function(e, t, s) {
        e.exports = s.p + "./templates/home/huasen-portal/img/2.977220e4.jpeg"
    },
    "6f0c": function(e, t, s) {
        "use strict";
        s("6409")
    },
    "704b": function(e, t, s) {
        "use strict";
        s("7c45")
    },
    7267: function(e, t, s) {
        "use strict";
        s.r(t);
        var i = s("2f62")
          , a = {
            name: "HsClock",
            data: ()=>({
                hours: "00",
                minutes: "00",
                seconds: "00"
            }),
            mounted() {
                setInterval(this.clock, 1e3)
            },
            methods: {
                clock() {
                    let e = (new Date).getHours()
                      , t = (new Date).getMinutes()
                      , s = (new Date).getSeconds();
                    this.$data.hours = e < 10 ? "0" + e : e,
                    this.$data.minutes = t < 10 ? "0" + t : t,
                    this.$data.seconds = s < 10 ? "0" + s : s
                }
            }
        }
          , o = (s("6f0c"),
        s("2877"))
          , n = Object(o.a)(a, (function() {
            var e = this
              , t = e.$createElement
              , s = e._self._c || t;
            return s("div", {
                staticClass: "hs-clock"
            }, [s("div", {
                staticClass: "time"
            }, [s("span", {
                ref: "hour",
                staticClass: "hour"
            }, [e._v(e._s(e.hours))]), s("div", {
                staticClass: "text"
            }, [e._v("时")]), s("span", {
                ref: "minute",
                staticClass: "minute"
            }, [e._v(e._s(e.minutes))]), s("div", {
                staticClass: "text"
            }, [e._v("分")]), s("span", {
                ref: "second",
                staticClass: "second"
            }, [e._v(e._s(e.seconds))]), s("div", {
                staticClass: "text"
            }, [e._v("秒")])])])
        }
        ), [], !1, null, "3bf0698a", null).exports
          , r = {
            name: "Weather",
            data: ()=>({
                showWeather: !0
            }),
            mounted() {
                window.WIDGET = {
                    CONFIG: {
                        modules: "12034",
                        background: 5,
                        tmpColor: "E4C600",
                        tmpSize: 14,
                        cityColor: "E4C600",
                        citySize: 14,
                        aqiColor: "#E4C600",
                        aqiSize: 14,
                        weatherIconSize: 24,
                        alertIconSize: 18,
                        padding: "0px 0px 0px 0px",
                        shadow: "1",
                        language: "auto",
                        borderRadius: 5,
                        fixed: "false",
                        vertical: "middle",
                        horizontal: "left",
                        key: "e05c4ce44b7e43c6a9303e68cc42a48c"
                    }
                },
                this.TOOL.getCDN("https://widget.qweather.net/simple/static/js/he-simple-common.js?v=2.0", "text/javascript", ()=>{
                    this.$nextTick(()=>{
                        let e = document.getElementById("hs-weather");
                        this.chartObserve || (this.chartObserve = new ResizeObserver(([{contentRect: e}])=>{
                            0 !== e.width && (this.showWeather = !(e.width > 180))
                        }
                        ),
                        this.chartObserve.observe(e),
                        this.$once("hook:beforeDestroy", (function() {
                            this.chartObserve.unobserve(e)
                        }
                        )))
                    }
                    )
                }
                )
            }
        }
          , l = (s("0ed7"),
        {
            name: "HomeHead",
            components: {
                Clock: n,
                Weather: Object(o.a)(r, (function() {
                    var e = this.$createElement
                      , t = this._self._c || e;
                    return t("div", {
                        directives: [{
                            name: "show",
                            rawName: "v-show",
                            value: this.showWeather,
                            expression: "showWeather"
                        }],
                        attrs: {
                            id: "hs-weather"
                        }
                    }, [t("div", {
                        attrs: {
                            id: "he-plugin-simple"
                        }
                    })])
                }
                ), [], !1, null, "28f44e35", null).exports
            },
            props: {
                headBgConfig: {
                    type: Object,
                    default: ()=>({
                        clear: !1,
                        white: !1,
                        grossGlass: !0
                    })
                }
            },
            data() {
                return {
                    showMenu: !1,
                    selectedTake: "常用热门",
                    takes: [],
                    journals: [],
                    currentJournal: {},
                    links: [{
                        iconfontClass: "iconfont icon-github",
                        text: " 作者: 花森JioJio",
                        url: "https://github.com/huasenjio/huasenjio-compose",
                        isArticle: !1
                    }]
                }
            },
            computed: {
                ...Object(i.d)(["showWrapLeft", "user"]),
                showGrossGlass() {
                    return !!(this.showMenu && document.body.clientWidth <= 1024)
                },
                signText() {
                    return this.user.token ? this.user.name : "注册登录"
                }
            },
            mounted() {
                this.querySites(),
                this.queryJournals()
                this.initMenu()
            },
            methods: {
                ...Object(i.c)(["commitAll"]),
                querySites() {
                    this.API.findSiteByCode({}, {
                        notify: !1
                    }).then(e=>{
                        this.commitAll({
                            sites: e.data
                        })
                    }
                    )
                },
                queryJournals() {
                    this.API.findJournal({}, {
                        notify: !1
                    }).then(e=>{
                        0 !== e.data.length && (this.journals = e.data,
                        this.handleSelectJournal(this.journals[0]._id))
                    }
                    )
                },
                handleSelectJournal(e) {
                    this.journals.find(t=>t._id === e) && this.API.findJournalInformationById({
                        _id: e
                    }).then(e=>{
                        this.selectJournal(e.data)
                    }
                    )
                },
                selectJournal(e) {
                    this.currentJournal = e,
                    this.commitAll({
                        categorySites: e.series
                    })
                },
                hiddenWrapLeft() {
                    this.commitAll({
                        showWrapLeft: !this.showWrapLeft
                    })
                },
                sign() {
                    this.user.token ? this.commitAll({
                        showWrapPerson: !0
                    }) : this.commitAll({
                        showWrapSign: !0
                    })
                },
                hiddenMenu() {
                    this.showMenu = !this.showMenu
                },
                initMenu() {
                    let e = this.LODASH.debounce(()=>{
                        document.body.clientWidth > 1024 ? this.showMenu = !0 : this.showMenu = !1
                    }
                    , 100, {
                        leading: !0,
                        trailing: !0
                    });
                    window.addEventListener("resize", e),
                    this.$once("hook:beforeDestory", ()=>{
                        window.removeEventListener("resize", e)
                    }
                    ),
                    this.$nextTick(()=>{
                        let e = new Event("resize",{
                            bubbles: !0,
                            cancelable: !1
                        });
                        document.dispatchEvent(e)
                    }
                    )
                },
                jump(e, t) {
                    let s = e.url;
                    0 === t ? this.TOOL.openPage(s) : this.TOOL.jumpToRead(this, s)
                }
            }
        })
          , c = (s("32ec"),
        Object(o.a)(l, (function() {
            var e = this
              , t = e.$createElement
              , s = e._self._c || t;
            return s("div", {
                directives: [{
                    name: "rightMenu",
                    rawName: "v-rightMenu"
                }],
                staticClass: "home-head",
                class: {
                    clear: !e.showGrossGlass && e.headBgConfig.clear,
                    white: e.headBgConfig.white,
                    "gross-glass": e.showGrossGlass || e.headBgConfig.grossGlass
                }
            }, [s("section", {
                staticClass: "fold",
                on: {
                    click: e.hiddenWrapLeft
                }
            }, [s("i", {
                staticClass: "iconfont icon-md-barcode"
            })]), s("section", {
                staticClass: "menu",
                on: {
                    click: e.hiddenMenu
                }
            }, [s("i", {
                staticClass: "iconfont  icon-md-menu"
            })]), e.showMenu ? s("section", {
                staticClass: "collapse"
            }, [s("ul", {
                staticClass: "links"
            }, e._l(e.links, (function(t, i) {
                return s("li", {
                    key: i,
                    on: {
                        click: function(s) {
                            return e.jump(t, i)
                        }
                    }
                }, [s("i", {
                    staticClass: "icon",
                    class: t.iconfontClass
                }), s("span", {
                    staticClass: "text"
                }, [e._v(e._s(t.text))])])
            }
            )), 0)]) : e._e(), s("section", {
                staticClass: "today"
            }, [s("div", {
                staticClass: "clock-group"
            }, [s("Clock")], 1), s("div", {
                staticClass: "weather-group"
            }, [s("Weather")], 1)]), e.showMenu ? s("section", {
                staticClass: "take"
            }, [s("el-dropdown", {
                staticClass: "dropdown",
                attrs: {
                    trigger: "click"
                },
                on: {
                    command: e.handleSelectJournal
                }
            }, [s("span", {
                staticClass: "el-dropdown-link pointer"
            }, [e._v(" " + e._s(e.currentJournal.name || "无订阅源") + " "), s("i", {
                staticClass: "el-icon-arrow-down el-icon--right"
            })]), s("el-dropdown-menu", {
                attrs: {
                    slot: "dropdown"
                },
                slot: "dropdown"
            }, e._l(e.journals, (function(t) {
                return s("el-dropdown-item", {
                    key: t._id,
                    attrs: {
                        command: t._id
                    }
                }, [e._v(" " + e._s(t.name) + " ")])
            }
            )), 1)], 1)], 1) : e._e(), e.showMenu ? s("section", {
                staticClass: "sign",
                on: {
                    click: e.sign
                }
            }, [e._v(" " + e._s(e.signText || "花酱大人") + " ")]) : e._e()])
        }
        ), [], !1, null, "60e7b2ad", null));
        t.default = c.exports
    },
    "7c22": function(e, t, s) {
        "use strict";
        s("2e70")
    },
    "7c45": function(e, t, s) {},
    8013: function(e, t, s) {},
    "84ad": function(e, t, s) {
        "use strict";
        s("e056")
    },
    "872e": function(e, t, s) {
        "use strict";
        s("2b6f")
    },
    "9bd2": function(e, t, s) {
        "use strict";
        s.r(t);
        var i = s("2f62")
          , a = {
            name: "HomeSite",
            data: ()=>({}),
            computed: {
                ...Object(i.d)(["categorySites"])
            },
            mounted() {
                this.$store.dispatch("initLocalStyleInfo")
            },
            methods: {
                imgUrl: e=>e.icon ? e.icon : s("4101")
            }
        }
          , o = (s("704b"),
        s("2877"))
          , n = Object(o.a)(a, (function() {
            var e = this
              , t = e.$createElement
              , s = e._self._c || t;
            return s("div", {
                directives: [{
                    name: "rightMenu",
                    rawName: "v-rightMenu"
                }],
                staticClass: "home-site"
            }, e._l(e.categorySites, (function(t, i) {
                return s("section", {
                    key: t.typeName + "-" + i,
                    attrs: {
                        id: "site-anchor-" + encodeURI(i)
                    }
                }, [s("div", {
                    directives: [{
                        name: "rightMenu",
                        rawName: "v-rightMenu"
                    }],
                    staticClass: "site-item"
                }, [s("header", [s("i", {
                    staticClass: "iconfont icon-tag"
                }), s("a", {
                    staticClass: "title",
                    attrs: {
                        name: t.typeName
                    }
                }, [e._v(e._s(t.typeName))])]), s("main", [s("ul", {
                    directives: [{
                        name: "balance",
                        rawName: "v-balance"
                    }]
                }, e._l(t.sites, (function(t, i) {
                    return s("a", {
                        key: t.url + "-" + i,
                        staticClass: "site inherit-text",
                        attrs: {
                            href: t.url,
                            title: t.describe,
                            target: "_blank"
                        }
                    }, [s("div", {
                        staticClass: "site-card inherit-text text w-px-180 sm:w-px-150"
                    }, [s("div", {
                        staticClass: "img-group"
                    }, [s("img", {
                        directives: [{
                            name: "lazy",
                            rawName: "v-lazy"
                        }],
                        attrs: {
                            src: e.imgUrl(t)
                        }
                    })]), s("div", {
                        staticClass: "text-group"
                    }, [s("div", {
                        staticClass: "name text"
                    }, [e._v(e._s(t.name))]), s("div", {
                        staticClass: "describe inherit-text text"
                    }, [e._v(e._s(t.describe))])])])])
                }
                )), 0)])])])
            }
            )), 0)
        }
        ), [], !1, null, "d6bf07ce", null);
        t.default = n.exports
    },
    a13d: function(e, t, s) {
        e.exports = s.p + "./templates/home/huasen-portal/img/1.4746c6ae.jpeg"
    },
    b3d7: function(e, t, s) {
        "use strict";
        s.r(t);
        var i = s("2f62")
          , a = s("6f90")
          , o = s("934a")
          , n = s("7267")
          , r = s("17c3")
          , l = s("cf4c")
          , c = s("0159")
          , d = s("1b8b")
          , h = s("9bd2")
          , u = s("1fe2")
          , m = {
            name: "Home",
            components: {
                HomeHead: n.default,
                HomeWallpaper: r.default,
                HomeSearch: l.default,
                HomeRecord: c.default,
                HomeNav: d.default,
                HomeSite: h.default,
                Empty: u.a
            },
            data: ()=>({
                headBgConfig: {
                    clear: !0,
                    white: !1,
                    grossGlass: !1
                }
            }),
            computed: {
                ...Object(i.d)(["categorySites"]),
                categoryEmpty() {
                    return 0 === this.categorySites.length
                }
            },
            mounted() {
                this.initScrollEvent(),
                this.initEventBus(),
                this.initLocalStyleInfo()
            },
            destroyed() {
                a.a.unSubEv(o.a)
            },
            methods: {
                ...Object(i.c)(["commitAll"]),
                ...Object(i.b)(["initLocalStyleInfo"]),
                initScrollEvent() {
                    let e = this.TOOL.debounce(e=>{
                        let t = {
                            clear: !1,
                            white: !1,
                            grossGlass: !1
                        };
                        e.target.scrollTop > 210 ? (this.commitAll({
                            showWrapSidebarSocket: !0
                        }),
                        t.white = !0) : e.target.scrollTop > 30 ? (this.commitAll({
                            showWrapSidebarSocket: !0
                        }),
                        t.grossGlass = !0) : (this.commitAll({
                            showWrapSidebarSocket: !1
                        }),
                        t.clear = !0),
                        this.headBgConfig = t
                    }
                    , 20);
                    this.$refs.homeContent.addEventListener("scroll", e),
                    this.$once("hook:beforeDestory", ()=>{
                        this.$refs.homeContent.removeEventListener("scroll", e)
                    }
                    )
                },
                initEventBus() {
                    a.a.subEv(o.a, (e,t)=>{
                        let s = t ? e : this.$refs.siteContent.$el.offsetTop - 85 + e;
                        this.homeContentScrollTo(s)
                    }
                    )
                },
                homeContentScrollTo(e) {
                    this.$refs.homeContent.scrollTo({
                        top: e,
                        behavior: "smooth"
                    })
                }
            }
        }
          , p = (s("84ad"),
        s("2877"))
          , f = Object(p.a)(m, (function() {
            var e = this.$createElement
              , t = this._self._c || e;
            return t("div", {
                staticClass: "home"
            }, [t("HomeWallpaper"), t("section", {
                staticClass: "content"
            }, [t("HomeHead", {
                attrs: {
                    headBgConfig: this.headBgConfig
                }
            }), t("main", {
                ref: "homeContent",
                staticClass: "home-content"
            }, [t("HomeSearch"), t("HomeRecord"), this.categoryEmpty ? this._e() : t("HomeNav"), this.categoryEmpty ? this._e() : t("HomeSite", {
                ref: "siteContent"
            }), this.categoryEmpty ? t("div", {
                staticClass: "empty-panel"
            }, [t("Empty")], 1) : this._e()], 1)], 1)], 1)
        }
        ), [], !1, null, "12498b36", null);
        t.default = f.exports
    },
    bd9f: function(e, t, s) {
        e.exports = s.p + "./templates/home/huasen-portal/img/6.f79ffc44.jpeg"
    },
    c489: function(e, t, s) {},
    d808: function(e, t, s) {},
    e056: function(e, t, s) {}
}]);
