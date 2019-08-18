<?php


namespace App\Services\Domain;


use App\Contracts\Domain\IBlock;
use App\Enums\BlockType;
use App\Models\Domain\Blocks\Block;
use App\Models\Domain\Blocks\EmptyBlock;
use App\Models\Domain\Blocks\PageDivideBlock;
use App\Models\Domain\Blocks\TextBlock;
use Intervention\Image\Exception\NotFoundException;

class BlockService {

    public function getListOfBlocks():array {
        $blockList = array();
        $blockTypeList = BlockType::getList();

        foreach($blockTypeList as $value){
            array_push($blockList, Block::getBlockByType($value));
        }

        return $blockList;
    }
}
