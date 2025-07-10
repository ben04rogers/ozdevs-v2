@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-4 px-4">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-8 mx-auto mt-4 space-y-10">

    {{-- Header --}}
    <div class="text-center space-y-2">
        <h1 class="text-3xl font-bold">
            {{ $companyProfile->paid_subscription ? 'You’re Subscribed 🎉' : 'Purchase Company Subscription' }}
        </h1>
        <p class="text-gray-600 mx-auto">
            Directly connect with hundreds of developers in Australia looking for their next job. Unlock premium features for your company and streamline your hiring workflow.
        </p>
    </div>

    {{-- Subscription Info --}}
    <div class="relative">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 {{ $companyProfile->paid_subscription ? 'bg-green-50 border-green-300' : 'bg-gray-50 border-gray-200' }} border rounded-xl p-6">
            <div>
                <div class="mb-2 text-sm text-gray-700">
                    <span class="font-semibold">Company:</span> {{ $companyProfile->company_name }}
                </div>
                <div class="text-sm text-gray-700">
                    <span class="font-semibold">Current Subscription:</span>
                    <span class="ml-2 i py-1 font-semibold {{ $companyProfile->paid_subscription ? 'text-green-700' : 'text-gray-500' }} rounded-full">
                        {{ $companyProfile->paid_subscription ? 'Active' : 'None' }}
                    </span>
                </div>
            </div>
            <div class="text-center md:text-right">
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-semibold text-lg">A$99.00/month</span>
            </div>
        </div>
    </div>

    {{-- What's Included --}}
    <div class="space-y-4">
        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">✅ What's Included</h2>
        <ul class="grid sm:grid-cols-2 gap-x-6 gap-y-3 text-gray-700 text-sm">
            @foreach([
                'Access our curated pool of developers',
                'View names and private information',
                'Message developers directly',
                'Email support from the owner',
                'Exclusively developers in Australia',
                'Email updates of new candidates'
            ] as $feature)
                <li class="flex items-start gap-2">
                    <span class="mt-1 text-green-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span>{{ $feature }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- FAQs --}}
    <div class="space-y-4">
        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">💬 Frequently Asked Questions</h2>
        <div class="grid sm:grid-cols-2 gap-6 text-sm text-gray-700">
            <div>
                <h3 class="font-semibold text-gray-900">Does OzDevs cost anything for developers?</h3>
                <p class="mt-1 text-gray-600">No. OzDevs is free for developers.</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">How does the pricing work?</h3>
                <p class="mt-1 text-gray-600">You pay a fixed monthly fee of $99 for unlimited access. No hidden costs.</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">Can I cancel my subscription?</h3>
                <p class="mt-1 text-gray-600">Yes, you can cancel any time through your account or by contacting support.</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">Who can I contact for questions?</h3>
                <p class="mt-1 text-gray-600">Send an email to the owner — we’ll get back to you promptly.</p>
            </div>
        </div>
    </div>

    {{-- Call to Action --}}
    @if(!$companyProfile->paid_subscription)
        <form method="POST" action="{{ route('purchase.store') }}">
            @csrf
            <button
                type="submit"
                class="w-full flex justify-center items-center px-6 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-xl text-lg shadow-lg transition dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Buy Subscription (A$99.00/month)
            </button>
        </form>
    @endif

</div>

</div>
@endsection
