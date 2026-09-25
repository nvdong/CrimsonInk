@extends('layouts.admin.login')
@section('content')
    <div class="error-pagewrap">
        <div class="error-page-int">
            <div class="text-center m-b-md custom-login">
                <h3>PLEASE LOGIN TO ADMIN</h3>
            </div>
            <div class="content-error">
                <div class="hpanel">
                    <form method="post">
                        @csrf
                        <button type="submit" class="btn btn-success btn-block loginbtn">Google login</button>
                        <br>

                    </form>
                    {{--                <a href="{{route('hq.login')}}?clearZone=true" class="btn btn-warning">Chọn lại Zone</a>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
