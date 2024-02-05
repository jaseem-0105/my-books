@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/libs/gridjs/gridjs.min.css') }}">
@endpush
@section('content')
    <main>
        <div>hlo</div>
    </main>
@endsection

@push('scripts')
    <script src="{{ URL::asset('backend/assets/libs/prismjs/prismjs.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/libs/gridjs/gridjs.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/js/pages/gridjs.init.js') }}"></script>

    <script src="{{ URL::asset('backend/assets/js/app.min.js') }}"></script>
@endpush
