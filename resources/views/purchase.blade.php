@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-900">Purchase Company Subscription</h1>

    @if(session('error'))
        <div class="mb-4">
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10A8 8 0 11. . ."/></svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif
    @if(session('success'))
        <div class="mb-4">
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10A8 8 0 11. . ."/></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="mb-6 p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
        <div class="mb-2">
            <span class="font-semibold text-gray-700">Company:</span> {{ $companyProfile->company_name }}
        </div>
        <div>
            <span class="font-semibold text-gray-700">Current Subscription:</span>
            <span class="{{ $companyProfile->paid_subscription ? 'text-green-600' : 'text-gray-500' }}">
                {{ $companyProfile->paid_subscription ? 'Active' : 'None' }}
            </span>
        </div>
    </div>

    @if(!$companyProfile->paid_subscription)
        <form method="POST" action="{{ route('purchase.store') }}">
            @csrf
            <button 
                type="submit" 
                class="w-full flex justify-center items-center px-4 py-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base transition dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Buy Subscription (A$99.00/month)
            </button>
        </form>
    @else
        <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10A8 8 0 11. . ."/></svg>
            <span class="font-medium">You already have an active subscription!</span>
        </div>
    @endif
</div>
@endsection 