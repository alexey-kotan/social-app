@if(Auth::user()->subscriptions->contains($user->id))
    <form action="{{ route('unsubscribe', ['id' => $user->id]) }}" method="post">
        @csrf
        <button type="submit" class="mb-2 btn btn-dark">Отписаться</button>
    </form>
@else
    <form action="{{ route('subscribe', ['id' => $user->id]) }}" method="post">
        @csrf
        <button type="submit" class="mb-2 btn btn-primary">Подписаться</button>
    </form>
@endif