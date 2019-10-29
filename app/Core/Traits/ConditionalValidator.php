<?php


namespace App\Core\Traits;


use App\Core\Enums\ElementType;
use App\Core\Models\Domain\FormElements\AttributeFormElement;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait ConditionalValidator {

    /** @var \Illuminate\Support\Collection */
    private $conditionalList;

    /** @var \Illuminate\Support\Collection */
    private $formElements;

    public function validateConditions(int $conditionalType, Collection $formElements): bool {
        if (!isset($this->conditionals)) {
            throw new \ErrorException("Conditional validator implemented in class without conditionals field");
        }

        $this->formElements = $formElements;
        $this->conditionalList = collect(collect($this->conditionals)
            ->where("conditionalType", $conditionalType)
            ->all());

        $self = $this;
        return $this->conditionalList
            ->every(function($element)use($self){
                return $self->isConditionalValidAndEqual(collect($element->content), true);
            });
    }

    private function isConditionalValidAndEqual(Collection $content, bool $equalValue): bool {
        if ($this->conditionalList->count() == 0) {
            return !$equalValue;
        }

        return $this->parseConditionalStringToBool($content) === $equalValue;
    }

    private function parseConditionalStringToBool(Collection $content) {
        $self = $this;
        $contentWithVariables = $content->map(function ($textElements) use($self){
            if (strlen($textElements) >= 3 && $textElements[0] === "{" && $textElements[strlen($textElements) - 1] === "}") {
                $varId = intval(Str::substr($textElements, 1, strlen($textElements) - 2));
                return $self->getVariableValue($varId);
            }
            return $textElements;
        })
        ->all();

        return eval("return ".implode(" ", $contentWithVariables).";");
    }

    private function getVariableValue(int $varId) {
        $allAttributes = $this->formElements
            ->where("elementType", ElementType::ATTRIBUTE)
            ->map(function (AttributeFormElement $e) {
                return $e->attribute;
            })
            ->all();

        $findedAttribute = collect($allAttributes)
            ->where("id",$varId)
            ->first();

        if (!isset($findedAttribute)) {
            throw new \ErrorException(`Var: {$varId} not found`);
        }

        return $findedAttribute->getValue();
    }
}
