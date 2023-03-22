<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasJwtToken;
use App\Traits\HasRouteKey;
use App\Traits\HasUuid;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\JwtToken|null $jwtToken
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 *
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUuid($value)
 *
 * @property string $first_name
 * @property string $last_name
 * @property bool $is_admin
 * @property string|null $avatar
 * @property string $address
 * @property string $phone_number
 * @property bool $is_marketing
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User limitBy($limit)
 * @method static \Illuminate\Database\Eloquent\Builder|User search($searchQuery)
 * @method static \Illuminate\Database\Eloquent\Builder|User sortBy($sortBy, $desc)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsMarketing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasJwtToken, HasFactory, Notifiable, HasUuid, HasRouteKey;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'is_admin',
        'email',
        'password',
        'avatar',
        'address',
        'phone_number',
        'is_marketing',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_marketing' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    public function setPasswordAttribute($value): string
    {
        return $this->attributes['password'] = Hash::make($value);
    }

    public function scopeSortBy($query, $sortBy, $desc): mixed
    {
        $sortFields = [
            'id',
            'first_name',
            'last_name',
            'email',
            'phone_number',
            'address',
            'created_at',
        ];

        if (! in_array($sortBy, $sortFields)) {
            $sortBy = 'created_at';
        }

        return $query->orderBy($sortBy, $desc ? 'desc' : 'asc');
    }

    public function scopeLimitBy($query, $limit): mixed
    {
        $limit = $limit ?: 50;

        return $query->limit(intval($limit));
    }

    public function scopeSearch($query, $searchQuery): mixed
    {
        if (! $searchQuery) {
            return $query;
        }

        return $query->where(function ($query) use ($searchQuery) {
            $query->where('first_name', 'like', "%$searchQuery%")
            ->orWhere('last_name', 'like', "%$searchQuery%")
            ->orWhere('email', 'like', "%$searchQuery%")
            ->orWhere('phone_number', 'like', "%$searchQuery%")
            ->orWhere('address', 'like', "%$searchQuery%");
        });
    }

    /**
     * Search and sort the user record
     *
     * @param  string  $searchQuery
     * @param  string  $sortBy
     * @param  string  $desc
     * @param  string  $limit
     * @param  string  $perPage
     */
    public static function searchAndSort($searchQuery, $sortBy, $desc, $limit, $perPage): mixed
    {
        return static::search($searchQuery)
            ->where('is_admin', false)
            ->sortBy($sortBy, $desc)
            ->limitBy($limit)
            ->paginate($perPage);
    }
}
