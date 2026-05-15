@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">

    {{-- Page Title --}}
    <h1 class="text-2xl font-bold text-gray-800 mb-6"> Lost & Found Noticeboard</h1>

    {{-- Search & Filter Bar --}}
    <form method="GET" action="{{ route('dashboard') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-8">
        <div class="flex flex-wrap gap-3">
            
            {{-- Title Search --}}
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs text-gray-500 mb-1">Search by item name</label>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="e.g. Blue Nokia phone..."
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500"
                >
            </div>

            {{-- Date Posted Search --}}
            <div class="min-w-[180px]">
                <label class="block text-xs text-gray-500 mb-1">Search by date posted</label>
                <input 
                    type="date" 
                    name="posted_on" 
                    value="{{ request('posted_on') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500"
                >
            </div>

            {{-- Category Filter --}}
            <div class="min-w-[180px]">
                <label class="block text-xs text-gray-500 mb-1">Filter by category</label>
                <select 
                    name="category_id"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500"
                >
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Buttons --}}
            <div class="flex items-end gap-2">
                <button 
                    type="submit"
                    class="bg-teal-600 text-white px-4 py-2 rounded-md text-sm hover:bg-teal-700 transition"
                >
                    Search
                </button>
                <a 
                    href="{{ route('dashboard') }}"
                    class="bg-gray-100 text-gray-600 px-4 py-2 rounded-md text-sm hover:bg-gray-200 transition"
                >
                    Clear
                </a>
            </div>

        </div>
    </form>

    {{-- Posts Grouped by Date --}}
    @forelse($posts as $date => $dayPosts)
        <div class="mb-8">
            
            {{-- Day Header --}}
            <div class="flex items-center gap-3 mb-4">
                <h2 class="text-lg font-semibold text-gray-700">
                    @php $carbon = \Carbon\Carbon::parse($date); @endphp
                    @if($carbon->isToday())
                        Today — {{ $carbon->format('d M Y') }}
                    @elseif($carbon->isYesterday())
                        Yesterday — {{ $carbon->format('d M Y') }}
                    @else
                        {{ $carbon->format('l, d M Y') }}
                    @endif
                </h2>
                <span class="bg-teal-100 text-teal-700 text-xs font-medium px-2 py-1 rounded-full">
                    {{ $dayPosts->count() }} item(s)
                </span>
            </div>

            {{-- Post Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($dayPosts as $post)
                    <a href="{{ route('posts.show', $post) }}" class="block bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md hover:border-teal-300 transition">
                        
                        {{-- Category Badge --}}
                        <span class="inline-block bg-teal-50 text-teal-700 text-xs font-medium px-2 py-1 rounded-full mb-2">
                            {{ $post->category->name }}
                        </span>

                        {{-- Title --}}
                        <h3 class="font-semibold text-gray-800 mb-1">{{ $post->title }}</h3>

                        {{-- Location & Phone --}}
                        <p class="text-sm text-gray-500">📍 {{ $post->location_found }}</p>
                        <p class="text-sm text-gray-500">📞 {{ $post->contact_phone }}</p>

                        {{-- Posted by --}}
                        <p class="text-xs text-gray-400 mt-2">Posted by {{ $post->user->name }}</p>

                    </a>
                @endforeach
            </div>

        </div>
    @empty
        {{-- Empty State --}}
        <div class="text-center py-16 text-gray-400">
            <p class="text-4xl mb-3">🔍</p>
            <p class="text-lg font-medium">No items found</p>
            <p class="text-sm mt-1">Try adjusting your search or check back later</p>
        </div>
    @endforelse

</div>
@endsection