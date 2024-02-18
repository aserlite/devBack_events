<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Avis as AppComment;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'participants');
    }
    public function comment()
    {
        return $this->hasMany(AppComment::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $url = url()->current();
        $startPos = strpos($url, 'admin/events/') + strlen('admin/events/');
        $endPos = strpos($url, '/edit');
        $eventId = substr($url, $startPos, $endPos - $startPos);

        $is_admin = Participants::where('is_admin',true)->where('user_id', auth()->id())->where('event_id', $eventId)->first();
        if ($is_admin != null){
            return true;
        }

        if($url == str_contains($url, '/admin/events/create') && auth()->id()){
            return true;
        }

        return str_ends_with($this->email, '@gmail.com');
    }
}
