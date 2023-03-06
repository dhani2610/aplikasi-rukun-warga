<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class ApprovalRegisterController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Approval List';
        $data['breadcumb'] = 'Approval List';
        $data['users'] = User::orderby('id', 'asc')->where('approval','Pending')->get();

        return view('approval-user.index', $data);
    }

    public function notifikasi()
    {
        $data['page_title'] = 'Approval List';
        $data['breadcumb'] = 'Approval List';
        $data['users'] = User::orderby('id', 'asc')->where('approval','Pending')->get();

        return view('approval-user.index', $data);
    }


    public function approval(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->approval = 'Approve';
        $user->save();
        return redirect()->route('approval-list')->with(['success' => 'Approv successfully!']);
    }

    public function notApprove(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->approval = 'Not Approve';
        $user->save();
        return redirect()->route('approval-list')->with(['success' => 'Not Approv successfully!']);
    }

}
