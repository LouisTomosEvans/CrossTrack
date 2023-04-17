<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\User;
use App\Models\Website;
use Spatie\Tags\HasTags;
use App\Constants\IndustrySectors;


class Segmentation extends Model
{
    use HasFactory;
    use HasTags;

    protected $fillable = [
        'website_id',
        'name',
        'criteria',
    ];

    protected $casts = [
        'criteria' => 'array',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'segmentation_user');
    }

    public function applyToQuery($query)
    {
        foreach ($this->criteria as $criterion) {
            $field = $criterion['category'];
            $operator = $criterion['logical_operator'];
            $value = $criterion['value'];
            $link = $criterion['link'] ?? 'and';

            // Apply the criteria to the query based on the logical operator
            $queryBuilder = function ($query) use ($field, $operator, $value) {
                switch ($operator) {
                    case 'gt':
                        $query->where($field, '>', $value);
                        break;
                    case 'lt':
                        $query->where($field, '<', $value);
                        break;
                    case 'gte':
                        $query->where($field, '>=', $value);
                        break;
                    case 'lte':
                        $query->where($field, '<=', $value);
                        break;
                    case 'like':
                        $query->where($field, 'LIKE', $value);
                        break;
                    case 'in':
                        $query->whereIn($field, $value);
                        break;
                    case 'between':
                        $query->whereBetween($field, $value);
                        break;
                    case 'equals':
                        $query->where($field, '=', $value);
                        break;
                    case 'not_equals':
                        $query->where($field, '!=', $value);
                        break;
                    default:
                        $query->where($field, $operator, $value);
                        break;
                }
                // if category is industry, we need to check the industry constants file for the value
                if ($field === 'industry') {
                    $sectors = IndustrySectors::SECTORS;

                    // find industry value in sectors nad get industries linked to it
                    $industries = [];
                    if ($sectors[$value]) {
                        $industries = $sectors[$value]['industries'];
                    }

                    // add all industries as orWhere to the query
                    foreach ($industries as $industry) {
                        $query->orWhere($field, 'LIKE', $industry);
                    }
                }
            };

            if ($link === 'or') {
                $query->orWhere($queryBuilder);
            } else {
                $query->where($queryBuilder);
            }
        }

        return $query;
    }
}
