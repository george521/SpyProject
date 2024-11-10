<?php

namespace App\Models;

use App\Events\SpyCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spy extends Model
{
    use HasFactory;

    protected $table = 'spies';

    protected $fillable = ['name', 'surname', 'agency', 'date_of_birth', 'country_of_operation', 'date_of_death'];

    protected $guarded = ['id'];

    protected $dates = ['date_of_birth', 'date_of_death'];

    //validations and triggering domain events
    public static function createSpy(array $data)
    {
        // Validate spy creation
        if (empty($data['name']) || empty($data['surname']) || empty($data['date_of_birth'])) {
            throw new \InvalidArgumentException('Name, Surname, and Date of Birth are required.');
        }

        // Validate Agency
        $validAgencies = ['CIA', 'MI6', 'KGB'];
        if (!in_array($data['agency'], $validAgencies)) {
            throw new \InvalidArgumentException("Invalid agency: {$data['agency']}");
        }

        // Ensure uniqueness by name and surname
        if (self::where('name', $data['name'])->where('surname', $data['surname'])->exists()) {
            throw new \InvalidArgumentException('Spy with the same name and surname already exists.');
        }

        // Create the spy
        $spy = self::create($data);

        // Trigger the SpyCreated event
        event(new SpyCreated($spy));

        return $spy;
    }
}
