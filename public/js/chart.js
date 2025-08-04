const ctx = document.getElementById('stockChart').getContext('2d');

const stockChart = new Chart(ctx, {
    type: 'doughnut', // ou 'pie'
    data: {
        labels: ['PC', 'Imprimante', 'Serveur', 'Scanner'],
        datasets: [{
            label: 'Matériels disponibles',
            data: [12, 8, 4, 6], // À remplacer par les vraies valeurs dynamiques
            backgroundColor: [
                '#007bff', // Bleu pour PC
                '#28a745', // Vert pour imprimante
                '#ffc107', // Jaune pour serveur
                '#dc3545'  // Rouge pour scanner
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            tooltip: {
                enabled: true
            }
        }
    }
});
