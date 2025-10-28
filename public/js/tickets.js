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

            document.getElementById('details-title').textContent = title;
            document.getElementById('details-ticket-id').value = ticketId;
            document.getElementById('details-description').value = description;
            document.getElementById('details-status').value = status;
            document.getElementById('details-date').textContent = new Date(date).toLocaleDateString();

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
