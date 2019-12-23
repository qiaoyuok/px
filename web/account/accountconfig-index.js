let vm;
let controller = '/accountconfig/'
let qiniu = "https://image.mysvip.cn/"
if (document.getElementById('accountconfig-index')) {
    vm = new Vue({
        el: "#accountconfig-index",
        data: {
            accountCates: [],
            fenqi: [],
            dialogAdd: false,
            dialogDel: false,
            cateId: 0,
            vip_name: '',
            field: '',
            des: '',
            controller: '',
            url: '',
            extraData: {token: token,key:''},
            imgUrl: 'account_logo.png',
            qiniu: qiniu,
            accountBaseConfig:{}
        },
        created() {
            this.getAccountConfig()
        },
        methods: {

            //获取账号配置
            getAccountConfig() {
                let _that = this
                postRequest(controller, 'get-account-config', {}, (res) => {
                    if (res.data.accountCates != null) {
                        $.each(res.data.accountCates, function (index, element) {
                            $.each(element.children, function (i, v) {
                                createUEOption('container' + element.id + '' + v.id)
                            })
                        })
                    }
                    _that.accountCates = res.data.accountCates
                    _that.accountBaseConfig = res.data.accountBaseConfig
                })
            },

            // 保存账号配置
            saveConfig(parent_index = '', index = '', cateId = '', field = '') {
                let _that = this
                let value = ''
                if (field == 'content') {
                    value = UE.getEditor("container" + _that.accountCates[parent_index].id + cateId).getContent()
                } else {
                    value = JSON.stringify(_that.accountCates[parent_index].children[index].config[field])
                }
                let data = {
                    value: value
                }
                postRequest(controller, 'edit-config?cateId=' + cateId + "&field=" + field, data, (res) => {
                    if (res.data.code == 1) {
                        setTimeout(() => {
                            _that.getAccountConfig()
                        }, 500)
                    }
                })
            },

            //添加账号配置获取信息
            addConfig(cateId = 0, field = '', des = '') {
                this.dialogAdd = true
                this.cateId = cateId
                this.field = field
                this.des = des
            },

            //删除账号配置
            delConfig(parent_index = '', index = '', cateId = '', field = '') {
                let _that = this
                console.log(_that.accountCates[parent_index].children[index].config[field])
                let value = JSON.stringify(_that.accountCates[parent_index].children[index].config[field])
                _that.dialogDel = true
                _that.controller = controller
                _that.url = 'del-config?cateId=' + cateId + "&field=" + field + "&value=" + value
            },


            dialogaddstatus(refresh) {
                this.dialogAdd = false
                if (refresh == "refresh") {
                    this.getAccountConfig()
                }
            },

            dialogstatus(refresh) {
                this.dialogDel = false
                if (refresh == "refresh") {
                    this.getAccountConfig()
                }
            },

            // 图片上传成功回调
            updateSuccess(response) {
                if (response.key) {
                    vm.$message({
                        showClose: false,
                        message: "上传成功",
                        type: 'success'
                    });
                    this.saveImageName(response)
                }
            },

            // 图片上传成功回调
            swiperUpdateSuccess(response) {
                if (response.key) {
                    vm.$message({
                        showClose: false,
                        message: "上传成功",
                        type: 'success'
                    });
                    this.saveImageSwiper(response)
                }
            },

            saveImageSwiper(response){
                console.log(222);
                postRequest(controller, 'save-image-swiper?cateId=' + this.cateId + "&swiper=" + response.key, {}, (res) => {
                    this.getAccountConfig()
                })
            },

            saveImageName(response){
                console.log(222);
                postRequest(controller, 'save-image-name?cateId=' + this.cateId + "&logo=" + response.key, {}, (res) => {
                    this.getAccountConfig()
                })
            },

            // 设定七牛云上传的文件名
            setKey(vip_name = '', cateId = '') {
                console.log(cateId);
                this.vip_name = vip_name
                this.cateId = cateId
                this.extraData.key = "logo__"+(new Date()).getTime()+".png"
            },

            // 设定七牛云上传的文件名
            setSwiperKey(vip_name = '', cateId = '') {
                console.log(cateId);
                this.vip_name = vip_name
                this.cateId = cateId
                this.extraData.key = "logo_setSwiperKey__"+(new Date()).getTime()+".png"
            }
        }
    })
}

function createUEOption(id = '') {
    UE.getEditor(id, {
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
}