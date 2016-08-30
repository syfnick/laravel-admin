<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

	protected $fillable = ['name', 'label', 'description'];

    public function roles()
	{
	    return $this->belongsToMany(Role::class);
	}
}
