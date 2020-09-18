<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Рецепты для всей семьи</title>

</head>
<body>
<div id="app">
    <loading :active.sync="isLoading"
             :can-cancel="false"
             :color="'#d9be8f'"
             :loader="'dots'"></loading>
    <header-component v-bind:authenticated="authenticated" v-bind:user="user"></header-component>
    <div class="main-row">
        <left-menu v-bind:authenticated="authenticated" v-bind:user="user"></left-menu>
        <app></app>
    </div>
    <footer-component v-bind:authenticated="authenticated" v-bind:user="user"></footer-component>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
