<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Carbon;


/**
 * Class Spell
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property string $quote
 * @property int $kind_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Spell newModelQuery()
 * @method static Builder|Spell newQuery()
 * @method static Builder|Spell query()
 * @method static Builder|Spell whereCreatedAt($value)
 * @method static Builder|Spell whereId($value)
 * @method static Builder|Spell whereName($value)
 * @method static Builder|Spell whereSlug($value)
 * @method static Builder|Spell whereDescription($value)
 * @method static Builder|Spell whereDomainId($value)
 * @method static Builder|Spell whereUpdatedAt($value)
 * @method static Builder|Spell whereQuote($value)
 * @mixin Eloquent
 * @property-read Kind $kind
 */
class Spell extends BaseModel
{
    public function kind()
    {
        return $this->belongsTo(Kind::class);
    }
}
