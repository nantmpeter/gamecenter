/**
 * JSSlide
 * @author YJC (web.4399.com)
 */
function JSSlide(varName, option) {
	this.o = option;
	this.varName = varName;
	this.container = $("#" + this.o.container);
	this.initVars();
	this.imgs = 0;
	this.allImg = this.o.src.length;
	this.lastImg = 0;
	this.allLoaded = false;
	this.firstImg = this.container.find("img");
	this.container.append('<p class="' + this.o.pClass + '"></p>');
	this.container.find("p").append('<ul></ul>');
	this.tagContainer = this.container.find("p ul");
	this.container.append('<p id="' + this.o.container + '_title' + '" class="' + this.o.titleClass + '"></p>');
	this.titleContainer = this.container.find("p#" + this.o.container + '_title');
	this.addImgDiv();
}
JSSlide.prototype.addImgDiv = function() {
	this.container.append('<div id="' + this.o.container + '_each_' + this.imgs + '" style="display:none;" class="' + this.o.divClass + '"></div>');
	this.container.find("div#" + this.o.container + '_each_' + this.imgs).html(
		'<p class="' + this.o.titleClass + '">' + this.o.title[this.imgs] + '</p>' +
		'<a class="' + this.o.aClass + '" href="' + this.o.href[this.imgs] + '" ' + this.o.aTarget + '>' +
		'<img src="' + this.o.src[this.imgs] + '" width="' + this.o.imgWidth + '" height="' + this.o.imgHeight +
			'" alt="' + (++(this.imgs)) + '" onload="' + this.parent + '.' + this.varName + '.imgLoaded(this);"/></a>' +
		'</div>');
}
JSSlide.prototype.initVars = function() {
	var i, each, defaultClass = [ // 设置默认样式
		'divClass', // 每个幻灯片的容器 DIV > P: 标题, A: 链接
		'titleClass', // 标题容器 P
		'aClass', // 图片容器 A > IMG: 图片
		'pClass', // 切换标签容器 P > UL > LI
		'tagClass', // 标签容器 LI
		'activeClass' // 选中的标签
	];
	for (i in defaultClass) {
		if (typeof this.o[defaultClass[i]] == 'undefined') this.o[defaultClass[i]] = defaultClass[i];
	}
	if ( ! this.container.height()) {
		this.container.css({
			"width":"200px",
			"height":"160px"
		});
	}
	if (typeof this.o.each != 'undefined') {
		this.o.title = []; // 幻灯片标题
		this.o.href = []; // 幻灯片转跳链接
		this.o.src = []; // 幻灯片图片地址
		for (i in this.o.each) {
			each = this.o.each[i].split('|');
			this.o.title[i] = each[0];
			this.o.href[i] = each[1];
			this.o.src[i] = each[2];
		}
	}
	delete this.o.each;
	if (typeof this.o.imgWidth == 'undefined') this.o.imgWidth = this.container.width();
	if (typeof this.o.imgHeight == 'undefined') this.o.imgHeight = this.container.height();
	if (typeof this.o.interval == 'undefined') this.o.interval = 8000; // 切换间隔时间
	if (typeof this.o.fadeTime == 'undefined') this.o.fadeTime = 300; // 淡出动画持续时间
	if (typeof this.o.fadeTimeIn == 'undefined') this.o.fadeTimeIn = 1000; // 淡入动画持续时间
	if (typeof this.o.tagStop == 'undefined') this.o.tagStop = 100; // 触发幻灯片切换的停留在标签的时间
	if (typeof this.o.aTarget == 'undefined') this.o.aTarget = 'target="_blank"'; // 点击图片转跳的target
	if (typeof this.o.lazyLoad == 'undefined') this.o.lazyLoad = 0; // 图片延时加载时间，此选项大于0时在IE下有bug
	if (typeof this.o.parent == 'undefined') this.parent = 'window'; // 实例化的幻灯片对象的父级对象
	else this.parent = this.o.parent;
}
JSSlide.prototype.imgLoaded = function(img) {
	if (this.allLoaded) return;
	if (this.imgs == 1) {
		this.lastTime = (new Date()).getTime();
		this.show();
		this.firstImg.remove();
	}
	if (this.imgs == 2 && (new Date()).getTime() - this.lastTime >= this.o.interval) {
		clearTimeout(this.timer);
		this.show(1);
	}
	this.tagContainer.append('<li id="' + this.o.container + '_tag_' + (this.imgs - 1) + '" class="' + this.o.tagClass + '" ' +
		' onmouseover="' + this.parent + '.' + this.varName + '.imgSelect(this);"' +
		' onmouseout="' + this.parent + '.' + this.varName + '.tagOut();">' + this.imgs + '</li>');
	if (this.imgs < this.o.src.length) {
		if (this.o.lazyLoad)
			setTimeout(this.parent + '.' + this.varName + '.addImgDiv()', this.o.lazyLoad);
		else
			this.addImgDiv();
	}
	else this.allLoaded = true;
}
JSSlide.prototype.show = function(i, stop) {
	if (typeof i != 'undefined') this.lastImg = i;
	else if (this.lastImg == this.imgs - 1) this.lastImg = 0;
	else this.lastImg ++;
	if (stop) {
		this.container.find("div:visible").hide();
		this.showIn(stop);
	} else {
		this.container.find("div:visible").fadeOut(this.o.fadeTime);
		this.timer = setTimeout(this.parent + '.' + this.varName + '.showIn(' + stop + ')', this.o.fadeTime * 1.2);
	}
}
JSSlide.prototype.showIn = function(stop) {
	clearTimeout(this.timer);
	var div = this.container.find("div#" + this.o.container + '_each_' + this.lastImg);
	if (stop && ! this.o.tagStop) {
		div.show();
	} else {
		div.fadeIn(this.o.fadeTimeIn);
	}
	this.tagContainer.find("li").attr('class', this.o.tagClass);
	this.tagContainer.find("li#" + this.o.container + '_tag_' + this.lastImg).attr('class', this.o.activeClass);
	this.titleContainer.html(div.find('p').html());
	if ( ! stop && this.allImg > 1) {
		this.timer = setTimeout(this.parent + '.' + this.varName + '.show()', this.o.interval);
	}
}
JSSlide.prototype.imgSelect = function(img) {
	img = parseInt($(img).html()) - 1;
	if (this.o.tagStop)
		this.tagTimer = setTimeout(this.parent + '.' + this.varName + '.imgChange(' + img + ')', this.o.tagStop);
	else
		this.imgChange(img);
}
JSSlide.prototype.tagOut = function() {
	if (this.o.tagStop) clearTimeout(this.tagTimer);
	clearTimeout(this.timer);
	this.timer = setTimeout(this.parent + '.' + this.varName + '.show()', this.o.interval);
}
JSSlide.prototype.imgChange = function(i) {
	clearTimeout(this.timer);
	this.show(i, true);
}
