@extends('layouts.app')
<title>Đọc truyện: Admin</title>

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 150%; cursor: default;">Thêm truyện</div>
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
                    <form method="POST" action="{{route('truyen.store')}}" id="themtruyen">
                        @csrf
                        <div class="mb-3">
                            <label for="tentruyen" class="form-label">Tên truyện</label>
                            <input type="text" class="form-control" value="{{old('tentheloai')}}" name="tentruyen" id="create_slug" onkeyup="ChangeToSlug();" aria-describedby="truyen" placeholder="Nhập tên truyện">
                        </div>
                        <div class="mb-3">
                            <label for="slugtheloai" class="form-label">Slug truyện</label>
                            <input readonly type="text" class="form-control" value="{{old('slug_theloai')}}" name="slug_truyen" id="convert_slug" aria-describedby="truyen" placeholder="Slug truyện">
                        </div>
                        <div class="mb-3">
                            <label for="tomtat" class="form-label">Tóm tắt truyện</label><br>
                            <textarea name="tomtat" class="form-control" id="" cols="105" rows="5" placeholder="Nội dung ngắn gọn..." form="themtruyen" style="resize: none;">{{old('mota')}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="theloai" class="form-label">Thể loại</label>
                            <select name="idtheloai" id="idtheloai" class="custom-select">
                                @foreach($theloai as $key => $category)
                                <option value="{{$category->id}}">{{$category->tentheloai}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="hinhanhtruyen" class="form-label">Hình ảnh truyện</label>
                            <input type="file" class="form-control-file" name="hinhanh">
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" name="themtruyen" class="btn btn-success me-md-2">Thêm truyện</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection