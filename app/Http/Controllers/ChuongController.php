<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truyen;
use App\Models\Chuong;

class ChuongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chuong = Chuong::with('truyen')->orderBy('id', 'DESC')->get();
        //dd($chuong);
        return view('admin.chuong.index')->with(compact('chuong'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $truyen = Truyen::orderBy('id', 'DESC')->get();
        return view('admin.chuong.create')->with(compact('truyen'));
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
                'tenchuong' => 'required|unique:chuong|max:255',
                'slug_chuong' => 'required|max:255',
                'noidung' => 'required',
                'idtruyen' => 'required',
            ],
            [
                'tenchuong.required' => 'Không được để trống tên chương',
                'slug_chuong.required' => 'Không được để trống Slug chương',
                'noidung.required' => 'Không được để trống nội dung chương',
                'tenchuong.unique' => 'Tên chương này đã tồn tại',
            ]
        );
        $chuong = new Chuong();
        $chuong->tenchuong = $data['tenchuong'];
        $chuong->slug_chuong = $data['slug_chuong'];
        $chuong->noidung = $data['noidung'];
        $chuong->id_truyen = $data['idtruyen'];

        $chuong->save();
        return redirect()->back()->with('status', 'Thêm chương cho truyện thành công');
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
        $chuong = Chuong::find($id);
        $truyen = Truyen::orderBy('id', 'DESC')->get();
        return view('admin.chuong.edit')->with(compact('chuong', 'truyen'));
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
                'tenchuong' => 'required|max:255',
                'slug_chuong' => 'required|max:255',
                'noidung' => 'required',
                'idtruyen' => 'required',
            ],
            [
                'tenchuong.required' => 'Không được để trống tên chương',
                'slug_chuong.required' => 'Không được để trống Slug chương',
                'noidung.required' => 'Không được để trống nội dung chương',
            ]
        );
        $chuong = Chuong::find($id);
        $chuong->tenchuong = $data['tenchuong'];
        $chuong->slug_chuong = $data['slug_chuong'];
        $chuong->noidung = $data['noidung'];
        $chuong->id_truyen = $data['idtruyen'];

        $chuong->save();
        return redirect()->back()->with('status', 'Cập nhật chương thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chuong::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa chương thành công');
    }
}
