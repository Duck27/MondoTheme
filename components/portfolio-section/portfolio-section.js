(function () {
  const section = document.querySelector('.portfolio-section');
  if (!section) {
    return;
  }

  const popup = document.getElementById('portfolio-popup');
  const popupTags = document.getElementById('portfolio-popup-tags');
  const popupTitle = document.getElementById('portfolio-popup-title');
  const popupText = document.getElementById('portfolio-popup-text');
  const moreButtons = section.querySelectorAll('.portfolio-section__more');
  const POPUP_TRANSITION_MS = 320;
  let closeTimer = null;

  function getScrollbarWidth() {
    return window.innerWidth - document.documentElement.clientWidth;
  }

  function lockScroll() {
    const scrollbarWidth = getScrollbarWidth();
    document.body.style.overflow = 'hidden';

    if (scrollbarWidth > 0) {
      document.body.style.paddingRight = scrollbarWidth + 'px';
    }
  }

  function unlockScroll() {
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
  }

  function openPopup(title, tags, text) {
    if (!popup || !popupTitle || !popupText || !popupTags) {
      return;
    }

    if (closeTimer) {
      clearTimeout(closeTimer);
      closeTimer = null;
    }

    popupTags.textContent = '*' + tags + '*';
    popupTitle.textContent = title;
    popupText.textContent = text;
    popup.hidden = false;

    requestAnimationFrame(function () {
      popup.classList.add('portfolio-popup--visible');
    });

    lockScroll();
  }

  function closePopup() {
    if (!popup || popup.hidden) {
      return;
    }

    popup.classList.remove('portfolio-popup--visible');

    closeTimer = window.setTimeout(function () {
      popup.hidden = true;
      unlockScroll();
      closeTimer = null;
    }, POPUP_TRANSITION_MS);
  }

  moreButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      openPopup(
        button.dataset.popupTitle || '',
        button.dataset.popupTags || '',
        button.dataset.popupText || ''
      );
    });
  });

  if (popup) {
    popup.querySelectorAll('[data-popup-close]').forEach(function (element) {
      element.addEventListener('click', closePopup);
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && !popup.hidden) {
        closePopup();
      }
    });
  }
})();
