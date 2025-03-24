@extends('template/template')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-4">Evolution des dépenses</h2>

        <canvas id="allChart" style="width: 200px; height: 200px"></canvas>
        <canvas id="ticketChart" style="width: 200px; height: 200px"></canvas>
        <canvas id="leadChart" style="width: 200px; height: 200px"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        const allCanvasId = "allChart";
        const allLabels = {!! json_encode($allLabels) !!};
        const allData = {!! json_encode($allData) !!};

        const ticketCanvasId = "ticketChart";
        const ticketLabels = {!! json_encode($ticketLabels) !!};
        const ticketData = {!! json_encode($ticketData) !!};

        const leadCanvasId = "leadChart";
        const leadLabels = {!! json_encode($leadLabels) !!};
        const leadData = {!! json_encode($leadData) !!};

        function generateChart(canvasId, titre, labels, data) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: titre,
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        document.addEventListener("DOMContentLoaded", () => {
            generateChart(allCanvasId, 'Toutes les depenses', allLabels, allData);
            generateChart(ticketCanvasId, 'Depenses Tickets', ticketLabels, ticketData);
            generateChart(leadCanvasId, 'Depenses Leads', leadLabels, leadData);
        })
    </script>
@endsection
