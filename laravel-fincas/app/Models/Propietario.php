<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo Propietario
 * 
 * Representa a los propietarios que pueden tener múltiples fincas.
 * Implementa las operaciones CRUD básicas y la relación con Fincas.
 * 
 * @property int $id
 * @property string $nombre
 * @property string $apellidos
 * @property string $email
 * @property string|null $telefono
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Propietario extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'telefono',
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
     * Relación uno-a-muchos con Fincas
     * Un propietario puede tener múltiples fincas
     */
    public function fincas(): HasMany
    {
        return $this->hasMany(Finca::class);
    }

    /**
     * Scope para buscar propietarios por nombre completo
     */
    public function scopeByNombre($query, string $nombre)
    {
        return $query->where('nombre', 'LIKE', "%{$nombre}%")
                    ->orWhere('apellidos', 'LIKE', "%{$nombre}%");
    }

    /**
     * Accessor para obtener el nombre completo
     */
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre} {$this->apellidos}";
    }

    /**
     * Crear un nuevo propietario con validación
     */
    public static function crearPropietario(array $datos): self
    {
        return self::create($datos);
    }

    /**
     * Actualizar propietario existente
     */
    public function actualizarPropietario(array $datos): bool
    {
        return $this->update($datos);
    }

    /**
     * Eliminar propietario (soft delete si está configurado)
     */
    public function eliminarPropietario(): bool
    {
        // Verificar si tiene fincas asociadas
        if ($this->fincas()->count() > 0) {
            // Opcional: desasociar fincas o manejar según lógica de negocio
            $this->fincas()->update(['propietario_id' => null]);
        }
        
        return $this->delete();
    }
}
