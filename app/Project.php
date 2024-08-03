<?php

namespace App;

use App\User\RoleType;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'partner_id', 'subtype_id', 'status_id',
        'budget', 'title', 'description', 'views', 'duration', 'withdraw_at', 'withdraw_verified_at'
    ];
    protected $with = 'review';

    protected $casts = [
        'user_id' => 'integer',
        'partner_id' => 'integer',
        'subtype_id' => 'integer',
        'status_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function partner()
    {
        return $this->belongsTo('App\User', 'partner_id');
    }
    public function subtype()
    {
        return $this->belongsTo('App\SubTypes');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function bids()
    {
        return $this->hasMany('App\Bid', 'project_id', 'id')->orderBy('bids.created_at', 'DESC');
    }
    public function progress()
    {
        return $this->hasMany('App\Progress', 'project_id', 'id')->orderBy('progresses.created_at', 'DESC');
    }
    public function payment()
    {
        return $this->hasOne('App\Payment', 'project_id');
    }
    public function review()
    {
        return $this->hasOne('App\Review', 'project_id');
    }

    public function scopeWherePartner(Builder $query, int $partnerId): Builder
    {
        return $query->where('partner_id', $partnerId);
    }

    public function scopeWhereCustomer(Builder $query, int $customerId): Builder
    {
        return $query->where('user_id', $customerId);
    }

    public function scopeStatusOngoing(Builder $query): Builder
    {
        return $query->where('status_id', '<', 4);
    }

    public function scopeStatusSuccess(Builder $query): Builder
    {
        return $query->where('status_id', '>', 3)
            ->where('status_id', '<', 100);
    }

    public function scopeStatusFailed(Builder $query): Builder
    {
        return $query->where('status_id', '>=', 100);
    }

    public function scopeStatusNew(Builder $query): Builder
    {
        return $query->where('status_id', 0);
    }

    public function scopeWhereUser(Builder $query, User $user): Builder
    {
        if ($user->isPartner()) {
            return $query->wherePartner($user->id);
        }

        return $query->whereCustomer($user->id);
    }

    public static function getCounterByUser(User $user): array
    {
        $query = Project::when(
            $user->isPartner(),
            fn ($q) => $q->wherePartner($user->id),
            fn ($q) => $q->whereCustomer($user->id),
        );

        return [
            'total' => $query->count(),
            'ongoing' => $query->statusOngoing()->count(),
            'success' => $query->statusSuccess()->count(),
            'failed' => $query->statusFailed()->count(),
        ];
    }
}
