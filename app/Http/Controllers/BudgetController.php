<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;
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

    public function editShow(int $id): object
    {
        $response = Http::get("{$this->budgetBaseUrl}/{$id}");

        if ($response->successful()) {
            $budget = $response->json();

            return view('admin/budgets/edit-budget', compact('budget'));
        } else {
            throw new HttpClientException($response->body());
        }
    }

    public function editProcess(Request $request, int $id)
    {
        try {
            $validatedData = $request->validate([
                'amount' => 'required|numeric|min:0'
            ]);

            $response = Http::asForm()->put("{$this->budgetBaseUrl}/{$id}", [
                "newAmount" => $validatedData['amount']
            ]);
            $response->throw(); // Lance une exception si la réponse n'est pas réussie

            $jsonResponse = $response->json();

            return redirect()
                ->back()
                ->withInput()
                ->with('message', $jsonResponse['message']);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de la dépense:', [
                'error' => $e->getMessage(),
                'status_code' => method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Échec de la mise à jour']);
        }
    }

    public function delete(int $id)
    {
        try {
            $response = Http::delete("{$this->budgetBaseUrl}/{$id}");

            if ($response->successful()) {
                $budget = $response->json();

                return redirect()
                    ->back()
                    ->with('message', $budget['message']);
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
