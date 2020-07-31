import { emailInput, passwordInput, loginButton } from "../helpers/login";
import { baseUrl, testUser } from "./config";
import { Role, t } from 'testcafe'

export async function login(username, password) {
  await t
    .wait(10000)
    .typeText(emailInput, username)
    .typeText(passwordInput, password)
    .click(loginButton)
}

export const contractTestUser = Role(`${baseUrl}/auth/login`, () => login(testUser.username, testUser.password), { preserveUrl: true })

export default {
  contractTestUser,
}