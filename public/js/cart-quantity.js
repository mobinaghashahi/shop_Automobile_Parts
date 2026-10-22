(() => {
    'use strict';

    const cart = document.querySelector('[data-cart]');
    if (!cart) return;
    let updating = false;

    const updateButtons = () => {
        cart.querySelectorAll('[data-cart-row]').forEach(row => {
            const quantity = Number(row.dataset.quantity);
            const maximum = Number(row.dataset.maxQuantity);
            row.querySelector('[data-cart-step="-1"]').disabled = updating || quantity <= 1;
            row.querySelector('[data-cart-step="1"]').disabled = updating || quantity >= maximum;
        });
        cart.querySelectorAll('[data-cart-checkout]').forEach(button => { button.disabled = updating; });
        cart.querySelectorAll('[data-cart-remove]').forEach(link => {
            if (updating) link.setAttribute('aria-disabled', 'true');
            else link.removeAttribute('aria-disabled');
        });
    };

    const feedback = (row, message, state) => {
        const element = row.querySelector('[data-cart-feedback]');
        element.textContent = message;
        element.dataset.state = state;
    };

    cart.addEventListener('submit', event => {
        if (updating) event.preventDefault();
    });

    cart.addEventListener('click', async event => {
        if (updating && event.target.closest('[data-cart-remove]')) {
            event.preventDefault();
            return;
        }
        const button = event.target.closest('[data-cart-step]');
        if (!button || !cart.contains(button) || updating || button.disabled) return;

        const row = button.closest('[data-cart-row]');
        const currentQuantity = Number(row.dataset.quantity);
        const maximum = Number(row.dataset.maxQuantity);
        const step = Number(button.dataset.cartStep);
        let nextQuantity = currentQuantity + step;
        // If inventory decreased since adding the item, a minus click can bring it back within stock.
        if (step < 0 && maximum > 0) nextQuantity = Math.min(nextQuantity, maximum);
        if (nextQuantity < 1 || nextQuantity > maximum) {
            feedback(row, 'تعداد انتخاب‌شده باید بین ۱ و موجودی محصول باشد.', 'error');
            return;
        }

        updating = true;
        cart.setAttribute('aria-busy', 'true');
        row.setAttribute('aria-busy', 'true');
        updateButtons();
        feedback(row, 'در حال به‌روزرسانی…', 'loading');

        try {
            const response = await fetch(button.dataset.url, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': cart.dataset.csrfToken,
                },
                body: JSON.stringify({ id: Number(row.dataset.productId), count: nextQuantity }),
            });

            if (response.status === 419) {
                throw new Error('نشست شما منقضی شده است. صفحه را دوباره باز کنید.');
            }
            if (!response.headers.get('content-type')?.includes('application/json')) {
                throw new Error('تغییر تعداد انجام نشد. دوباره تلاش کنید.');
            }
            const data = await response.json();
            if (!response.ok) {
                const messages = Object.values(data.errors || {}).flat();
                throw new Error(messages[0] || 'تغییر تعداد انجام نشد. دوباره تلاش کنید.');
            }
            if (Number(data.productId) !== Number(row.dataset.productId) || !Number.isInteger(data.quantity)) {
                throw new Error('تغییر تعداد انجام نشد. دوباره تلاش کنید.');
            }

            row.dataset.quantity = String(data.quantity);
            row.dataset.maxQuantity = String(data.maxQuantity);
            row.querySelector('[data-cart-quantity]').value = String(data.quantity);
            row.querySelector('[data-cart-line-total]').textContent = data.lineTotalFormatted;
            cart.querySelector('[data-cart-total]').textContent = data.totalPriceFormatted;
            feedback(row, 'تعداد به‌روزرسانی شد.', 'success');
        } catch (error) {
            const message = error instanceof TypeError
                ? 'ارتباط با سرور برقرار نشد. دوباره تلاش کنید.'
                : error.message;
            feedback(row, message, 'error');
        } finally {
            updating = false;
            cart.removeAttribute('aria-busy');
            row.removeAttribute('aria-busy');
            updateButtons();
        }
    });

    updateButtons();
})();
