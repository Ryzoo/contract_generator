<?php


namespace App\Models\Domain\Blocks;

use App\Enums\BlockType;
use App\Helpers\Validator;
use Illuminate\Support\Collection;

class TextBlock extends Block {

    public function __construct() {
        $this->initialize(BlockType::TEXT_BLOCK);
    }

    protected function buildSettings() {
        // TODO: Implement buildSettings() method.
    }

    protected function buildContent() {
        // TODO: Implement buildContent() method.
    }

    protected function validateContent(): bool {
        Validator::validate($this->content,[
            "text" => "nullable|string",
        ]);

        return true;
    }

    public function findVariable(Collection $variableArray): Collection{
        $variableArray = parent::findVariable($variableArray);

        foreach ($this->content as $element){
            preg_match_all('/{(\d)}/', $this->content["text"], $output_array);

            if(isset($output_array[1] ) && is_array($output_array[1] ))
                foreach ($output_array[1] as $arrayElement)
                    $variableArray->push([$this->id, $arrayElement]);
        }

        return $variableArray->uniqueStrict("1");
    }
}
