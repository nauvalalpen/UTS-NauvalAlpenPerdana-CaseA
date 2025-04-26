<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Http\Requests\StoreDonasiRequest; // Import create validation request
use App\Http\Requests\UpdateDonasiRequest; // Import update validation request

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get donation data (not soft-deleted) with pagination (10 per page)
        $donasis = Donasi::latest()->paginate(10); // latest() = order by created_at desc
        return view('donasi.index', compact('donasis')); // Send data to the index view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donasi.create'); // Show the create view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDonasiRequest $request) // Use StoreDonasiRequest for validation
    {
        Donasi::create($request->validated()); // Create new data from validated input

        return redirect()->route('donasi.index')
                         ->with('success', 'Donasi baru berhasil ditambahkan.'); // Redirect to index with success message
    }

    /**
     * Display the specified resource. (Optional)
     */
    public function show(Donasi $donasi)
    {
         // return view('donasi.show', compact('donasi')); // If you want a detail page
         return redirect()->route('donasi.index'); // Or just redirect if no detail page
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donasi $donasi) // Laravel automatically finds or fails by ID
    {
        return view('donasi.edit', compact('donasi')); // Send the donation data to the edit view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDonasiRequest $request, Donasi $donasi) // Use UpdateDonasiRequest
    {
        $donasi->update($request->validated()); // Update donation data with validated input

        return redirect()->route('donasi.index')
                         ->with('success', 'Data donasi berhasil diperbarui.'); // Redirect to index with success message
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donasi $donasi)
    {
        $donasi->delete(); // Perform soft delete

        return redirect()->route('donasi.index')
                         ->with('success', 'Data donasi berhasil dihapus (soft delete).');
    }

    // --- Additional Methods for Soft Delete ---

    /**
     * Display a list of soft-deleted donations.
     */
    public function deleted()
    {
        $deletedDonasis = Donasi::onlyTrashed()->latest('deleted_at')->paginate(10); // Get only trashed items
        return view('donasi.deleted', compact('deletedDonasis'));
    }

    /**
     * Restore a soft-deleted donation.
     */
    public function restore($id) // Using ID as model binding doesn't automatically work on trashed items
    {
        $donasi = Donasi::onlyTrashed()->findOrFail($id);
        $donasi->restore();

        return redirect()->route('donasi.deleted') // Redirect back to the deleted list
                         ->with('success', 'Data donasi berhasil dipulihkan.');
    }

    /**
     * Permanently delete a donation from the database.
     * Use with caution!
     */
    public function forceDelete($id)
    {
        $donasi = Donasi::onlyTrashed()->findOrFail($id);
        $donasi->forceDelete();

        return redirect()->route('donasi.deleted') // Redirect back to the deleted list
                         ->with('success', 'Data donasi berhasil dihapus permanen.');
    }
}