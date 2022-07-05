<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theloai;
use App\Models\Truyen;

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $truyen = Truyen::with('theloai')->orderBy('id', 'DESC')->get();
        return view('admin.truyen.index')->with(compact('truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        return view('admin.truyen.create')->with(compact('theloai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'tentruyen' => 'required|unique:truyen|max:255',
                'slug_truyen' => 'required|max:255',
                'tomtat' => 'required',
                'idtheloai' => 'required',
                'hinhanh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|
                dimensions:min_width=100,min_height=100,max_width=1500,max_height=1500',
            ],
            [
                'tentruyen.required' => 'Không được để trống tên truyện',
                'slug_truyen.required' => 'Không được để trống Slug_truyện',
                'tomtat.required' => 'Không được để trống tóm tắt truyện',
                'hinhanh.required' => 'Phải thêm hình ảnh',
                'tentruyen.unique' => 'Tên truyện này đã tồn tại',
            ]
        );
        $truyen = new Truyen();
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->slug_truyen = $data['slug_truyen'];
        $truyen->tomtat = $data['tomtat'];
        $truyen->id_theloai = $data['idtheloai'];

        //tải ảnh lên folder 'truyen'
        $get_image = $request->hinhanh;
        $path = 'public/uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();  //lấy tên ảnh và đuôi extension
        $name_image = current(explode('.', $get_name_image));   //lấy phần tên ảnh lưu vào name_image
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();    //tên ở name_image thêm một số random và gắn lại extension
        $get_image->move($path, $new_image);    //lưu hình ảnh vào đường dẫn path
        $truyen->hinhanh = $new_image;

        $truyen->save();
        return redirect()->back()->with('status', 'Thêm truyện thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $truyen = Truyen::find($id);
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        return view('admin.truyen.edit')->with(compact('truyen', 'theloai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'tentruyen' => 'required|max:255',
                'slug_truyen' => 'required|max:255',
                'tomtat' => 'required',
                'idtheloai' => 'required',
            ],
            [
                'tentruyen.required' => 'Không được để trống tên truyện',
                'slug_truyen.required' => 'Không được để trống Slug_truyện',
                'tomtat.required' => 'Không được để trống tóm tắt truyện',
            ]
        );
        $truyen = Truyen::find($id);
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->slug_truyen = $data['slug_truyen'];
        $truyen->tomtat = $data['tomtat'];
        $truyen->id_theloai = $data['idtheloai'];

        //tải ảnh lên folder 'truyen'
        $get_image = $request->hinhanh;
        if ($get_image) {
            //xóa hình ảnh cũ trước khi cập nhật ảnh
            $path = 'public/uploads/truyen/' . $truyen->hinhanh;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/truyen/';
            $get_name_image = $get_image->getClientOriginalName();  //lấy tên ảnh và đuôi extension
            $name_image = current(explode('.', $get_name_image));   //lấy phần tên ảnh lưu vào name_image
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();    //tên ở name_image thêm một số random và gắn lại extension
            $get_image->move($path, $new_image);    //lưu hình ảnh vào đường dẫn path
            $truyen->hinhanh = $new_image;
        }
        $truyen->save();
        return redirect()->back()->with('status', 'Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $truyen = Truyen::find($id);
        $path = 'public/uploads/truyen/' . $truyen->hinhanh;
        if (file_exists($path)) {
            unlink($path);
        }
        Truyen::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa truyện thành công');
    }
}
