<?php

namespace App\Http\Controllers;

use App\Models\ApiUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    private string $configBaseUrl = "http://localhost:8080/api/login";

    public function loginShow()
    {
        return view('login');
    }

    public function loginProcess(Request $request)
    {
        try {
            $validated = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string'
            ]);

            $response = Http::post("{$this->configBaseUrl}", [
                "username" => $validated['username'],
                "password" => $validated['password']
            ]);

            $jsonResponse = $response->json();
            $ok = $jsonResponse['data']['authenticated'] && $response->successful();

            if (!$ok) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('message', $jsonResponse['message'])
                    ->with('error', $jsonResponse['data']['error']);
            } else {
                $data = $jsonResponse['data'];
                $apiUser = new ApiUser([
                    "id" => $data['id'],
                    "name" => $data['username'],
                    "email" => $data['email'],
                    "role" => $data['role'],
                ]);

                // Enregistrer l'utilisateur en session
                Auth::login($apiUser);
                $request->session()->regenerate();

                return redirect()->route('admin.dashboard');
            }

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Echec de connexion: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
