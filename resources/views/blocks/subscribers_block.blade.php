<div class="grid grid-cols-2">  
    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-1">  <!-- Адаптивные размеры -->
      <div class="bg-blue-100 rounded-full h-16 w-32 flex items-center justify-center shadow-lg"> <!-- Фиксированная высота -->
        <a href="/id_{{$subscriber->user->id}}">
          <img src="{{ asset('storage/' . $subscriber->user->avatar) }}" class="rounded-full w-12 h-12 object-cover" alt=""> <!-- Фиксированные размеры аватарки -->
        </a>
        <a href="/id_{{$subscriber->user->id}}" class="ml-3 text-black-600 hover:underline">{{ $subscriber->user->name }}</a>  
      </div> 
    </div>
    @if(Auth::user()->id !== $subscriber->user->id)
      <div class="mt-2">
        @include('blocks.subscribe_block', ['user' => $subscriber->user])
      </div> 
    @endif  
  </div> 
  <hr class="my-2 border-gray-500 w-full">