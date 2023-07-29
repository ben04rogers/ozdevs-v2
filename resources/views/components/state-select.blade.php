@props(['selectedState' => null])

<div class="mb-4">
    <label for="state" class="block text-sm font-medium text-gray-700">State</label>
    <select id="state" class="mt-1 px-3 py-2 border border-gray-300 rounded-md w-full" name="state">
        <option value="">All States</option>
        <option value="New South Wales" {{ $selectedState === 'New South Wales' ? 'selected' : '' }}>New South Wales</option>
        <option value="Victoria" {{ $selectedState === 'Victoria' ? 'selected' : '' }}>Victoria</option>
        <option value="Queensland" {{ $selectedState === 'Queensland' ? 'selected' : '' }}>Queensland</option>
        <option value="Western Australia" {{ $selectedState === 'Western Australia' ? 'selected' : '' }}>Western Australia</option>
        <option value="South Australia" {{ $selectedState === 'South Australia' ? 'selected' : '' }}>South Australia</option>
        <option value="Tasmania" {{ $selectedState === 'Tasmania' ? 'selected' : '' }}>Tasmania</option>
        <option value="Australian Capital Territory" {{ $selectedState === 'Australian Capital Territory' ? 'selected' : '' }}>Australian Capital Territory</option>
        <option value="Northern Territory" {{ $selectedState === 'Northern Territory' ? 'selected' : '' }}>Northern Territory</option>
    </select>
</div>
