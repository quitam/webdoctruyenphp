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
                            <input type="text" class="form-control" value="{{old('tentheloai')}}" name="tentheloai" id="create_slug" onkeyup="ChangeToSlug();" aria-describedby="theloai" placeholder="Nhập tên thể loại">
                        </div>
                        <div class="mb-3">
                            <label for="slugtheloai" class="form-label">Slug thể loại</label>
                            <input readonly type="text" class="form-control" value="{{old('slug_theloai')}}" name="slug_theloai" id="convert_slug" aria-describedby="theloai" placeholder="Slug thể loại">
                        </div>
                        <div class="mb-3">
                            <label for="mota" class="form-label">Mô tả thể loại</label><br>
                            <textarea name="mota" class="form-control" id="" cols="105" rows="8" placeholder="Mô tả" form="themtheloai"  style="resize: none;">{{old('mota')}}</textarea>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" name="themtheloai" class="btn btn-success me-md-2">Thêm thể loại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection