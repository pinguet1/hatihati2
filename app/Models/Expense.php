<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'description',
        'amount'
    ];

    public function paidExpenses() {

        return $this -> belongsTo(User::class);
    }
}
