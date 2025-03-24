<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BudgetConfigController extends Controller
{
    private string $configBaseUrl = "http://localhost:8080/api/budget-alert-configs";

    public function editShow()
    {
        $response = Http::get($this->configBaseUrl);
        $config = $response->json();

        return view('admin/configs/edit-config', compact('config'));
    }

    public function editProcess(Request $request)
    {
        try {
            $validated = $request->validate([
                'rate' => 'required|numeric|between:0,100'
            ]);

            $response = Http::asForm()->post("{$this->configBaseUrl}", [
                "rate" => $validated['rate']
            ]);
            $response->throw(); // Lance une exception si la réponse n'est pas réussie

            $jsonResponse = $response->json();

            return redirect()
                ->back()
                ->withInput()
                ->with('message', $jsonResponse['message']);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de la config:', [
                'error' => $e->getMessage(),
                'status_code' => method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Échec de la mise à jour');
        }
    }
}
