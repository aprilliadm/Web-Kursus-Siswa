<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\JurusanTingkatKelas;
use App\Models\KelasMapel;
use App\Models\Mapel;
use App\Models\Modul;
use App\Models\PengumpulanTugas;
use App\Models\Pertemuan;
use App\Models\Tingkat;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::join('admin', 'users.username', '=', 'admin.username')
                ->select('users.username', 'admin.*')
                ->where('users.id', Auth::user()->id)
                ->first();
        
        $mapel = Mapel::all()->where('hapus', 0);

        return view('admin.mapel', ['mapel' => $mapel])
                ->with('user', $user);
    }

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
        $request->validate([
            'nama' => ['required', 'string', 'max:50'],
        ]);

        Mapel::create([
            'nama' => $request->input('nama'),
            'hapus' => 0,
        ]);

        return redirect('admin/input-mata_pelajaran')->with('success', 'User Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:50'],
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->nama = $request->input('nama');
        $mapel->save();

        return redirect('admin/input-mata_pelajaran')->with('success', 'Mapel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $mapel = Mapel::findOrFail($id);

    $mapel->hapus = 1;

    $mapel->save();

    return redirect('admin/input-mata_pelajaran')->with('success', 'Mapel berhasil dihapus.');
}


    public function kelasMapel_index($t, $j)
    {
        $user = User::join('admin', 'users.username', '=', 'admin.username')
                ->select('users.username', 'admin.*')
                ->where('users.id', Auth::user()->id)
                ->first();
        
        $jurusanTingkatKelas = JurusanTingkatKelas::with('jurusan', 'tingkat', 'kelas')
            ->where('id_tingkat', $t)
            ->where('id_jurusan', $j)
            ->get();

        
        $tingkat = Tingkat::find($t);
        $jurusan = Jurusan::find($j);

        return view('admin.kelasMapel', ['jurusanTingkatKelas' => $jurusanTingkatKelas, 'tingkat' => $tingkat, 'jurusan' => $jurusan])
            ->with('user', $user);
    }

    public function kelasMapel_store(Request $request)
    {
        $request->validate([
            'id_jurusanTingkatKelas' => ['required'],
        ]);

        $id_jurusanTingkatKelas = $request->input('id_jurusanTingkatKelas');
    $selectedMapel = $request->input('mata_pelajaran', []);
    $guruIds = $request->input('guru_id', []);
    
    // Simpan data ke dalam database
    for ($i = 0; $i < count($selectedMapel); $i++) {
        KelasMapel::create([
            'id_jurusanTingkatKelas' => $id_jurusanTingkatKelas,
            'id_mapel' => $selectedMapel[$i],
            'id_guru' => $guruIds[$i],
        ]);
    }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function kelasMapel_update(Request $request, $id)
    {
        $request->validate([
            'id_jurusanTingkatKelas' => ['required'],
            'id_mapel' => ['required'],
            'id_guru' => ['required'],
        ]);

        $kelasMapel = KelasMapel::findOrFail($id);
        $kelasMapel->id_jurusanTingkatKelas = $request->input('id_jurusanTingkatKelas');
        $kelasMapel->id_mapel = $request->input('id_mapel');
        $kelasMapel->id_guru = $request->input('id_guru');
        $kelasMapel->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function kelasMapel_destroy($id)
    {
        // Menghapus entri dalam model Pertemuan
        $kelasMapel = KelasMapel::findOrFail($id);
        $idPertemuan = $kelasMapel->pertemuan->pluck('id');

        $pertm = Pertemuan::whereIn('id', $idPertemuan)->get();
        
        if ($pertm->count() > 0){
            $message = "Data Tidak Bisa Dihapus, Karena Sudah Terhubung dengan Entitas Lainnya";
            return response()->json(['message' => $message]);
        }else{
            $kelasMapel->delete();
            return response()->json(['message' => '']);
        }
    }
    



}
