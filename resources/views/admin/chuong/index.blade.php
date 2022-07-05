@extends('layouts.app')
<title>Đọc truyện: Admin</title>

@section('content')
@include('layouts.nav')
<style>
    .table {
        width: 100%;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="font-size: 150%; cursor: default;">Tất cả truyện</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center" style="width: 5%">STT</th>
                                <th scope="col" class="text-center" style="width: 15%">Hình ảnh</th>
                                <th scope="col" class="text-center" style="width: 15%">Tên truyện</th>
                                <th scope="col" class="text-center" style="width: 15%">Slug truyện</th>
                                <th scope="col" class="text-center" style="width: 15%">Thể loại</th>
                                <th scope="col" class="text-center" style="width: 25%">Tóm tắt</th>
                                <th scope="col" class="text-center" style="width: 10%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($truyen as $key => $story)
                            <tr>
                                <th scope="row" class="text-center align-middle">{{$key+1}}</th>
                                <td class="text-center align-middle"><img src="{{asset('public/uploads/truyen/'.$story->hinhanh)}}" alt="{{$story->hinhanh}}" height="120"></td>
                                <td class="text-center align-middle">{{$story->tentruyen}}</td>
                                <td class="text-center align-middle">{{$story->slug_truyen}}</td>
                                <td class="text-center align-middle">{{$story->theloai->tentheloai}}</td>
                                <td class="align-middle">{{$story->tomtat}}</td>
                                <td class="text-center align-middle">
                                    <a href="{{route('truyen.edit',['truyen'=>$story->id])}}" class="btn btn-warning" style="margin-bottom: 5px;">Sửa</a>
                                    <form action="{{route('truyen.destroy',['truyen'=>$story->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa truyện \({{$story->tentruyen}}\) không')" class="btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection