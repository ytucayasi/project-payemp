<?php

use App\Http\Livewire\Dnipago;
use App\Http\Livewire\EmployeeList;
use Illuminate\Support\Facades\Route;

Route::get('/', EmployeeList::class)->name('dashboard');
Route::get('/pagos', Dnipago::class)->name('pagos');