document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('materielChart').getContext('2d');

    const labels = JSON.parse(document.getElementById('materielChart').dataset.labels);
    const data = JSON.parse(document.getElementById('materielChart').dataset.values);

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'disponibilité',
                data: data,
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545' , '#2bf8eeff' , '#ad08faff' , '#e586deff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
});
