import { baseUrl } from "../utils/config";
import { contractTestUser } from "../utils/roles";
import { formSubmissionsStats, newContractsStats, userRegistrationsStats } from "../helpers/dashboard";

fixture `Check dashboard tests`
  .page(baseUrl);

test
  .before(async (t) => {
    await t.useRole(contractTestUser);
  })
('When checking dashboard 3 cards should be visible', async (t) => {
  await t
    .expect(userRegistrationsStats).ok()
    .expect(formSubmissionsStats).ok()
    .expect(newContractsStats).ok()
});