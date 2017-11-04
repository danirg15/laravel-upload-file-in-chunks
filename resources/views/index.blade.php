@extends('master')


@section('content')
    
	<section>
        <h1 id="try-it-out">Try it out!</h1>
        <div id="dropzone">
            <form class="dropzone dz-clickable" id="file-upload">
                {{ csrf_field() }}
                <div class="dz-message">Drop files here or click to upload.
                    <br> <span class="note">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                </div>
            </form>
        </div>
    </section>


@endsection