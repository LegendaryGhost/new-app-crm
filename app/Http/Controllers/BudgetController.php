<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class BudgetController extends Controller
{
    private string $configBaseUrl = "http://localhost:8080/api";

    public function index(): object
    {
        $response = Http::get($this->configBaseUrl . '/budgets');
        $budgets = $response->json();
        return view('admin/budgets/list-budget', compact('budgets'));
    }

}
