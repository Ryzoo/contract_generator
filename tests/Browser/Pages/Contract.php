<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class Contract extends Page
{
  /**
   * Get the URL for the page.
   *
   * @return string
   */
  public function url()
  {
    return '/panel/contracts/list';
  }

  /**
   * Assert that the browser is on the page.
   *
   * @param  \Laravel\Dusk\Browser  $browser
   * @return void
   */
  public function assert(Browser $browser)
  {
    //
  }

  /**
   * Get the element shortcuts for the page.
   *
   * @return array
   */
  public function elements()
  {
    return [
      '@newContractButton' => 'ADD NEW CONTRACT',
      '@contractNameInput' => 'input[name="contract-name"]',
      '@contractDescriptionTextarea' => 'div[name="contract-description"] .ql-editor',
      '@saveButton' => 'SAVE AND BUILD',
      '@contractNameHeader' => 'h3[name="builder-contract-name"]',
    ];
  }
}
