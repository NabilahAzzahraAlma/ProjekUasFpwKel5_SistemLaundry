<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Notifications\ComplaintStatusNotification;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
            'evidence' => 'nullable|image|max:2048', // Jika ada bukti berupa gambar
        ]);

        $complaint = new Complaint();
        $complaint->user_id = auth()->id();
        $complaint->type = $validated['type'];
        $complaint->description = $validated['description'];

        if ($request->hasFile('evidence')) {
            $path = $request->file('evidence')->store('complaints/evidence', 'public');
            $complaint->evidence = $path;
        }

        $complaint->save();

        return redirect()->route('dashboard')->with('status', 'Komplain berhasil diajukan');
    }

    public function showAdmin()
    {
        $complaints = Complaint::all(); // Admin melihat semua komplain
        return view('admin.complaints.index', compact('complaints'));
    }

    public function verifyComplaint($id, $status)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->status = $status; // 'verified' atau 'rejected'
        $complaint->save();

        // Kirim notifikasi ke pelanggan
        $complaint->user->notify(new ComplaintStatusNotification($complaint));

        return redirect()->route('admin.complaints')->with('status', 'Status komplain diperbarui');
    }
}
