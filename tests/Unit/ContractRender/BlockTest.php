<?php

namespace Tests\Unit\ContractRender;

use App\Core\Enums\AttributeType;
use App\Core\Enums\BlockType;
use App\Core\Enums\EnumeratorListType;
use App\Core\Enums\MultiUseRenderType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlockTest extends TestCase {
  use RefreshDatabase;

  public function testPageDivideBlock(): void {
    $testText = '<div class="page-break"></div>';
    $html = $this->builder()
      ->buildBlock(BlockType::PAGE_DIVIDE_BLOCK, [
        'settings' => ['isBreaker' => true]
      ])
      ->getHTML();

    $this->assertStringContainsString($testText, $html);
  }

  public function testListBlock(): void {
    $html = $this->builder()
      ->buildBlock(BlockType::LIST_BLOCK, [
        'content' => [ 'blocks' => [] ],
        'settings' => [ 'enumeratorType' => EnumeratorListType::DOT ]
      ])
      ->buildBlock(BlockType::LIST_BLOCK, [
        'content' => [ 'blocks' => [] ],
        'settings' => [ 'enumeratorType' => EnumeratorListType::LOVER_ALPHA ]
      ])
      ->buildBlock(BlockType::LIST_BLOCK, [
        'content' => [ 'blocks' => [] ],
        'settings' => [ 'enumeratorType' => EnumeratorListType::UPPER_ROMAN ]
      ])
      ->buildBlock(BlockType::LIST_BLOCK, [
        'content' => [ 'blocks' => [] ],
        'settings' => [ 'enumeratorType' => EnumeratorListType::DECIMAL ]
      ])
      ->getHTML();

    $testText = '<ul style="list-style-type: disc;">';
    $this->assertStringContainsString($testText, $html);

    $testText = '<ol style="list-style-type: lower-alpha;">';
    $this->assertStringContainsString($testText, $html);

    $testText = '<ol style="list-style-type: upper-roman;">';
    $this->assertStringContainsString($testText, $html);

    $testText = '<ol style="list-style-type: decimal;">';
    $this->assertStringContainsString($testText, $html);
  }

  public function testAttributeWithValueBlock(): void {
    $html = $this->builder()
      ->buildBlock(BlockType::REPEAT_BLOCK, [
        'settings' => [ 'repeatAttributeId' => 1, 'separator' => 'i' ],
        'content' => [
          'blocks' => $this->builder()
            ->buildBlock(BlockType::TEXT_BLOCK, ['content' => ['text' => 'hello {1:value} world']])
            ->getBlocks()
        ]
      ])
      ->buildAttribute(AttributeType::ATTRIBUTE_GROUP, [
        'id' => 1,
        'value' => ['test', 'testv2'],
        'settings' => [
          'isMultiUse' => true,
          'multiUseRenderType' => MultiUseRenderType::COMMA_SEPARATED
        ]
      ])
      ->getHTML();

    $testText = 'hello test world';
    $this->assertStringContainsString($testText, $html);

    $testText = 'hello testv2 world';
    $this->assertStringContainsString($testText, $html);
  }

  public function testAttributeWithArrayBlock(): void {
    $attributesList = $this->builder()
      ->buildAttribute(AttributeType::TEXT, [
        'id' => 2,
        'value' => 'test',
      ])
      ->buildAttribute(AttributeType::TEXT, [
        'id' => 3,
        'value' => 'testv2',
      ])
      ->getAttributes();

    $html = $this->builder()
      ->buildBlock(BlockType::REPEAT_BLOCK, [
        'settings' => [ 'repeatAttributeId' => 1, 'separator' => 'i' ],
        'content' => [
          'blocks' => $this->builder()
            ->buildBlock(BlockType::TEXT_BLOCK, ['content' => ['text' => 'hello {1:2} world + hello {1:3} world']])
            ->getBlocks()
        ]
      ])
      ->buildAttribute(AttributeType::ATTRIBUTE_GROUP, [
        'id' => 1,
        'value' => [$attributesList],
        'content' => $attributesList,
        'settings' => [
          'isMultiUse' => true,
          'multiUseRenderType' => MultiUseRenderType::COMMA_SEPARATED
        ]
      ])
      ->getHTML();

    $testText = 'hello test world';
    $this->assertStringContainsString($testText, $html);

    $testText = 'hello testv2 world';
    $this->assertStringContainsString($testText, $html);
  }
}
