<?php

namespace App\Services;

use App\ColocationStatus;
use App\DepenseStatus;
use App\Models\Settlement;

class BalanceCalculator {

    public function __construct() {
    }

    public function balance($user) : array {
        $colocation = $user->getActiveColocation()->first();
        $activeUsersCount = $colocation ? $colocation->users()->wherePivot('status', ColocationStatus::active->value)->count() : 0;

        if (!$colocation || $activeUsersCount === 0) return ['totalPaid' => 0, 'share' => 0, 'solde' => 0];
        $totalExpenses = $colocation->depenses()->where('status', DepenseStatus::pending->value)->sum('amount');
        $fairShare = $totalExpenses / $activeUsersCount;
        $billsPaid = $colocation->depenses()->where('status', DepenseStatus::pending->value)->where('user_id', $user->id)->sum('amount');

        $settlementsPaid = Settlement::where('user_id', $user->id)
            ->whereHas('depense', fn($q) => $q->where('status', DepenseStatus::pending->value))
            ->whereHas('depense.category', fn($q) => $q->where('colocation_id', $colocation->id))
            ->sum('amount');
        
        $totalPaid = $billsPaid + $settlementsPaid;

        $settlementsReceived = Settlement::whereHas('depense', function($q) use ($user) {
            $q->where('status', DepenseStatus::pending->value)->where('user_id', $user->id);
            })->whereHas('depense.category', fn($q) => $q->where('colocation_id', $colocation->id))
            ->sum('amount');

        $solde = ($totalPaid - $settlementsReceived) - $fairShare;

        return [ 'totalPaid' => $totalPaid, 'billsPaid' => $billsPaid,  'share' => $fairShare, 'solde' => $solde
        ];
    }
}