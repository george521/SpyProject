<?php

namespace App\Models;

use App\Domain\ValueObjects\Agency;
use App\Domain\ValueObjects\DateChecker;
use App\Domain\ValueObjects\Name;
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
        $name = new Name($data['name'], $data['surname']);

        // Validate Agency
        $agency = new Agency($data['agency']);

        //Vallidate dates
        $date_of_birth = new DateChecker( $data['date_of_birth']);
        $date_of_death = new DateChecker( $data['date_of_death']);

        // Ensure uniqueness by name and surname
        if (self::where('name', $data['name'])->where('surname', $data['surname'])->exists()) {
            throw new \InvalidArgumentException('Spy with the same name and surname already exists.');
        }

        // Create the spy
        $spy = self::create([
            'name' => $name->getName(),
            'surname' => $name->getSurname(),
            'agency' => $agency->getAgency(),
            'date_of_birth' => $date_of_birth->datechecker,
            'date_of_death' => $date_of_death->datechecker,
            'country_of_operation' => $data['country_of_operation']
        ]);

        // Trigger the SpyCreated event
        event(new SpyCreated($spy));

        return $spy;
    }
}
