<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'uuid',
        'name',
        'url',
        'phone',
        'whatsapp',
        'email',
        'facebook',
        'instagram',
        'youtube',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCompanies(string $filter = '')
    {
        $companies = $this->with('category')
            ->when(
                $filter,
                function ($query, $filter) {
                    return $query->where(
                        function ($query) use ($filter) {
                            $query->where('name', 'LIKE', "%$filter%")
                                ->orWhere('email', 'LIKE', "%$filter%")
                                ->orWhere('phone', 'LIKE', "%$filter%");
                        }
                    );;
                }
            )
            ->paginate();
        return $companies;
    }
}
