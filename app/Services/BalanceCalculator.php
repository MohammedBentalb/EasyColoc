<?php

namespace App\Services;

use App\Models\Colocation;
use App\Models\Depense;
use App\Models\Settlement;
use App\Models\User;

class BalanceCalculator
{
    /**
     * Create a new class instance.
     */
    public function __construct() {
    }

    public function balance($user) : array {
        $colocation = $user->getActicveColocation()->first();
        if (!$colocation) return ['totalPaid' => 0, 'share' => 0, 'solde' => 0];
        
        $usersCount = $colocation->users()->count();
        if ($usersCount === 0) return ['totalPaid' => 0, 'share' => 0, 'solde' => 0];

        $depensesPaid = Depense::where('user_id', $user->id)->whereHas('category', function($q) use($colocation){
                $q->where('colocation_id', $colocation->id);
            })->sum('amount');

        $settlementsPaid = Settlement::where('user_id', $user->id) ->whereHas('depense.category', function($q) use($colocation){
                $q->where('colocation_id', $colocation->id);
            })->sum('amount');

        $totalPaye = $depensesPaid + $settlementsPaid;

        $totalColocationExpenses = Depense::whereHas('category', function($q) use($colocation){
            $q->where('colocation_id', $colocation->id);
        })->sum('amount');
        
        $partIndividuelle = $totalColocationExpenses / $usersCount;

        $settlementsReceived = Settlement::whereHas('depense', function($q) use($user){
            $q->where('user_id', $user->id); // Depenses created by this user
        })->whereHas('depense.category', function($q) use($colocation){
            $q->where('colocation_id', $colocation->id);
        })->sum('amount');

        $solde = ($totalPaye - $settlementsReceived) - $partIndividuelle;
        return [ 'totalPaid' => $totalPaye, 'share' => $partIndividuelle, 'solde' => $solde];
    }
}