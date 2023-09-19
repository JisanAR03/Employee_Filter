@extends('layouts.app')

@section('content')
<style>
.loader {
  border: 10px solid #d8d8d8;
  border-radius: 50%;
  border-top: 10px solid #4f46e5;
  width: 60px;
  height: 60px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<main class=" w-11/12 md:max-w-[767px] lg:max-w-[1000px] xl:max-w-[1200px] container mx-auto my-10">
  {{-- <h4 class="my-14">Upload File</h4> --}}
  {{-- <div class="flex justify-start items-start shadow-custom h-full"> --}}
  <div class="flex justify-start items-start h-full">
    <div class=" md:w-4/6 pt-8 px-8 md:px-12 xl:px-24">

      <form action="{{ route('uploadSubmit') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('post')
        <div class="flex flex-col md:flex-row justify-start items-start w-full gap-2 md:gap-4">
          <label for="" class="w-full md:w-60 font-medium">Upload here:</label>
          <div class="flex flex-col w-full md:w-3/5 lg:w-full xl:w-full ">
            <label class="flex flex-col ">
              <div class="flex flex-col items-center justify-center input-class h-48 space-y-3">
                <div class="p-7 border border-black opacity-20 rounded-lg ">
                  <svg   class="w-12 h-12" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                  </svg>
                </div>
                <p id="upload-status" class="flex pt-1 text-sm text-bodyText">Upload files here <svg   fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m0-3l-3-3m0 0l-3 3m3-3V15" />
                  </svg>
                </p>
              </div>
              <label for="file-input" class="block mb-2 text-sm font-medium" style='display: none;'>Resumes</label>
              <input multiple name="resumes[]" id="file-input" type="file" class="hidden" multiple/>
              <button type="submit" class="tgrCls text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center  mt-5">Upload</button>
              <div class="ldrtgr mt-5 hidden"><div class="m-auto loader"></div></div>
              @if(Session::has('extension_error'))<small class="text-red-500 mt-5">{{Session::get('extension_error')}}</small>@endif
              @if(Session::has('upload_success'))<small class="text-green-500 mt-5">{{ Session::get('upload_success') }}</small>@endif
            </label>
          </div>
        </div>
      </form>

    </div>
  </div>
</main>
<script>
  const fileInput = document.getElementById('file-input');
  const uploadStatus = document.getElementById('upload-status');

  fileInput.addEventListener('change', () => {
    if (fileInput.files.length > 0) {
      uploadStatus.textContent = `${fileInput.files.length} file(s) uploaded`;
    } else {
      uploadStatus.textContent = 'Upload files here';
    }
  });
  jQuery(document).ready(function(){
    jQuery('.tgrCls').on('click', function(){
      jQuery(this).addClass('hidden');
      jQuery('.ldrtgr').removeClass('hidden');
    })
  })
</script>
@endsection