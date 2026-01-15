<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'description',
        'amount',
        'paid_by',
        'group_id',
    ];

    public function payer() {

        return $this -> belongsTo(User::class, 'paid_by');
    }

    public function payers() {

        return $this -> belongsTo(Group::class, 'group_id');
    }
}
