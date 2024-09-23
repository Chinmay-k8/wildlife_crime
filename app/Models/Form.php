<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table = 'crime_form10'; // Name of your form table
    
    // Fillable properties to allow mass assignment
    protected $guarded = [];

    public function circle()
    {
        return $this->belongsTo(Circle::class, 'circle', 'id');
    }

    // Custom relationship for Division
    public function division()
    {
        return $this->belongsTo(Division::class, 'division', 'id');
    }

    // Custom relationship for Range
    public function range()
    {
        return $this->belongsTo(Range::class, 'range', 'id');
    }

    // Custom relationship for Section
    public function section()
    {
        return $this->belongsTo(Section::class, 'section', 'id');
    }

    // Custom relationship for Beat
    public function beat()
    {
        return $this->belongsTo(Beat::class, 'beat', 'id');
    }

    // Custom relationship for Forestblock
    public function forestblock()
    {
        return $this->belongsTo(Forestblock::class, 'detection_place', 'id');
    }
    public function species()
    {
        return $this->belongsTo(MasterSpecies::class, 'species_name', 'id');
    }
    // Relationship with Accused model
    public function accused()
    {
        return $this->hasMany(Accused::class, 'form_data_id');
    }

    // Relationship with ArrestedAccused model
    public function arrestedAccused()
    {
        return $this->hasMany(ArrestedAccused::class, 'form_data_id');
    }
    public function nbwAccused()
    {
        return $this->hasMany(NbwAccused::class, 'form_data_id');
    }
    public function releasedAccused()
    {
        return $this->hasMany(ReleasedAccused::class, 'form_data_id');

    }
    public function accusedMobiles()
    {
        return $this->hasMany(AccusedMobiles::class, 'form_data_id');
    }
    public function uploads()
    {
        return $this->hasMany(Uploads::class, 'form_data_id');
    }
    public function additionalpr()
    {
        return $this->hasMany(AdditionalPr::class, 'form_data_id');
    }
    public function abscondedAccused()
    {
        return $this->hasMany(AbscondedAccused::class, 'form_data_id');
    }
    // Dynamic save method
    public function saveFormData($data)
    {
         // Fill the form model with the incoming data
         $this->fill($data);

         // Save the form data to the database
         $this->save(); // Ensure that the form is saved here
 
         // The $this->id will now hold the ID of the newly inserted record
         return $this->id;
    }
}
