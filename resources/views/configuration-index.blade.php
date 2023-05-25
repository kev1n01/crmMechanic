@extends('layouts.admin.app')
@section('title', 'Configuración')
@section('content')
    <div class="row mt-5 justify-content-center ">
        <div class="col-lg-10">
            <div class="row">
                <div class="col-sm-3 mb-2 mb-sm-0">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active show mb-2" id="v-pills-company-tab" data-bs-toggle="pill"
                            href="#v-pills-company" role="tab" aria-controls="v-pills-company" aria-selected="true">
                            <span class="d-md-block">Datos Empresa</span>
                        </a>
                        <a class="nav-link mb-2" id="v-pills-sunat-tab" data-bs-toggle="pill" href="#v-pills-sunat"
                            role="tab" aria-controls="v-pills-sunat" aria-selected="false">
                            <span class="d-md-block">Sunat</span>
                        </a>
                        <a class="nav-link mb-2" id="v-pills-bankacc-tab" data-bs-toggle="pill" href="#v-pills-bankacc"
                            role="tab" aria-controls="v-pills-bankacc" aria-selected="false">
                            <span class="">Cuentas de banco</span>
                        </a>
                    </div>
                </div>


                <div class="col-sm-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="v-pills-company" role="tabpanel"
                            aria-labelledby="v-pills-company-tab">
                            @livewire('setting.company-conf')
                        </div>
                        <div class="tab-pane fade" id="v-pills-sunat" role="tabpanel" aria-labelledby="v-pills-sunat-tab">
                            @livewire('setting.sunat-conf')
                        </div>
                        <div class="tab-pane fade" id="v-pills-bankacc" role="tabpanel"
                            aria-labelledby="v-pills-bankacc-tab">
                            @livewire('setting.bank-acc-conf')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .nav-pills .nav-link{
            border: 1px solid #7e7f96;
            color: #7d7e9e
        }
        .nav-pills .nav-link:hover{
            color: white;
        }
    
    </style> 
@endpush