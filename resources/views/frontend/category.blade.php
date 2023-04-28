@extends('layouts.frontend')

@section('content')
    <div class="md:mt-28 mt-24 container mx-auto">
        <form action="{{ route('items.category') }}" method="get">
            <label for="categories">Categories:</label>
            <div>
                @foreach ($categories as $category)
                    <button type="submit" name="categories[]" value="{{ $category->id }}"
                        class="{{ in_array($category->id, $selectedCategories) }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
            <button type="submit">Filter</button>
        </form>
        <hr>
        <ul class="mt-20">
            @foreach ($items as $item)
                <li>{{ $item->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection
