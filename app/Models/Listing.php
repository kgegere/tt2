<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Listing extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'user_id',
        'category_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
    public function purchases()
    {
        return $this->hasMany(\App\Models\Purchase::class, 'listing_id');
    }
    public function buyer()
    {
        return $this->hasOne(\App\Models\Purchase::class, 'listing_id')
            ->latest()
            ->with('user');
    }
    public function firstPurchase()
    {
        return $this->hasOne(\App\Models\Purchase::class, 'listing_id')->oldest();
    }
    public function getIsPurchasedAttribute()
    {
        return $this->purchases()->exists();
    }
}