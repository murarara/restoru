<ul class="list-group list-group-flush">
    @foreach($posts as $post)
        <li class="list-group-item">$post->content</li>
    @endforeach
</ul>