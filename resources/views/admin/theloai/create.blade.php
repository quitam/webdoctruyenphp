@extends('layouts.app')
<title>Đọc truyện: Admin</title>

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 150%; cursor: default;">Thêm thể loại</div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{route('theloai.store')}}" id="themtheloai">
                        @csrf
                        <div class="mb-3">
                            <label for="tentheloai" class="form-label">Tên thể loại</label>
                            <input type="text" class="form-control" value="{{old('tentheloai')}}" name="tentheloai" id="tentheloai" aria-describedby="theloai" placeholder="Nhập tên thể loại">
                        </div>
                        <div class="mb-3">
                            <label for="mota" class="form-label">Mô tả thể loại</label><br>
                            <!-- <input type="textarea" class="form-control" id="mota" aria-describedby="mota" placeholder="Mô tả"> -->
                            <textarea name="mota" id="" cols="105" rows="5" placeholder="Mô tả" form="themtheloai">{{old('mota')}}</textarea>
                        </div>
                        <button type="submit" name="themtheloai" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection