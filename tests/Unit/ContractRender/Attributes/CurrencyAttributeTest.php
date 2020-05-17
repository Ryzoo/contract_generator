<?php

namespace Tests\Unit\ContractRender\Attributes;

use App\Core\Enums\AttributeType;
use App\Core\Enums\BlockType;
use App\Core\Enums\ConditionalType;
use App\Core\Helpers\Parsers\OperatorType;
use App\Core\Helpers\Parsers\RuleTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrencyAttributeTest extends TestCase {

  use RefreshDatabase;

  private function assertCurrencyFor(float $number, string $currency, string $words, $renderFloatAsText = false): void {
    $html = $this->builder()
      ->buildBlock(BlockType::TEXT_BLOCK, [
        'content' => [
          'text' => 'The currency type: {1:currency} and value {1:number}. In words: {1:words}',
        ],
      ])
      ->buildAttribute(AttributeType::CURRENCY, [
        'id' => 1,
        'value' => [
          'currency' => $currency,
          'number' => $number,
        ],
        'settings' => [
          'renderFloatAsText' => $renderFloatAsText
        ],
      ])
      ->getHTML();

    $this->assertStringContainsString('The currency type: ' . $currency . ' and value ' . $number . '. In words: ' . $words, $html);
  }

  private function assertConditional(float $number, string $conditionals){
    $html = $this->builder()
      ->buildBlock(BlockType::TEXT_BLOCK, [
        'content' => [
          'text' => 'test content',
        ],
        'conditionals' => [
          [
            'conditionalName' => 'SHOW_ON',
            'conditionalType' => ConditionalType::SHOW_ON,
            'content' => $conditionals
          ]
        ]
      ])
      ->buildAttribute(AttributeType::CURRENCY, [
        'id' => 1,
        'value' => [
          'currency' => 'PLN',
          'number' => $number,
        ]
      ])
      ->getHTML();

    $testText = 'test content';
    $this->assertStringContainsString($testText, $html);
  }

  public function testRenderAsText(): void {
    $currency = 'PLN';
    $this->assertCurrencyFor(1, $currency, 'jeden złoty');
    $this->assertCurrencyFor(2, $currency, 'dwa złote');
    $this->assertCurrencyFor(3, $currency, 'trzy złote');
    $this->assertCurrencyFor(4, $currency, 'cztery złote');
    $this->assertCurrencyFor(11, $currency, 'jedenaście złotych');
    $this->assertCurrencyFor(12, $currency, 'dwanaście złotych');
    $this->assertCurrencyFor(13, $currency, 'trzynaście złotych');
    $this->assertCurrencyFor(14, $currency, 'czternaście złotych');
    $this->assertCurrencyFor(22, $currency, 'dwadzieścia dwa złote');
    $this->assertCurrencyFor(22.35, $currency, 'dwadzieścia dwa złote 35/100');
    $this->assertCurrencyFor(22.35, $currency, 'dwadzieścia dwa złote trzydzieści pięć groszy', true);
    $this->assertCurrencyFor(101, $currency, 'sto jeden złotych');
    $this->assertCurrencyFor(102, $currency, 'sto dwa złote');
    $this->assertCurrencyFor(103, $currency, 'sto trzy złote');
    $this->assertCurrencyFor(104, $currency, 'sto cztery złote');
    $this->assertCurrencyFor(1001, $currency, 'jeden tysiąc jeden złotych');
    $this->assertCurrencyFor(1002, $currency, 'jeden tysiąc dwa złote');
    $this->assertCurrencyFor(1003, $currency, 'jeden tysiąc trzy złote');
    $this->assertCurrencyFor(1004, $currency, 'jeden tysiąc cztery złote');
    $this->assertCurrencyFor(3043, $currency, 'trzy tysiące czterdzieści trzy złote');
  }

  public function testConditional(): void{
    $this->assertConditional(1056810, $this->conditionals()
      ->buildRule('1:number', OperatorType::EQUAL, 1056810, RuleTypes::NUMBER)
      ->buildRule('1:number', OperatorType::BEGINS_WITH, 105, RuleTypes::NUMBER)
      ->buildRule('1:number', OperatorType::CONTAINS, 68, RuleTypes::NUMBER)
      ->buildRule('1:number', OperatorType::ENDS_WITH, 10, RuleTypes::NUMBER)
      ->buildRule('1:number', OperatorType::GREATER, 0, RuleTypes::NUMBER)
      ->buildRule('1:number', OperatorType::GREATER_OR_EQUAL, 1056810, RuleTypes::NUMBER)
      ->buildRule('1:number', OperatorType::N_CONTAINS, 111, RuleTypes::NUMBER)
      ->buildRule('1:number', OperatorType::N_EMPTY, 0, RuleTypes::NUMBER)
      ->buildRule('1:number', OperatorType::N_EQUAL, 1056811, RuleTypes::NUMBER)
      ->buildRule('1:number', OperatorType::SMALLER, 1056820, RuleTypes::NUMBER)
      ->buildRule('1:number', OperatorType::SMALLER_OR_EQUAL, 1056810, RuleTypes::NUMBER)
      ->encode());
  }
}
