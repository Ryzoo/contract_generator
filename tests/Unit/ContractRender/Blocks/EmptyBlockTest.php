<?php

namespace Tests\Unit\ContractRender\Blocks;

use App\Core\Enums\BlockType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmptyBlockTest extends TestCase {

  use RefreshDatabase;

  public function testOneLevelTextElements(): void {
    $testText = 'hello world';
    $testTextV2 = 'hello world v2';
    $html = $this->builder()
      ->buildBlock(BlockType::EMPTY_BLOCK, [
        'content' => [
          'blocks' => $this->builder()
            ->buildBlock(BlockType::TEXT_BLOCK, [
              'content' => ['text' => $testText],
            ])
            ->buildBlock(BlockType::TEXT_BLOCK, [
              'content' => ['text' => $testTextV2],
            ])
            ->getBlocks(),
        ],
      ])
      ->getHTML();

    $this->assertStringContainsString($testText, $html);
    $this->assertStringContainsString($testTextV2, $html);
  }

  public function testNestedLevelTextElements(): void {
    $testText = 'hello world';
    $testTextV2 = 'hello world v2';

    $finalTextBlocks = $this->builder()
      ->buildBlock(BlockType::TEXT_BLOCK, [
        'content' => ['text' => $testText],
      ])
      ->buildBlock(BlockType::TEXT_BLOCK, [
        'content' => ['text' => $testTextV2],
      ])
      ->getBlocks();

    $html = $this->builder()
      ->buildBlock(BlockType::EMPTY_BLOCK, [
        'content' => [
          'blocks' => $this->builder()
            ->buildBlock(BlockType::EMPTY_BLOCK, [
              'content' => [
                'blocks' => $this->builder()
                  ->buildBlock(BlockType::EMPTY_BLOCK, [
                    'content' => [
                      'blocks' => $finalTextBlocks,
                    ],
                  ])
                  ->getBlocks()
              ],
            ])
            ->getBlocks(),
        ],
      ])
      ->getHTML();

    $this->assertStringContainsString($testText, $html);
    $this->assertStringContainsString($testTextV2, $html);
  }
}
