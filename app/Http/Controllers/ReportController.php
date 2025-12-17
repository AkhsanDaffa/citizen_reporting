<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        // Tampilkan semua laporan dari yang terbaru
        $reports = Report::latest()->get();
        return view('reports.index', compact('reports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reporter_name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi Gambar
        ]);

        // Upload File ke folder 'public/reports'
        $path = $request->file('image')->store('reports', 'public');

        Report::create([
            'reporter_name' => $request->reporter_name,
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path, // Simpan path-nya saja di DB
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }

    // Fitur Admin: Update Status
    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->update([
            'status' => $request->status,
            'admin_response' => 'Status diubah menjadi ' . $request->status
        ]);
        return redirect()->back()->with('success', 'Status diperbarui');
    }
}