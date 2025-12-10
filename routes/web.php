<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Landing Page
Route::livewire('/', 'pages.⚡home');

// Existing Kanban Dashboard
Route::livewire('/dashboard', 'pages.⚡dashboard');

// Request Interceptors Demo
Route::livewire('/interceptors', 'pages.⚡interceptors');

// Smart Loading Indicators Demo
Route::livewire('/loading', 'pages.⚡loading');

// Blaze Optimization Demo
Route::livewire('/blaze', 'pages.⚡blaze');

// Islands Demos
Route::livewire('/islands', 'pages.⚡islands');
Route::livewire('/islands/advanced', 'pages.⚡islands-advanced');
Route::livewire('/islands/nested', 'pages.⚡islands-nested');

// Islands - Real-World Use Cases
Route::livewire('/islands/infinite-scroll', 'pages.⚡infinite-scroll');
Route::livewire('/islands/chat', 'pages.⚡chat');
Route::livewire('/islands/load-more', 'pages.⚡load-more');

// Product CRUD
Route::livewire('/products', 'pages.products.index')->name('products.index');
Route::livewire('/products/create', 'pages.products.create')->name('products.create');
Route::livewire('/products/{product}/edit', 'pages.products.edit')->name('products.edit');

// Multi-Response Demo (supports GET and POST for API functionality)
Route::match(['get', 'post'], '/multi-response-demo', App\Livewire\Pages\MultiResponseDemo::class);

// Observer Pattern Demo
Route::get('/observer-demo', App\Livewire\Observer\ObserverDemo::class);
