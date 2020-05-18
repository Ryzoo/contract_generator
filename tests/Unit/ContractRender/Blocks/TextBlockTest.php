<?php

namespace Tests\Unit\ContractRender\Blocks;

use App\Core\Enums\BlockType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TextBlockTest extends TestCase {
  use RefreshDatabase;

  public function testTextRender(): void {
    $html = $this->builder()
      ->buildBlock(BlockType::TEXT_BLOCK, [
        'content' => [ 'text' => 'hello world' ]
      ])
      ->getHTML();

    $this->assertStringContainsString('hello world', $html);
  }

  public function testMultipleTextRender(): void {
    $html = $this->builder()
      ->buildBlock(BlockType::TEXT_BLOCK, [
        'content' => [ 'text' => 'hello world' ]
      ])
      ->buildBlock(BlockType::TEXT_BLOCK, [
        'content' => [ 'text' => 'hello world v2' ]
      ])
      ->getHTML();

    $this->assertStringContainsString('hello world', $html);
    $this->assertStringContainsString('hello world v2', $html);
  }
}
