<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $qrisImage = Setting::get('qris_image');
        return view('admin.settings.index', compact('qrisImage'));
    }

    public function uploadQris(Request $request)
    {
        $request->validate([
            'qris_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Delete old QRIS if exists
        $oldQris = Setting::get('qris_image');
        if ($oldQris) {
            Storage::disk('public')->delete($oldQris);
        }

        // Upload new QRIS
        $path = $request->file('qris_image')->store('qris', 'public');
        Setting::set('qris_image', $path);

        return redirect()->back()->with('success', 'QRIS berhasil diupload!');
    }

    public function deleteQris()
    {
        $qrisImage = Setting::get('qris_image');
        if ($qrisImage) {
            Storage::disk('public')->delete($qrisImage);
            Setting::where('key', 'qris_image')->delete();
        }

        return redirect()->back()->with('success', 'QRIS berhasil dihapus!');
    }
}
