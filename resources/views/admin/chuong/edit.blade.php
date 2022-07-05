@extends('layouts.app')
<title>Đọc truyện: Admin</title>

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 150%; cursor: default;">Chỉnh sửa chương</div>
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
                    <form method="POST" action="{{route('chuong.update',[$chuong->id])}}" id="themchuong" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="tenchuong" class="form-label">Tên chương</label>
                            <input type="text" class="form-control" value="{{$chuong->tenchuong}}" name="tenchuong" id="create_slug" onkeyup="ChangeToSlug();" aria-describedby="chuong" placeholder="Nhập tên chương">
                        </div>
                        <div class="mb-3">
                            <label for="slugchuong" class="form-label">Slug chương</label>
                            <input readonly type="text" class="form-control" value="{{$chuong->slug_chuong}}" name="slug_chuong" id="convert_slug" aria-describedby="chuong" placeholder="Slug chương">
                        </div>

                        <div class="mb-3">
                            <label for="idtruyen" class="form-label">Thuộc truyện: </label>
                            <select name="idtruyen" id="idtruyen" class="custom-select">
                                @foreach($truyen as $key => $story)
                                <option <?= $story->id==$chuong->id_truyen ? 'selected':''?> value="{{$story->id}}">{{$story->tentruyen}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="noidung" class="form-label">Nội dung chương</label><br>
                            <textarea name="noidung" class="form-control" id="" cols="105" rows="5" placeholder="Nội dung chương" form="themchuong" style="resize: none;">{{$chuong->noidung}}</textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" name="themchuong" class="btn btn-success me-md-2">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection