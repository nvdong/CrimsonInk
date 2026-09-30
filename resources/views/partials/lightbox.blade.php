<div class="ci-lightbox" id="ci-lightbox" role="dialog" aria-modal="true" aria-label="CrimsonInk Tattoo Studio" hidden>
	<button class="ci-lightbox__btn ci-lightbox__close" type="button" data-ci-act="close" aria-label="Đóng">
		<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M18.3 5.71 12 12.01l-6.3-6.3-1.41 1.41 6.3 6.3-6.3 6.29 1.41 1.42 6.3-6.3 6.3 6.3 1.41-1.42-6.3-6.29 6.3-6.3z"/></svg>
	</button>
	<button class="ci-lightbox__btn ci-lightbox__prev" type="button" data-ci-act="prev" aria-label="Ảnh trước">
		<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M15.41 7.41 14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>
	</button>
	<div class="ci-lightbox__stage" data-ci-act="close">
		<img class="ci-lightbox__img" src="" alt="CrimsonInk Tattoo Studio" hidden />
		<div class="ci-lightbox__frame" hidden></div>
	</div>
	<button class="ci-lightbox__btn ci-lightbox__next" type="button" data-ci-act="next" aria-label="Ảnh sau">
		<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M10 6 8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
	</button>
	<span class="ci-lightbox__counter" aria-live="polite"></span>
</div>
@push('scripts')
<script id="ci-gallery-lightbox-js">
(function () {
	var links = [].slice.call(document.querySelectorAll('[data-ci-lightbox]'));
	var box   = document.getElementById('ci-lightbox');

	if (!links.length || !box) {
		return;
	}

	var img     = box.querySelector('.ci-lightbox__img');
	var frame   = box.querySelector('.ci-lightbox__frame');
	var counter = box.querySelector('.ci-lightbox__counter');
	var index   = 0;
	var lastFocus = null;

	// Chỉ hiện mũi tên khi có từ 2 ảnh trở lên.
	if (links.length < 2) {
		box.classList.add('ci-lightbox--single');
	}

	function show(i) {
		index = (i + links.length) % links.length;

		var link = links[index];
		var url  = link.getAttribute('href');
		var type = link.getAttribute('data-ci-type');

		frame.innerHTML = '';

		if (type === 'video') {
			img.hidden = true;
			frame.hidden = false;
			frame.innerHTML = '<video class="ci-lightbox__media" src="' + url + '" controls autoplay playsinline></video>';
		} else if (type === 'embed') {
			img.hidden = true;
			frame.hidden = false;
			frame.innerHTML = '<iframe class="ci-lightbox__media" src="' + url + '" allow="autoplay; fullscreen" allowfullscreen title="CrimsonInk Tattoo Studio"></iframe>';
		} else {
			frame.hidden = true;
			img.hidden = false;
			img.src = url;
		}

		counter.textContent = (index + 1) + ' / ' + links.length;
	}

	function open(i) {
		lastFocus = document.activeElement;
		show(i);
		box.hidden = false;
		document.body.classList.add('ci-lightbox-open');
		box.querySelector('.ci-lightbox__close').focus();
	}

	function close() {
		box.hidden = true;
		document.body.classList.remove('ci-lightbox-open');
		img.removeAttribute('src');
		frame.innerHTML = '';

		if (lastFocus && lastFocus.focus) {
			lastFocus.focus();
		}
	}

	links.forEach(function (link, i) {
		link.addEventListener('click', function (e) {
			e.preventDefault();
			open(i);
		});
	});

	box.addEventListener('click', function (e) {
		var target = e.target.closest ? e.target.closest('[data-ci-act]') : null;

		if (!target) {
			return;
		}

		e.preventDefault();

		var action = target.getAttribute('data-ci-act');

		if (action === 'close') {
			close();
		} else if (action === 'prev') {
			show(index - 1);
		} else if (action === 'next') {
			show(index + 1);
		}
	});

	document.addEventListener('keydown', function (e) {
		if (box.hidden) {
			return;
		}

		if (e.key === 'Escape') {
			close();
		} else if (e.key === 'ArrowLeft') {
			show(index - 1);
		} else if (e.key === 'ArrowRight') {
			show(index + 1);
		}
	});
})();
//# sourceURL=ci-gallery-lightbox-js
</script>
@endpush
