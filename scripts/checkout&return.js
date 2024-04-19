document.addEventListener('DOMContentLoaded', () => {
    const nicInput = document.querySelector('input[name="nic"]');
    const copyIdInput = document.querySelector('input[name="copyid"]');
    
    nicInput.addEventListener('input', (event) => {
        const value = event.target.value;
        event.target.value = value.charAt(0).toUpperCase() + value.slice(1);
    });

    copyIdInput.addEventListener('input', (event) => {
        const value = event.target.value;
        event.target.value = value.charAt(0).toUpperCase() + value.slice(1);
    });
});
