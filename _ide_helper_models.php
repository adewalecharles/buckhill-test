<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Brand
 *
 * @property int $id
 * @property string $uuid
 * @property string $title
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BrandFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Brand limitBy($limit)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand search($searchQuery)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand sortBy($sortBy, $desc)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUuid($value)
 */
	class Brand extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $uuid
 * @property string $title
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUuid($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\File
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $path
 * @property string $size
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUuid($value)
 */
	class File extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\JwtToken
 *
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $unique_id
 * @property string $token_title
 * @property mixed|null $restrictions
 * @property mixed|null $permissions
 * @property string|null $expires_at
 * @property string|null $last_used_at
 * @property string|null $refreshed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken whereRefreshedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken whereRestrictions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken whereTokenTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken whereUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JwtToken whereUserId($value)
 */
	class JwtToken extends \Eloquent {}
}

namespace App\Models{
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
 * @mixin \Eloquent
 * @property string $first_name
 * @property string $last_name
 * @property bool $is_admin
 * @property string|null $avatar
 * @property string $address
 * @property string $phone_number
 * @property bool $is_marketing
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
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
 */
	class User extends \Eloquent {}
}

