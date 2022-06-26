@extends('layouts.app')
<title>Đọc truyện: Admin</title>

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 150%; cursor: default;">Chỉnh sửa truyện</div>
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
                    <form method="POST" action="{{route('truyen.update',[$truyen->id])}}" id="themtruyen" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="tentruyen" class="form-label">Tên truyện</label>
                            <input type="text" class="form-control" value="{{$truyen->tentruyen}}" name="tentruyen" id="create_slug" onkeyup="ChangeToSlug();" aria-describedby="truyen" placeholder="Nhập tên truyện">
                        </div>
                        <div class="mb-3">
                            <label for="slugtheloai" class="form-label">Slug truyện</label>
                            <input readonly type="text" class="form-control" value="{{$truyen->slug_truyen}}" name="slug_truyen" id="convert_slug" aria-describedby="truyen" placeholder="Slug truyện">
                        </div>
                        <div class="mb-3">
                            <label for="tomtat" class="form-label">Tóm tắt truyện</label><br>
                            <textarea name="tomtat" class="form-control" id="" cols="105" rows="5" placeholder="Nội dung ngắn gọn..." form="themtruyen" style="resize: none;">{{$truyen->tomtat}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="idtheloai" class="form-label">Thể loại</label>
                            <select name="idtheloai" id="idtheloai" class="custom-select">
                                @foreach($theloai as $key => $category)
                                <option <?= $category->id==$truyen->id_theloai ? 'selected':''?> value="{{$category->id}}">{{$category->tentheloai}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="hinhanh" class="form-label">Hình ảnh truyện</label>
                            <input type="file" class="form-control-file" name="hinhanh">
                            <img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" alt="{{$truyen->hinhanh}}" height="120">
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" name="themtruyen" class="btn btn-success me-md-2">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection