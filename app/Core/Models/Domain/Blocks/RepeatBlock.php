<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Helpers\AttributeResolver;
use App\Core\Helpers\BlockCounterResolver;
use App\Core\Helpers\PdfRenderer;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\Attributes\Attribute;
use App\Core\Models\Domain\FormElements\AttributeFormElement;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class RepeatBlock extends Block
{
    private ?Attribute $repeatAttribute;
    private Contract $contract;
    private int $conditionalType;

    public function __construct()
    {
        $this->initialize(BlockType::REPEAT_BLOCK);
    }

    protected function buildSettings(): void
    {
        $this->settings = [
            'repeatAttributeId' => NULL,
            'separator' => '',
        ];
    }

    protected function validateContent(): bool
    {
        Validator::validate($this->content, [
            'blocks' => 'sometimes|array',
        ]);

        return true;
    }

    protected function buildContent(): void
    {
        $this->content['blocks'] = Block::getListFromString(json_encode($this->content['blocks'], JSON_THROW_ON_ERROR, 512));
    }

    public function validateConditions(int $conditionalType, Collection $formElements, Contract $contract, int $index = 0): bool
    {
        $parentActive = parent::validateConditions($conditionalType, $formElements, $contract, $index);

        $this->conditionalType = $conditionalType;
        $this->formElements = $formElements;
        $this->contract = $contract;

        return $parentActive;
    }

    public function findVariable(Contract $contract): Collection
    {
        $variableArray = parent::findVariable($contract);

        if (isset($this->settings['repeatAttributeId'])) {
            $variableArray->push([$this->id, $this->settings['repeatAttributeId']]);
        }

        /** @var Block $block */
        foreach ($this->content['blocks'] as $block) {
            $variableArray = $variableArray->merge($block->findVariable($contract));
        }

        return $variableArray;
    }

    public function counterResolve(string $matchString, int $countStart, Contract $contract): int
    {
        $countStart = parent::counterResolve($matchString, $countStart, $contract);
        return BlockCounterResolver::resolve($matchString, collect($this->content['blocks']), $contract, $countStart)['count'];
    }

    public function getBlockCollection(Collection $blockCollection): Collection
    {
        $blockCollection = parent::getBlockCollection($blockCollection);

        /** @var Block $block */
        foreach ($this->content['blocks'] as $block) {
            $blockCollection = $block->getBlockCollection($blockCollection);
        }

        return $blockCollection;
    }

    protected function resolveAttributesInContent(Collection $formElements, Attribute $repeatAttribute = null, $repeatValue = null): void
    {
        $attributeResolver = new AttributeResolver($formElements);
        $this->repeatAttribute = $attributeResolver->getAttributeById($this->settings['repeatAttributeId'] ?? -1);

        $blockList = $this->content['blocks'];

        /** @var Block $block */
        foreach ($blockList as $block) {
            $block->resolveAttributesInContent($formElements, $repeatAttribute, $repeatValue);
        }
    }

    public function renderToHtml(Collection $attributes, Attribute $repeatAttribute = null, $repeatValue = null): string
    {
        $htmlString = parent::renderToHtml($attributes, $repeatAttribute, $repeatValue);
        return $this->repeatContent($htmlString, $attributes);
    }


    public function renderToHtmlArray(Collection $attributes, Attribute $repeatAttribute = null, $repeatValue = null)
    {
        $htmlString = parent::renderToHtml($attributes, $repeatAttribute, $repeatValue);
        return $this->repeatContentAsArray($htmlString, $attributes);
    }


    private function repeatContent(string $htmlString, $attributes): string
    {
        $elements = $this->repeatContentAsArray($htmlString, $attributes);

        foreach ($elements as $key => $value) {
            $htmlString .= $value;
            if (count($elements) > ($key + 1)) {
                $htmlString .= $this->getSeparator();
            }
        }

        return $htmlString;
    }

    private function repeatContentAsArray(string $htmlString, $attributes)
    {
        $elements = [];

        foreach (collect($this->repeatAttribute->getValueAsArray())->reverse() as $key => $value) {
            $this->validateConditions($this->conditionalType, $this->formElements, $this->contract, $key);

            if ($this->isActive) {
                /** @var Block $block */
                foreach ($this->content['blocks'] as $block) {
                    $tempChild = clone $block;
                    $tempChild->validateConditions($this->conditionalType, $this->formElements, $this->contract, $key);

                    if ($tempChild->isActive) {
                        $tempChild->resolveAttributesInContent($this->formElements, $this->repeatAttribute, $value);
                        $elements[] = PdfRenderer::blockHtmlTemplate($tempChild->renderToHtml($attributes));
                    }
                }
            }
        }

        return $elements;
    }

    private function isSeparator(): bool
    {
        return isset($this->settings['separator']) && $this->settings['separator'] !== '';
    }

    private function getSeparator(): string
    {
        if (!$this->isSeparator()) {
            return '';
        }
        $separator = $this->settings['separator'];
        return "<p>$separator</p>";
    }

    public function getFormElements(Contract $contract): Collection
    {
        $elementCollection = collect();

        $elementCollection->push(new AttributeFormElement($this->parentId, $contract->getAttributeByID($this->settings['repeatAttributeId'])));

        return $elementCollection;
    }
}
