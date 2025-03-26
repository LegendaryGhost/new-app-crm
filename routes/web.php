<?php

use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImportController;
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

    Route::group(['prefix' => 'configurations'], function () {
        Route::get('/expense-threshold/edit', [ConfigurationController::class, 'showEditExpenseThreshold'])->name('configurations.edit.show');
        Route::post('/expense-threshold/edit', [ConfigurationController::class, 'processEditExpenseThreshold'])->name('configurations.edit.process');
    });

    Route::group(['prefix' => 'expenses'], function () {
        Route::get('/tickets', [ExpenseController::class, 'ticketsExpenses'])->name('expenses.tickets');
        Route::get('/leads', [ExpenseController::class, 'leadsExpenses'])->name('expenses.leads');
        Route::get('/{id}/edit', [ExpenseController::class, 'editShow'])->name('expenses.edit.show');
        Route::post('/{id}/edit', [ExpenseController::class, 'editProcess'])->name('expenses.edit.process');
        Route::get('/{id}/delete', [ExpenseController::class, 'delete'])->name('expenses.delete');
    });

    Route::group(['prefix' => 'budgets'], function () {
        Route::get('', [BudgetController::class, 'index'])->name('budgets.index');
        Route::get('/{id}/edit', [BudgetController::class, 'editShow'])->name('budgets.edit.show');
        Route::post('/{id}/edit', [BudgetController::class, 'editProcess'])->name('budgets.edit.process');
        Route::get('/{id}/delete', [BudgetController::class, 'delete'])->name('budgets.delete');
    });

    Route::group(['prefix' => 'import'], function () {
        Route::get('', [ImportController::class, 'editShow'])->name('import.edit.show');
        Route::post('', [ImportController::class, 'editProcess'])->name('import.edit.process');
    });
});
