<?php


namespace Tests\ContractBuilder;


class ConditionalsBuilder {

  public function __construct() {
    $this->content = [
      'operator' => 'All',
      'children' => collect()
    ];
  }

  public function make():ConditionalsBuilder {
    return new self();
  }

  public function getRule($id, int $operator, $value, int $ruleType): array {
    return [
      'type' => 'rule',
      'query' => [
        'id' => $id,
        'operator' => $operator,
        'value' => $value,
        'ruleType' => $ruleType
      ]
    ];
  }

  public function buildRule($id, int $operator, $value, int $ruleType):ConditionalsBuilder {
    $this->content['children']->push($this->getRule($id, $operator, $value, $ruleType));
    return $this;
  }

  public function buildGroup(int $operator, array $children):ConditionalsBuilder {
    $this->content['children']->push([
      'type' => 'group',
      'query' => [
        'operator' => $operator,
        'children' => $children
      ]
    ]);
    return $this;
  }

  public function encode(): string{
    return json_encode($this->content, JSON_THROW_ON_ERROR);
  }
}
