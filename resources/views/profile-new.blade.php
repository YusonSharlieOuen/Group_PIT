<x-app-layout>
    @php
        $user = auth()->user();
        $profilePhotoUrl = null;

        if ($user?->profile_photo_path) {
            $isExternalPhoto = str_starts_with($user->profile_photo_path, 'http://')
                || str_starts_with($user->profile_photo_path, 'https://');

            if ($isExternalPhoto) {
                $profilePhotoUrl = $user->profile_photo_path;
            } elseif (Storage::disk('public')->exists($user->profile_photo_path)) {
                $profilePhotoUrl = Storage::disk('public')->url($user->profile_photo_path);
            }
        }
    @endphp

    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-serif text-3xl text-gray-800 leading-tight uppercase tracking-[0.3em]">
                {{ __('Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Profile Header -->
                    <div class="flex items-center justify-between mb-8 pb-8 border-b border-gray-200">
                        <div class="flex items-center gap-6">
                            <!-- Avatar -->
                            <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                                @if($profilePhotoUrl)
                                    <img src="{{ $profilePhotoUrl }}" alt="Profile" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-12 h-12 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                @endif
                            </div>

                            <!-- User Info -->
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800 uppercase tracking-wider">
                                    {{ auth()->user()->name }}
                                </h3>
                                <p class="text-gray-600 mt-1">{{ auth()->user()->email }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4">
                            <a href="{{ route('profile.edit') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                                Edit Profile
                            </a>
                            <button class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                                ADD INFO
                            </button>
                        </div>
                    </div>

                    <!-- Profile Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Left Column - Details -->
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 uppercase tracking-wide mb-6">YOUR PROFILE DETAILS</h4>
                            
                            <div class="space-y-4">
                                @if($userProfile = auth()->user()->profile)
                                    <div>
                                        <p class="text-gray-600 text-sm">First Name:</p>
                                        <p class="text-gray-900 font-semibold">{{ $userProfile->first_name ?? auth()->user()->name }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-gray-600 text-sm">Last Name:</p>
                                        <p class="text-gray-900 font-semibold">{{ $userProfile->last_name ?? '' }}</p>
                                    </div>

                                    <div>
                                        <p class="text-gray-600 text-sm">Birthdate:</p>
                                        <p class="text-gray-900 font-semibold">{{ $userProfile->birthdate ?? 'Not specified' }}</p>
                                    </div>

                                    <div>
                                        <p class="text-gray-600 text-sm">Address:</p>
                                        <p class="text-gray-900 font-semibold">{{ $userProfile->address ?? 'Not specified' }}</p>
                                    </div>

                                    <div>
                                        <p class="text-gray-600 text-sm">Contact Info:</p>
                                        <p class="text-gray-900 font-semibold">{{ $userProfile->contact_number ?? 'Not specified' }}</p>
                                    </div>

                                    <div>
                                        <p class="text-gray-600 text-sm">Email Address:</p>
                                        <p class="text-gray-900 font-semibold">{{ auth()->user()->email }}</p>
                                    </div>
                                @else
                                    <div class="bg-gray-100 p-4 rounded-lg text-center text-gray-600">
                                        <p>No profile information available. Click "Edit Profile" to add your details.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Right Column - About Section -->
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 uppercase tracking-wide mb-6">About Renting a House</h4>
                            
                            <div class="bg-gray-100 rounded-lg p-8 min-h-[300px] flex flex-col items-center justify-center text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-2m-9-2l4 2m-5-9l7-4 7 4"></path>
                                </svg>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Learn more about our rental services, tenant requirements, lease terms, and property management solutions. We're here to help make your rental experience smooth and rewarding.
                                </p>
                                <a href="{{ route('services') }}" class="mt-6 text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                    Explore Our Services →
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information Section -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h4 class="text-lg font-bold text-gray-800 uppercase tracking-wide mb-6">Recent Activity</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                                <p class="text-2xl font-bold text-blue-600">0</p>
                                <p class="text-gray-600 text-sm mt-2">Properties Saved</p>
                            </div>
                            
                            <div class="bg-green-50 p-6 rounded-lg border border-green-100">
                                <p class="text-2xl font-bold text-green-600">0</p>
                                <p class="text-gray-600 text-sm mt-2">Properties Listed</p>
                            </div>
                            
                            <div class="bg-purple-50 p-6 rounded-lg border border-purple-100">
                                <p class="text-2xl font-bold text-purple-600">0</p>
                                <p class="text-gray-600 text-sm mt-2">Active Inquiries</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
