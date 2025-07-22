<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Finca
 * 
 * Representa las fincas que pueden pertenecer a un propietario.
 * Implementa las operaciones CRUD básicas y la relación con Propietarios.
 * 
 * @property int $id
 * @property string $nombre
 * @property string $direccion
 * @property string $codigo_postal
 * @property string $ciudad
 * @property string $provincia
 * @property int|null $propietario_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Finca extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'direccion',
        'codigo_postal',
        'ciudad',
        'provincia',
        'propietario_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación muchos-a-uno con Propietario
     * Una finca pertenece a un propietario (opcional)
     */
    public function propietario(): BelongsTo
    {
        return $this->belongsTo(Propietario::class);
    }

    /**
     * Scope para filtrar fincas por ciudad
     */
    public function scopeByCiudad($query, string $ciudad)
    {
        return $query->where('ciudad', 'LIKE', "%{$ciudad}%");
    }

    /**
     * Scope para filtrar fincas por provincia
     */
    public function scopeByProvincia($query, string $provincia)
    {
        return $query->where('provincia', 'LIKE', "%{$provincia}%");
    }

    /**
     * Scope para fincas sin propietario
     */
    public function scopeSinPropietario($query)
    {
        return $query->whereNull('propietario_id');
    }

    /**
     * Accessor para obtener la dirección completa
     */
    public function getDireccionCompletaAttribute(): string
    {
        return "{$this->direccion}, {$this->codigo_postal} {$this->ciudad}, {$this->provincia}";
    }

    /**
     * Crear una nueva finca con validación
     */
    public static function crearFinca(array $datos): self
    {
        return self::create($datos);
    }

    /**
     * Actualizar finca existente
     */
    public function actualizarFinca(array $datos): bool
    {
        return $this->update($datos);
    }

    /**
     * Asignar propietario a la finca
     */
    public function asignarPropietario(int $propietarioId): bool
    {
        return $this->update(['propietario_id' => $propietarioId]);
    }

    /**
     * Desasignar propietario de la finca
     */
    public function desasignarPropietario(): bool
    {
        return $this->update(['propietario_id' => null]);
    }
}
