(function (window) {
	'use strict';
	function MobileDetect(userAgent) { this.ua = userAgent || ''; }
	MobileDetect.prototype.mobile = function () {
		return /Android|iPhone|iPod|IEMobile|Opera Mini/i.test(this.ua) ||
			(window.matchMedia && window.matchMedia('(max-width: 767px), (pointer: coarse)').matches);
	};
	MobileDetect.prototype.tablet = function () {
		return /iPad|Tablet/i.test(this.ua) ||
			(window.matchMedia && window.matchMedia('(min-width: 768px) and (max-width: 1024px) and (pointer: coarse)').matches);
	};
	MobileDetect.prototype.phone = MobileDetect.prototype.mobile;
	window.MobileDetect = MobileDetect;
})(window);
