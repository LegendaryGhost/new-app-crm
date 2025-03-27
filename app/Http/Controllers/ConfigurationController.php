<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ConfigurationController extends Controller
{
    private string $configBaseUrl = "http://localhost:8080/api/configurations";

    public function showEditExpenseThreshold(): object
    {
        $response = Http::get($this->configBaseUrl . '/expense-threshold');
        $threshold = $response->json();

        return view('admin/configurations/edit-expense-threshold', compact('threshold'));
    }

    public function processEditExpenseThreshold(Request $request): object
    {
        try {
            $validated = $request->validate([
                'threshold' => 'required|numeric|min:0'
            ]);

            $response = Http::asForm()->put($this->configBaseUrl . '/expense-threshold', [
                "threshold" => $validated['threshold']
            ]);
            $response->throw(); // Lance une exception si la réponse n'est pas réussie

            $jsonResponse = $response->json();

            return redirect()
                ->back()
                ->withInput()
                ->with('message', $jsonResponse['message']);

        } catch (\Exception $e) {
            Log::error('An error occured while processing edit expense threshold:', [
                'error' => $e->getMessage(),
                'status_code' => method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}
