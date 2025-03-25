<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BudgetController extends Controller
{
    private string $budgetBaseUrl = "http://localhost:8080/api/budgets";

    public function index(): object
    {
        $response = Http::get($this->budgetBaseUrl);
        $budgets = $response->json();
        return view('admin/budgets/list-budgets', compact('budgets'));
    }

    public function delete(int $id)
    {
        try {
            $response = Http::delete("{$this->budgetBaseUrl}/{$id}");

            if ($response->successful()) {
                $expense = $response->json();

                return redirect()
                    ->back()
                    ->with('message', $expense['message']);
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de la dépense:', [
                'error' => $e->getMessage(),
                'status_code' => method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500
            ]);

            return redirect()
                ->back()
                ->with('error', 'Échec de la suppression');
        }
    }

}
