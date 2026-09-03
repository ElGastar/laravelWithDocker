this is blase file
@foreach ($posts as $post)
    <p>{{ $post->name }}</p>
    <p>{{ $post->email }}</p>
    <hr>
@endforeach 