@extends('site-layout')

@section('meta-title', 'Modular: Ready to build')

@section('meta-description', 'Your amazing site')

@section('bodyEndScripts')
    @vite('resources-site/js/index-app.js')
@endsection

@section('content')
    <section class="py-10 md:py-12">

        <div class="container max-w-screen-xl px-4 mx-auto">

            <div class="text-center">
                <div class="flex justify-center mb-16">
                    <img src="{{ Vite::asset('resources-site/images/home-img.png') }}" alt="Image">
                </div>

                <h1 class="mb-8 text-lg font-medium text-gray-600 uppercase md:text-2xl">Modular: Ready to build</h1>

                <h2 class="mb-8 text-4xl font-normal leading-none text-gray-700 md:text-7xl">Your amazing site</h2>

                <index-example-component></index-example-component>
            </div>

        </div>

    </section>
@endsection
