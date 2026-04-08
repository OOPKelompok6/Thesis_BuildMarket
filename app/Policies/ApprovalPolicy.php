<?php

namespace App\Policies;

use App\Models\Approval;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApprovalPolicy
{
    public function approvalExist(User $user): bool
    {
        if($user->approval !== null) {
            return false;
        }
        return true;
    }
}
