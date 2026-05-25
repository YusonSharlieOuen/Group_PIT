@php
    // expects: $revenueLabels, $revenueValues, $portfolioLabels, $portfolioValues
@endphp

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

<script defer>
    document.addEventListener('DOMContentLoaded', function () {
        // Guard: Chart.js
        if (typeof Chart === 'undefined') return;

        const revenueLabels = @json($revenueLabels ?? []);
        const revenueValues = @json($revenueValues ?? []);

        const portfolioLabels = @json($portfolioLabels ?? []);
        const portfolioValues = @json($portfolioValues ?? []);
        const portfolioTotal = portfolioValues.reduce((sum, v) => sum + (Number(v) || 0), 0);
        const portfolioPercents = portfolioValues.map(v => {
            const n = Number(v) || 0;
            return portfolioTotal > 0 ? (n / portfolioTotal) * 100 : 0;
        });


        // Revenue by Branch (Bar)
        const revenueCanvas = document.getElementById('revenueByBranchChart');
        if (revenueCanvas) {
            new Chart(revenueCanvas.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: revenueLabels,
                    datasets: [{
                        label: 'Total Monthly Rent',
                        data: revenueValues,
                        backgroundColor: 'rgba(16, 185, 129, 0.25)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: true }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Portfolio Breakdown (Pie)
        const portfolioCanvas = document.getElementById('portfolioBreakdownChart');
        if (portfolioCanvas) {
            new Chart(portfolioCanvas.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: portfolioLabels.map((l, i) => `${l} (${portfolioPercents[i].toFixed(1)}%)`),
                    datasets: [{
                        label: 'Properties by Type',
                        data: portfolioValues,
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.6)',

                            'rgba(16, 185, 129, 0.6)',
                            'rgba(245, 158, 11, 0.6)',
                            'rgba(239, 68, 68, 0.6)',
                            'rgba(168, 85, 247, 0.6)',
                        ],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        }
    });
</script>

