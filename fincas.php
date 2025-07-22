<?php
// database/migrations/consolidated_migration.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropietariosAndFincasTables extends Migration
{
    public function up()
    {
        // Tabla propietarios
        Schema::create('propietarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellidos', 100);
            $table->string('email')->unique();
            $table->string('telefono', 20)->nullable();
            $table->timestamps();
            $table->index('email');
        });

        // Tabla fincas
        Schema::create('fincas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->string('codigo_postal', 10);
            $table->string('ciudad', 100);
            $table->string('provincia', 100);
            $table->foreignId('propietario_id')->nullable()->constrained('propietarios')->onDelete('set null');
            $table->timestamps();
            $table->index(['nombre', 'ciudad']);
            $table->index('propietario_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fincas');
        Schema::dropIfExists('propietarios');
    }
}

// app/Models/ConsolidatedModels.php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Propietario extends Model
{
    protected $fillable = ['nombre', 'apellidos', 'email', 'telefono'];

    public function fincas(): HasMany
    {
        return $this->hasMany(Finca::class);
    }

    public static function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:propietarios,email',
            'telefono' => 'nullable|string|max:20',
        ];
    }

    public static function crear(array $data): self
    {
        return self::create($data);
    }

    public function actualizar(array $data): bool
    {
        return $this->update($data);
    }

    public static function listar(int $perPage = 10)
    {
        return self::query()->paginate($perPage);
    }

    public function eliminar(): ?bool
    {
        return $this->delete();
    }
}

class Finca extends Model
{
    protected $fillable = ['nombre', 'direccion', 'codigo_postal', 'ciudad', 'provincia', 'propietario_id'];

    public function propietario(): BelongsTo
    {
        return $this->belongsTo(Propietario::class);
    }

    public static function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
            'ciudad' => 'required|string|max:100',
            'provincia' => 'required|string|max:100',
            'propietario_id' => 'nullable|exists:propietarios,id',
        ];
    }

    public static function crear(array $data): self
    {
        return self::create($data);
    }

    public function actualizar(array $data): bool
    {
        return $this->update($data);
    }

    public static function listar(int $perPage = 10)
    {
        return self::with('propietario')->paginate($perPage);
    }

    public static function buscarPorId(int $id): ?self
    {
        return self::with('propietario')->find($id);
    }

    public function eliminar(): ?bool
    {
        return $this->delete();
    }
}

// app/Http/Controllers/ConsolidatedController.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class ConsolidatedController
{
    // Métodos para Propietarios
    public function listarPropietarios(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        return response()->json(Propietario::listar($perPage));
    }

    public function crearPropietario(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), Propietario::rules());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        return response()->json(Propietario::crear($request->all()), 201);
    }

    // Métodos para Fincas
    public function listarFincas(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        return response()->json(Finca::listar($perPage));
    }

    public function crearFinca(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), Finca::rules());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        return response()->json(Finca::crear($request->all()), 201);
    }

    // ... otros métodos CRUD similares
}

// Uso básico (ejemplo)
/*
// Migración
$migration = new CreatePropietariosAndFincasTables();
$migration->up();

// Controlador
$controller = new ConsolidatedController();

// Crear propietario
$request = new Request([
    'nombre' => 'Juan',
    'apellidos' => 'Pérez',
    'email' => 'juan@example.com'
]);
$response = $controller->crearPropietario($request);
*/
?>