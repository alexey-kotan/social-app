<div class="hidden md:block">
  <div class="relative max-w-md mx-auto bg-white dark:bg-slate-800 shadow-lg h-80 overflow-hidden ring-1 ring-slate-900/5">
    <div class="absolute top-0 left-0 right-0 px-4 py-3 flex items-center font-semibold text-sm text-slate-900 dark:text-slate-200 bg-slate-50/90 dark:bg-slate-700/90 backdrop-blur-sm ring-1 ring-slate-900/10 dark:ring-black/10">Подписки</div>
      <div class="overflow-auto flex flex-col divide-y h-80 dark:divide-slate-200/5">
        
        @if(Auth::user()->subscriptions->isEmpty())
          <div class="mt-8 flex items-center gap-4 p-4">
            <p>У вас нет подписок</p> 
          </div>
        @else
          <p class="mb-12"></p>
          @foreach (Auth::user()->subscriptions as $subscription)
            <div class="flex items-center gap-2 p-2">
              <a href="/id_{{$subscription->id}}">
                  <img class="w-12 h-12 rounded-full" src="{{ asset('storage/' . $subscription->avatar) }}" alt="{{ $subscription->name }}">
              </a>
              <a href="/id_{{$subscription->id}}" class="text-blue-600 hover:underline">{{ $subscription->name }}</a>
            </div>
          @endforeach
        @endif

      </div>
    </div>
  </div>
</div>