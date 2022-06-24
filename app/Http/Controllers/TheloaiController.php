<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theloai;

class TheloaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //sắp xếp thể loại theo id giảm dần(cái mới thêm được hiển thị trước)
        $theloai = Theloai::orderBy('id','DESC')->get();
        //$theloai = Theloai::all();
        return view('admin.theloai.index')->with(compact('theloai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.theloai.create');
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
                'tentheloai'=> 'required|unique:theloai|max:255',
                'mota'=>'required',],
            [
                'tentheloai.required'=>'Không được để trống tên thể loại',
                'mota.required'=>'Không được để trống mô tả',
                'tentheloai.unique'=>'Thể loại truyện này đã tồn tại',
            ]
        );
        $theloai = new Theloai();
        $theloai->tentheloai = $data['tentheloai'];
        $theloai->mota = $data['mota'];
        $theloai->save();
        return redirect()->back()->with('status','Thêm thể loại thành công');
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
        $theloai = Theloai::find($id);
        return view('admin.theloai.edit')->with(compact('theloai'));
        //return redirect()->back()->with('status','Thêm thể loại thành công');
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
                'tentheloai'=> 'required|max:255',
                'mota'=>'required',],
            [
                'tentheloai.required'=>'Không được để trống tên thể loại',
                'mota.required'=>'Không được để trống mô tả',
            ]
        );
        $theloai = Theloai::find($id);
        $theloai->tentheloai = $data['tentheloai'];
        $theloai->mota = $data['mota'];
        $theloai->save();
        return redirect()->back()->with('status','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Theloai::find($id)->delete();
        return redirect()->back()->with('status','Xóa thể loại thành công');
    }
}
