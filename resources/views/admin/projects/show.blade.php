@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <h1>Project Show</h1>
            <h1>{{ $project->title }}</h1>
            <p>{{ $project->description }}</p>
            @if ($project->category)
                <p>{{ $project->category->name }}</p>
            @endif
                
            <ul>
                @foreach ($project->technologies as $technology)
                <li class="badge text-bg-success">{{ $technology->name }}</li>
                @endforeach
            </ul>
            <ul class="list-inline">
                <li class="mb-3">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.projects.edit', $project) }}">Edit</a>
                </li>
                <li>
                    <button id="myBtn" class="btn btn-sm btn-danger delete">Delete</button>
                    <div id="bgForm" class="bg-form">
                        <div class="d-flex gap-3 delete-form">
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-lg">Yes</button>
                            </form>
                        <button id="noBtn" class="btn btn-primary btn-lg">No</button>
                    </div>
                </li>
            </ul>
           
        
        </div>
    </section>
@endsection