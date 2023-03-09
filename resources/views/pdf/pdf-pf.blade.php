@extends('layouts.admin.app')

@section('content')
    <div class="row mt-3">
        <div class="col-12">
            <object width="100%" height="1000px" data="{{ env('APP_URL') }}/proforma/preview/{{ $id }}" type="application/pdf">
                <embed src="{{ env('APP_URL') }}/proforma/preview/{{ $id }}" type="application/pdf" />
            </object>
        </div>
    </div>
@endsection
