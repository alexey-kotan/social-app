@foreach($posts as $post)
<div class="col-md-12 bg-gray-100">
  <div class="row border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-350 position-relative">
    <div class="col-auto d-lg-block mt-2 mb-2">
      @if($post->post_image !== null)
          <a href="{{ asset('storage/' . $post->post_image) }}" target="_blank">
          <img src="{{ asset('storage/' . $post->post_image) }}" width="150" height="150" alt="">
          </a>
      @endif
    </div>
    <div class="col p-6 d-flex flex-column">
      <div class="mb-1 text-body-secondary">Опубликовал(-a) <b><a href="id_{{ $post->user->id }}">{{ $post->user->name }}</a></b> {{ $post->created_at }}</div>
      <p class="mb-auto">{{ $post->post_text }}</p>
    </div>

    @if($post->likes > 0)
      <p class="ml-2 mb-2 d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart mr-2" viewBox="0 0 16 16">
        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"></path>
        </svg> {{ $post->likes }}
      </p>
    @endif

    <div class="d-flex">
      <form action="{{ route('post_like', $post->id) }}" method="POST">
        @csrf
        <button class="btn btn {{ $post->post_likes()->where('user_id', Auth::id())->exists() ? 'btn-secondary' : 'btn-dark mr-2' }} w-30 py-2 ml-1 mb-2" type="submit">
          {{ $post->post_likes()->where('user_id', Auth::id())->exists() ? 'Вам понравилось' : 'Нравится' }}</button>
      </form>

      @if($post->user_id == Auth::id() || Auth::user()->role == 'admin')
      <form action="{{ route('post_delete', ['id' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-warning w-30 py-2 ml-1 mb-2" type="submit">Удалить пост</button>
      </form>
      @endif
    </div>

  </div>
</div>
@endforeach