<?php


namespace App\Repository\Domain;


use App\Enums\BlockType;
use App\Models\Domain\Blocks\Block;

class BlockRepository {

    public function getListOfBlocks():array {
        $blockList = array();
        $blockTypeList = BlockType::getList();

        foreach($blockTypeList as $value){
            array_push($blockList, Block::getBlockByType($value));
        }

        return $blockList;
    }
}
