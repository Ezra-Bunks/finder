@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome to CampusFind</h1>
        <p class="text-gray-500 mb-6">Select your institution to see lost and found items near you.</p>

        <form method="POST" action="{{ route('institution.store') }}">
            @csrf

            <div class="mb-4">
                <label for="institution_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Your Institution
                </label>
                <select 
                    name="institution_id" 
                    id="institution_id"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500"
                >
                    <option value="">-- Choose your institution --</option>
                    @foreach($institutions as $institution)
                        <option value="{{ $institution->id }}">
                            {{ $institution->name }}
                        </option>
                    @endforeach
                </select>

                @error('institution_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button 
                type="submit"
                class="w-full bg-teal-600 text-white py-2 px-4 rounded-md hover:bg-teal-700 transition"
            >
                Continue →
            </button>

        </form>
    </div>
</div>
@endsection