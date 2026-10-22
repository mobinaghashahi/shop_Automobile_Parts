(() => {
    'use strict';

    const dialog = document.getElementById('product-delete-dialog');
    if (!dialog || typeof dialog.showModal !== 'function') return;

    const image = dialog.querySelector('[data-product-delete-image]');
    const placeholder = dialog.querySelector('[data-product-delete-placeholder]');
    const confirmButton = dialog.querySelector('[data-product-delete-confirm]');
    const confirmLabel = dialog.querySelector('[data-product-delete-confirm-label]');
    const spinner = dialog.querySelector('.product-delete-dialog__spinner');
    const status = dialog.querySelector('[data-product-delete-status]');
    const cancelButtons = dialog.querySelectorAll('[data-product-delete-cancel]');
    let selectedForm = null;
    let trigger = null;
    let busy = false;

    const resetBusy = () => {
        busy = false;
        confirmButton.disabled = false;
        cancelButtons.forEach(button => { button.disabled = false; });
        confirmLabel.textContent = 'بله، حذف محصول';
        spinner.hidden = true;
        status.textContent = '';
        dialog.removeAttribute('aria-busy');
        if (trigger) trigger.disabled = false;
    };

    const close = () => {
        if (!busy) dialog.close();
    };

    image.addEventListener('load', () => {
        image.hidden = false;
        placeholder.setAttribute('hidden', '');
    });
    image.addEventListener('error', () => {
        image.hidden = true;
        placeholder.removeAttribute('hidden');
    });

    document.addEventListener('click', event => {
        const button = event.target.closest('[data-product-delete-trigger]');
        if (!button || busy || dialog.open) return;
        const form = button.form;
        if (!form || !form.matches('[data-product-delete]')) return;

        event.preventDefault();
        resetBusy();
        trigger = button;
        selectedForm = form;
        dialog.querySelector('[data-product-delete-name]').textContent = form.dataset.productName;
        dialog.querySelector('[data-product-delete-id]').textContent = '#' + form.dataset.productId;
        image.hidden = true;
        placeholder.removeAttribute('hidden');
        image.src = form.dataset.productImage;
        document.body.classList.add('product-delete-open');
        dialog.showModal();
    });

    // Opening the dialog never sends a request, including an implicit form submission.
    document.addEventListener('submit', event => {
        if (event.target.matches('form[data-product-delete]')) event.preventDefault();
    });

    cancelButtons.forEach(button => { button.addEventListener('click', close); });
    dialog.addEventListener('cancel', event => {
        if (busy) event.preventDefault();
    });
    dialog.addEventListener('click', event => {
        if (event.target !== dialog) return;
        const bounds = dialog.getBoundingClientRect();
        if (event.clientX < bounds.left || event.clientX > bounds.right ||
            event.clientY < bounds.top || event.clientY > bounds.bottom) close();
    });
    dialog.addEventListener('close', () => {
        document.body.classList.remove('product-delete-open');
        resetBusy();
        selectedForm = null;
        if (trigger && trigger.isConnected) trigger.focus({ preventScroll: true });
        trigger = null;
    });

    confirmButton.addEventListener('click', () => {
        if (!selectedForm || busy) return;
        busy = true;
        dialog.setAttribute('aria-busy', 'true');
        confirmButton.disabled = true;
        cancelButtons.forEach(button => { button.disabled = true; });
        trigger.disabled = true;
        spinner.hidden = false;
        confirmLabel.textContent = 'در حال حذف…';
        status.textContent = 'در حال حذف محصول، لطفاً منتظر بمانید.';

        // Send the original form with its DELETE override and CSRF token only after confirmation.
        HTMLFormElement.prototype.submit.call(selectedForm);
    });

    window.addEventListener('pageshow', event => {
        if (event.persisted) {
            resetBusy();
            if (dialog.open) dialog.close();
        }
    });
})();
