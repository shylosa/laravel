<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->save();

        return $user;
    }

    public function edit($fields): void
    {
        $this->fill($fields); //name,email

        $this->save();
    }

    public function generatePassword($password): void
    {
        if($password !== null)
        {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function remove(): void
    {
        try {
            $this->removeAvatar();
            $this->delete();
        } catch (\Exception $e) {
        }
    }

    public function uploadAvatar($image)
    {
        if($image == null) { return; }

        $this->removeAvatar();

        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->avatar = $filename;
        $this->save();
    }

    public function removeAvatar()
    {
        if($this->avatar != null)
        {
            Storage::delete('uploads/' . $this->avatar);
        }
    }

    public function getImage()
    {
        if($this->avatar == null)
        {
            return '/img/no-image.png';
        }

        return '/uploads/' . $this->avatar;
    }
    public function makeAdmin(): void
    {
        $this->is_admin = 1;
        $this->save();
    }

    public function makeNormal(): void
    {
        $this->is_admin = 0;
        $this->save();
    }

    public function toggleAdmin($value): void
    {
        if($value === null)
        {
            $this->makeNormal();
        }

        $this->makeAdmin();
    }


}
