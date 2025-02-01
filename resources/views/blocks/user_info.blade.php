
<div class="flex mt-3 mb-3">
  <div class="w-1/2">
    <div class="dropdown flex items-center">
      <img class="rounded-circle me-1 mr-2" width="100" height="100" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt=""> 
      <span class="text-gray-700 font-medium text-2xl">{{ Auth::user()->name }} </span>
    </div>
  </div>
  @active
  @if(Auth::user()->bio)
    <div class="w-1/2 mx-auto lg:block hidden">
      <p><b>БИО:</b> {{ Auth::user()->bio }}</p>
    </div>
  @endif
  @endactive
</div>