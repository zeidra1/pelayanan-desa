<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\StatusPerkawinan;
use App\Http\Requests\Master\StatusPerkawinanRequest;

class StatusPerkawinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $statusPerkawinan = StatusPerkawinan::orderBy('created_at', 'desc')
            ->get();

        $dataTablesStatusPerkawinan = DataTables($statusPerkawinan)
            ->addColumn('action', function($statusPerkawinan){
                return '
                    <center>
                        <a
                            href="/dasbor/master/status-perkawinan/form-ubah/'.$statusPerkawinan->id.'"
                            class="btn btn-sm btn-social btn-warning"
                        >
                            <i class="fa fa-pencil"></i> Ubah
                        </a>
                        <a
                            class="btn btn-sm btn-social btn-danger"
                            id="delete-button"
                            onclick="destroy('.$statusPerkawinan->id.')"
                        >
                            <i class="fa fa-times"></i> Hapus
                        </a>
                    </center>
                ';
            })
            ->rawColumns(['action'])
            ->toJson();

        return $dataTablesStatusPerkawinan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.status_perkawinan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.status_perkawinan.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusPerkawinanRequest $statusPerkawinanRequest)
    {
        $keterangan = $statusPerkawinanRequest->keterangan;

        $data = [
            'keterangan' => $keterangan
        ];

        $createStatusPerkawinan = StatusPerkawinan::create($data);

        return redirect('/dasbor/master/status-perkawinan')
            ->with([
                'notification' => 'Data status perkawinan berhasil ditambah.'
            ]);
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
        $statusPerkawinan = StatusPerkawinan::findOrFail($id);

        return view('master.status_perkawinan.form_ubah', compact(
            'statusPerkawinan'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatusPerkawinanRequest $statusPerkawinanRequest, $id)
    {
        $keterangan = $statusPerkawinanRequest->keterangan;

        $data = [
            'keterangan' => $keterangan
        ];

        $createStatusPerkawinan = StatusPerkawinan::where('id', '=', $id)
            ->update($data);

        return redirect('/dasbor/master/status-perkawinan')
            ->with([
                'notification' => 'Data status perkawinan berhasil diubah.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteStatusPerkawinan = StatusPerkawinan::destroy($id);

        return response()
            ->json(200);
    }
}
