@extends('layouts.admin')

@section('content')
    <div class="row">
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col">
            <h1>
                Posts
            </h1>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th colspan="3" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (Auth::user()->roles()->get()->contains('1'))
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category_id }}</td>
                            <td>
                                @foreach ($post->tags()->get() as $tag)
                                    {{ $tag->name }} <br>
                                @endforeach
                            </td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->updated_at }}</td>
                            <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('admin.posts.edit', $post->slug) }}">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach (Auth::user()->posts()->get()
        as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category_id }}</td>
                            <td>
                                @foreach ($post->tags()->get() as $tag)
                                    {{ $tag->name }} <br>
                                @endforeach
                            </td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->updated_at }}</td>
                            <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('admin.posts.edit', $post->slug) }}">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">{{ $posts->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
