@extends('layouts.app')

@section('title', 'Create Colocation')
@section('page_category', 'Colocation')

@section('content')
<div class="px-4 py-8 lg:px-12 max-w-[1000px] mx-auto">
    <div class="mx-auto max-w-2xl">
        <div class="mb-10">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Create New Colocation
            </h1>
            <p class="mt-2 text-slate-500">
                Set up a new shared housing project and manage your roommates and expenses efficiently.
            </p>
        </div>
        
        <form id="colocation-form" action="{{ route('colocations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-8 rounded-xl border border-slate-200 shadow-sm" novalidate>
            @csrf
            <div class="space-y-6">
                <!-- Cover Image -->
                <div class="grid gap-2">
                    <label class="text-sm font-semibold text-slate-700" for="cover_image">Colocation Cover Image</label>
                    <div id="image-upload-wrapper" class="group relative flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-slate-200 rounded-xl bg-slate-50/50 cursor-pointer hover:border-primary/50 hover:bg-slate-50 transition-all duration-200 overflow-hidden">
                        <!-- Default Upload UI -->
                        <div id="upload-placeholder" class="flex flex-col items-center justify-center pb-6 pt-5">
                            <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors mb-2 text-3xl">cloud_upload</span>
                            <p class="mb-1 text-sm text-slate-600 font-medium tracking-tight">Click to upload cover image</p>
                            <p class="text-xs text-slate-400">PNG, JPG or GIF (max. 5MB)</p>
                        </div>
                        
                        <!-- Image Preview UI (Hidden by default) -->
                        <div id="image-preview-container" class="absolute inset-0 hidden">
                            <img id="image-preview" src="#" alt="Preview" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="bg-white/20 backdrop-blur-md text-white px-3 py-1.5 rounded-lg text-xs font-bold border border-white/30">Click to Change</span>
                            </div>
                        </div>

                        <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="cover_image" name="cover_image" type="file" accept="image/*" />
                    </div>
                </div>

                <!-- Name -->
                <div class="grid gap-2">
                    <label class="text-sm font-semibold text-slate-700" for="name">Colocation Name</label>
                    <input class="flex w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-primary disabled:cursor-not-allowed disabled:opacity-50 text-slate-900" 
                           id="name" name="name" placeholder="e.g. Riverside Apartment 4B" type="text" required />
                </div>

                <!-- Address -->
                <div class="grid gap-2">
                    <label class="text-sm font-semibold text-slate-700" for="address">Address / Location</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">location_on</span>
                        <input class="flex w-full rounded-md border border-slate-200 bg-white pl-10 pr-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-primary disabled:cursor-not-allowed disabled:opacity-50 text-slate-900" 
                               id="address" name="address" placeholder="Enter the full street address" type="text" required />
                    </div>
                </div>

                <!-- City -->
                <div class="grid gap-2">
                    <label class="text-sm font-semibold text-slate-700" for="city">City</label>
                    <input class="flex w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-primary disabled:cursor-not-allowed disabled:opacity-50 text-slate-900" 
                           id="city" name="city" placeholder="e.g. Casablanca" type="text" required />
                </div>

                <!-- Description -->
                <div class="grid gap-2">
                    <label class="text-sm font-semibold text-slate-700" for="description">Description</label>
                    <textarea class="flex w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-primary disabled:cursor-not-allowed disabled:opacity-50 text-slate-900" 
                              id="description" name="description" placeholder="Add some details about the colocation rules or house vibes..." rows="4"></textarea>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                <a href="{{ route('colocations.home') }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-md px-6 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                    Cancel
                </a>
                <button class="w-full sm:w-auto inline-flex items-center justify-center rounded-md bg-slate-900 px-8 py-2 text-sm font-semibold text-white shadow hover:bg-slate-800 transition-colors" type="submit">
                    Create Colocation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
