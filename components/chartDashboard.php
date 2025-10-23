<div class="chart-container">
    <div class="chart">
        <canvas id="statusChart"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById("statusChart");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Jan", "Mar", "Apr", "May", "Jun", "Aug", "Sep", "Oct", "Nov"],
            datasets: [{
                    label: "Opened",
                    data: [80, 100, 120, 65, 95, 110, 55, 75, 90],
                    backgroundColor: "#9e9e9e", // gray
                },
                {
                    label: "Processing",
                    data: [60, 70, 85, 50, 75, 80, 40, 130, 65],
                    backgroundColor: "#ffeb3b", // yellow
                },
                {
                    label: "Completed",
                    data: [45, 55, 95, 40, 60, 70, 30, 110, 55],
                    backgroundColor: "#4caf50", // green
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                    labels: {
                        boxWidth: 20,
                        padding: 15,
                    },
                },
                title: {
                    display: true,
                    text: "Incident Progress by Month",
                    font: {
                        size: 16,
                    },
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: "Number of Incidents",
                    },
                },
                x: {
                    title: {
                        display: true,
                        text: "Month",
                    },
                },
            },
        },
    });
</script>