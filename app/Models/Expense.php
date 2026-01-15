<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    protected $fillable = [
        'description',
        'amount',
        'user_id',
        'group_id',
    ];

    public function payer() {

        return $this -> belongsTo(User::class, 'paid_by');
    }

    public function user()
    {
        return $this -> belongsTo(User::class);
    }

    public function group() :BelongsTo
    {

        return $this -> belongsTo(Group::class, 'group_id');
    }
}
