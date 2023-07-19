@extends("layouts.app")

@section("content")
    <form action="{{ route('newDeveloper') }}" method="POST">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <!-- Hero -->
        <div>
            <label for="hero">Hero:</label>
            <input type="text" id="hero" name="hero" required>
        </div>

        <!-- City -->
        <div>
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>
        </div>

        <!-- State -->
        <div>
            <label for="state">State:</label>
            <select id="state" name="state" required>
                <option value="Australian Capital Territory">Australian Capital Territory</option>
                <option value="New South Wales">New South Wales</option>
                <option value="Northern Territory">Northern Territory</option>
                <option value="Queensland">Queensland</option>
                <option value="South Australia">South Australia</option>
                <option value="Tasmania">Tasmania</option>
                <option value="Victoria">Victoria</option>
                <option value="Western Australia">Western Australia</option>
            </select>
        </div>

        <!-- Country -->
        <div>
            <label for="country">Country:</label>
            <select id="country" name="country" required>
                <option value="Australia">Australia</option>
            </select>
        </div>

        <!-- Bio -->
        <div>
            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio" required></textarea>
        </div>

        <!-- Search Status -->
        <div>
            <label for="search_status">Search Status:</label>
            <select id="search_status" name="search_status">
                <option value="actively looking">Actively Looking</option>
                <option value="open">Open</option>
                <option value="not interested">Not Interested</option>
                <option value="invisible">Invisible</option>
            </select>
        </div>

        <!-- Role Level -->
        <div>
            <label for="role_level">Role Level:</label>
            <select id="role_level" name="role_level">
                <option value="junior">Junior</option>
                <option value="mid">Mid</option>
                <option value="senior">Senior</option>
                <option value="principal">Principal</option>
            </select>
        </div>

        <!-- Employment Type -->
        <div>
            <label>Employment Type:</label>
            <div>
                <input type="checkbox" id="part_time" name="part_time" value="0">
                <label for="part_time">Part Time</label>
            </div>
            <div>
                <input type="checkbox" id="full_time" name="full_time" value="0">
                <label for="full_time">Full Time</label>
            </div>
            <div>
                <input type="checkbox" id="contract" name="contract" value="0">
                <label for="contract">Contract</label>
            </div>
        </div>

        <!-- Website -->
        <div>
            <label for="website">Website:</label>
            <input type="text" id="website" name="website">
        </div>

        <!-- GitHub -->
        <div>
            <label for="github">GitHub:</label>
            <input type="text" id="github" name="github">
        </div>

        <!-- Twitter -->
        <div>
            <label for="twitter">Twitter:</label>
            <input type="text" id="twitter" name="twitter">
        </div>

        <!-- Stack Overflow -->
        <div>
            <label for="stack_overflow">Stack Overflow:</label>
            <input type="text" id="stack_overflow" name="stack_overflow">
        </div>

        <!-- LinkedIn -->
        <div>
            <label for="linkedin">LinkedIn:</label>
            <input type="text" id="linkedin" name="linkedin">
        </div>

        <!-- Email Notifications -->
        <div>
            <input type="checkbox" id="email_notifications" name="email_notifications" value="1">
            <label for="email_notifications">Receive Email Notifications</label>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit">Create Profile</button>
        </div>
    </form>
@endsection
