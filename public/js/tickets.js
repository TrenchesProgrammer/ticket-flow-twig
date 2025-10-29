console.log('tickets.js is attempting to load');
console.log('tickets.js loaded');
document.addEventListener('DOMContentLoaded', () => {
    const addTicketBtn = document.getElementById('add-ticket-btn');
    const addTicketModal = document.getElementById('add-ticket-modal');
    const cancelAddBtn = document.getElementById('cancel-add-btn');

    const ticketDetailsModal = document.getElementById('ticket-details-modal');
    const cancelDetailsBtn = document.getElementById('cancel-details-btn');
    const deleteTicketBtn = document.getElementById('delete-ticket-btn');

    const confirmModal = document.getElementById('confirm-modal');
    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');

    // Open Add Ticket Modal
    addTicketBtn.addEventListener('click', () => {
        addTicketModal.classList.remove('hidden');
    });

    // Close Add Ticket Modal
    cancelAddBtn.addEventListener('click', () => {
        addTicketModal.classList.add('hidden');
    });

    // Open Ticket Details Modal
    document.querySelectorAll('.ticket-card').forEach(card => {
        card.addEventListener('click', () => {
            const ticketId = card.dataset.ticketId;
            const title = card.dataset.ticketTitle;
            const description = card.dataset.ticketDescription;
            const status = card.dataset.ticketStatus;
            const date = card.dataset.ticketDate;

            const descriptionEl = document.getElementById('details-description');
            descriptionEl.value = description;
            const statusEl = document.getElementById('details-status');
            statusEl.value = status;
            document.getElementById('details-date').textContent = new Date(date).toLocaleDateString();

            const saveBtn = document.querySelector('#update-ticket-form button[type="submit"]');
            const deleteBtn = document.getElementById('delete-ticket-btn');

            if (status === 'closed') {
                descriptionEl.disabled = true;
                statusEl.disabled = true;
                saveBtn.disabled = true;
                saveBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                deleteBtn.style.display = 'none';
            } else {
                descriptionEl.disabled = false;
                statusEl.disabled = false;
                saveBtn.disabled = false;
                saveBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                deleteBtn.style.display = 'block';
            }

            console.log('Ticket card clicked:', ticketId);
            console.log('ticketDetailsModal element:', ticketDetailsModal);
            ticketDetailsModal.classList.remove('hidden');
        });
    });

    // Close Ticket Details Modal
    cancelDetailsBtn.addEventListener('click', () => {
        ticketDetailsModal.classList.add('hidden');
    });

    // Open Confirmation Modal
    deleteTicketBtn.addEventListener('click', () => {
        const ticketId = document.getElementById('details-ticket-id').value;
        document.getElementById('delete-ticket-id').value = ticketId;
        confirmModal.classList.remove('hidden');
    });

    // Close Confirmation Modal
    cancelDeleteBtn.addEventListener('click', () => {
        confirmModal.classList.add('hidden');
    });
});
