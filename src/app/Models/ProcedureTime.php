<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProcedureTime
 *
 * @property int $id
 * @property int $business_id
 * @property int|null $procedure_id id процедуры
 * @property string $start Начало интервала
 * @property string $end Начало интервала
 * @property int $day Номер дня недели
 * @property int $day_off Выходной
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureTime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureTime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureTime query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureTime whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureTime whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureTime whereDayOff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureTime whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureTime whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureTime whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureTime whereStart($value)
 * @mixin \Eloquent
 */
class ProcedureTime extends Model
{
    public $fillable = [
        'id',
        'business_id',
        'procedure_id',
        'start',
        'end',
        'day',
        'day_off',
    ];

    public $timestamps = false;
}
