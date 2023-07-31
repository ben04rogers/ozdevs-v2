@extends("layouts.app")

@section("content")
    <div class="max-w-2xl mx-auto mb-8">
        <h1 class="text-2xl md:text-3xl font-bold mb-8 text-center">Edit Company Profile</h1>

        @if($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('updateCompany', ['id' => $companyProfile->user_id]) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg">
            @csrf
            @method('PUT')

            <!-- Image -->
            <div class="mb-4">
                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company Image:</label>
                @if ($companyProfile->image)
                    <img class="rounded w-24 h-24 md:w-32 md:h-32 border mb-3" id="profileImage" src="{{$companyProfile->image}}" alt="Extra large avatar">
                @else
                    <img class="rounded w-24 h-24 md:w-32 md:h-32 border mb-3" id="profileImage" src="{{ asset('img/profile-placeholder.png') }}" alt="Extra large avatar">
                @endif
                <input type="file" id="image" name="image" class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer dark:text-gray-400 focus:outline-none" accept="image/*">
            </div>

            <!-- Company Name -->
            <div class="mb-4">
                <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company:</label>
                <input type="text" id="company_name" name="company_name" value="{{ $companyProfile->company_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <!-- Staff Name -->
            <div class="mb-4">
                <label for="staff_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Staff Name:</label>
                <input type="text" id="staff_name" name="staff_name" value="{{ $companyProfile->staff_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <!-- Staff Role -->
            <div class="mb-4">
                <label for="staff_role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Staff Role:</label>
                <input type="text" id="staff_role" name="staff_role" value="{{ $companyProfile->staff_role }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <!-- Bio -->
            <div class="mb-4">
                <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bio:</label>
                <textarea id="bio" name="bio" rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $companyProfile->bio }}</textarea>
            </div>

            <!-- Website -->
            <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Website:</label>
            <div class="flex mb-4">
                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    https://
                </span>
                <input type="text" id="website" name="website" value="{{ $companyProfile->website }}" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="yourwebsite.com">
            </div>

            <!-- Email Notifications -->
            <div class="flex items-center mt-5 mb-2">
                <input type="checkbox" id="email_notifications" name="email_notifications" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if($companyProfile->email_notifications) checked @endif>
                <label for="email_notifications" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Receive email notifications</label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="text-white bg-customBlue hover:bg-customDarkBlue focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg px-5 py-3 mr-2 mb-2 mt-4 w-full text-sm">Save</button>
            </div>
        </form>
        <script src="{{ asset('js/profile_image.js') }}"></script>
    </div>
@endsection
