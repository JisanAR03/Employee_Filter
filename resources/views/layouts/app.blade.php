<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Filtering App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Poppins:wght@400;500;600;700&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite('resources/css/app.css')
  </head>
  <body>
    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-red-500 text-white px-4 py-2 rounded-md">
      {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-green-500 text-white px-4 py-2 rounded-md">
      {{ session('success') }}
    </div>
    @endif
  @if(!session('username') && !session('basicUser'))<div style=" margin-top: 200px; "></div>@endif
  @if(session('username'))<header>
    <nav class="flex items-center justify-end p-4 bg-gray-200">
      <div class="space-x-2">
        @if(!(request()->routeIs('uploadFile')))
        <button {{ session('username') ? '' : 'disabled' }} class="px-4 py-2 text-gray-800 border border-gray-400 rounded"><a href="{{route('uploadFile')}}">File Upload</a></button>
        @endif
        @if(!(request()->routeIs('filterData')))
        <button {{ session('username') ? '' : 'disabled' }} class="px-4 py-2 text-gray-800 border border-gray-400 rounded"><a href="{{route('filterData')}}">Filter Data</a></button>
        @endif
        @if(!(request()->routeIs('all_list')))
        <button {{ session('username') ? '' : 'disabled' }} class="px-4 py-2 text-gray-800 border border-gray-400 rounded"><a href="{{route('all_list')}}">All List</a></button>
        @endif

        {{-- <button {{ session('username') ? '' : 'disabled' }} class="px-4 py-2 text-gray-800 border border-gray-400 rounded">@if(request()->is('upload-file')) <a href="{{route('filterData')}}">Filter Data</a> @elseif (request()->is('filter-data')) <a href="{{route('uploadFile')}}">File Upload</a> @else disable @endif</button> --}}

        <button><form method="POST" action="{{route('logout')}}">@csrf<button type="submit" {{ session('username') ? '' : 'disabled' }} class="px-4 py-2 text-gray-800 border border-gray-400 rounded">{{ session('username') ? 'Logout' : 'Login' }}</button></form></button>
      </div>
    </nav>
  </header>@endif
  @if(session('basicUser'))
  <header>
    <nav class="flex items-center justify-end p-4 bg-gray-200">
      <div class="space-x-2">
        @if(!(request()->routeIs('timeline')))
        <button {{ session('basicUser') ? '' : 'disabled' }} class="px-4 py-2 text-gray-800 border border-gray-400 rounded"><a href="{{route('timeline')}}">Posts</a></button>
        @endif
        @if(!(request()->routeIs('profile')))
        <button {{ session('basicUser') ? '' : 'disabled' }} class="px-4 py-2 text-gray-800 border border-gray-400 rounded"><a href="{{route('profile')}}">Profile</a></button>
        @endif
        <button><form method="POST" action="{{route('logout')}}">@csrf<button type="submit" {{ session('basicUser') ? '' : 'disabled' }} class="px-4 py-2 text-gray-800 border border-gray-400 rounded">{{ session('basicUser') ? 'Logout' : 'Login' }}</button></form></button>
      </div>
    </nav>
  </header>
  @endif


    @yield('content')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{asset('js/mains.js')}}" type="text/javascript"></script>
    <style>
      .pagination {
  display: flex;
  justify-content: center;
  align-items: center;
}

.pagination button,
.pagination a {
  border: 1px solid #ddd;
  background-color: #f9f9f9;
  color: #333;
  padding: 8px 12px;
  text-decoration: none;
  transition: background-color 0.3s;
}

.pagination button:hover,
.pagination a:hover {
  background-color: #e9e9e9;
}

.pagination button.active {
  background-color: #ccc;
  cursor: default;
}

    </style>
  </body>
</html>
