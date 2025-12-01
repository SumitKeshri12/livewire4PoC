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

// Multi-Response Demo
Route::get('/multi-response-demo', App\Livewire\Pages\MultiResponseDemo::class);
