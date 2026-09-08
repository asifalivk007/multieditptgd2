/**
 * MultiEdit PTG Designer — application bootstrap.
 * Instantiates the PTGDesigner once the DOM is ready (tool page).
 */
// Initialize the application
document.addEventListener('DOMContentLoaded', () => {
    try {
        console.log('Initializing PTGDesigner...');
        window.designer = new PTGDesigner();
        console.log('PTGDesigner initialized successfully');
    } catch (error) {
        console.error('Failed to initialize PTGDesigner:', error);
    }
});
