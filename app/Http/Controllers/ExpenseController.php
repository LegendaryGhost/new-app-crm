<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExpenseController extends Controller
{
    private string $expenseBaseUrl = "http://localhost:8080/api/expenses";

    public function index()
    {
        $response = Http::get($this->expenseBaseUrl);
        $expenses = $response->json();

        return view('admin/expenses/list-expense', compact('expenses'));
    }

    public function editShow(int $id)
    {
        $response = Http::get("{$this->expenseBaseUrl}/{$id}");

        if ($response->successful()) {
            $expense = $response->json();

            return view('admin/expenses/edit-expense', compact('expense'));
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

            $response = Http::asForm()->put("{$this->expenseBaseUrl}/{$id}", [
                "newAmount" => $validatedData['amount']
            ]);
            $response->throw(); // Lance une exception si la réponse n'est pas réussie

            $jsonResponse = $response->json();

            return redirect()
                ->back()
                ->withInput()
                ->with('message', $jsonResponse['message'])
                ->with('warningsBudget', $jsonResponse['data']);

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
            $response = Http::delete("{$this->expenseBaseUrl}/{$id}");

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
