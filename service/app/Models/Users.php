<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Users extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'username',
        'email',
        'password',
        'phone',
        'refferal_code',
        'address',
        'photo'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public static function getRefCode($payload)
    {
        try {

            $validator = Validator::make($payload, [
                'referral_code' => 'required'
            ]);

            if ($validator->fails()) {

                $data = ['error' => $validator->errors()->toArray()];

            } else {
                
                $selectedData = self::where('referral_code', '=', $payload['referral_code'])->firstOrFail();
                $data = ['success' => $selectedData];

            }

        } catch (ModelNotFoundException $e) {
            
            $data = ['error' => 'Owner Refferal Code Not Found'];

        } catch (QueryException $e) {

            $data = ['error' => $e->getMessage()];

        }

        return $data;
    }
}
