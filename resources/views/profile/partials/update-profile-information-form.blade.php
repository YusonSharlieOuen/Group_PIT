<section>
    @php
        $profilePhotoUrl = null;

        if ($user->profile_photo_path) {
            $isExternalPhoto = str_starts_with($user->profile_photo_path, 'http://')
                || str_starts_with($user->profile_photo_path, 'https://');

            if ($isExternalPhoto) {
                $profilePhotoUrl = $user->profile_photo_path;
            } elseif (Storage::disk('public')->exists($user->profile_photo_path)) {
                $profilePhotoUrl = Storage::disk('public')->url($user->profile_photo_path);
            }
        }
    @endphp

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
            <x-input-label for="profile_photo" :value="__('Profile Photo')" />

            <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center">
                @if ($profilePhotoUrl)
                    <img src="{{ $profilePhotoUrl }}"
                         class="h-24 w-24 rounded-full border-4 border-white object-cover shadow"
                         alt="{{ $user->name }}">
                @else
                    <div class="flex h-24 w-24 items-center justify-center rounded-full border-4 border-white bg-gray-200 text-2xl font-bold text-gray-600 shadow">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <div class="space-y-3">
                    <input id="profile_photo" name="profile_photo" type="file" accept="image/*"
                           class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-md file:border-0 file:bg-gray-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gray-700" />
                    <p class="text-xs text-gray-500">Upload or edit your round menu photo. JPG, PNG, or WEBP up to 2MB.</p>

                    @if ($user->profile_photo_path)
                        <label class="inline-flex items-center gap-2 text-sm text-red-600">
                            <input type="checkbox" name="remove_profile_photo" value="1" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500">
                            Remove current photo
                        </label>
                    @endif
                </div>
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- RENTER INFORMATION --}}

<div>
    <x-input-label for="first_name" :value="__('First Name')" />

    <x-text-input
        id="first_name"
        name="first_name"
        type="text"
        class="mt-1 block w-full"
        :value="old('first_name', $renter->first_name ?? '')"
    />

    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
</div>

<div>
    <x-input-label for="last_name" :value="__('Last Name')" />

    <x-text-input
        id="last_name"
        name="last_name"
        type="text"
        class="mt-1 block w-full"
        :value="old('last_name', $renter->last_name ?? '')"
    />

    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
</div>

<div>
    <x-input-label for="address" :value="__('Address')" />

    <textarea
        id="address"
        name="address"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
        rows="3"
    >{{ old('address', $renter->address ?? '') }}</textarea>

    <x-input-error class="mt-2" :messages="$errors->get('address')" />
</div>

<div>
    <x-input-label for="phone" :value="__('Phone Number')" />

    <x-text-input
        id="phone"
        name="phone"
        type="text"
        class="mt-1 block w-full"
        :value="old('phone', $renter->phone ?? '')"
    />

    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
</div>

<div>
    <x-input-label for="preferred_property_type" :value="__('Preferred Property Type')" />

    <x-text-input
        id="preferred_property_type"
        name="preferred_property_type"
        type="text"
        class="mt-1 block w-full"
        :value="old('preferred_property_type', $renter->preferred_property_type ?? '')"
    />

    <x-input-error class="mt-2" :messages="$errors->get('preferred_property_type')" />
</div>

<div>
    <x-input-label for="max_rent" :value="__('Maximum Rent Budget')" />

    <x-text-input
        id="max_rent"
        name="max_rent"
        type="number"
        step="0.01"
        class="mt-1 block w-full"
        :value="old('max_rent', $renter->max_rent ?? '')"
    />

    <x-input-error class="mt-2" :messages="$errors->get('max_rent')" />
</div>

<div>
    <x-input-label for="comments" :value="__('Comments')" />

    <textarea
        id="comments"
        name="comments"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
        rows="4"
    >{{ old('comments', $renter->comments ?? '') }}</textarea>

    <x-input-error class="mt-2" :messages="$errors->get('comments')" />
</div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
