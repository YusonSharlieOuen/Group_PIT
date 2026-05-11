<x-app-layout>
    <div class="bg-[#b39e60] w-full py-2 px-4 text-center">
        <p class="text-white text-sm font-medium tracking-wide shadow-sm">
            Ready to find your next great tenant? Let's list your beautiful rental house.
        </p>
    </div>

    <div class="w-full h-24 bg-cover bg-center relative flex items-center justify-center shadow-inner" style="background-image: url('{{ asset('images/photo4.jpg') }}');">
        <div class="absolute inset-0 bg-black/40"></div>
        <h2 class="relative z-10 text-white text-2xl md:text-3xl font-serif tracking-widest uppercase text-center px-4">
            Get started with Your Property Listing
        </h2>
    </div>

    <div class="bg-[#fcfbf9] min-h-screen py-10 font-sans">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            
            <h1 class="text-3xl font-serif text-gray-900 mb-8 uppercase tracking-widest border-b-2 border-gray-200 pb-4 inline-block">
                Property Listing
            </h1>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <div class="lg:col-span-3 space-y-6 hidden lg:block">
                    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('images/house1.jpg') }}" class="w-full h-40 object-cover" alt="Villa" onerror="this.style.display='none'">
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 text-md leading-tight mb-1">Address Villa, Mianan</h3>
                            <div class="flex justify-between items-baseline mb-2">
                                <span class="text-gray-900 font-extrabold text-lg">$2,500 / month</span>
                                <span class="text-gray-800 font-bold text-xs">3d, 2 Ba</span>
                            </div>
                            <p class="text-gray-500 text-[10px] mb-3 leading-relaxed">
                                Modern rental villa with shared beach access and complete home features.
                            </p>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-gray-100 text-gray-700 py-1.5 rounded text-[10px] font-bold hover:bg-gray-200">Save Property</button>
                                <button class="flex-1 bg-[#6caec1] text-white py-1.5 rounded text-[10px] font-bold hover:bg-[#5a93a3]">View Details</button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('images/house2.jpg') }}" class="w-full h-40 object-cover" alt="Villa" onerror="this.style.display='none'">
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 text-md leading-tight mb-1">Address, Villa, Mianai</h3>
                            <div class="flex justify-between items-baseline mb-2">
                                <span class="text-gray-900 font-extrabold text-lg">$1,800 / month</span>
                                <span class="text-gray-800 font-bold text-xs">3 Bd, 2 Ba</span>
                            </div>
                            <p class="text-gray-500 text-[10px] mb-3 leading-relaxed">
                                Spacious family rental home in a gated community, close to local amenities.
                            </p>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-gray-100 text-gray-700 py-1.5 rounded text-[10px] font-bold hover:bg-gray-200">Save Rental</button>
                                <button class="flex-1 bg-[#6caec1] text-white py-1.5 rounded text-[10px] font-bold hover:bg-[#5a93a3]">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 bg-white rounded-xl shadow-md border border-gray-100 p-6 sm:p-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Step 1: Property Details</h2>
                    
                    <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Property Type</label>
                                <select name="property_type" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] text-sm bg-gray-50">
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Beds</label>
                                <input type="number" name="beds" min="1" value="1" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] text-sm bg-gray-50">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Baths</label>
                                <input type="number" name="baths" min="1" value="1" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] text-sm bg-gray-50">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Rental Price per Month</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">$</span>
                                    <input type="text" name="price" placeholder="2,500" class="w-full pl-7 border-gray-300 rounded-md shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] text-sm bg-gray-50">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Square Feet</label>
                                <input type="number" name="sqft" placeholder="1" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] text-sm bg-gray-50">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Deposit Amount</label>
                            <div class="relative mb-4">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">$</span>
                                <input type="text" name="deposit" class="w-full pl-7 border-gray-300 rounded-md shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] text-sm bg-gray-50">
                            </div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Address</label>
                            <input type="text" name="address" placeholder="Google Maps address-autocomplete..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] text-sm bg-gray-50 text-gray-400">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Contact Name</label>
                                <input type="text" name="contact_name" placeholder="Contact Phone" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] text-sm bg-gray-50">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Contact Email</label>
                                <input type="email" name="contact_email" placeholder="Contact Email" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] text-sm bg-gray-50">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Description</label>
                            <textarea name="description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] text-sm bg-gray-50"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 mb-1">Upload Photos</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 transition cursor-pointer">
                                    <div class="flex gap-2 text-gray-400 mb-2">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="text-xs text-gray-600 font-medium mb-3">Drag & Drop or Click to Upload</p>
                                    <button type="button" class="bg-[#6caec1] text-white px-4 py-1.5 rounded text-xs font-bold shadow-sm hover:bg-[#5a93a3]">Add up to 20 Photos</button>
                                </div>
                                
                                <div class="mt-4">
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Lease Term</label>
                                    <select name="lease_term" class="w-1/2 border-gray-300 rounded-md shadow-sm focus:ring-[#5c9aa9] text-sm bg-gray-50">
                                        <option value="6 Months">6 Months</option>
                                        <option value="12 Months" selected>12 Months</option>
                                        <option value="18 Months">18 Months</option>
                                        <option value="24 Months">24 Months</option>
                                        <option value="Month-to-Month">Month-to-Month</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-2">Utilities Included</label>
                                <div class="space-y-2">
                                    <label class="flex items-center text-xs text-gray-700">
                                        <input type="checkbox" name="utilities[]" value="Electricity" class="rounded border-gray-300 text-[#5c9aa9] shadow-sm focus:ring-[#5c9aa9] mr-2"> Electricity
                                    </label>
                                    <label class="flex items-center text-xs text-gray-700">
                                        <input type="checkbox" name="utilities[]" value="Water" class="rounded border-gray-300 text-[#5c9aa9] shadow-sm focus:ring-[#5c9aa9] mr-2"> Water
                                    </label>
                                    <label class="flex items-center text-xs text-gray-700">
                                        <input type="checkbox" name="utilities[]" value="Gas" class="rounded border-gray-300 text-[#5c9aa9] shadow-sm focus:ring-[#5c9aa9] mr-2"> Gas
                                    </label>
                                    <label class="flex items-center text-xs text-gray-700">
                                        <input type="checkbox" name="utilities[]" value="Internet" class="rounded border-gray-300 text-[#5c9aa9] shadow-sm focus:ring-[#5c9aa9] mr-2"> Internet
                                    </label>
                                    <label class="flex items-center text-xs text-gray-700">
                                        <input type="checkbox" name="utilities[]" value="Garbage" class="rounded border-gray-300 text-[#5c9aa9] shadow-sm focus:ring-[#5c9aa9] mr-2"> Garbage
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                            <button type="button" class="bg-[#f0eee6] text-gray-700 px-6 py-2 rounded-md font-bold text-sm hover:bg-gray-200 transition border border-gray-300 shadow-sm">
                                Save for Later
                            </button>
                            <button type="submit" class="bg-[#b39e60] text-white px-6 py-2 rounded-md font-bold text-sm hover:bg-[#9c8952] transition shadow-sm">
                                Continue to Step 2
                            </button>
                        </div>
                    </form>
                </div>

                <div class="lg:col-span-3 space-y-6">
                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                        <h3 class="font-bold text-gray-900 mb-4 text-sm">Listing Checklist</h3>
                        
                        <div class="space-y-4 relative before:absolute before:inset-0 before:ml-2.5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-300 before:to-transparent">
                            
                            <div class="relative flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full bg-[#2da664] flex items-center justify-center ring-4 ring-white z-10 shrink-0">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900">Property Basics</span>
                            </div>

                            <div class="relative flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full bg-[#2da664] flex items-center justify-center ring-4 ring-white z-10 shrink-0">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900">Contact Info</span>
                            </div>

                            <div class="relative flex items-center gap-3 opacity-60">
                                <div class="w-5 h-5 rounded-full bg-gray-300 ring-4 ring-white z-10 shrink-0"></div>
                                <span class="text-sm font-bold text-gray-700">Photo Gallery</span>
                            </div>

                            <div class="relative flex items-center gap-3 opacity-60">
                                <div class="w-5 h-5 rounded-full bg-gray-300 ring-4 ring-white z-10 shrink-0"></div>
                                <span class="text-sm font-bold text-gray-700">Property Narrative</span>
                            </div>

                            <div class="relative flex items-center gap-3 opacity-60">
                                <div class="w-5 h-5 rounded-full bg-gray-300 ring-4 ring-white z-10 shrink-0"></div>
                                <span class="text-sm font-bold text-gray-700">Preview and Submit</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#eef3f2] rounded-xl shadow-sm border border-gray-200 h-48 w-full overflow-hidden relative">
                        <img src="{{ asset('images/map-placeholder.jpg') }}" class="w-full h-full object-cover" alt="Map" onerror="this.style.display='none'">
                        <div class="absolute inset-0 flex flex-col items-center justify-center -z-10 bg-gray-100 text-gray-400">
                            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-xs font-medium">Location Preview</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>