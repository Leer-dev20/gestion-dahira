// public/js/app.js

document.addEventListener('DOMContentLoaded', function() {
    // Gestion des toggles de cotisation
    const toggleButtons = document.querySelectorAll('.cotisation-toggle');
    toggleButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const memberId = this.dataset.memberId;
            const cellId = this.dataset.cellId;
            const month = this.dataset.month;
            const year = this.dataset.year;
            const currentState = this.dataset.paid === '1';

            fetch('/dahira-gestion/public/cotisations/toggle', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ member_id: memberId, cell_id: cellId, month, year })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Inverser l'état visuel
                    this.dataset.paid = currentState ? '0' : '1';
                    this.classList.toggle('bg-green-100');
                    this.classList.toggle('text-green-700');
                    this.classList.toggle('bg-red-100');
                    this.classList.toggle('text-red-700');
                    // Mettre à jour l'icône ou le texte
                    const icon = this.querySelector('svg');
                    if (icon) {
                        if (!currentState) {
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />';
                        } else {
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
                        }
                    }
                }
            });
        });
    });
});