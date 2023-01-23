@extends('layouts.admin.app')

@section('content')
    <div class="row mt-3">
        <div class="col-12">
            <object width="100%" height="1000px" data="http://127.0.0.1:8000/pdf/preview/{{ $id }}" type="application/pdf">
                <embed src="http://127.0.0.1:8000/pdf/preview/{{ $id }}" type="application/pdf" />
            </object>
        </div>
    </div>
@endsection
