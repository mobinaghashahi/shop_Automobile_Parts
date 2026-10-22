@once
    <link rel="stylesheet" href="{{ asset('css/product-delete-dialog.css') }}?v=1">
    <dialog id="product-delete-dialog" class="product-delete-dialog" dir="rtl" lang="fa"
            aria-labelledby="product-delete-title" aria-describedby="product-delete-description">
        <button type="button" class="product-delete-dialog__close" data-product-delete-cancel aria-label="بستن پنجره">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="m6 6 12 12M18 6 6 18"/>
            </svg>
        </button>
        <div class="product-delete-dialog__icon" aria-hidden="true">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 6h18M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2M5 6l1 14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1l1-14M10 10v7m4-7v7"/>
            </svg>
        </div>
        <h2 id="product-delete-title" class="product-delete-dialog__title">این محصول حذف شود؟</h2>
        <p id="product-delete-description" class="product-delete-dialog__description">
            با تأیید، محصول و تصاویر آن حذف می‌شوند.<br>این کار قابل بازگشت نیست.
        </p>
        <div class="product-delete-dialog__product">
            <div class="product-delete-dialog__thumbnail">
                <svg data-product-delete-placeholder width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path d="m12 3 9 5-9 5-9-5 9-5Zm-9 5v9l9 5 9-5V8M12 13v9M7.5 5.5l9 5"/>
                </svg>
                <img data-product-delete-image alt="" width="64" height="64" hidden>
            </div>
            <div class="product-delete-dialog__product-info">
                <p data-product-delete-name class="product-delete-dialog__product-name"></p>
                <span class="product-delete-dialog__product-label">کد محصول: <bdi data-product-delete-id dir="ltr"></bdi></span>
            </div>
        </div>
        <div class="product-delete-dialog__actions">
            <button type="button" class="product-delete-dialog__button product-delete-dialog__button--cancel" data-product-delete-cancel autofocus>انصراف</button>
            <button type="button" class="product-delete-dialog__button product-delete-dialog__button--confirm" data-product-delete-confirm>
                <span class="product-delete-dialog__spinner" aria-hidden="true" hidden></span>
                <span data-product-delete-confirm-label>بله، حذف محصول</span>
            </button>
        </div>
        <p class="product-delete-dialog__status" data-product-delete-status role="status" aria-live="polite"></p>
    </dialog>
    <script src="{{ asset('js/product-delete-dialog.js') }}?v=1" defer></script>
@endonce
