@extends(!Request::ajax() ? 'layouts.layout' : 'layouts.layoutAjax')

@section('fullcontent')
    @yield('content')
@endsection