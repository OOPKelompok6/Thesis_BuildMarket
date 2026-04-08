<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Services\ApprovalService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ApprovalsController extends Controller
{

    public function __construct(protected ApprovalService $approvalService)
    {}

    public function userApproval() {
        if (Gate::allows('isUser')) {
            return view('Approvals.userApprovals');
        } else {
            abort(403);
        }
    }

    public function createApproval() {
        $payload = request()->validate([
            'npwp_number' => ['required', 'digits:16'],
            'NIBDocument' => ['required', 'file', 'mimes:pdf']
        ], [
            'npwp_number.required' => 'NPWP Number is required.',
            'npwp_number.digits' => 'NPWP Number is of length 16.',

            'NIBDocument.required' => 'NIB Document is required.',
            'NIBDocument.file' => 'NIB Document must be a file.',
            'NIBDocument.mimes' => 'NIB Document must be a pdf file.'
        ]);
        $this->approvalService->createApproval($payload);

        return redirect('/sellerRequest');
    }

    public function approvalList() {
        if (Gate::allows('isAdmin')) {
            return view('Approvals.approvalList', ['approvals' => $this->approvalService->getApprovals()]);
        } else {
            abort(403);
        }
    }

    public function deleteApproval(Approval $approval) {
        $this->approvalService->deleteApproval($approval);
        return redirect('/approvalList');
    }

    public function approveApproval(Approval $approval) {
        $this->approvalService->approveApproval($approval);
        return redirect('/approvalList');
    }

}
