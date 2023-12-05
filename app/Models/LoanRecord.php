<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_loaned' => 'date',
        'date_return' => 'date',
        'date_returned' => 'date',
    ];

    /**
     * Get the copy of this loan.
     *
     * @return BelongsTo
     */
    public function copy(): BelongsTo
    {
        return $this->belongsTo(Copy::class, 'copy_id', 'id');
    }

    /**
     * Get the user that loaned the copy.
     *
     * @return BelongsTo
     */
    public function borrowedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'borrower_id', 'id');
    }

    /**
     * Get the user that created this.
     *
     * @return BelongsTo
     */
    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by', 'id');
    }
}
