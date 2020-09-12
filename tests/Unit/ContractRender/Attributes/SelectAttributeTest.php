<?php

namespace Tests\Unit\ContractRender\Attributes;

use App\Core\Enums\AttributeType;
use App\Core\Enums\BlockType;
use App\Core\Enums\ConditionalType;
use App\Core\Enums\MultiUseRenderType;
use App\Core\Helpers\Parsers\OperatorType;
use App\Core\Helpers\Parsers\RuleTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SelectAttributeTest extends TestCase
{
	use RefreshDatabase;

	private function assertConditionalMultiSelect(array $text, string $conditionals)
	{
		$html = $this->builder()
			->buildBlock(BlockType::TEXT_BLOCK, [
				'content' => [
					'text' => 'test content',
				],
				'conditionals' => [
					[
						'conditionalName' => 'SHOW_ON',
						'conditionalType' => ConditionalType::SHOW_ON,
						'content' => $conditionals,
					],
				],
			])
			->buildAttribute(AttributeType::SELECT, [
				'id' => 1,
				'value' => implode('|,', $text),
				'settings' => [
					'isInline' => FALSE,
					'isMultiUse' => FALSE,
					'isMultiSelect' => TRUE,
					'allowSelfOptions' => FALSE,
					'items' => [],
					'required' => FALSE,
					'lengthMin' => NULL,
					'lengthMax' => NULL,
					'multiUseRenderType' => MultiUseRenderType::COMMA_SEPARATED,
					'listRenderType' => MultiUseRenderType::COMMA_SEPARATED,
				],
			])
			->getHTML();

		$testText = 'test content';
		$this->assertStringContainsString($testText, $html);
	}

	private function assertConditionalSingleSelect(string $text, string $conditionals)
	{
		$html = $this->builder()
			->buildBlock(BlockType::TEXT_BLOCK, [
				'content' => [
					'text' => 'test content',
				],
				'conditionals' => [
					[
						'conditionalName' => 'SHOW_ON',
						'conditionalType' => ConditionalType::SHOW_ON,
						'content' => $conditionals,
					],
				],
			])
			->buildAttribute(AttributeType::SELECT, [
				'id' => 1,
				'value' => $text,
				'settings' => [
					'isInline' => FALSE,
					'isMultiUse' => FALSE,
					'isMultiSelect' => FALSE,
					'allowSelfOptions' => FALSE,
					'items' => [],
					'required' => FALSE,
					'lengthMin' => NULL,
					'lengthMax' => NULL,
					'multiUseRenderType' => MultiUseRenderType::COMMA_SEPARATED,
					'listRenderType' => MultiUseRenderType::COMMA_SEPARATED,
				],
			])
			->getHTML();

		$testText = 'test content';
		$this->assertStringContainsString($testText, $html);
	}

	public function testConditionalSingle(): void
	{
		$singleValue = 'test case';
		$this->assertConditionalSingleSelect('test case', $this->conditionals()
			->buildRule('1', OperatorType::EQUAL, $singleValue, RuleTypes::SELECT)
			->buildRule('1', OperatorType::BEGINS_WITH, 'test', RuleTypes::SELECT)
			->buildRule('1', OperatorType::CONTAINS, 'ca', RuleTypes::SELECT)
			->buildRule('1', OperatorType::ENDS_WITH, 'case', RuleTypes::SELECT)
			->buildRule('1', OperatorType::N_CONTAINS, 'test1', RuleTypes::SELECT)
			->buildRule('1', OperatorType::N_EMPTY, 0, RuleTypes::SELECT)
			->buildRule('1', OperatorType::N_EQUAL, 'test case 2', RuleTypes::SELECT)
			->encode());
	}

	public function testConditionalMulti(): void
	{
		$multiValue = ['test case', 'test case 2', 'test case 3'];
		$this->assertConditionalMultiSelect($multiValue, $this->conditionals()
			->buildRule('1', OperatorType::EQUAL, $multiValue, RuleTypes::MULTI_SELECT)
			->buildRule('1', OperatorType::CONTAINS, ['test case 2'], RuleTypes::MULTI_SELECT)
			->buildRule('1', OperatorType::N_CONTAINS, ['test case 4'], RuleTypes::MULTI_SELECT)
			->buildRule('1', OperatorType::N_EMPTY, 0, RuleTypes::MULTI_SELECT)
			->buildRule('1', OperatorType::N_EQUAL, ['test case', 'test case 2', 'test case 3', 'test'], RuleTypes::MULTI_SELECT)
			->encode());
	}

	public function testConditionalMulti_forEmpty(): void
	{
		$multiValue = [];
		$this->assertConditionalMultiSelect($multiValue, $this->conditionals()
			->buildRule('1', OperatorType::EMPTY, 0, RuleTypes::MULTI_SELECT)
			->encode());
	}
}
