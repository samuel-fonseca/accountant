@extends('layouts.app')

@section('head.scripts')
<script>
    window.__COMPONENTS__ = {
        'login': 'Auth/Login',
    };
</script>
@endsection

@section('content')
<login></login>
@endsection
