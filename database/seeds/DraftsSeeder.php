<?php

use App\Core\Models\Database\VariableDraft;
use Illuminate\Database\Seeder;

class DraftsSeeder extends Seeder
{
    public function run()
    {
        VariableDraft::create([
          'name' => 'Umowa prosta',
          'description' => 'Zmienne domyślnie istniejące w każdej umowie. Np. data podpisania umowy',
          'category' => 'Umowa Podstawy',
          'content' => '[{"attributeName":"DataPodpisania","id":1,"attributeType":4,"defaultValue":"","additionalInformation":"","placeholder":"","description":"Data podpisania umowy","toAnonymize":"","isMultiUse":false,"isInline":false,"multiUseRenderType":null,"settings":{"isInline":false,"isMultiUse":false,"valueMin":null,"valueMax":null,"required":true,"multiUseRenderType":2}},{"attributeName":"MiejscePodpisania","id":2,"attributeType":1,"defaultValue":"","additionalInformation":"","placeholder":"","description":"Miejsce podpisania umowy","toAnonymize":"","isMultiUse":false,"isInline":false,"multiUseRenderType":null,"settings":{"isInline":false,"isMultiUse":false,"lengthMin":null,"lengthMax":null,"required":true,"multiUseRenderType":2}}]',
        ]);
    }
}
