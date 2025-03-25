<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    private string $apiBaseUrl = "http://localhost:8080/api";

    public function index()
    {
        $response = Http::get("$this->apiBaseUrl/expenses/dashboard");
        $map = $response->json();

        $all = $map["all"];
        $expenseTypes = $map["expenseTypes"];
        $ticket = $map["ticket"];
        $lead = $map["lead"];
        $totalClientBudget = $map["totalClientBudget"];
        $totalTicketExpense = $map["totalTicketExpense"];
        $totalLeadExpense = $map["totalLeadExpense"];

        $allCollection = collect($all);
        $ticketCollection = collect($ticket);
        $leadCollection = collect($lead);

        $allParJour = $allCollection->groupBy(function ($all) {
            $date = DateTime::createFromFormat('Y-m-d\TH:i:s', $all['creationDate']);
            return $date->format('Y-m');
        })->map(function ($allMois) {
            return $allMois->sum('amount');
        })->sortKeys();
        $allLabels = $allParJour->keys()->toArray();
        $allData = $allParJour->values()->toArray();

        $ticketParJour = $ticketCollection->groupBy(function ($ticket) {
            return $ticket['creationDate'];
//            return $ticket['creationDate']->format('Y-m-d');
        })->map(function ($ticketJour) {
            return $ticketJour->sum('amount');
        });
        $ticketLabels = $ticketParJour->keys()->toArray();
        $ticketData = $ticketParJour->values()->toArray();

        $leadParJour = $leadCollection->groupBy(function ($lead) {
            return $lead['creationDate'];
//            return $lead['creationDate']->format('Y-m-d');
        })->map(function ($leadJour) {
            return $leadJour->sum('amount');
        });
        $leadLabels = $leadParJour->keys()->toArray();
        $leadData = $leadParJour->values()->toArray();

        // Traitement des données expenseTypes pour le camembert
        $expenseTypesCollection = collect($expenseTypes);
        $expenseTypesLabels = $expenseTypesCollection->pluck('type')->toArray(); // ["tickets", "leads"]
        $expenseTypesData = $expenseTypesCollection->pluck('amount')->toArray(); // [485600.0, 288000.0]

        return view(
            '/admin/dashboard',
            compact(
                'allLabels', 'allData',
                'ticketLabels', 'ticketData',
                'leadLabels', 'leadData',
                'totalClientBudget', 'totalTicketExpense', 'totalLeadExpense',
                'expenseTypesLabels', 'expenseTypesData' // Ajout des nouvelles variables
            )
        );
    }
}
