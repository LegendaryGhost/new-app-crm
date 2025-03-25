<?php

use App\Http\Controllers\BudgetConfigController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// login
Route::get('/', function () {
    return view('login');
});

Route::get('/login', [AuthController::class, 'loginShow'])
    ->name('login');

Route::post('/login', [AuthController::class, 'loginProcess'])
    ->name('login.process');

// logout
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// protection de routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'configs'], function () {
        Route::get('/edit', [BudgetConfigController::class, 'editShow'])->name('configs.edit.show');
        Route::post('/edit', [BudgetConfigController::class, 'editProcess'])->name('configs.edit.process');
    });

    Route::group(['prefix' => 'expenses'], function () {
        Route::get('/tickets', [ExpenseController::class, 'ticketsExpenses'])->name('expenses.tickets');
        Route::get('/leads', [ExpenseController::class, 'leadsExpenses'])->name('expenses.leads');
        Route::get('/edit/{id}', [ExpenseController::class, 'editShow'])->name('expenses.edit.show');
        Route::post('/edit/{id}', [ExpenseController::class, 'editProcess'])->name('expenses.edit.process');
        Route::get('/delete/{id}', [ExpenseController::class, 'delete'])->name('expenses.delete');
    });

    Route::group(['prefix' => 'budgets'], function () {
        Route::get('', [BudgetController::class, 'index'])->name('budgets.index');
    });
});
