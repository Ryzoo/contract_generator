import { Selector } from 'testcafe'

export const emailInput = Selector('input').withAttribute('type', 'email')
export const passwordInput = Selector('input').withAttribute('type', 'email')
export const loginButton = Selector('.v-card__actions button');