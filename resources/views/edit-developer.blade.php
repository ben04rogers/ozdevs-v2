@extends("layouts.app")

@section("content")
    <div class="max-w-2xl mx-auto mb-8">
        <h1 class="text-3xl font-bold mb-8 text-center">Edit Developer Profile</h1>

        @if($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('updateDeveloper', ['id' => $developerProfile->user_id]) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg">
            @csrf
            @method('PUT')

            <!-- Image -->
            <div class="mb-4">
                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profile Image:</label>
                @if ($developerProfile->image)
                    <img class="rounded w-32 h-32 border mb-3" id="profileImage" src="{{$developerProfile->image}}" alt="Extra large avatar">
                @else
                    <img class="rounded w-32 h-32 border mb-3" id="profileImage" src="{{ asset('img/profile-placeholder.png') }}" alt="Extra large avatar">
                @endif
                <input type="file" id="image" name="image" class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer dark:text-gray-400 focus:outline-none" accept="image/*">
            </div>

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                <input type="text" id="name" name="name" value="{{ $developerProfile->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <!-- Hero -->
            <div class="mb-4">
                <label for="hero" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hero:</label>
                <input type="text" id="hero" name="hero" value="{{ $developerProfile->hero }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <!-- City -->
            <div class="mb-4">
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City:</label>
                <input type="text" id="city" name="city" value="{{ $developerProfile->city }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <!-- State -->
            <div class="mb-4">
                <label for="state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State:</label>
                <select id="state" name="state" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" disabled selected>Choose a state</option>
                    <option value="Australian Capital Territory" @if($developerProfile->state === 'Australian Capital Territory') selected @endif>Australian Capital Territory</option>
                    <option value="New South Wales" @if($developerProfile->state === 'New South Wales') selected @endif>New South Wales</option>
                    <option value="Northern Territory" @if($developerProfile->state === 'Northern Territory') selected @endif>Northern Territory</option>
                    <option value="Queensland" @if($developerProfile->state === 'Queensland') selected @endif>Queensland</option>
                    <option value="South Australia" @if($developerProfile->state === 'South Australia') selected @endif>South Australia</option>
                    <option value="Tasmania" @if($developerProfile->state === 'Tasmania') selected @endif>Tasmania</option>
                    <option value="Victoria" @if($developerProfile->state === 'Victoria') selected @endif>Victoria</option>
                    <option value="Western Australia" @if($developerProfile->state === 'Western Australia') selected @endif>Western Australia</option>
                </select>
            </div>

            <!-- Country -->
            <div class="mb-4">
                <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country:</label>
                <input type="text" id="country" name="country" aria-label="disabled input" value="{{ $developerProfile->country }}" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
            </div>

            <!-- Bio -->
            <div class="mb-4">
                <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bio:</label>
                <textarea id="bio" name="bio" rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $developerProfile->bio }}</textarea>
            </div>

            <!-- Search Status -->
            <div class="mb-4">
                <label for="search_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search Status:</label>
                <select id="search_status" name="search_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="actively looking" @if($developerProfile->search_status === 'actively looking') selected @endif>Actively Looking</option>
                    <option value="open" @if($developerProfile->search_status === 'open') selected @endif>Open</option>
                    <option value="not interested" @if($developerProfile->search_status === 'not interested') selected @endif>Not Interested</option>
                    <option value="invisible" @if($developerProfile->search_status === 'invisible') selected @endif>Invisible</option>
                </select>
            </div>

            <!-- Role Level -->
            <div class="mb-4">
                <label for="role_level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role Level:</label>
                <div class="flex items-center">
                    <input id="role_level_junior" type="radio" value="junior" name="role_level" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if($developerProfile->role_level === 'junior') checked @endif>
                    <label for="role_level_junior" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Junior</label>
                </div>
                <div class="flex items-center">
                    <input id="role_level_mid" type="radio" value="mid" name="role_level" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if($developerProfile->role_level === 'mid') checked @endif>
                    <label for="role_level_mid" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mid</label>
                </div>
                <div class="flex items-center">
                    <input id="role_level_senior" type="radio" value="senior" name="role_level" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if($developerProfile->role_level === 'senior') checked @endif>
                    <label for="role_level_senior" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Senior</label>
                </div>
                <div class="flex items-center">
                    <input id="role_level_principal" type="radio" value="principal" name="role_level" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if($developerProfile->role_level === 'principal') checked @endif>
                    <label for="role_level_principal" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Principal</label>
                </div>
            </div>

            <!-- Employment Type -->
            <div class="mb-4" x-data="{ partTime: {{ $developerProfile->part_time ? 'true' : 'false' }}, fullTime: {{ $developerProfile->full_time ? 'true' : 'false' }}, contract: {{ $developerProfile->contract ? 'true' : 'false' }} }">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employment Type:</label>
                <div class="flex items-center">
                    <input type="checkbox" id="full_time" name="full_time" :value="fullTime ? 1 : 0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" x-on:click="fullTime = !fullTime" x-bind:checked="fullTime">
                    <label for="full_time" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Full Time</label>
                    <input type="hidden" name="full_time" :value="fullTime ? 1 : 0">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="part_time" name="part_time" :value="partTime ? 1 : 0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" x-on:click="partTime = !partTime" x-bind:checked="partTime">
                    <label for="part_time" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Part Time</label>
                    <input type="hidden" name="part_time" :value="partTime ? 1 : 0">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="contract" name="contract" :value="contract ? 1 : 0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" x-on:click="contract = !contract" x-bind:checked="contract">
                    <label for="contract" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Contract</label>
                    <input type="hidden" name="contract" :value="contract ? 1 : 0">
                </div>
            </div>



            <!-- Website -->
            <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Website:</label>
            <div class="flex mb-4">
                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    https://
                </span>
                <input type="text" id="website" name="website" value="{{ $developerProfile->website }}" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="yourwebsite.com">
            </div>

            <!-- GitHub -->
            <label for="github" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Github:</label>
            <div class="flex mb-4">
                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    github.com/
                </span>
                <input type="text" id="github" name="github" value="{{ $developerProfile->github }}" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username">
            </div>

            <!-- Stack Overflow -->
            <label for="stack_overflow" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stack Overflow:</label>
            <div class="flex mb-4">
                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    stackoverflow.com/users/
                </span>
                <input type="text" id="stack_overflow" name="stack_overflow" value="{{ $developerProfile->stack_overflow }}" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username">
            </div>

            <!-- LinkedIn -->
            <label for="linkedin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">LinkedIn:</label>
            <div class="flex mb-4">
                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    linkedin.com/in/
                </span>
                <input type="text" id="linkedin" name="linkedin" value="{{ $developerProfile->linkedin }}" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username">
            </div>

            <!-- Twitter -->
            <label for="twitter" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Twitter:</label>
            <div class="flex mb-4" >
                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    twitter.com/
                </span>
                <input type="text" id="twitter" name="twitter" value="{{ $developerProfile->twitter }}" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username">
            </div>

            <!-- Email Notifications -->
            <div class="flex items-center mt-5 mb-2">
                <input type="checkbox" id="email_notifications" name="email_notifications" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if($developerProfile->email_notifications) checked @endif>
                <label for="email_notifications" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Receive email notifications</label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="text-white bg-customBlue hover:bg-customDarkBlue focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg px-5 py-3 mr-2 mb-2 mt-4 w-full text-sm">Save</button>
            </div>
        </form>

        <script>
            // Update the displayed image when a new image is selected
            const fileInput = document.getElementById('image');
            const profileImage = document.getElementById('profileImage');

            fileInput.addEventListener('change', function () {
                const file = fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        profileImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
    </div>
@endsection
