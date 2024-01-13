@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <h1>Project Show</h1>
            <div class="card" style="width: 18rem;">
                @if ($project->cover_image)
                <img src="{{ asset('storage/'. $project->cover_image) }}" class="card-img-top" alt="...">
                @endif
                <div class="card-body">
                  <h5 class="card-title">{{ $project->title }}</h5>
                  <p class="card-text">{{ $project->description }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                    @if ($project->category)
                        <h6>Type: {{ $project->category->name }}</h6>
                    @endif
                    </li>
                  <li class="list-group-item">
                    <ul class="d-flex justify-content-between px-0">
                        @foreach ($project->technologies as $technology)
                        <li class="badge text-bg-success">{{ $technology->name }}</li>
                        @endforeach
                    </ul>
                </ul>
                <div class="card-body d-flex justify-content-between">
                  <a  class="btn btn-primary btn-sm" href="{{ route('admin.projects.edit', $project) }}" class="card-link">Edit</a>
                  <a href="#">
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
                  </a>
                </div>
            </div>
        </div>
    </section>
@endsection