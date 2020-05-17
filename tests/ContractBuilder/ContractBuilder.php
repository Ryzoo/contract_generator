<?php

namespace Tests\ContractBuilder;

use App\Core\Models\Database\Contract;
use App\Core\Services\Contract\ContractService;
use App\Core\Services\Contract\FormService;
use Illuminate\Support\Collection;

class ContractBuilder {
  private ContractService $contractService;
  private FormService $formService;

  private Contract $contract;
  private Collection $contractBlocks;
  private Collection $contractAttributes;
  private Collection $formElements;

  public function __construct(ContractService $contractService, FormService $formService) {
    $this->contractService = $contractService;
    $this->formService = $formService;
    $this->contract = new Contract();
    $this->contractBlocks = collect();
    $this->contractAttributes = collect();
    $this->formElements = collect();
  }

  public function make():ContractBuilder {
    return new self($this->contractService, $this->formService);
  }

  public function buildBlock(int $type, array $options): ContractBuilder {
    $this->contractBlocks->push([
      'id' => $options['id'] ?? random_int(0, 10000),
      'parentId' => $options['parentId'] ?? 0,
      'blockType' => $type,
      'settings' => $options['settings'] ?? [],
      'conditionals' => $options['conditionals'] ?? [],
      'content' => $options['content'] ?? [],
    ]);
    return $this;
  }

  public function buildAttribute(int $type, array $options): ContractBuilder {
    $this->contractAttributes->push([
      'id' => $options['id'] ?? random_int(0, 10000),
      'parentId' => $options['parentId'] ?? 0,
      'attributeType' => $type,
      'settings' => $options['settings'] ?? [],
      'conditionals' => $options['conditionals'] ?? [],
      'content' => $options['content'] ?? [],
      'value' => $options['value'] ?? null,
      'isActive' => $options['isActive'] ?? false,
      'toAnonymize' => $options['toAnonymize'] ?? false,
    ]);
    return $this;
  }

  public function getHTML(): string{
    $this->contract->blocks = $this->contractBlocks->toArray();
    $this->contract->attributesList = $this->contractAttributes->toArray();
    $this->formElements = $this->formService->createFormElementsCollection($this->contract);

    $contractPdfFile = $this->contractService
      ->renderContract($this->contract, $this->formElements);

    return $contractPdfFile->getDomPDF()->outputHtml();
  }

  public function getBlocks():array {
    return $this->contractBlocks->toArray();
  }

  public function getAttributes():array {
    return $this->contractAttributes->toArray();
  }
}
