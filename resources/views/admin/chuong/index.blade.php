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
                <div class="card-header" style="font-size: 150%; cursor: default;">Tất cả chương</div>

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
                                <th scope="col" class="text-center" style="width: 15%">Tên chương</th>
                                <th scope="col" class="text-center" style="width: 15%">Slug chương</th>
                                <th scope="col" class="text-center" style="width: 15%">Truyện</th>
                                <th scope="col" class="text-center" style="width: 10%">Ảnh truyện</th>
                                <th scope="col" class="text-center" style="width: 30%">Nội dung truyện</th>
                                <th scope="col" class="text-center" style="width: 10%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chuong as $key => $chapter)
                            <tr>
                                <th scope="row" class="text-center align-middle">{{$key+1}}</th>
                                <td class="text-center align-middle">{{$chapter->tenchuong}}</td>
                                <td class="text-center align-middle">{{$chapter->slug_chuong}}</td>
                                <td class="text-center align-middle">{{$chapter->truyen->tentruyen}}</td>
                                <td class="text-center align-middle"><img src="{{asset('public/uploads/truyen/'.$chapter->truyen->hinhanh)}}" alt="{{$chapter->truyen->hinhanh}}" height="120"></td>
                                <td class="align-middle">{{$chapter->noidung}}</td>
                                <td class="text-center align-middle">
                                    <a href="{{route('chuong.edit',['chuong'=>$chapter->id])}}" class="btn btn-warning" style="margin-bottom: 5px;">Sửa</a>
                                    <form action="{{route('chuong.destroy',['chuong'=>$chapter->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa chương \({{$chapter->tenchuong}}\) không')" class="btn btn-danger">Xóa</button>
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