<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SidatData;

class ApprovalController extends Controller
{
    public function index()
    {
        $pendingData = SidatData::with('user')
            ->where('isapproved', false)
            ->latest('created_at')
            ->paginate(15);

        return view('admin.approvals.index', compact('pendingData'));
    }

    public function approve(SidatData $sidat)
    {
        $sidat->update([
            'isapproved' => true
        ]);

        return redirect()->route('admin.approvals.index')->with('success', 'Data has been approved successfully.');
    }

    public function reject(SidatData $sidat)
    {
        $sidat->delete();

        return redirect()->route('admin.approvals.index')->with('success', 'Data has been rejected and deleted.');
    }
}
