var vm;
var controller = '/goods/goods/';
let qiniu = "https://image.mysvip.cn/"

if (document.getElementById('goods-add-app')) {

    vm = new Vue({
        el: "#goods-add-app",
        data: {
            goods: {
                goodsType: 1,
                goodsName: null,
                parent_cate_id: null,
                cateId: null,
                accountType: null,
                vipType: null,
                fenqi: [],
                attributes: [{attribute: '', originAttribute: '', originOldAttribute: '', price: '', originPrice: ''}],
                images: [],
                content: null,
                everyTimes: null,
                loginHelp: null,
                loginTimes: null,
                status: true,
                stock: 0,
                isOfficial: 1,
                goods_id: 0,
                endTime: '',
            },
            nowAttrIndex: 0,
            parentCates: [],
            childCates: [],
            accountTypes: [],
            endTimeObj: '',
            vipTypes: [],
            extraData: {token: token, key: ''},
            fenqis: [],
            baseConfig: {
                accountType: [],
                fenqi: [],
                vipType: [],
            },
            dialogImageUrl: '',
            dialogVisible: false,
            accountRules: {
                parent_cate_id: [
                    {required: true, message: '顶级分类不能为空', trigger: 'blur'},
                    {type: 'number', message: '顶级分类值必须是数字', trigger: 'blur'}
                ],
                cateId: [
                    {required: true, message: '分类不能为空', trigger: 'blur'},
                    {type: 'number', message: '分类值必须是数字', trigger: 'blur'}
                ],
                accountType: [
                    {required: true, message: '账号类型不能为空', trigger: 'blur'},
                    {type: 'number', message: '账号类型必须是数字', trigger: 'blur'}
                ],
                vipType: [
                    {required: true, message: '会员类型不能为空', trigger: 'blur'},
                    {type: 'number', message: '会员类型必须是数字', trigger: 'blur'}
                ],
            },
            commonRules: {
                goodsName: [
                    {required: true, message: '请填写商品名称', trigger: 'blur'},
                    {min: 3, message: '长度在不能低于3个字符', trigger: 'blur'}
                ],
                parent_cate_id: [
                    {required: true, message: '顶级分类不能为空', trigger: 'blur'},
                    {type: 'number', message: '顶级分类值必须是数字', trigger: 'blur'}
                ],
                cateId: [
                    {required: true, message: '分类不能为空', trigger: 'blur'},
                    {type: 'number', message: '分类值必须是数字', trigger: 'blur'}
                ],
            },
            rules: {}
        },
        created() {
            this.rules = this.accountRules
            this.getCate()
        },
        filters: {
            accountFilter(id, origin) {
                let _that = this
                let name;
                $.each(origin, function (index, element) {
                    if (element.index == id) {
                        return name = element.value;
                    }
                })
                return name
            }
        },
        watch: {
            'goods.goodsType'() {
                let _that = this
                _that.goods.parent_cate_id = null
                if (this.goods.goodsType == 1) {
                    this.rules = this.accountRules
                } else {
                    this.rules = this.commonRules
                }
            },
            'goods.parent_cate_id'() {
                //根据父分类的变化来获取子分类
                let _that = this
                _that.goods.cateId = null
                console.log(_that.parentCates, 2222);
                $.each(_that.parentCates, function (index, element) {
                    if (element.id == _that.goods.parent_cate_id) {
                        _that.childCates = _that.parentCates[index].children
                    }
                })
            },
            'goods.cateId'() {
                //根据子分类的变化来账号配置，会员类型配置，分期
                let _that = this
                _that.goods.accountType = null
                _that.goods.vipType = null
                _that.goods.fenqi = []
                _that.goods.images = []
                $.each(_that.parentCates, function (index, element) {
                    // 先找到父分类
                    if (element.id == _that.goods.parent_cate_id) {
                        // 再找子分类
                        $.each(element.children, function (i, e) {
                            if (e.id == _that.goods.cateId) {
                                _that.accountTypes = e.config.accountType
                                _that.vipTypes = e.config.vipType
                                _that.fenqis = e.config.fenqi
                            }
                        })
                    }
                })
            },
        },
        methods: {

            //获取分类列表
            getCate() {
                let _that = this
                postRequest("/accountconfig/", 'get-account-config', {}, res => {
                    console.log(res);
                    _that.parentCates = res.data.accountCates
                    _that.baseConfig = res.data.accountBaseConfig
                    if (goods != '') {
                        console.log(goods);
                        _that.goods.goodsType = parseInt(goods.goodsType)

                        setTimeout(() => {
                            _that.goods.goodsName = goods.goodsName
                            _that.goods.parent_cate_id = parseInt(goods.parent_cate_id)
                            setTimeout(() => {
                                _that.goods.cateId = parseInt(goods.cateId)
                                setTimeout(() => {
                                    if (goods.goodsType == 1) {
                                        _that.goods.accountType = parseInt(goods.accountType)
                                        _that.goods.vipType = parseInt(goods.vipType)
                                    }
                                    var fenqi = JSON.parse(goods.fenqi);
                                    $.each(fenqi, function (i, v) {
                                        fenqi[i] = parseInt(fenqi[i])
                                    })
                                    _that.goods.fenqi = fenqi
                                }, 50)
                            }, 20)
                            _that.goods.stock = goods.stock
                            if (goods.goodsType == 1) {
                                _that.goods.everyTimes = parseInt(goods.everyTimes)
                                _that.goods.loginHelp = goods.loginHelp
                                _that.goods.loginTimes = parseInt(goods.loginTimes)
                            }
                            _that.goods.id = parseInt(goods.id)
                            _that.goods.status = goods.status
                            _that.goods.endTime = moment(moment.unix(goods.endTime).format('YYYY-MM-DD HH:mm:ss'))._i
                            _that.goods.attributes = JSON.parse(goods.attributes)
                            var ue = initUe('goods-edit')
                            ue.ready(function (content = '') {
                                ue.setContent(goods.content);
                            });
                            _that.goods.content = goods.content
                            setTimeout(() => {
                                var images = JSON.parse(goods.images)
                                $.each(images, function (i, v) {
                                    console.log(qiniu + v.url);
                                    _that.goods.images.push({url: qiniu + v.url})
                                    console.log(_that.goods.images, 111);
                                })
                            }, 50)
                        }, 20)
                    }
                })
            },
            // 添加图片成功
            updateSuccess(response) {
                console.log(response);
                let _that = this
                if (response.key) {
                    this.goods.images.push({url: qiniu + response.key})
                } else {
                    vm.$message({
                        showClose: false,
                        message: "上传图片失败",
                        type: 'error'
                    });
                }
            },
            setKey() {
                this.extraData.key = "goods_swiper__" + (new Date()).getTime() + ".png"
            },
            onSubmit() {
                this.goods.content = UE.getEditor("goods-edit").getContent()
                var data = {
                    Goods: this.goods
                }
                this.$refs.goods.validate((valid) => {
                    if (valid) {
                        postRequest(controller, 'add-goods', data, res => {
                            console.log(res);
                            if (res.data.code == 1) {
                                setTimeout(() => {
                                    javascript:history.back(-1)
                                }, 1000)
                            }
                        })
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            handleRemove(file, fileList) {
                this.goods.images = fileList
            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            },
            removeDomain(item) {
                var index = this.goods.attributes.indexOf(item)
                if (index !== -1) {
                    this.goods.attributes.splice(index, 1)
                }
            },
            slideChange(v) {
                if (this.goods.endTime == '') {
                    vm.$message({
                        showClose: false,
                        message: "请先添加会员时长",
                        type: 'error'
                    })
                    return false
                }
                let endTimeStemp = moment(this.goods.endTime).valueOf();
                let tmp_timeStemp = '';
                // 小时的处理
                if (v < 24) {
                    tmp_timeStemp = moment().add('hours', v).format('X')
                    timespaceAlias = v + '小时';
                } else if (v >= 24 && v < 53) {
                    //天的处理 30天以内
                    tmp_timeStemp = moment().add('days', (v - 23)).format('X')
                    timespaceAlias = (v - 23) + '天'
                } else if (v >= 53 && v < 64) {
                    //月的处理
                    tmp_timeStemp = moment().add('months', (v - 52)).format('X')
                    timespaceAlias = (v - 52) + '月'
                } else {
                    // 年的处理
                    tmp_timeStemp = moment().add('months', (v - 63)).format('X')
                    timespaceAlias = (v - 63) + '年'
                }
                console.log(endTimeStemp);
                if (endTimeStemp / 1000 < tmp_timeStemp) {
                    vm.$message({
                        showClose: false,
                        message: "租赁时长大于会员时长",
                        type: 'error'
                    })
                    this.goods.attributes[this.nowAttrIndex].originAttribute = this.goods.attributes[this.nowAttrIndex].originOldAttribute
                    return false
                }
                this.goods.attributes[this.nowAttrIndex].attribute = timespaceAlias
                this.goods.attributes[this.nowAttrIndex].originOldAttribute = v
            },
            toolTip(v) {
                if (v < 24) {
                    tmp_timeStemp = moment().add('hours', v).format('X')
                    timespaceAlias = v + '小时';
                } else if (v >= 24 && v < 53) {
                    //天的处理 30天以内
                    tmp_timeStemp = moment().add('days', (v - 23)).format('X')
                    timespaceAlias = (v - 23) + '天'
                } else if (v >= 53 && v < 64) {
                    //月的处理
                    tmp_timeStemp = moment().add('months', (v - 52)).format('X')
                    timespaceAlias = (v - 52) + '月'
                } else {
                    // 年的处理
                    tmp_timeStemp = moment().add('months', (v - 63)).format('X')
                    timespaceAlias = (v - 63) + '年'
                }
                return timespaceAlias;
            },
            setAttrIndex(index = 0) {
                this.nowAttrIndex = index
            },
            addDomain() {
                this.goods.attributes.push({
                    attribute: '',
                    price: '',
                    originPrice: '',
                });
            }
        }
    })

}
initUe('goods-edit')

function initUe(id = '') {
    var ue = UE.getEditor(id, {
        toolbars: [
            [
                'anchor', //锚点
                'undo', //撤销
                'redo', //重做
                'bold', //加粗
                'indent', //首行缩进
                'snapscreen', //截图
                'italic', //斜体
                'underline', //下划线
                'strikethrough', //删除线
                'subscript', //下标
                'fontborder', //字符边框
                'superscript', //上标
                'formatmatch', //格式刷
                'source', //源代码
                'blockquote', //引用
                'pasteplain', //纯文本粘贴模式
                'selectall', //全选
                'print', //打印
                'preview', //预览
                'horizontal', //分隔线
                'removeformat', //清除格式
                'time', //时间
                'date', //日期
                'unlink', //取消链接
                'insertrow', //前插入行
                'insertcol', //前插入列
                'mergeright', //右合并单元格
                'mergedown', //下合并单元格
                'deleterow', //删除行
                'deletecol', //删除列
                'splittorows', //拆分成行
                'splittocols', //拆分成列
                'splittocells', //完全拆分单元格
                'deletecaption', //删除表格标题
                'inserttitle', //插入标题
                'mergecells', //合并多个单元格
                'deletetable', //删除表格
                'cleardoc', //清空文档
                'insertparagraphbeforetable', //"表格前插入行"
                'insertcode', //代码语言
                'fontfamily', //字体
                'fontsize', //字号
                'paragraph', //段落格式
                'simpleupload', //单图上传
                'insertimage', //多图上传
                'edittable', //表格属性
                'edittd', //单元格属性
                'link', //超链接
                'emotion', //表情
                'spechars', //特殊字符
                'searchreplace', //查询替换
                'map', //Baidu地图
                'gmap', //Google地图
                'insertvideo', //视频
                'help', //帮助
                'justifyleft', //居左对齐
                'justifyright', //居右对齐
                'justifycenter', //居中对齐
                'justifyjustify', //两端对齐
                'forecolor', //字体颜色
                'backcolor', //背景色
                'insertorderedlist', //有序列表
                'insertunorderedlist', //无序列表
                'fullscreen', //全屏
                'directionalityltr', //从左向右输入
                'directionalityrtl', //从右向左输入
                'rowspacingtop', //段前距
                'rowspacingbottom', //段后距
                'pagebreak', //分页
                'insertframe', //插入Iframe
                'imagenone', //默认
                'imageleft', //左浮动
                'imageright', //右浮动
                'attachment', //附件
                'imagecenter', //居中
                'wordimage', //图片转存
                'lineheight', //行间距
                'edittip ', //编辑提示
                'customstyle', //自定义标题
                'autotypeset', //自动排版
                'webapp', //百度应用
                'touppercase', //字母大写
                'tolowercase', //字母小写
                'background', //背景
                'template', //模板
                'scrawl', //涂鸦
                'music', //音乐
                'inserttable', //插入表格
                'drafts', // 从草稿箱加载
                'charts', // 图表
            ],
        ],
        initialFrameWidth: '400px',
        initialFrameHeight: '420',
        zIndex: 2000,
    });
    return ue
}
