<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Roles;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property Roles $role
 * @property string $phone
 * @property ?Carbon $email_verified_at
 * @property string $password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $full_name
 * @property bool $is_admin
 * @property string $initials
 *
 **/
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => Roles::class,
        ];
    }

    public function fullName(): Attribute
    {
        return Attribute::make(get: fn () => $this->first_name.' '.$this->last_name);
    }

    public function address(): HasOne
    {
        return $this->hasOne(UserAddress::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function latestReservations(): HasMany
    {
        return $this->hasMany(Reservation::class)
            ->with('address')
            ->with('customerInformation')
            ->with('companyData')
            ->latest();
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'from_email', 'email')->with('messages');
    }

    public function isAdmin(): Attribute
    {
        return Attribute::make(get: fn () => in_array($this->role, Roles::adminGroup()));
    }

    public function initials(): Attribute
    {
        return Attribute::make(get: fn () => Str::upper(Str::take($this->first_name, 1).Str::take($this->last_name, 1)));
    }

    public function temporaryReservation(): HasOne
    {
        return $this->hasOne(ReservationTemp::class);
    }

    public function upcomingReservations(): HasMany
    {
        return $this->hasMany(Reservation::class)
            ->whereNull('cancelled')
            ->where('date', '>=', Carbon::now())
            ->orderBy('date');
    }
}
