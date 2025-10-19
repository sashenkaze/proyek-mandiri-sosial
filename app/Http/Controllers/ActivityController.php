<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //home function
    public function home()
    {
        return view('home');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Auto nonaktif kalau tanggal sudah lewat
    Activity::whereDate('date', '<', now())
        ->where('actived', 1)
        ->update(['actived' => 0]);

    $activities = Activity::all();
    return view('admin.activities.index', compact('activities'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'description' => 'required|min:10',
        ], [
            'title.required' => 'Judul kegiatan harus diisi',
            'location.required' => 'Lokasi kegiatan harus diisi',
            'date.required' => 'Tanggal berakhir harus diisi',
            'date.date' => 'Tanggal berakhir harus berupa tanggal yang valid',
            'date.after_or_equal' => 'Tanggal berakhir tidak boleh sebelum hari ini',
            'description.required' => 'Deskripsi kegiatan harus diisi',
            'description.min' => 'Deskripsi minimal terdiri dari 10 karakter',
        ]);

        $createData = Activity::create([
            'title' => $request->title,
            'location' => $request->location,
            'date' => $request->date,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'actived' => 1
        ]);

        if ($createData) {
            return redirect()->route('admin.activities.index')->with('success', 'Kegiatan berhasil ditambahkan!');
        } else {
            return redirect()->route('admin.activities.create')->with('error', 'Gagal! Silakan coba lagi.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $activity = Activity::find($id);
        return view('admin.activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'description' => 'required|min:10',
        ], [
            'title.required' => 'Judul kegiatan harus diisi',
            'location.required' => 'Lokasi kegiatan harus diisi',
            'date.required' => 'Tanggal berakhir harus diisi',
            'date.date' => 'Tanggal berakhir harus berupa tanggal yang valid',
            'date.after_or_equal' => 'Tanggal berakhir tidak boleh sebelum hari ini',
            'description.required' => 'Deskripsi kegiatan harus diisi',
            'description.min' => 'Deskripsi minimal terdiri dari 10 karakter',
        ]);

        $updateData = Activity::where('id', $id)->update([
            'title' => $request->title,
            'location' => $request->location,
            'date' => $request->date,
            'description' => $request->description,
            'actived' => 1
        ]);

        if ($updateData) {
            return redirect()->route('admin.activities.index')->with('success', 'Data kegiatan berhasil diperbarui!');
        } else {
            return redirect()->route('admin.activities.edit', $id)->with('error', 'Gagal! Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $linkedSchedules = Schedule::where('activity_id', $id)->count();

        // if ($linkedSchedules) {
        //     return redirect()->route('admin.activities.index')->with('failed', 'Tidak dapat menghapus data kegiatan! Data tertaut dengan jadwal.');
        // }

        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('admin.activities.index')->with('success', 'Data kegiatan berhasil dihapus');
    }

    public function patch($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update([
            'actived' => 0
        ]);

        return redirect()->route('admin.activities.index')->with('success', 'Kegiatan berhasil dinonaktifkan!');
    }

    // public function exportExcel()
    // {
    //     $file_name = 'data-film.xlsx';
    //     return Excel::download(new MovieExport, $file_name);
    // }
    public function trash()
    {
        $activities = Activity::onlyTrashed()->get();
        return view('admin.activities.trash', compact('activities'));
    }
    public function restore($id)
    {
        $activity = Activity::onlyTrashed()->find($id);
        $activity->restore();
        return redirect()->route('admin.activities.index')->with('success', 'Data berhasil dikembalikan!');
    }

    public function deletePermanent($id)
    {
        $activity = Activity::onlyTrashed()->find($id);
        $activity->forceDelete();
        return redirect()->route('admin.activities.index')->with('success', 'Data berhasil dihapus permanen!');
    }
}
