<?php


namespace App\Core\Traits;


use App\Core\Enums\ElementType;
use App\Core\Helpers\Parsers\ModelObjectToTextParser;
use App\Core\Models\Domain\FormElements\AttributeFormElement;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait ConditionalValidator
{

    /** @var \Illuminate\Support\Collection */
    private $conditionalList;

    /** @var \Illuminate\Support\Collection */
    private $formElements;

    public function validateConditions(int $conditionalType, Collection $formElements): bool
    {
        if (!isset($this->conditionals)) {
            throw new \ErrorException("Conditional validator implemented in class without conditionals field");
        }

        $this->formElements = $formElements;

        $this->conditionalList = collect(collect($this->conditionals)
            ->where("conditionalType", $conditionalType)
            ->all());

        $self = $this;

        return $this->conditionalList
            ->every(function ($element) use ($self) {
                return $self->isConditionalValidAndEqual(ModelObjectToTextParser::parse(json_decode($element->content)), true);
            });
    }

    private function isConditionalValidAndEqual($content, bool $equalValue): bool
    {
        if (strlen($content) <= 0) {
            return $equalValue;
        }

        return $this->parseConditionalStringToBool($content) === $equalValue;
    }

    private function parseConditionalStringToBool($content)
    {
        $self = $this;

        $contentWithVariables = collect(explode(" ", $content))
            ->map(function ($textElements) use ($self) {
                preg_match('/{(\d+)}/', $textElements, $matches);
                if (isset($matches[1])) {
                    $var = $self->getVariableValue(intval($matches[1][0]));
                    $search = $matches[1][0];
                    return str_replace("{{$search}}", $var, $textElements);
                }
                return $textElements;
            })
            ->all();

        return eval("return " . implode(" ", $contentWithVariables) . ";");
    }

    private function getVariableValue(int $varId)
    {
        $allAttributes = $this->formElements
            ->where("elementType", ElementType::ATTRIBUTE)
            ->map(function (AttributeFormElement $e) {
                return $e->attribute;
            })
            ->all();

        $foundedAttribute = collect($allAttributes)
            ->where("id", $varId)
            ->first();

        if (!isset($foundedAttribute)) {
            throw new \ErrorException(`Var: {$varId} not found`);
        }

        return $foundedAttribute->getValue();
    }
}
