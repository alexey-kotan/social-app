@foreach($posts as $post)
<div class="col-md-12 bg-gray-100">
  <div class="row border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-350 position-relativeц">
    <div class="col-auto d-none d-lg-block mt-2 mb-2">
      @if($post->post_image !== null)
          <a href="{{ asset('storage/' . $post->post_image) }}" target="_blank">
          <img src="{{ asset('storage/' . $post->post_image) }}" width="200" height="200" alt="">
          </a>
      @endif
    </div>
    <div class="col p-6 d-flex flex-column">
      <div class="mb-1 text-body-secondary">Опубликовал <b>{{ $post->user->name }}</b> в {{ $post->created_at }}</div>
      <p class="mb-auto">{{ $post->post_text }}</p>
    </div>
    <form action="#">
      @csrf
      <button class="btn btn-success w-30 py-2 ml-1 mb-2" type="submit">Нравится</button>
    </form>

    @if($post->id !== Auth::id())
    <form action="{{ route('post_delete', ['id' => $post->id]) }}" method="POST">
      @csrf
      @method('DELETE')
      <button class="btn btn-warning w-30 py-2 ml-1 mb-2" type="submit">Удалить пост</button>
    </form>
    @endif
  </div>
</div>
@endforeach