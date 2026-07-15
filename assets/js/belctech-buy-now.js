(function ($) {
	'use strict';

	var $modal = $();
	var $dialog = $();
	var $frame = $();
	var $loader = $();
	var lastFocused = null;

	function cacheModal() {
		$modal = $('#belctech-buy-now-modal');
		$dialog = $modal.find('.belctech-buy-now-modal__dialog');
		$frame = $modal.find('iframe');
		$loader = $modal.find('.belctech-buy-now-modal__loader');
	}

	function showNotices(html, $form) {
		if (!html) return;
		var $target = $('.woocommerce-notices-wrapper').first();
		if (!$target.length) {
			$target = $('<div class="woocommerce-notices-wrapper" />');
			$form.before($target);
		}
		$target.html(html);
		$target.get(0).scrollIntoView({ behavior: 'smooth', block: 'center' });
	}

	function openModal(url) {
		if (!$modal.length) cacheModal();
		if (!$modal.length) {
			window.location.assign(url);
			return;
		}

		lastFocused = document.activeElement;
		$loader.text(belctech_buy_now_vars.l10n.loading).removeClass('is-hidden');
		$frame.removeClass('is-ready').attr('src', url);
		$modal.prop('hidden', false).attr('aria-hidden', 'false');
		$('body').addClass('belctech-buy-now-open');
		window.requestAnimationFrame(function () {
			$modal.addClass('is-open');
			$dialog.trigger('focus');
		});
	}

	function closeModal() {
		if (!$modal.length) return;
		$modal.removeClass('is-open').attr('aria-hidden', 'true');
		$('body').removeClass('belctech-buy-now-open');
		window.setTimeout(function () {
			$modal.prop('hidden', true);
			$frame.removeClass('is-ready').attr('src', 'about:blank');
		}, 180);
		if (lastFocused && typeof lastFocused.focus === 'function') lastFocused.focus();
	}

	function prepareCheckout($button) {
		var $form = $button.closest('form.cart');
		var $addButton = $form.find('.single_add_to_cart_button').first();
		if (!$form.length) return;

		if ($addButton.hasClass('disabled') || $addButton.hasClass('wc-variation-selection-needed')) {
			$addButton.trigger('click');
			return;
		}

		var formData = new FormData($form.get(0));
		formData.set('add-to-cart', $button.data('product-id') || $button.val());
		formData.set('belctech_buy_now_popup', '1');
		formData.set('belctech_atc_nonce', belctech_buy_now_vars.nonce);

		$button.prop('disabled', true).addClass('et-loader is-preparing').attr('aria-busy', 'true');

		$.ajax({
			url: $form.attr('action') || window.location.href,
			type: 'POST',
			data: formData,
			dataType: 'json',
			processData: false,
			contentType: false,
			cache: false
		}).done(function (response) {
			if (!response || !response.success || !response.data || !response.data.checkout_url) {
				showNotices(response && response.data ? response.data.notices : '', $form);
				return;
			}
			$(document.body).trigger('wc_fragment_refresh');
			openModal(response.data.checkout_url);
		}).fail(function (xhr) {
			var payload = xhr.responseJSON && xhr.responseJSON.data ? xhr.responseJSON.data : {};
			if (payload.notices) {
				showNotices(payload.notices, $form);
			} else {
				showNotices('<ul class="woocommerce-error" role="alert"><li>' + belctech_buy_now_vars.l10n.error + '</li></ul>', $form);
			}
		}).always(function () {
			$button.prop('disabled', false).removeClass('et-loader is-preparing').removeAttr('aria-busy');
		});
	}

	$(document).on('click', '.belctech-buy-now-popup-button', function (event) {
		event.preventDefault();
		event.stopImmediatePropagation();
		prepareCheckout($(this));
	});

	$(document).on('click', '[data-belctech-buy-now-close]', function (event) {
		event.preventDefault();
		closeModal();
	});

	$(document).on('keydown', function (event) {
		if (!$modal.length || !$modal.hasClass('is-open')) return;
		if (event.key === 'Escape') {
			closeModal();
			return;
		}
		if (event.key !== 'Tab') return;

		var $focusable = $dialog.find('a:visible, button:visible, iframe:visible, [tabindex]:visible').filter(':not([tabindex="-1"])');
		if (!$focusable.length) return;
		var first = $focusable.get(0);
		var last = $focusable.get($focusable.length - 1);
		if (event.shiftKey && document.activeElement === first) {
			event.preventDefault();
			last.focus();
		} else if (!event.shiftKey && document.activeElement === last) {
			event.preventDefault();
			first.focus();
		}
	});

	$(function () {
		cacheModal();
		$frame.on('load', function () {
			if ($frame.attr('src') === 'about:blank') return;
			$frame.addClass('is-ready');
			$loader.addClass('is-hidden');
		});
	});
})(jQuery);
