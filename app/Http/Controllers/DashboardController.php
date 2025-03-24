<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    private string $apiBaseUrl = "http://localhost:8080/api";

    public function index()
    {
        $response = Http::get("$this->apiBaseUrl/expenses/dashboard");
        $map = $response->json();

        $all = $map["all"];
        $ticket = $map["ticket"];
        $lead = $map["lead"];

        $allCollection = collect($all);
        $ticketCollection = collect($ticket);
        $leadCollection = collect($lead);

        $allParJour = $allCollection->groupBy(function ($all) {
            return $all['creationDate'];
//            return $all['creationDate']->format('Y-m-d');
        })->map(function ($allJour) {
            return $allJour->sum('amount');
        });
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

        return view(
            '/admin/dashboard',
            compact(
                'allLabels', 'allData',
                'ticketLabels', 'ticketData',
                'leadLabels', 'leadData',
            )
        );
    }
}
