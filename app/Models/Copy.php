<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Copy extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'print_date' => 'date',
    ];

    /**
     * Get the book of this copy.
     *
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
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

    public function loanRecords(): HasMany
    {
        return $this->hasMany(LoanRecord::class, 'copy_id', 'id');
    }

    public function getIsBorrowedAttribute(): bool
    {
        return $this->loanRecords()->whereNull('date_returned')->exists();
    }
}
