<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">


<title>Maritel Admin Panel</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{asset('dist/assets/css/main/app.css')}}">
<link rel="stylesheet" href="{{asset('dist/assets/css/main/app-dark.css')}}">
<link rel="shortcut icon" href="{{asset('logo/logoM.png')}}" type="image/x-icon">
<link rel="shortcut icon" href="{{asset('logo/logoM.png')}}" type="image/png">
<link rel="stylesheet" href="{{asset('dist/assets/css/shared/iconly.css')}}">
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{asset('dist/assets/extensions/sweetalert2/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('query-ui/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('query-ui/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{asset('dist/assets/extensions/choices.js/public/assets/styles/choices.css')}}">

<!-- Data Tables -->
<link href="{{asset('dataTables/datatables.min.css')}}" rel="stylesheet">
<!-- <link rel="stylesheet" href="{{ asset('bulma/css/bulma.min.css') }}"> -->
 


<!-- Select 2 js -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- flatpickr js  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Dropify css -->
<link rel="stylesheet" href="{{ asset('dropify/dist/css/dropify.css')}}"/>

<!-- daterange picker -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" /> -->


<style>
  .logoicon {
    transform: scale(4);
  }

  .logoicon2 {
    transform: scale(2);
  }

  .round-image-3 {
    width: 40px;
    /* Sesuaikan dengan lebar yang diinginkan */
    height: 40px;
    /* Sesuaikan dengan tinggi yang diinginkan */
    border-radius: 50%;
    overflow: hidden;
  }
</style>
<style>
.fixed-height {
  max-height: 600px; /* Set the fixed height for the card */
    overflow-y: auto; /* Enable vertical scrolling */
}

.fixed-height-card {
  max-height: 500px; /* Set the fixed height for the card */
    overflow-y: auto; /* Enable vertical scrolling */
}
.fixed-height-cardBody {
  max-height: 300px; /* Set the fixed height for the card */
    overflow-y: auto; /* Enable vertical scrolling */
}

.fixed-height-samll-card {
  max-height: 200px; /* Set the fixed height for the card */
    overflow-y: auto; /* Enable vertical scrolling */
}
.button-container {
    display: flex;
    align-items: center;
    gap: 10px; /* Adjust the gap between buttons as needed */
}

.table-textarea {
    width: 100%;
    resize: none;
    overflow: hidden; /* Ensures content stays visible */
}

.custom-textarea {
    width: 100%;
    min-height: 100px;
    height: auto;
    resize: vertical;
}
</style>
@if(View::hasSection('custom_styles'))
@yield('custom_styles')
@endif
<link rel="stylesheet" href="{{ asset('query-ui/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('query-ui/jquery-ui.min.css') }}">