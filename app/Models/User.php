<?php

namespace App\Models;

use Eloquent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * App\User
 * @mixin Eloquent
 * @method static find(int $id)
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string|null $password
 * @property int $is_admin
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $avatar
 */
class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Add user
     *
     * @param $fields
     * @return static
     */
    public static function add($fields)
    {
        $user = new self();
        $user->fill($fields);
        $user->save();

        return $user;
    }

    /**
     * Edit existing user
     *
     * @param $fields
     */
    public function edit($fields): void
    {
        $this->fill($fields); //name,email
        $this->save();
    }

    /**
     * Generate (encryption) user password
     *
     * @param $password
     */
    public function generatePassword($password): void
    {
        if ($password !== null) {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    /**
     * Remove user
     */
    public function remove(): void
    {
        try {
            $this->removeAvatar();
            $this->delete();
        } catch (\Exception $e) {
        }
    }

    /**
     * Upload user's avatar
     *
     * @param $image
     */
    public function uploadAvatar($image): void
    {
        if ($image === null) {
            return;
        }

        $this->removeAvatar();

        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->avatar = $filename;
        $this->save();
    }

    /**
     * Remove user's avatar from disk
     */
    public function removeAvatar(): void
    {
        if ($this->avatar !== null) {
            Storage::delete(Project::UPLOAD_PATH . $this->avatar);
        }
    }

    /**
     * Remove user's avatar from database
     */
    public function deleteAvatar()
    {
        if ($this->avatar === null) {
            return;
        }
        $this->removeAvatar();
        $this->avatar = null;
        $this->save();
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getAvatar(): string
    {
        if ($this->avatar === null) {
            return '/img/no-image.png';
        }

        return '/' . Project::UPLOAD_PATH . $this->avatar;
    }

    /**
     * Make admin status for user
     */
    public function makeAdmin(): void
    {
        $this->is_admin = self::ROLE_ADMIN;
        $this->save();
    }

    /**
     * Make normal status for user
     */
    public function makeNormal(): void
    {
        $this->is_admin = 0;
        $this->save();
    }

    /**
     * Toggle admin status
     *
     * @param $value
     */
    public function toggleAdmin($value): void
    {
        if ($value === null) {
            $this->makeNormal();
        }

        $this->makeAdmin();
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        /** @var $user User */
        $user = Auth::user();

        return ($user->is_admin === self::ROLE_ADMIN);
    }

}
