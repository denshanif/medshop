<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Unit;

class UnitController extends Controller
{
    public function index()
    {
        // Get all units
        $units = Unit::all();

        return view('admin.units.index', ['units' => $units]);
    }

    public function create()
    {
        return view('admin.units.create');
    }

    public function store(Request $request)
    {
        // Validate the request...
        $request->validate([
            'unit_name' => 'required|unique:units|max:255',
        ]);

        $unit = new Unit;

        $unit->unit_name = $request->unit_name;

        $unit->save();

        if ($unit->save()) {
            return redirect('admin/units')->with('success', 'Unit created successfully');
        } else {
            return redirect('admin/units')->with('error', 'Failed to create unit');
        }
    }

    public function edit($id)
    {
        // Get the unit
        $unit = Unit::find($id);

        return view('admin.units.edit', ['unit' => $unit]);
    }

    public function update(Request $request, $id)
    {
        // Validate the request...
        $request->validate([
            'unit_name' => 'required|unique:units|max:255',
        ]);

        $unit = Unit::find($id);

        $unit->unit_name = $request->unit_name;

        $unit->save();

        if ($unit->save()) {
            return redirect('admin/units')->with('success', 'Unit updated successfully');
        } else {
            return redirect('admin/units')->with('error', 'Failed to update unit');
        }
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);

        if ($unit) {
            $unit->delete();
            return redirect('admin/units')->with('success', 'Unit deleted successfully');
        } else {
            return redirect('admin/units')->with('error', 'Failed to delete unit');
        }
    }
}
