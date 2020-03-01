<?php

namespace App;
use DB;
use App\Wallet;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

  protected $guarded = [];

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
    public function roles()
    {
    return $this->belongsToMany(Role::class);
    }
    /**
  * @param string|array $roles
  */
  public function authorizeRoles($roles)
  {
    if (is_array($roles)) {
        return $this->hasAnyRole($roles) || 
              abort(redirect('/'));
    }
    return $this->hasRole($roles) || 
          abort(redirect('/'));
  }
  /**
  * Check multiple roles
  * @param array $roles
  */
  public function hasAnyRole($roles)
  {
    return null !== $this->roles()->whereIn('name', $roles)->first();
  }
  /**
  * Check one role
  * @param string $role
  */
  public function hasRole($role)
  {
    return null !== $this->roles()->where('name', $role)->first();
  }
  public function getSponser($data){
    $dataw = User::where('memberid',$data)->limit(1)->get();
    return $dataw;
  }

  public function isAdmin()
  {
      return $this->roles()->where('name', 'admin')->first();
  }
  public function isUser()
  {
      return $this->roles()->where('name', 'user')->first();
  }
  public function wallets()
  {
    return $this->hasMany(Wallet::Class);
  }
  public function moneys()
  {
    return $this->hasMany(Money::Class);
  }
  public function pay_moneys()
  {
    return $this->hasMany(Money::Class,'pay_user_id','id');
  }
  public function uplink()
  {
    return $this->belongsTo(User::Class,'u_parent','memberid');
  }
}
