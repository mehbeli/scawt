<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScamDetail extends Model
{
    public static $rules = [
        'scammer_name' => 'required',
        'modus_operandi_or_scam_details' => 'required',
        'currency' => 'required_with:value-loss',
        'value_loss' => 'required_with:currency',
    ];

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'body.required' => 'A message is required',
        ];
    }

    public function scam()
    {
        $this->belongsTo(App\Scam::class);
    }

}
