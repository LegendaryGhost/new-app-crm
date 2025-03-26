<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImportController extends Controller
{
    private string $budgetBaseUrl = "http://localhost:8080/api/import";

    public function editShow(): object
    {
        return view('admin/import/import');
    }

    public function editProcess(Request $request)
    {

        try {
            $file = $request->file("file");

            $response = Http::withHeaders(
                [
                    'Accept' => 'application/json',
                ]
            )
                ->attach('file', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
                ->post("{$this->budgetBaseUrl}/customer");

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

}
