<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
<link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css">

<style>

#scroll-products{
  height: 300px;
  width: 88% !important;
  overflow-y: scroll;
}

input[type="time"]::-webkit-calendar-picker-indicator{
    filter: invert(0.9);
}
input[type="search"]::-webkit-search-cancel-button{
    filter: invert(1);
}

body::-webkit-scrollbar {
  width: 10px !important;               /* width of the entire scrollbar */
}

body::-webkit-scrollbar-track {
  background: rgb(52, 58, 64) !important;        /* color of the tracking area */
  border-radius: 20px !important;       /* roundness of the scroll thumb */
}

body::-webkit-scrollbar-thumb {
  background-color: rgb(27, 75, 114) !important;    /* color of the scroll thumb */
  border-radius: 20px !important;       /* roundness of the scroll thumb */
  border: 1px solid rgb(52, 58, 64) !important;  /* creates padding around scroll thumb */
}

body::-webkit-scrollbar-thumb:hover {
  background-color: rgb(62, 84, 200) !important;    /* color of the scroll thumb */
}

.table-responsive::-webkit-scrollbar {
  height: 10px !important;               /* width of the entire scrollbar */
}

.table-responsive::-webkit-scrollbar-track {
  background: rgb(52, 58, 64) !important;        /* color of the tracking area */
  border-radius: 20px !important;       /* roundness of the scroll thumb */
}

.table-responsive::-webkit-scrollbar-thumb {
  background-color: rgb(27, 75, 114) !important;    /* color of the scroll thumb */
  border-radius: 20px !important;       /* roundness of the scroll thumb */
  border: 1px solid rgb(52, 58, 64) !important;  /* creates padding around scroll thumb */
}

.table-responsive::-webkit-scrollbar-thumb:hover {
  background-color: rgb(62, 84, 200) !important;    /* color of the scroll thumb */
}

#scroll-products::-webkit-scrollbar {
  width: 10px !important;               /* width of the entire scrollbar */
  height: 10px !important;               /* width of the entire scrollbar */
}

#scroll-products::-webkit-scrollbar-track {
  background: rgb(52, 58, 64) !important;        /* color of the tracking area */
  border-radius: 20px !important;       /* roundness of the scroll thumb */
}

#scroll-products::-webkit-scrollbar-thumb {
  background-color: rgb(27, 75, 114) !important;    /* color of the scroll thumb */
  border-radius: 20px !important;       /* roundness of the scroll thumb */
  border: 1px solid rgb(52, 58, 64) !important;  /* creates padding around scroll thumb */
}

#scroll-products::-webkit-scrollbar-thumb:hover {
  background-color: rgb(62, 84, 200) !important;    /* color of the scroll thumb */
}

li .menuitem-active {
  background:  rgb(62, 84, 200) ;
}

.side-nav-item{
  border-bottom: 2px solid rgb(61, 65, 73) ;
}
</style>