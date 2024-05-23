<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use Illuminate\Http\Request;

class ManageCabangController extends Controller
{
    public function index()
    {
        $cabangs = Cabang::all();
        return view('admin.cabang.index', compact('cabangs'));
    }

    public function create()
    {
        return view('admin.cabang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kota_kabupaten' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nama_pimpinan' => 'required|string|max:255',
            'nib_cabang' => 'required|string|unique:cabangs,nib_cabang|max:255',
            'pdf_nib' => 'nullable|file|mimes:pdf',
            'pdf_akta_cabang' => 'nullable|file|mimes:pdf',
        ]);

        $data = $request->all();

        if ($request->hasFile('pdf_nib')) {
            $data['pdf_nib'] = $request->file('pdf_nib')->store('pdfs');
        }

        if ($request->hasFile('pdf_akta_cabang')) {
            $data['pdf_akta_cabang'] = $request->file('pdf_akta_cabang')->store('pdfs');
        }

        Cabang::create($data);

        return redirect()->route('admin.cabang.index')->with('success', 'Cabang created successfully.');
    }

    public function edit($id)
    {
        $cabang = Cabang::findOrFail($id);
        return view('admin.cabang.edit', compact('cabang'));
    }

    public function update(Request $request, $id)
    {
        $cabang = Cabang::findOrFail($id);

        $request->validate([
            'kota_kabupaten' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nama_pimpinan' => 'required|string|max:255',
            'nib_cabang' => 'required|string|max:255|unique:cabangs,nib_cabang,'.$cabang->id,
            'pdf_nib' => 'nullable|file|mimes:pdf',
            'pdf_akta_cabang' => 'nullable|file|mimes:pdf',
        ]);

        $data = $request->all();

        if ($request->hasFile('pdf_nib')) {
            $data['pdf_nib'] = $request->file('pdf_nib')->store('pdfs');
        }

        if ($request->hasFile('pdf_akta_cabang')) {
            $data['pdf_akta_cabang'] = $request->file('pdf_akta_cabang')->store('pdfs');
        }

        $cabang->update($data);

        return redirect()->route('admin.cabang.index')->with('success', 'Cabang updated successfully.');
    }

    public function destroy($id)
    {
        $cabang = Cabang::findOrFail($id);
        $cabang->delete();

        return redirect()->route('admin.cabang.index')->with('success', 'Cabang deleted successfully.');
    }
}
