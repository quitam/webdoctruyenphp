@extends('layouts.app')
<title>Đọc truyện: Admin</title>

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="font-size: 150%; cursor: default;">Tất cả thể loại</div>

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
                                <th scope="col" class="text-center" style="width: 20%">Tên thể loại</th>
                                <th scope="col" class="text-center" style="width: 15%">Slug thể loại</th>
                                <th scope="col" class="text-center" style="width: 50%">Mô tả</th>
                                <th scope="col" class="text-center" style="width: 20%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($theloai as $key => $tentheloai)
                            <tr>
                                <th scope="row" class="text-center align-middle">{{$key+1}}</th>
                                <td class="text-center align-middle">{{$tentheloai->tentheloai}}</td>
                                <td class="text-center align-middle">{{$tentheloai->slug_theloai}}</td>
                                <td class="align-middle">{{$tentheloai->mota}}</td>
                                <td class="text-center align-middle">
                                    <a href="{{route('theloai.edit',['theloai'=>$tentheloai->id])}}" class="btn btn-primary" style="margin-bottom: 5px;">Sửa</a>
                                    <form action="{{route('theloai.destroy',['theloai'=>$tentheloai->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa thể loại \({{$tentheloai->tentheloai}}\)')" class="btn btn-danger">Xóa</button>
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