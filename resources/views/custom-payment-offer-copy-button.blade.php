<div class="mt-4">
    <button 
        type="button"
        onclick="copyPaymentLink(event, '{{ addslashes($paymentLink) }}')"
        class="inline-flex items-center justify-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors duration-200"
    >
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
        </svg>
        Copy Payment Link
    </button>
</div>

<script>
function copyPaymentLink(event, link) {
    event.preventDefault();
    
    // Try clipboard API first
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(link)
            .then(() => {
                showSuccessMessage(event.target.closest('button'));
            })
            .catch(() => {
                // Fallback to old method
                fallbackCopy(link, event.target.closest('button'));
            });
    } else {
        // Use fallback for older browsers
        fallbackCopy(link, event.target.closest('button'));
    }
}

function fallbackCopy(text, button) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    document.body.appendChild(textarea);
    textarea.select();
    
    try {
        document.execCommand('copy');
        showSuccessMessage(button);
    } catch (err) {
        console.error('Fallback copy failed:', err);
        alert('Failed to copy link. Please try manually selecting the URL.');
    }
    
    document.body.removeChild(textarea);
}

function showSuccessMessage(button) {
    const originalText = button.innerHTML;
    button.innerHTML = '<svg class="w-5 h-5 mr-2 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Copied!';
    button.classList.add('bg-success-600', 'hover:bg-success-700');
    button.classList.remove('bg-primary-600', 'hover:bg-primary-700');
    
    setTimeout(() => {
        button.innerHTML = originalText;
        button.classList.remove('bg-success-600', 'hover:bg-success-700');
        button.classList.add('bg-primary-600', 'hover:bg-primary-700');
    }, 2000);
}
</script>
