/*
 * zxxFile.js 基于HTML5 文件上传的核心脚本 http://www.zhangxinxu.com/wordpress/?p=1923
 * by zhangxinxu 2011-09-12
*/
var ZXXFILE = {
	fileInput: null,				//html file控件
	url: "",						//ajax地址
	filteredFiles: [],					//过滤后的文件数组
	filter: function(files) {		// 选择文件组的过滤方法，如果返回的是空数组，则onSelect或者onAppendSelect
		return files;	
	},
	deal: function(lastFiles, files) {	//处理旧的和新输入的文件
		return (lastFiles || []).concat(files);
	},
	
	onSelect: function(filteredFiles) {},		//文件选择后
	onAppendSelect: function(filteredFiles) {},
	onDelete: function(deletedFile) {},		//文件删除后
	
	onProgress: function(file, loaded, total) {},		//文件上传进度
	dealResponse: function(xhr) { return false; },		//处理结果，如果返回的值==true，就不进行onSuccess或onFailed
	onSuccess: function(file, data) {},		//文件上传成功时
	onFailure: function(file, msg) {},		//文件上传失败时,
	onComplete: function() {},		//文件全部上传完毕时
	
	//删除对应的文件
	deleteFile: function(key) {
		var arrFile = [];
		for (var i = 0, file; file = this.filteredFiles[i]; i++) {
			if (file.index != key) {
				arrFile.push(file);
			} else {
				this.onDelete(file);
			}
		}
		this.filteredFiles = arrFile;
		this.__funReIndexFiles();
		return this;
	},
	
	//文件上传
	upload: function() {
		var self = this;	
		if (location.host.indexOf("sitepointstatic") >= 0) {
			//非站点服务器上运行
			return;	
		}
		var uploadCount = (self.filteredFiles || []).length;
		var uploadIndex = 0;
		function __upload(file) {
		    var xhr = new XMLHttpRequest();
		    if (xhr.upload) {
				// 上传中
				xhr.upload.addEventListener("progress", function(e) {
					self.onProgress(file, e.loaded, e.total);
				}, false);
				// 文件上传成功或是失败
				xhr.onreadystatechange = function(e) {
					if (xhr.readyState == 4) {
						if (self.dealResponse(xhr)) {
							next();
							return ;
						}
						if (xhr.status == 200) {
							// ***************************
							// 这边是我自己的处理
							// ***************************
							var myJsonResult = $.parseJSON(xhr.responseText);
							if (myJsonResult.code == 200) {
								self.onSuccess(file, myJsonResult.data);
							} else {
								self.onFailure(file, myJsonResult.msg);	
							}
						} else {
							self.onFailure(file, xhr.responseText);
						}
						next();
					}
				};
				// 开始上传
				xhr.open("POST", self.url, true);
				xhr.setRequestHeader("X_FILENAME", $.urlencode(file.name));
				xhr.send(file);
			}	
		}
		function next() {
		    var file = self.filteredFiles[uploadIndex];
		    if (!file) {
		        self.onComplete();
		        return;
		    }
		    __upload(file);
		    uploadIndex++;
		}
		next();
	},
	
	//获取选择文件，file控件或拖放
	__funGetFiles: function(e) {
		// 获取文件列表对象
		var files = e.target.files || e.dataTransfer.files;
		if (!files || (files['length'] && files.length < 1)) {
		    return this;
		}
		files = this.filter(files);
		if (!files || (files['length'] && files.length < 1)) {
		    return this;
		}
	    //继续添加文件
	    this.onAppendSelect(files);
		this.filteredFiles = this.deal(this.filteredFiles, files);
		this.__funDealFiles();
		return this;
	},
	
	__funDealFiles: function() {
		this.__funReIndexFiles();
		//执行选择回调
		this.onSelect(this.filteredFiles);
		return this;
	},
	
	__funReIndexFiles: function() {
	    for (var i = 0, file; file = this.filteredFiles[i]; i++) {
			//增加唯一索引值
			file.index = i;
		}
	},
	
	init: function() {
		var self = this;
		//文件选择控件选择
		if (this.fileInput) {
			this.fileInput.addEventListener("change", function(e) { self.__funGetFiles(e); }, false);	
		}
	}
};