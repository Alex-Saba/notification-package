<?php

namespace TemplateGenerator\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use TemplateGenerator\Contracts\TemplateGeneratorContract;
use TemplateGenerator\Models\Template;
use TemplateGenerator\Models\TemplateVariable;
use InvalidArgumentException;

class TemplateGenerator implements TemplateGeneratorContract
{
    public function generatePdf(int $templateId, array $entities = []): string
    {
        if (!is_array($entities)) {
            throw new InvalidArgumentException('Entities must be an array keyed by model class.');
        }

        /** @var Template $template */
        $template = Template::findOrFail($templateId);

        $variables = TemplateVariable::all();
        $replaceMap = [];
        $entitiesCache = [];

        foreach ($variables as $variable) {
            $modelClass = $variable->model;

            if (!class_exists($modelClass)) {
                $replaceMap['{{' . $variable->key . '}}'] = '';
                continue;
            }

            $idForModel = $entities[$modelClass] ?? null;

            if ($idForModel === null) {
                $replaceMap['{{' . $variable->key . '}}'] = '';
                continue;
            }

            if (!array_key_exists($modelClass, $entitiesCache)) {
                $entitiesCache[$modelClass] = $modelClass::find($idForModel);
            }

            $entity = $entitiesCache[$modelClass] ?? null;

            $replaceMap['{{' . $variable->key . '}}'] =
                $entity && isset($entity->{$variable->column})
                ? $entity->{$variable->column}
                : '';
        }

        $generatedContent = strtr($template->content ?? '', $replaceMap);

        $pdf = Pdf::loadHTML($generatedContent);

        return $pdf->output();
    }
}
