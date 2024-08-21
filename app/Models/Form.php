<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table = 'form_data'; // Name of your form table
    
    // Fillable properties to allow mass assignment
    protected $guarded = [];

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
