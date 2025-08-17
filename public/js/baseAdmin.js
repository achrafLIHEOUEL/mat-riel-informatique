document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('materielChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['En Stock', 'Affectés', 'En Panne'],
            datasets: [{
                data: [95, 17, 8],
                backgroundColor: ['#44bd32', '#40739e', '#e84118']
            }]
        }
    });
});
