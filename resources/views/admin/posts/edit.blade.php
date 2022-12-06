@extends('admin.layout')

@section('header')
    <h1>
        POSTS
        <small>Crear publicación</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ route('posts.index') }}"><i class="fa fa-list"></i> Posts</a></li>
        <li class="active">Crear</li>
    </ol>
@stop

@section('content')
    <div class="row">
        @if ($post->photos->count())
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        @foreach ($post->photos as $photo)
                            <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}">
                                {{ method_field('DELETE') }} {{ csrf_field() }}
                                <div class="col-md-2">
                                    <button class="btn btn-danger btn-xs" style="position: absolute">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    <img class="img-responsive" src="{{ url($photo->url) }}">
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <form id="post-form" method="POST" action="{{ route('posts.update', $post) }}">
            {{ csrf_field() }} {{ method_field('PUT') }}
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label>Título de la publicación</label>
                            <input name="title" class="form-control" value="{{ old('title', $post->title) }}"
                                placeholder="Ingresa aquí el título de la publicación">
                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            <label>Contenido publicación</label>
                            <textarea rows="10" name="body" id="ckeditor" class="form-control"
                                placeholder="Ingresa el contendido completo de la publicación">{{ old('body', $post->body) }}</textarea>
                            {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('iframe') ? 'has-error' : '' }}">
                            <label>Contenido embebido (iframe)</label>
                            <textarea rows="2" name="iframe" id="ckeditor" class="form-control"
                                placeholder="Ingresa contenido embebido (iframe) de audio o video">{{ old('iframe', $post->iframe) }}</textarea>
                            {!! $errors->first('iframe', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Fecha de publicación:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="published_at" class="form-control" {{-- value="{{ old('published_at', $post->published_at ? $post->published_at->format('dd/mm/Y') : null) }}" --}}
                                    value="{{-- {{ old('published_at', $post->published_at ? $post->published_at->format('d/m/Y') : null) }} --}}
                                    {{today() }}" type="text" id="datepicker" disabled>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                            <label>Categorías</label>
                            <select name="category_id" class="form-control select2">
                                <option value="">Seleciona una categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                            <label>Etiquetas</label>
                            <select name="tags[]" class="form-control select2" multiple="multiple"
                                data-placeholder="Selecciona una o más etiquetas" style="width: 100%;">
                                @foreach ($tags as $tag)
                                    <option
                                        {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}
                                        value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                            <label>Extracto publicación</label>
                            <textarea name="excerpt" class="form-control" placeholder="Ingresa un extracto de la publicación">{{ old('excerpt', $post->excerpt) }}</textarea>
                            {!! $errors->first('excerpt', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label class="label-info">Image</label>
                            <div class="dropzone" id="myDropzone"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="guardar" class="btn btn-primary btn-block">Guardar Publicación</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@stop

@section('styles')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/dropzone.css"> --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    {{-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/dist/css/select2.css') }}">
@endsection

@section('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/min/dropzone.min.js"></script> --}}
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone-amd-module.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> --}}
    <script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
    {{-- <script src="{{ asset('adminlte/plugins/select2/dist/js/select2.js') }}"></script> --}}
    <script src="{{ asset('adminlte/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    {{-- <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
    <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.js') }}"></script>
    <script>
        //  $('input[name="published_at"]').daterangepicker();

        $('.select2').select2({
            // tags: true
        });

        $("#datepicker").datepicker({
            dateFormat: 'dd/mm/yy'
        });
        function today(){
    var d = new Date();
    var curr_date = d.getDate();
    var curr_month = d.getMonth() + 1;
    var curr_year = d.getFullYear();
    document.write(curr_date + "-" + curr_month + "-" + curr_year);
}

        CKEDITOR.replace('ckeditor');
        CKEDITOR.config.height = 315;

        // let myDropzone = new Dropzone('#myDropzone', {
        //     autoProcessQueue: false,
        //     maxFilesize: 10,
        //     parallelUploads: 20,
        //     maxFile: 10,
        //     url: '/admin/posts/{{ $post->url }}/photos',
        //     dictDefaultMessage: 'Subir la imagen...',
        //     // dictDefaultMessage: 'Arrastra las fotos aquí para subirlas'
        //     acceptedFiles: ".png,.jpg,.jpeg,.gif,.bmp",
        //     // acceptedFiles: 'image/*',
        //     addRemoveLinks: true,
        //     dictRemoveFile: 'Borrar Archivo',
        //     paramName: 'photo',
        //     headers: {
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //     },
        //     init: function() {
        //         this.on("queuecomplete", function() {
        //             this.options.autoProcessQueue = false;
        //         });

        //         this.on("processing", function() {
        //             this.options.autoProcessQueue = true;
        //         });

        //         this.on("addedfile", function(file) {
        //             file.previewElement.classList.add('dz-completa')
        //         })
        //     }

        // });

        let myDropzone = new Dropzone('#myDropzone', {
            autoProcessQueue: false,
            maxFilesize: 10,
            parallelUploads: 20,
            maxFile: 10,
            url: '/admin/posts/{{ $post->url }}/photos',
            dictDefaultMessage: 'Subir la imagen...',
            // dictDefaultMessage: 'Arrastra las fotos aquí para subirlas'
            acceptedFiles: ".png,.jpg,.jpeg,.gif,.bmp",
            // acceptedFiles: 'image/*',
            addRemoveLinks: true,
            dictRemoveFile: 'Borrar Archivo',
            paramName: 'photo',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            init: function() {
                this.on("queuecomplete", function() {
                    this.options.autoProcessQueue = false;
                });

                this.on("processing", function() {
                    this.options.autoProcessQueue = true;
                });

                this.on("addedfile", function(file) {
                    file.previewElement.classList.add('dz-complete');
                });

                // $("#guardar").click(function(e) {
                //     e.preventDefault();
                //     dropzoneDevJobs.processQueue();
                //     Swal.fire({
                //         icon: 'success',
                //         title: 'Se han guardado con exito',
                //         timer: 2000
                //     }).then(function() {
                //         location.href = `{{ asset('img/post/') }}`;
                //     });
                // });
            },

            success: function(file, response) {
                console.log({
                    file,
                    response
                });
            }
        });

        // dropzone.on('error', function(file, res) {
        //     var msg = res.photo[0];
        //     $('.dz-error-message:last > span').text(msg);
        // });

        Dropzone.autoDiscover = false;
    </script>
@endsection
