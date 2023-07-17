@extends("layouts.app")

@section("content")
    <div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl sm:text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Simple no-tricks pricing</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">Directly connect with hundreds of developers in Australia looking for their next job.</p>
            </div>
            <div class="bg-white mx-auto mt-16 max-w-2xl rounded-lg ring-1 ring-gray-200 sm:mt-20 lg:mx-0 lg:flex lg:max-w-none">
                <div class="p-8 sm:p-10 lg:flex-auto">
                    <h3 class="text-2xl font-bold tracking-tight text-gray-900">Monthly Subscription</h3>
                    <p class="mt-6 text-base leading-7 text-gray-600">Skip the formal job postings and middlemen – hire directly from a candidate pool of developers in Australia, from juniors to seniors.</p>
                    <div class="mt-10 flex items-center gap-x-4">
                        <h4 class="flex-none text-sm font-semibold leading-6">What’s included</h4>
                        <div class="h-px flex-auto bg-gray-100"></div>
                    </div>
                    <ul role="list" class="mt-8 grid grid-cols-1 gap-4 text-sm leading-6 text-gray-600 sm:grid-cols-2 sm:gap-6">
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Access our curated pool of developers
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            View names and private information
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Message developers directly
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Email support from the owner
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Exclusively developers in Australia
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Email updates of new candidates
                        </li>
                    </ul>
                </div>
                <div class="-mt-2 p-2 lg:mt-0 lg:w-full lg:max-w-md lg:flex-shrink-0">
                    <div class="rounded-2xl bg-gray-50 py-10 text-center ring-1 ring-inset ring-gray-900/5 lg:flex lg:flex-col lg:justify-center lg:py-16">
                        <div class="mx-auto max-w-xs px-8">
                            <p class="mt-6 flex items-baseline justify-center gap-x-2">
                                <span class="text-5xl font-bold tracking-tight text-gray-900">$99</span>
                                <span class="text-md font-semibold leading-6 tracking-wide text-gray-600">/month</span>
                            </p>
                            <a href="#" class="mt-10 block w-full rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300">Get access</a>
                            <p class="mt-6 text-xs leading-5 text-gray-600">Invoices and receipts available for easy company reimbursement</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
