<?php


namespace App\Core\Repository\Domain;


use App\Core\Enums\BlockType;
use App\Core\Models\Domain\Blocks\Block;

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
