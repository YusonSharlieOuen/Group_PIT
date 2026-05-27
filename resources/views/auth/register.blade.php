<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name"
                class="block mt-1 w-full"
                type="text"
                name="first_name"
                :value="old('first_name')"
                required autofocus />

            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last Name')" />

            <x-text-input id="last_name"
                class="block mt-1 w-full"
                type="text"
                name="last_name"
                :value="old('last_name')"
                required />

            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />

            <textarea id="address"
                name="address"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm"
                required>{{ old('address') }}</textarea>

            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />

            <x-text-input id="phone"
                class="block mt-1 w-full"
                type="text"
                name="phone"
                :value="old('phone')"
                required />

            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Preferred Property Type -->
        <div class="mt-4">
            <x-input-label for="preferred_property_type" :value="__('Preferred Property Type')" />

            <select id="preferred_property_type"
                name="preferred_property_type"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">

                <option value="">Select Type</option>

                <option value="Apartment">Apartment</option>
                <option value="House">House</option>
                <option value="Condo">Condo</option>
                <option value="Studio">Studio</option>
            </select>

            <x-input-error :messages="$errors->get('preferred_property_type')" class="mt-2" />
        </div>

        <!-- Max Rent -->
        <div class="mt-4">
            <x-input-label for="max_rent" :value="__('Maximum Rent Budget')" />

            <x-text-input id="max_rent"
                class="block mt-1 w-full"
                type="number"
                step="0.01"
                name="max_rent"
                :value="old('max_rent')" />

            <x-input-error :messages="$errors->get('max_rent')" class="mt-2" />
        </div>

        <!-- Comments -->
        <div class="mt-4">
            <x-input-label for="comments" :value="__('Comments')" />

            <textarea id="comments"
                name="comments"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old('comments') }}</textarea>

            <x-input-error :messages="$errors->get('comments')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation"
                :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>