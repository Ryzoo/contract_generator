<?php


namespace App\Services\Domain;


use App\Contracts\Domain\IBlock;
use App\Enums\BlockType;
use App\Models\Domain\Blocks\EmptyBlock;
use App\Models\Domain\Blocks\PageDivideBlock;
use App\Models\Domain\Blocks\TextBlock;
use Intervention\Image\Exception\NotFoundException;

class BlockService {

    public function getListOfBlocks():array {
        $blockList = array();
        $blockTypeList = BlockType::getList();

        foreach($blockTypeList as $value){
            array_push($blockList,$this->getBlockByType($value));
        }

        return $blockList;
    }

    public function getBlockByType(int $blockType):IBlock {
        switch ($blockType)
        {
            case BlockType::TEXT_BLOCK:
                return new TextBlock();
            case BlockType::EMPTY_BLOCK:
                return new EmptyBlock();
            case BlockType::PAGE_DIVIDE_BLOCK:
                return new PageDivideBlock();
        }

        throw new NotFoundException("Block {$blockType} was not found");
    }

}
