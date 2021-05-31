<h1>Nuovo Commento</h1>
<h2>Il post commentato è: {{$post->title}}</h2>
<a href="{{route('admin.posts.show', ['post' => $post->id])}}">Vai al post</a>