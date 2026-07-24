<x-nav title="Edit Location">
    <div class="max-w-md mx-auto pt-10">
        <div class="bg-[#0D0D0D] border border-white/5 rounded-3xl p-10 shadow-2xl">

            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-white mb-2">Edit Location</h2>
                <p class="text-gray-500 text-sm">Update your regional preferences</p>
            </div>

            <form method="POST" action="{{ route('location.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- COUNTRY --}}
                <div>
                    <label class="block mb-2 text-xs uppercase tracking-widest font-semibold text-gray-500">
                        Country
                    </label>
                    <select id="country" name="country_id"
                        class="w-full px-4 py-4 rounded-2xl bg-black border border-white/10 text-white focus:border-white focus:ring-1 focus:ring-white transition outline-none appearance-none">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ old('country_id', $user->country_id) == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <p class="text-red-400 text-xs mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- STATE --}}
                <div>
                    <label class="block mb-2 text-xs uppercase tracking-widest font-semibold text-gray-500">
                        State
                    </label>
                    <select id="state" name="state_id"
                        class="w-full px-4 py-4 rounded-2xl bg-black border border-white/10 text-white focus:border-white focus:ring-1 focus:ring-white transition outline-none appearance-none">
                        <option value="">Select State</option>
                    </select>
                    <p id="state-error" class="text-red-400 text-xs mt-2 ml-1 hidden">Please select a state first.</p>
                    @error('state_id')
                        <p class="text-red-400 text-xs mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CITY --}}
                <div>
                    <label class="block mb-2 text-xs uppercase tracking-widest font-semibold text-gray-500">
                        City
                    </label>
                    <select id="city" name="city_id"
                        class="w-full px-4 py-4 rounded-2xl bg-black border border-white/10 text-white focus:border-white focus:ring-1 focus:ring-white transition outline-none appearance-none">
                        <option value="">Select City</option>
                    </select>
                    <p id="city-error" class="text-red-400 text-xs mt-2 ml-1 hidden">Please select a city first.</p>
                    @error('city_id')
                        <p class="text-red-400 text-xs mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- SUBMIT --}}
                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-4 mt-4 rounded-2xl bg-white text-black font-bold hover:bg-gray-200 transition-all active:scale-[0.98]">
                        Save Location
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-nav>

{{-- SCRIPT --}}
<script>
    const countries = @json($countries);

    const countrySelect = document.getElementById('country');
    const stateSelect = document.getElementById('state');
    const citySelect = document.getElementById('city');

    const stateError = document.getElementById('state-error');
    const cityError = document.getElementById('city-error');

    // Current selections (sticky form with old() fallback)
    let currentCountry = "{{ old('country_id', $user->country_id) }}";
    let currentState = "{{ old('state_id', $user->state_id) }}";
    let currentCity = "{{ old('city_id', $user->city_id) }}";

    function loadStates(countryId, selectedState = null) {
        stateSelect.innerHTML = '<option value="">Select State</option>';
        citySelect.innerHTML = '<option value="">Select City</option>';
        stateError.classList.add('hidden');
        cityError.classList.add('hidden');

        if (!countryId) return;

        const country = countries.find(c => c.id == countryId);
        if (!country) return;

        country.states.forEach(state => {
            stateSelect.innerHTML += `
                <option value="${state.id}" ${selectedState == state.id ? 'selected' : ''}>
                    ${state.name}
                </option>`;
        });

        if (selectedState) loadCities(selectedState, currentCity);
    }

    function loadCities(stateId, selectedCity = null) {
        citySelect.innerHTML = '<option value="">Select City</option>';
        cityError.classList.add('hidden');

        if (!stateId) return;

        countries.forEach(country => {
            country.states.forEach(state => {
                if (state.id == stateId) {
                    state.cities.forEach(city => {
                        citySelect.innerHTML += `
                            <option value="${city.id}" ${selectedCity == city.id ? 'selected' : ''}>
                                ${city.name}
                            </option>`;
                    });
                }
            });
        });
    }

    // EVENT LISTENERS
    countrySelect.addEventListener('change', function () {
        currentCountry = this.value;
        currentState = null;
        currentCity = null;
        loadStates(this.value);
    });

    stateSelect.addEventListener('change', function () {
        currentState = this.value;
        currentCity = null;
        loadCities(this.value);
        stateError.classList.add('hidden');
    });

    citySelect.addEventListener('change', function () {
        currentCity = this.value;
        cityError.classList.add('hidden');
    });

    stateSelect.addEventListener('click', function () {
        if (!countrySelect.value) {
            stateError.textContent = 'Please select a country first.';
            stateError.classList.remove('hidden');
            countrySelect.focus();
        } else {
            stateError.classList.add('hidden');
        }
    });

    citySelect.addEventListener('click', function () {
        if (!stateSelect.value) {
            cityError.textContent = 'Please select a state first.';
            cityError.classList.remove('hidden');
            stateSelect.focus();
        } else {
            cityError.classList.add('hidden');
        }
    });

    // FORM SUBMIT VALIDATION
    document.querySelector('form').addEventListener('submit', function(e) {
        let valid = true;

        if (!countrySelect.value) {
            stateError.textContent = 'Please select a country first.';
            stateError.classList.remove('hidden');
            countrySelect.focus();
            valid = false;
        }

        if (!stateSelect.value) {
            cityError.textContent = 'Please select a state first.';
            cityError.classList.remove('hidden');
            stateSelect.focus();
            valid = false;
        }

        if (!citySelect.value) {
            cityError.textContent = 'Please select a city.';
            cityError.classList.remove('hidden');
            citySelect.focus();
            valid = false;
        }

        if (!valid) e.preventDefault();
    });

    // INITIAL LOAD
    if (currentCountry) {
        loadStates(currentCountry, currentState);
    }
</script>