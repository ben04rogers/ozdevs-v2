@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-4 px-4">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8 mx-auto mt-4">
        <h1 class="text-3xl font-bold mb-4 text-center">Purchase Company Subscription</h1>
        <p class="text-center text-gray-600 mb-8">Directly connect with hundreds of developers in Australia looking for their next job. Unlock premium features for your company and streamline your hiring workflow.</p>

        @if(session('error'))
            <div class="mb-4">
                <div class="flex items-center p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10A8 8 0 11. . ."/></svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif
        @if(session('success'))
            <div class="mb-4">
                <div class="flex items-center p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10A8 8 0 11. . ."/></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-gray-50 border border-gray-200 rounded-lg p-6">
            <div>
                <div class="mb-2">
                    <span class="font-semibold text-gray-700">Company:</span> {{ $companyProfile->company_name }}
                </div>
                <div>
                    <span class="font-semibold text-gray-700">Current Subscription:</span>
                    <span class="ml-1 {{ $companyProfile->paid_subscription ? 'text-green-600' : 'text-gray-500' }}">
                        {{ $companyProfile->paid_subscription ? 'Active' : 'None' }}
                    </span>
                </div>
            </div>
            <div class="text-center md:text-right">
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-semibold text-lg">A$99.00/month</span>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-2">What's included</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li class="flex items-center gap-x-2"><span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 text-white bg-green-500 rounded-full"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"></path></svg></span>Access our curated pool of developers</li>
                <li class="flex items-center gap-x-2"><span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 text-white bg-green-500 rounded-full"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"></path></svg></span>View names and private information</li>
                <li class="flex items-center gap-x-2"><span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 text-white bg-green-500 rounded-full"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"></path></svg></span>Message developers directly</li>
                <li class="flex items-center gap-x-2"><span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 text-white bg-green-500 rounded-full"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"></path></svg></span>Email support from the owner</li>
                <li class="flex items-center gap-x-2"><span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 text-white bg-green-500 rounded-full"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"></path></svg></span>Exclusively developers in Australia</li>
                <li class="flex items-center gap-x-2"><span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 text-white bg-green-500 rounded-full"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"></path></svg></span>Email updates of new candidates</li>
            </ul>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Frequently Asked Questions</h2>
            <div class="space-y-4">
                <div>
                    <h3 class="font-semibold text-gray-900">Does OzDevs cost anything for developers?</h3>
                    <p class="text-gray-600 text-sm">No. OzDevs is free for developers.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">How does the pricing work?</h3>
                    <p class="text-gray-600 text-sm">You pay a fixed monthly fee of $99 for unlimited access to our curated pool of talented developers. There are no additional charges or hidden costs.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Can I cancel my subscription?</h3>
                    <p class="text-gray-600 text-sm">Yes, you can cancel your subscription at any time. If you decide to cancel, simply reach out to our support team or access the cancellation option in your account settings.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Who can I contact for more specific questions?</h3>
                    <p class="text-gray-600 text-sm">Send an email to the owner and I will get back to you as soon as possible.</p>
                </div>
            </div>
        </div>

        @if(!$companyProfile->paid_subscription)
            <form method="POST" action="{{ route('purchase.store') }}" class="mt-6">
                @csrf
                <button 
                    type="submit" 
                    class="w-full flex justify-center items-center px-6 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-xl text-lg shadow-lg transition dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    Buy Subscription (A$99.00/month)
                </button>
            </form>
        @else
            <div class="flex items-center p-4 mt-6 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 justify-center" role="alert">
                <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10A8 8 0 11. . ."/></svg>
                <span class="font-medium">You already have an active subscription!</span>
            </div>
        @endif
    </div>
</div>
@endsection 