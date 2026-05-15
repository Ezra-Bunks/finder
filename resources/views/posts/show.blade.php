<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post Detail
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                <p class="mt-2 text-gray-600">{{ $post->description }}</p>
                <p class="mt-2 text-sm text-gray-500">Location: {{ $post->location_found }}</p>
                <p class="mt-2 text-sm text-gray-500">Date Found: {{ $post->date_found }}</p>
                <p class="mt-2 text-sm text-gray-500">Contact: {{ $post->contact_phone }}</p>

                @if(Auth::id() === $post->user_id)
                    <div class="mt-4 flex gap-4">
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 underline">Edit</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>