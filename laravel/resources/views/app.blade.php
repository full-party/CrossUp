<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CrossUp</title>
  <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
  <script>
    window.Laravel = {};
    window.Laravel.csrfToken = "{{ csrf_token() }}";
  </script>
</head>
<body>
<div id="app">
  <app-header></app-header>
  <router-view></router-view>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>