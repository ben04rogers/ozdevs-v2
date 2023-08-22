<nav class="bg-customBlue border-b border-gray-200 dark:border-gray-600" x-data="{ mobileOpen: false }">
    <div class="mx-auto max-w-[1200px] px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <div class="flex md:order-2">
                    <button data-collapse-toggle="navbar-sticky" type="button" @click="mobileOpen = !mobileOpen" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden ring-white focus:ring-2 focus:ring-gray-200" aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img class="block h-6" src="{{ asset('img/ozdevs-logo.png') }}" alt="OzDevs Logo">
                </a>
                <div class="hidden sm:ml-3 sm:block">
                    <div class="flex space-x-2">
                        <a href="{{ route('developers') }}" class="text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Developers</a>
                        <a href="{{ route('pricing') }}" class="text-white rounded-md px-3 py-2 text-sm font-medium">Pricing</a>
                    </div>
                </div>
            </div>

            @guest
                <div class="hidden md:block">
                    <a href="{{ route('login') }}" class="text-white py-2.5 px-5 mr-2 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Login</a>
                    <a href="{{ route('register') }}" class="bg-customDarkBlue text-white focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Register</a>
                </div>
            @else
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <!-- Profile dropdown -->
                    <div class="relative ml-3" x-data="{ open: false }" @click.away="open = false">
                        <div>
                            <button @click="open = !open" type="button" class="flex flex-col justify-center items-center rounded-full text-sm focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                @if (auth()->user()->developerProfile?->image)
                                    <img class="h-9 w-9 rounded-full" src="{{ auth()->user()->developerProfile->image }}" alt="">
                                @else
                                    <img class="h-9 h-9 rounded-full" src="{{ url('img/profile-placeholder.png') }}" alt="">
                                @endif
                            </button>
                        </div>

                        <div x-show.transition="open" x-cloak @click.away="open = false" :class="{ 'hidden': !open }" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">  <!-- Active: "bg-gray-100", Not Active: "" -->
                            @if(!auth()->user()->developerProfile()->exists() && !auth()->user()->companyProfile()->exists())
                                <a href="{{ route('getStarted') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Get Started</a>
                            @endif

                            @if(auth()->user()->developerProfile()->exists())
                                <a href="{{ url('/developer-profiles/' . auth()->user()->developerProfile->id) }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Developer Profile</a>
                            @endif

                            @if(auth()->user()->companyProfile()->exists())
                                <a href="{{ url('/company-profiles/' . auth()->user()->companyProfile->id) }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Company Profile</a>
                            @endif

                            @if (auth()->user()?->developerProfile || auth()->user()?->companyProfile?->paid_subscription)
                                <a href="{{ url('/messages') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Messages</a>
                            @endif

                            <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="mobileOpen">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <a href="{{ route('developers') }}" class="text-white hover:bg-customDarkBlue block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Developers</a>
            <a href="{{ route('pricing') }}" class="text-white hover:bg-customDarkBlue block rounded-md px-3 py-2 text-base font-medium">Pricing</a>
            @guest
            <a href="{{ route('login') }}" class="text-white hover:bg-customDarkBlue block rounded-md px-3 py-2 text-base font-medium">Login</a>
            <a href="{{ route('register') }}" class="text-white hover:bg-customDarkBlue block rounded-md px-3 py-2 text-base font-medium">Register</a>
            @else
            @endguest
        </div>
    </div>
</nav>
