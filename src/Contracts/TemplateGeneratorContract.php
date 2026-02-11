<?php

namespace TemplateGenerator\Contracts;

interface TemplateGeneratorContract
{
    /**
     * Generate a PDF for a template with entity ids keyed by model FQCN.
     *
     * @param int $templateId
     * @param array $entities Example: ["App\\Models\\Client" => 5]
     * @return string PDF binary data.
     */
    public function generatePdf(int $templateId, array $entities = []): string;
}
