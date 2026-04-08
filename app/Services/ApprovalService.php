<?php

namespace App\Services;

use App\Models\Approval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApprovalService
{

    public function createApproval($payload) {
        Storage::disk('azure')->putFileAs('', $payload['NIBDocument'], 'ApprovalDocs-' . Auth::user()->id . '.pdf');
        $url = Storage::disk('azure')->url('ApprovalDocs-' . Auth::user()->id . '.pdf');

        $approval = Approval::create([
            'npwp_number' => $payload['npwp_number'],
            'user_id' => Auth::user()->id
        ]);

        $approval->blob_link = $url;
        $approval->save();
    }

    public function getApprovals() {
        return Approval::oldest()->simplePaginate(15);
    }

    public function deleteApproval($approval) {
        Storage::disk('azure')->delete('ApprovalDocs-' . $approval->user_id . '.pdf');
        $approval->delete();
    }

    public function approveApproval($approval) {
        Storage::disk('azure')->delete('ApprovalDocs-' . $approval->user_id . '.pdf');
        $approval->user->role = 'Seller';
        $approval->user->save();
        $approval->delete();
    }
}
