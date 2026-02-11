<?php

namespace TemplateGenerator\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateVariable extends Model
{
    protected $table = 'template_variables';

    protected $fillable = [
        'key',
        'label',
        'default',
        'description',
        'model',
        'column',
    ];

    public function getValue($entityId)
    {
        if (!class_exists($this->model)) {
            return null;
        }

        $modelInstance = $this->model::find($entityId);
        return $modelInstance ? $modelInstance->{$this->column} : null;
    }
}
