(function ($) {
	'use strict';

	function sync($form) {
		var isLoop = $form.hasClass('variations_form_loop');
		var hasUserSelection = !!$form.data('belctech-user-selection');
		$form.find('.variable-items-wrapper').each(function () {
			var $list = $(this);
			var $select = $list.siblings('select').first();
			$list.children('.variable-item').each(function () {
				var $item = $(this);
				var value = String($item.data('value'));
				var available = $select.find('option:enabled').filter(function () {
					return String(this.value) === value;
				}).length > 0;
				$item.toggleClass('disabled', !available).attr('aria-disabled', available ? 'false' : 'true');
				var selected = (!isLoop || hasUserSelection) && String($select.val()) === value;
				$item.toggleClass('selected', selected).attr('aria-checked', selected ? 'true' : 'false');
			});
		});
	}

	function clearCardSelections($scope) {
		$scope.find('.belctech-card-swatches').each(function () {
			$(this).removeClass('has-user-selection').children('.variable-item').removeClass('selected').attr('aria-checked', 'false');
		});
		$scope.find('form.variations_form_loop').each(function () {
			var $form = $(this);
			if ($form.data('belctech-user-selection')) return;
			$form.find('select').val('');
			$form.find('.variable-item').removeClass('selected').attr('aria-checked', 'false');
			$form.find('.variation_id').val('0');
		});
	}

	function updateFilterCount() {
		var count = 0;
		try {
			var params = new URLSearchParams(window.location.search);
			params.forEach(function (value, key) {
				if (key.indexOf('filter_') === 0 && value) count += value.split(',').filter(Boolean).length;
			});
			if (params.has('min_price') || params.has('max_price')) count += 1;
			if (params.has('rating_filter')) count += 1;
			if (params.get('on_sale') === '1') count += 1;
		} catch (error) {
			count = $('#side-filters .widget_layered_nav .chosen, #side-filters .widget_layered_nav_filters li').length;
		}
		var $counter = $('.et-active-filters-count');
		$counter.text(count || '').toggleClass('active', count > 0);
	}

	var filterPanelKey = 'belctech_filter_panel_open';
	var filterNoticeKey = 'belctech_filter_notice';

	function filterStorage(action, key, value) {
		try {
			if (action === 'set') window.sessionStorage.setItem(key, value || '1');
			if (action === 'get') return window.sessionStorage.getItem(key);
			if (action === 'remove') window.sessionStorage.removeItem(key);
		} catch (error) {
			return null;
		}
		return null;
	}

	function showFilterFeedback(message, loading) {
		var $panel = $('#side-filters');
		if (!$panel.length) return;
		var $feedback = $panel.find('.belctech-filter-feedback');
		if (!$feedback.length) {
			$feedback = $('<div class="belctech-filter-feedback" role="status" aria-live="polite"></div>');
			$panel.find('.side-panel-content').prepend($feedback);
		}
		$feedback.text(message).toggleClass('is-loading', !!loading).addClass('is-visible');
	}

	function keepFilterPanelOpen(message) {
		var $panel = $('#side-filters');
		if (!$panel.length) return;
		$('body').addClass('panel-open-filters');
		$('html').css({ width: 'auto', overflow: 'hidden' });
		$panel.attr('aria-hidden', 'false');
		if (message) showFilterFeedback(message, false);
		updateFilterCount();
	}

	function rememberFilterPanel() {
		filterStorage('set', filterPanelKey, '1');
		filterStorage('set', filterNoticeKey, 'Filtro aplicado. Puedes elegir más opciones o cerrar cuando termines.');
		showFilterFeedback('Aplicando filtro...', true);
	}

	function orderProductAttributes() {
		$('.single-product .product-showcase form.variations_form table.variations tbody').each(function () {
			var $body = $(this);
			var $size = $body.find('select[name="attribute_pa_talla"]').closest('tr');
			var $color = $body.find('select[name="attribute_pa_color"]').closest('tr');
			if ($size.length) $body.prepend($size);
			if ($color.length && $size.length) $color.insertAfter($size);
		});
	}

	function updateTallProductLayout() {
		var $detail = $('.single-product .et-product-detail').first();
		var $showcase = $detail.find('.product-showcase.showcase-active').first();
		var $summary = $showcase.find('.entry-summary').first();
		if (!$showcase.length || !$summary.length) return;
		var available = Math.max(600, window.innerHeight - 90);
		var contentHeight = 80;
		$summary.children(':visible').each(function () { contentHeight += $(this).outerHeight(true) || 0; });
		var isTall = $detail.hasClass('product-type-wgm_gift_card') || contentHeight > available;
		$detail.toggleClass('belctech-product-content-tall', isTall);
	}

	function cardImageState($product, $image) {
		var state = $product.data('belctech-card-original-image');
		if (state) return state;

		state = {
			src: String($image.attr('data-src') || $image.attr('data-lazy-src') || $image.attr('src') || ''),
			srcset: String($image.attr('data-srcset') || $image.attr('data-lazy-srcset') || $image.attr('srcset') || ''),
			sizes: String($image.attr('data-sizes') || $image.attr('sizes') || '')
		};
		$product.data('belctech-card-original-image', state);
		return state;
	}

	function optionalImageAttribute($image, name, value) {
		if (value) $image.attr(name, value);
		else $image.removeAttr(name);
	}

	function loadCardHoverImage($product) {
		var $image = $product.find('img.product_thumbnail_hover[data-belctech-hover-src]').first();
		if (!$image.length) return;
		$image.attr('src', $image.attr('data-belctech-hover-src'));
		optionalImageAttribute($image, 'srcset', String($image.attr('data-belctech-hover-srcset') || ''));
		optionalImageAttribute($image, 'sizes', String($image.attr('data-belctech-hover-sizes') || ''));
		$image.removeAttr('data-belctech-hover-src data-belctech-hover-srcset data-belctech-hover-sizes');
	}

	$(document.body).on('click', '.variable-items-wrapper:not(.belctech-card-swatches) .variable-item', function (event) {
		var $item = $(this);
		if ($item.hasClass('disabled')) return;
		var $list = $item.closest('.variable-items-wrapper');
		var $select = $list.siblings('select').first();
		event.preventDefault();
		$item.closest('form.variations_form_loop').data('belctech-user-selection', true);
		$list.children().removeClass('selected');
		$item.addClass('selected');
		$select.val($item.data('value')).trigger('change');
	});

	$(document.body).on('click', '.belctech-card-swatches .variable-item', function (event) {
		var $item = $(this);
		if ($item.hasClass('disabled')) return;
		event.preventDefault();
		event.stopPropagation();

		var $product = $item.closest('.product');
		var $image = $product.find('img.main-image').first();
		$item.parent().addClass('has-user-selection');
		$item.siblings().removeClass('selected').attr('aria-checked', 'false');
		$item.addClass('selected').attr('aria-checked', 'true');

		if (!$image.length) return;
		var original = cardImageState($product, $image);
		var imageUrl = String($item.attr('data-card-image') || original.src || '');
		var previousUrl = String($image.attr('data-src') || $image.attr('data-lazy-src') || $image.attr('src') || '');
		var restoringOriginal = imageUrl === original.src;

		if (!imageUrl || imageUrl === previousUrl) {
			$product.toggleClass('wvs-img-replaced', !restoringOriginal).removeClass('belctech-card-image-loading');
			return;
		}

		$product.addClass('belctech-card-image-loading');
		$product.data('belctech-card-image-request', imageUrl);
		var preload = new Image();
		preload.onload = function () {
			if ($product.data('belctech-card-image-request') !== imageUrl) return;
			$image.attr({
				'src': imageUrl,
				'data-src': imageUrl,
				'data-lazy-src': imageUrl
			});

			if (restoringOriginal) {
				optionalImageAttribute($image, 'srcset', original.srcset);
				optionalImageAttribute($image, 'data-srcset', original.srcset);
				optionalImageAttribute($image, 'data-lazy-srcset', original.srcset);
				optionalImageAttribute($image, 'sizes', original.sizes);
				optionalImageAttribute($image, 'data-sizes', original.sizes);
			} else {
				$image.removeAttr('srcset data-srcset data-lazy-srcset sizes data-sizes');
			}

			$product.toggleClass('wvs-img-replaced', !restoringOriginal).removeClass('belctech-card-image-loading');
		};
		preload.onerror = function () {
			if ($product.data('belctech-card-image-request') === imageUrl) $product.removeClass('belctech-card-image-loading');
		};
		preload.src = imageUrl;
	});

	$(document.body).on('keydown', '.variable-items-wrapper .variable-item', function (event) {
		if (event.key === 'Enter' || event.key === ' ') {
			event.preventDefault();
			$(this).trigger('click');
		}
	});

	$(document.body).on('mouseenter focusin', '.products .product', function () {
		loadCardHoverImage($(this));
	});

	$(document).on('click', '#side-filters a[href]:not(.et-close)', rememberFilterPanel);
	$(document).on('submit', '#side-filters form', rememberFilterPanel);
	$(document).on('click', '#side-filters .et-close, .click-capture', function () {
		filterStorage('remove', filterPanelKey);
		filterStorage('remove', filterNoticeKey);
		$('#side-filters .belctech-filter-feedback').removeClass('is-visible');
	});

	$(document).on('woof_ajax_done yith-wcan-ajax-filtered wcapf_after_update', function () {
		keepFilterPanelOpen('Filtro aplicado. Puedes seguir agregando opciones.');
	});

	$(document.body).on('woocommerce_update_variation_values found_variation reset_data', 'form.variations_form, form.variations_form_loop', function () {
		sync($(this));
	});

	$(function () {
		clearCardSelections($(document));
		$('form.variations_form, form.variations_form_loop').each(function () { sync($(this)); });
		orderProductAttributes();
		updateTallProductLayout();
		if (window.ResizeObserver) {
			var summary = document.querySelector('.single-product .product-showcase.showcase-active .entry-summary');
			if (summary) new ResizeObserver(updateTallProductLayout).observe(summary);
		}
		updateFilterCount();
		if (filterStorage('get', filterPanelKey)) {
			var notice = filterStorage('get', filterNoticeKey) || 'Filtros actualizados.';
			filterStorage('remove', filterPanelKey);
			filterStorage('remove', filterNoticeKey);
			window.setTimeout(function () { keepFilterPanelOpen(notice); }, 0);
		}
	});

	$(window).on('load resize', updateTallProductLayout);
	$(window).on('popstate', updateFilterCount);
})(jQuery);
