@extends("layouts.app")

@section("content")
    <div>
        <div class="mx-auto max-w-7xl px-2 lg:px-8">
            <div class="mx-auto max-w-2xl sm:text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Simple no-tricks pricing</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">Directly connect with hundreds of developers in Australia looking for their next job.</p>
            </div>
            <div class="bg-white mx-auto mt-8 md:mt-14 max-w-2xl rounded-lg ring-1 ring-gray-200 lg:mx-0 lg:flex lg:max-w-none">
                <div class="p-8 sm:p-10 lg:flex-auto">
                    <h3 class="text-2xl font-bold tracking-tight text-gray-900">Monthly Subscription</h3>
                    <p class="mt-6 text-base leading-7 text-gray-600">Skip the formal job postings and middlemen – hire directly from a candidate pool of developers in Australia, from juniors to seniors.</p>
                    <div class="mt-10 flex items-center gap-x-4">
                        <h4 class="flex-none font-semibold leading-6">What’s included</h4>
                        <div class="h-px flex-auto bg-gray-100"></div>
                    </div>
                    <ul role="list" class="mt-8 grid grid-cols-1 gap-4 text-sm leading-6 text-gray-600 sm:grid-cols-2 sm:gap-6">
                        <li class="flex gap-x-3 items-center">
                             <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>
                            Access our curated pool of developers
                        </li>
                        <li class="flex gap-x-3 items-center">
                            <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>
                            View names and private information
                        </li>
                        <li class="flex gap-x-3 items-center">
                            <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>
                            Message developers directly
                        </li>
                        <li class="flex gap-x-3 items-center">
                            <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>
                            Email support from the owner
                        </li>
                        <li class="flex gap-x-3 items-center">
                            <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>
                            Exclusively developers in Australia
                        </li>
                        <li class="flex gap-x-3 items-center">
                            <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>
                            Email updates of new candidates
                        </li>
                    </ul>
                </div>
                <div class="-mt-2 p-2 lg:mt-0 lg:w-full lg:max-w-md lg:flex-shrink-0">
                    <div class="rounded-2xl bg-gray-50 py-10 text-center ring-1 ring-inset ring-gray-900/5 lg:flex lg:flex-col lg:justify-center lg:py-16 h-full">
                        <div class="mx-auto max-w-xs px-8">
                            <p class="mt-6 flex items-baseline justify-center gap-x-2">
                                <span class="text-5xl font-bold tracking-tight text-gray-900">$99</span>
                                <span class="text-md font-semibold leading-6 tracking-wide text-gray-600">/month</span>
                            </p>
                            <a href="#" class="mt-10 block w-full rounded-md px-3 py-2 w-[230px] text-center text-sm font-semibold text-white shadow-sm bg-customBlue hover:bg-customDarkBlue focus:outline-none focus:ring-4 focus:ring-gray-300">Get access</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <h2 class="mb-8 text-3xl tracking-tight font-bold text-gray-900 dark:text-white">Frequently asked questions</h2>
                <div class="grid pt-8 text-left border-t border-gray-200 md:gap-16 dark:border-gray-700 md:grid-cols-2">
                    <div>
                        <div class="mb-10">
                            <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                                <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                                Does OzDevs cost anything for developers?
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400">No. OzDevs is free for developers.</p>
                        </div>
                        <div class="mb-10">
                            <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                                <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                                How does the pricing work?
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400">Our pricing is simple and transparent. You pay a fixed monthly fee of $99 for unlimited access to our curated pool of talented developers. There are no additional charges or hidden costs.</p>
                        </div>
                    </div>
                    <div>
                        <div class="mb-10">
                            <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                                <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                                Can I cancel my subscription?
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400">Yes, you can cancel your subscription at any time. If you decide to cancel, simply reach out to our support team or access the cancellation option in your account settings. .</p>
                        </div>
                        <div class="mb-10">
                            <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                                <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                                Who can I contact for more specific questions?
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400">Send an email to the owner and I will get back to you as soon as possible.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
