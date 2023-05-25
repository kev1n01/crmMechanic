<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
<link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

@php
    $cookie = \Illuminate\Support\Facades\Cookie::get('theme');
@endphp
@if ($cookie === 'dark')
    <style>
        .full .ts-control {
            background-color: #404954 !important;
        }

        .ts-control {
            border: 1px solid #4a525d !important;
        }

        .ts-dropdown {
            background: #404954 !important;
            color: #e3eaef !important;
            border: 1px solid #4a525d !important;
        }

        .ts-dropdown .active {
            background-color: #73787e !important;
            color: #e3eaef !important;
        }

        .ts-dropdown,
        .ts-control,
        .ts-control input {
            color: #ffffff !important;
        }

        .ts-control,
        .ts-wrapper.single.input-active .ts-control {
            background: #404954 !important;
            color: #e3eaef !important;
            font-size: initial !important;
        }
    </style>
@endif

<style>
    #scroll-products {
        height: 300px;
        width: 88% !important;
        overflow-y: scroll;
    }

    input[type="time"]::-webkit-calendar-picker-indicator {
        filter: invert(0.9);
    }

    input[type="search"]::-webkit-search-cancel-button {
        filter: invert(1);
    }

    body::-webkit-scrollbar {
        width: 10px !important;
        /* width of the entire scrollbar */
    }

    body::-webkit-scrollbar-track {
        background: rgb(52, 58, 64) !important;
        /* color of the tracking area */
        border-radius: 20px !important;
        /* roundness of the scroll thumb */
    }

    body::-webkit-scrollbar-thumb {
        background-color: rgb(27, 75, 114) !important;
        /* color of the scroll thumb */
        border-radius: 20px !important;
        /* roundness of the scroll thumb */
        border: 1px solid rgb(52, 58, 64) !important;
        /* creates padding around scroll thumb */
    }

    body::-webkit-scrollbar-thumb:hover {
        background-color: rgb(62, 84, 200) !important;
        /* color of the scroll thumb */
    }

    .table-responsive::-webkit-scrollbar {
        height: 10px !important;
        /* width of the entire scrollbar */
    }

    .table-responsive::-webkit-scrollbar-track {
        background: rgb(52, 58, 64) !important;
        /* color of the tracking area */
        border-radius: 20px !important;
        /* roundness of the scroll thumb */
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background-color: rgb(27, 75, 114) !important;
        /* color of the scroll thumb */
        border-radius: 20px !important;
        /* roundness of the scroll thumb */
        border: 1px solid rgb(52, 58, 64) !important;
        /* creates padding around scroll thumb */
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background-color: rgb(62, 84, 200) !important;
        /* color of the scroll thumb */
    }

    .cursor {
        cursor: pointer;
    }

    #scroll-products::-webkit-scrollbar {
        width: 10px !important;
        /* width of the entire scrollbar */
        height: 10px !important;
        /* width of the entire scrollbar */
    }

    #scroll-products::-webkit-scrollbar-track {
        background: rgb(52, 58, 64) !important;
        /* color of the tracking area */
        border-radius: 20px !important;
        /* roundness of the scroll thumb */
    }

    #scroll-products::-webkit-scrollbar-thumb {
        background-color: rgb(27, 75, 114) !important;
        /* color of the scroll thumb */
        border-radius: 20px !important;
        /* roundness of the scroll thumb */
        border: 1px solid rgb(52, 58, 64) !important;
        /* creates padding around scroll thumb */
    }

    #scroll-products::-webkit-scrollbar-thumb:hover {
        background-color: rgb(62, 84, 200) !important;
        /* color of the scroll thumb */
    }

    li .menuitem-active {
        background: rgb(62, 84, 200);
    }

    .side-nav-item {
        border-bottom: 2px solid rgb(61, 65, 73);
    }
</style>
