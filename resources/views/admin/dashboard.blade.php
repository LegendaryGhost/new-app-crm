@extends('template/template')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <!-- ============================================================== -->
            <!-- Info box -->
            <!-- ============================================================== -->
            <div class="card-group">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h3><i class="fas fa-users"></i></h3>
                                        <p class="text-muted">TOTAL CLIENT BUDGET</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h2 class="counter text-primary">
                                            <a href="{{ url('/budgets')  }}">
                                                {{ number_format($totalClientBudget, 2, ',', ' ') }}
                                            </a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h3><i class="fas fa-ticket-alt"></i></h3>
                                        <p class="text-muted">TOTAL TICKETS EXPENSES</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h2 class="counter text-cyan">
                                            <a href="{{ url('/expenses/tickets')  }}">
                                                {{ number_format($totalTicketExpense, 2, ',', ' ') }}
                                            </a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h3><i class="fas fa-calendar"></i></h3>
                                        <p class="text-muted">TOTAL LEADS EXPENSES</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h2 class="counter text-purple">
                                            <a href="{{ url('/expenses/leads')  }}">
                                                {{ number_format($totalLeadExpense, 2, ',', ' ') }}
                                            </a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Info box -->
            <!-- ============================================================== -->

            <div class="row">
                <div class="card col-md-6">
                    <div class="card-body">
                        <h4 class="card-title">Expenses evolution</h4>
                        <canvas id="allChart" style="width: 200px; height: 200px"></canvas>
                    </div>
                </div>
                <div class="card col-md-6">
                    <div class="card-body">
                        <h4 class="card-title">Expenses evolution</h4>
                        <canvas id="ticketChart" style="width: 200px; height: 200px"></canvas>
                    </div>
                </div>
                <div class="card col-md-6">
                    <div class="card-body">
                        <h4 class="card-title">Expenses evolution</h4>
                        <canvas id="leadChart" style="width: 200px; height: 200px"></canvas>
                    </div>
                </div>
            </div>
        </div>
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

        function generateLineChart(canvasId, titre, labels, data) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            new Chart(ctx, {
                type: 'line',
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

        function generateBarChart(canvasId, titre, labels, data) {
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
            generateLineChart(allCanvasId, 'Toutes les depenses', allLabels, allData);
            generateBarChart(ticketCanvasId, 'Depenses Tickets', ticketLabels, ticketData);
            generateBarChart(leadCanvasId, 'Depenses Leads', leadLabels, leadData);
        })
    </script>
@endsection
