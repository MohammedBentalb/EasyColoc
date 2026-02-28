@extends('layouts.app')

@section('title', 'Category Management - ColocSaaS')

@section('page_category', $user->getActiveColocation()->first()->name)
@section('page_link', "/colocations/{$user->getActiveColocation()->first()->id}")

@section('content')
<div class="px-4 py-8 lg:px-12 max-w-[1000px] mx-auto">
    <div class="space-y-8">
        <div class="space-y-8 mt-4">
            <!-- Page Header -->
            <div class="space-y-1">
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900">
                    Categories
                </h2>
                <p class="text-sm text-slate-500">
                    Manage expense categories for this colocation
                </p>
            </div>

            <!-- Add Category Card -->
            <div class="bg-white border border-slate-200 rounded-lg p-6 shadow-sm">
                <div class="mb-4">
                    <h3 class="text-sm font-medium mb-1 text-slate-900">
                        Add New Category
                    </h3>
                    <p class="text-xs text-slate-500">
                        Create labels to organize your shared household costs.
                    </p>
                </div>
                <form action="{{ route('categories.create', $user->getActiveColocation()->first()->id) }}" method="POST" class="flex gap-3">
                    @csrf
                    <div class="relative flex-1">
                        <input
                            class="w-full bg-transparent border border-slate-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary transition-all placeholder:text-slate-400"
                            placeholder="e.g., Utilities, Internet, Cleaning Supplies"
                            type="text"
                            name="name"
                        />
                    </div>
                    <button
                        type="submit"
                        class="bg-slate-900 text-white text-sm font-medium px-4 py-2 rounded-md hover:bg-slate-800 transition-colors"
                    >
                        Add Category
                    </button>
                </form>
            </div>

            @if (isset($categories))
            <!-- Category List -->
            <div class="space-y-4">
                <div class="flex items-center justify-between px-1">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Category Name</span>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Actions</span>
                </div>
                <div class="bg-white border border-slate-200 rounded-lg divide-y divide-slate-100 overflow-hidden shadow-sm">
                    @foreach ($categories as $category)                    
                    <form action="{{ route('categories.delete',['colocation' => $user->getActiveColocation()->first()->id , 'category' => $category->id]) }}" method="POST" class="flex items-center justify-between p-4 group">
                        @csrf
                        @method('DELETE')
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            <div>
                                <p class="text-sm font-medium text-slate-900">{{ $category->name }}</p>
                                <p class="text-xs text-slate-500">{{ $category->depenses()->count() }} expenses linked</p>
                            </div>
                        </div>
                        <button class="text-slate-400 hover:text-red-500 p-2 rounded-md hover:bg-red-50 transition-all flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
