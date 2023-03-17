<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Token;

/**
 * App\Models\JwtToken
 *
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken query()
 * @mixin \Eloquent
 */
class JwtToken extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'token_title',
        'unique_id',
        'permissions',
        'restrictions',
        'title',
        'last_used_at',
        'expires_at',
        'refreshed_at'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function hasPermission(string $permission): bool
    {
        $token = $this->getToken();

        return in_array($permission, $token->getClaim('permissions', []));
    }

    public function hasRestriction(string $restriction): bool
    {
        $token = $this->getToken();

        return in_array($restriction, $token->getClaim('restrictions', []));
    }

    public function getToken(): Token
    {
        $jwt = Auth::parseToken();

        return $jwt->getPayload();
    }
}
