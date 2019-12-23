let controller = '/feedback/feedback/'
let vm;
let ue;
if (document.getElementById('feedback-app')) {
    vm = new Vue({
        el: "#feedback-app",
        data: {
            feedbackList: [],
            total: 1000,
            avatarstyle: {width: "40px", height: "40px", 'border-radius': "50%"},
            limit: 9,
            search_datetime: '',
            search_tel: '',
            search_nickname: '',
            page: 1,
            feedbackInfo: [],
            pickerOptions: {
                shortcuts: [{
                    text: '最近一周',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近一个月',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近三个月',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近半年',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 90 * 2);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近一年',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 90 * 2 * 2);
                        picker.$emit('pick', [start, end]);
                    }
                }]
            },
            feedbackId: 0,
            replyId: 0,
            account_id: '',
            uuid: '',
            currentIndex: '',
            currentCIndex: '',
            accountInfo:{},
            viewAccountId:0,
            type: ''
        },
        created() {
            this.getFeedbackList()
        },
        filters: {
            // 时间戳转时间

            // 时间戳转时间
            getLocalTime(time=0){
                if (time == undefined){
                    return false
                }
                return moment(moment.unix(time).format('YYYY-MM-DD HH:mm:ss'))._i
            },
        },
        methods: {
            search() {
                let _that = this
                _that.getFeedbackList()
            },

            // 获取反馈列表
            getFeedbackList() {
                let _that = this
                postRequest(controller, 'feedback-list?page=' + _that.page + "&limit=" + this.limit + "&nickname=" + _that.search_nickname + "&tel=" + _that.search_tel + "&datetime=" + _that.search_datetime, {}, res => {
                    _that.feedbackList = res.data.data
                    _that.total = parseInt(res.data.total)
                })
            },

            // 刷新
            refresh() {
                let _that = this
                _that.search_datetime = ''
                _that.search_tel = ''
                _that.search_nickname = ''
            },

            // 换页
            pageChange(page) {
                let _that = this
                _that.page = page
                _that.getUsers()
            },

            // 删除反馈
            delFeedback(id = 0) {
                let _that = this
                this.$confirm('确定要删除该条反馈吗?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    postRequest(controller, 'del-feedback?id=' + id, {}, res => {
                        if (res.data.code == 1) {
                            _that.getFeedbackList()
                        }
                    })
                }).catch(() => {

                });
            },

            // 获取item反馈列表
            getFeedbackInfo(account_id = '', uuid = '') {
                let _that = this
                if (account_id != '' && uuid != '') {
                    _that.account_id = account_id
                    _that.uuid = uuid
                }
                postRequest(controller, 'feedback-info?&account_id=' + _that.account_id + "&uuid=" + _that.uuid, {}, res => {
                    _that.feedbackInfo = res.data
                })
            },

            //获取回复的反馈ID号
            getFeedback(id = 0, index = '') {
                console.log(id);
                let _that = this
                _that.type = 'feedback'
                _that.feedbackId = id
                _that.currentIndex = index
                _that.currentCIndex = ''
                UE.getEditor("feedback-reply-container").setContent('')
            },

            //提交编辑
            submitConfirm() {
                let _that = this
                let replyContent = UE.getEditor("feedback-reply-container").getContent()

                if (_that.type == 'feedback') {

                    var data = {
                        feedback_id: _that.feedbackId,
                        content: replyContent
                    }
                    postRequest(controller, 'add-feedback-reply', data, res => {
                        if (res.data.code == 1) {
                            UE.getEditor("feedback-reply-container").setContent('')
                            _that.getFeedbackInfo()
                            _that.getFeedbackList()
                        }
                    })
                } else if (_that.type = 'reply') {

                    var data = {
                        reply_id: _that.replyId,
                        content: replyContent
                    }
                    postRequest(controller, 'edit-feedback-reply', data, res => {
                        if (res.data.code == 1) {
                            UE.getEditor("feedback-reply-container").setContent('')
                            _that.getFeedbackInfo()
                            _that.getFeedbackList()
                        }
                    })
                } else {
                    if (_that.feedbackId == 0) {
                        this.$message({
                            type: 'info',
                            message: '请先选择一个反馈进行回复'
                        });
                        return false
                    }
                }
            },

            // 删除回复
            delFeedbackReply(id = 0) {
                let _that = this
                this.$confirm('确定要删除该条回复吗?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    postRequest(controller, 'del-feedback-reply?id=' + id, {}, res => {
                        if (res.data.code == 1) {
                            _that.getFeedbackInfo()
                            _that.getFeedbackList()
                        }
                    })
                }).catch(() => {

                });
            },

            // 编辑回复
            getFeedbackReply(id = 0, pindex = '', cindex = '') {
                let _that = this
                _that.type = 'reply'
                _that.replyId = id
                _that.currentIndex = pindex
                _that.currentCIndex = cindex
                let content = _that.feedbackInfo[pindex]['children'][cindex].content
                UE.getEditor("feedback-reply-container").setContent(content)
            },

            // 查看账号信息
            viewAccountInfo(account_id = 0) {
                let _that = this
                _that.viewAccountId = account_id
                postRequest(controller, 'get-account-info?account_id=' + account_id, {}, res => {
                    console.log(res,222);
                    _that.accountInfo = res.data
                })
            },

            // 获取登陆码
            getloginCode(account_id=''){
                let _that = this
                console.log(account_id);
                postRequest(controller, 'get-login-code?account_id=' + account_id, {}, res => {
                    if (res.data.code == 1) {
                        _that.viewAccountInfo(account_id)
                    }
                })
            }
        }
    })
}

ud = initUe('feedback-reply-container')

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