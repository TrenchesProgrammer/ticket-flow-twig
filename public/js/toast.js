document.addEventListener('DOMContentLoaded', () => {
    const toast = document.getElementById('toast-notification');
    if (toast) {
        // Show toast
        toast.classList.remove('hidden');

        // Hide toast after 5 seconds
        setTimeout(() => {
            toast.classList.add('hidden');
            toast.remove(); // Remove from DOM after hiding
        }, 5000);

        // Close button functionality
        const closeButton = toast.querySelector('[data-dismiss-target="#toast-notification"]');
        if (closeButton) {
            closeButton.addEventListener('click', () => {
                toast.classList.add('hidden');
                toast.remove();
            });
        }
    }
});