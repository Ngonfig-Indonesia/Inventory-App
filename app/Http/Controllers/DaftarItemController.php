<?php

namespace App\Http\Controllers;

use App\Imports\DaftarImport;
use App\Models\DaftarItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DaftarItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = DaftarItem::with('barangmasuk')->get();
        $item = DaftarItem::with('barangkeluar')->get();
        return view('/admin/daftarbarang', compact('item'));

    }

    public function select2(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data =DaftarItem::select("id","nama_barang")
            		->where('nama_barang','LIKE',"%$search%")
            		->get();
        }
        // $select2 = DaftarItem::all();
        return response()->json($data, 200);
    }

    public function select3(Request $request)
    {
        $datas = [];
        if($request->has('q')){
            $search = $request->q;
            $datas =DaftarItem::select("id","nama_barang")
            		->where('nama_barang','LIKE',"%$search%")
            		->get();
        }
        // $select2 = DaftarItem::all();
        return response()->json($datas, 200);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = $file->hashName();

        $path = $file->storeAs('public/assets/excel/',$nama_file);

        // import data
        $import = Excel::import(new DaftarImport(), storage_path('app/public/assets/excel/'.$nama_file));

        //remove from server
        Storage::delete($path);

        if($import) {
            //redirect
            return redirect()->route('daftaritem')->with(['success' => 'Data Berhasil Diimport!']);
        } else {
            //redirect
            return redirect()->route('daftaritem')->with(['error' => 'Data Gagal Diimport!']);
        }
    }

    public function export()
    {
        return Excel::download(new DaftarExport(), 'Daftar Item Barang.xlsx');
    }

    // public function download()
    // {
    //     $download = storege_path('public/assets/excel/storage/contohimport.xlsx');
    //     return response()->download($download);
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DaftarItem::create([
            'kode_barang' => $request->kode_barang,
            'barcode' => $request->barcode,
            'nama_barang' => $request->nama_barang
        ]);

        return redirect()->route('daftaritem');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaftarItem  $daftarItem
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarItem $daftarItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaftarItem  $daftarItem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = DaftarItem::findOrFail($id);
        return view('/admin/daftarbarang/barangedit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaftarItem  $daftarItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = DaftarItem::find($id)->update($request->all());
        return redirect()->route('daftaritem');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaftarItem  $daftarItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DaftarItem::find($id);
        $delete->delete();
        if ($delete) {
            return back()->with('success',' Penghapusan berhasil.');
        } else {
            return back()->with('error',' Penghapusan tidak berhasil.');
        }
        
    }
}
