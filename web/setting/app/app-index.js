var vm;
var controller = '/setting/';
let qiniu = "https://image.mysvip.cn/"
if (document.getElementById('app-index')) {

    vm = new Vue({
        el: "#app-index",
        data: {
            deleteDialog: false,
            announce: {
                content: '请输入公告内容....',
                title: '',
                id: 0
            },
            announcelist: [],
            controller: controller,
            url: '',

            // 轮播图
            swiperDialog: false,
            extraData: {token: token, key: ''},
            swiperList: [],
            qiniu: qiniu,
            swiperItem: {},
            swiperId: null
        },
        created() {
            this.getAnnounceList()
            this.getSwiperList()
        },
        methods: {

            // 保存公告
            saveAnnounce() {
                let _that = this
                let data = {
                    id: _that.announce.id,
                    title: _that.announce.title,
                    content: UE.getEditor("edit-container").getContent()
                }
                postRequest(controller, 'save-announce', data, res => {
                    console.log(res);
                    if (res.data.code == 1) {
                        setTimeout(() => {
                            _that.getAnnounceList()
                        }, 500)
                    }
                })
            },

            // 获取公告列表
            getAnnounceList() {

                let _that = this
                postRequest(controller, 'get-announce-list', {}, res => {
                    console.log(res);
                    _that.announcelist = res.data
                })

            },

            // 编辑公告状态
            editAnnounceStatus(id = '', status = '') {

                let _that = this
                postRequest(controller, 'edit-announce?id=' + id + "&status=" + status, {}, res => {
                    console.log(res);
                    if (res.data.code == 1) {
                        setTimeout(() => {
                            _that.getAnnounceList()
                        }, 500)
                    }
                })
            },

            // 删除公告
            delAnnounce(announce_id = 0) {
                this.deleteDialog = true
                this.url = 'del-announce?id=' + announce_id

            },

            // 编辑公告
            editAnnounce(id = '') {
                console.log($("[contenteditable='true']"));
                let _that = this
                postRequest(controller, 'get-announce?id=' + id, {}, res => {
                    console.log(res);
                    setTimeout(() => {
                        _that.announce.content = res.data.content
                        _that.announce.title = res.data.title
                        _that.announce.id = res.data.id
                        var ue = initUe('edit-container')
                        ue.ready(function (content = '') {
                            ue.setContent(res.data.content);
                        });
                    }, 500)

                })
            },

            // 监听对话框状态
            dialogstatus(refresh = '') {
                this.deleteDialog = false
                if (refresh != '') {
                    this.getAnnounceList()
                }
            },

            // 添加编辑图片
            addimage() {
                let _that = this
                _that.swiperDialog = true
            },

            // 添加图片成功
            updateSuccess(response) {
                console.log(response);
                let _that = this
                if (response.key) {
                    _that.addSwiper(response)
                } else {
                    vm.$message({
                        showClose: false,
                        message: "上传图片失败",
                        type: 'error'
                    });
                }
            },


            // 保存swiper
            addSwiper(res = {}) {
                if (this.swiperId != null) {
                    console.log(2222);
                    res['id'] = this.swiperId
                }
                let _that = this
                postRequest(controller, 'add-swiper', res, res => {
                    console.log(res);
                    if (res.data.code == 1) {
                        _that.getSwiperList()
                    }

                    _that.swiperId = null
                })
            },

            // 设定七牛云上传的文件名
            setKey(id = '') {
                if (id != '') {
                    console.log(id, 2333);
                    console.log(222111);
                    this.swiperId = id
                }
                this.extraData.key = "swiper__" + (new Date()).getTime() + ".png"
            },

            // 获取swiper列表
            getSwiperList() {
                let _that = this
                postRequest(controller, 'swiper-list', {}, res => {
                    console.log(res);
                    _that.swiperList = res.data
                })
            },

            // 删除一个swiper
            delSwiper(id = '') {
                let _that = this
                this.$confirm('此操作将永久删除该轮播图, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    postRequest(controller, 'swiper-delete?id=' + id, {}, res => {
                        console.log(res);
                        if (res.data.code == 1) {
                            _that.getSwiperList()
                        }
                    })
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },

            //编辑swiper
            editSwiperDialog(index = '') {
                let _that = this
                this.swiperItem = this.swiperList[index]
                var ue = initUe('swiper-edit-container')
                ue.ready(function (content = '') {
                    console.log(_that.swiperItem);
                    console.log(_that.swiperItem.content);
                    ue.setContent(_that.swiperItem.content);
                });
            },

            // 保存swiper编辑
            saveSwiper(){
                let _that = this
                _that.swiperItem['content'] = UE.getEditor("swiper-edit-container").getContent()
                postRequest(controller,'save-swiper',_that.swiperItem,res=>{
                    console.log(res);
                    if (res.data.code == 1){
                        _that.getSwiperList()
                    }
                })
            },

            // 编辑swiper状态
            editSwiperStatus(id = '', value = 0) {
                let _that = this
                postRequest(controller, 'swiper-edit-status?id=' + id + "&value=" + value, {}, res => {
                    console.log(res);
                    if (res.data.code == 1) {
                        _that.getSwiperList()
                    }
                })
            },

            //设定当前swiper项
            setSwiperItem(index = 0) {
                this.swiperItem = this.swiperList[index]
            }
        }
    })
}

initUe('edit-container')
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


