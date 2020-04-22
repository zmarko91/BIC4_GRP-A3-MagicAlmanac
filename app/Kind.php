<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Carbon;

/**
 * Class Kind
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Kind newModelQuery()
 * @method static Builder|Kind newQuery()
 * @method static Builder|Kind query()
 * @method static Builder|Kind whereCreatedAt($value)
 * @method static Builder|Kind whereId($value)
 * @method static Builder|Kind whereName($value)
 * @method static Builder|Kind whereSlug($value)
 * @method static Builder|Kind whereDescription($value)
 * @method static Builder|Kind whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Collection|Spell[] $spells
 */
class Kind extends BaseModel
{
    public function spells()
    {
        return $this->hasMany(Spell::class);
    }
}
