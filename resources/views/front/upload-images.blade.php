@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('vendors/dropzone/dropzone.css') }}">
@endsection

@section('content')

<main class='add-unit'>
		<div class='container'>
            @include('front.includes.status')
			<h1> {{ $property->title }} </h1>
			<div class='row'>
				<div class='col-xl-8 col-md-10 mx-auto'>
                    <form method="POST" class='add-form-con' enctype="multipart/form-data">
                        @csrf
                        {{-- Property Images --}}
                        <div class="row mt-3">
                            <h1> {{ __('lang.add_images') }} </h1>
							<div class='col-12 mb-5'>
                                {{-- <input type="file" name="file" class="dropzone" id="my-awesome-dropzone"/> --}}
                                <div id="dZUpload" class="dropzone">
                                    <div class="dz-default dz-message">
                                        <i class='fas fa-cloud-upload-alt fa-4x mx-2'></i>
                                        {{ __('lang.dragFilesHere') }}
                                    </div>
                                </div>
							</div>
                        </div>
                        {{-- Footer --}}
                        <div class="row mt-3">
                            <div class='col-12 text-left'>
								<button id="uploadImages" class='btn button add-new-property'>
                                    <i class="fa fa-spinner fa-spin d-none"></i>
                                    {{ __('lang.uploadImages') }}
                                </button>
							</div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</main>

@endsection

@section('script')
    <script src="{{ asset('vendors/dropzone/dropzone.js') }}"></script>
    <script>
        // Dropzone for Images
        Dropzone.autoDiscover = false;
        $(document).ready(function(){

            // DropZone Options
            const myImagesDropzone = new Dropzone("#dZUpload", {
                autoProcessQueue: false,
                addRemoveLinks: true,
                maxFilesize: 50,
                acceptedFiles: "image/*",
                dictRemoveFile: "{{ __('lang.delete') }}",
                dictDefaultMessage: "<i class='fas fa-cloud-upload-alt mx-2'></i>" + "{{ __('lang.dragFilesHere') }}",
                dictFileTooBig: "{{ __('lang.maxFileSize') }}",
                dictInvalidFileType: "{{ __('lang.invalid_filetype') }}",
                dictCancelUpload: "{{ __('lang.cancel') }}",
                headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                url: "{{ route('property.store.upload_images') }}",
                paramName: 'images',
                parallelUploads: 20,
                uploadMultiple: true,
                sendingmultiple: (file, xhr, formData)  =>  {
                    // console.log(file.upload.uuid);
                    formData.append('property_id', "{{ $property->id }}");
                },
                success: (file, response) => {},
                successmultiple: (file, response) => {
                    window.location.href = '/';
                },
                removedfile: (file) => {
                    console.log(file);
                }
            });

            // Upload Image in Click
            $('#uploadImages').click((e) => {
                e.preventDefault();

                $('#uploadImages').find('i').removeClass('d-none');
                $('#uploadImages').addClass('disabled');

                // Start Upload images
                myImagesDropzone.processQueue();
            });

        });
    </script>
@endsection
