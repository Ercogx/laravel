@extends('layouts.app')

@section('content')
    @php /** @var \App\Models\BlogPost $item */@endphp

    @include('blog.admin.posts.include.result_message')

    @if($item->exists)
        <form method="POST" action="{{ route('blog.admin.posts.update', $item->id) }}">
        @method('PATCH')
    @else
        <form method="POST" action="{{ route('blog.admin.posts.store') }}">
    @endif
        @csrf

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.posts.include.post_edit_main_col')
                </div>
                <div class="col-md-4">
                    @include('blog.admin.posts.include.post_edit_add_col')
                </div>
            </div>
        </div>
    </form>
@endsection
