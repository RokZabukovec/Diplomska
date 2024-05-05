const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"login":{"uri":"login","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["POST"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.update":{"uri":"reset-password","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"verification.notice":{"uri":"email\/verify","methods":["GET","HEAD"]},"verification.verify":{"uri":"email\/verify\/{id}\/{hash}","methods":["GET","HEAD"],"parameters":["id","hash"]},"verification.send":{"uri":"email\/verification-notification","methods":["POST"]},"user-profile-information.update":{"uri":"user\/profile-information","methods":["PUT"]},"user-password.update":{"uri":"user\/password","methods":["PUT"]},"password.confirmation":{"uri":"user\/confirmed-password-status","methods":["GET","HEAD"]},"password.confirm":{"uri":"user\/confirm-password","methods":["POST"]},"two-factor.login":{"uri":"two-factor-challenge","methods":["GET","HEAD"]},"two-factor.enable":{"uri":"user\/two-factor-authentication","methods":["POST"]},"two-factor.confirm":{"uri":"user\/confirmed-two-factor-authentication","methods":["POST"]},"two-factor.disable":{"uri":"user\/two-factor-authentication","methods":["DELETE"]},"two-factor.qr-code":{"uri":"user\/two-factor-qr-code","methods":["GET","HEAD"]},"two-factor.secret-key":{"uri":"user\/two-factor-secret-key","methods":["GET","HEAD"]},"two-factor.recovery-codes":{"uri":"user\/two-factor-recovery-codes","methods":["GET","HEAD"]},"terms.show":{"uri":"terms-of-service","methods":["GET","HEAD"]},"policy.show":{"uri":"privacy-policy","methods":["GET","HEAD"]},"profile.show":{"uri":"user\/profile","methods":["GET","HEAD"]},"other-browser-sessions.destroy":{"uri":"user\/other-browser-sessions","methods":["DELETE"]},"current-user-photo.destroy":{"uri":"user\/profile-photo","methods":["DELETE"]},"current-user.destroy":{"uri":"user","methods":["DELETE"]},"api-tokens.index":{"uri":"user\/api-tokens","methods":["GET","HEAD"]},"api-tokens.store":{"uri":"user\/api-tokens","methods":["POST"]},"api-tokens.update":{"uri":"user\/api-tokens\/{token}","methods":["PUT"],"parameters":["token"]},"api-tokens.destroy":{"uri":"user\/api-tokens\/{token}","methods":["DELETE"],"parameters":["token"]},"teams.create":{"uri":"teams\/create","methods":["GET","HEAD"]},"teams.store":{"uri":"teams","methods":["POST"]},"teams.show":{"uri":"teams\/{team}","methods":["GET","HEAD"],"parameters":["team"]},"teams.update":{"uri":"teams\/{team}","methods":["PUT"],"parameters":["team"]},"teams.destroy":{"uri":"teams\/{team}","methods":["DELETE"],"parameters":["team"]},"current-team.update":{"uri":"current-team","methods":["PUT"]},"team-members.store":{"uri":"teams\/{team}\/members","methods":["POST"],"parameters":["team"]},"team-members.update":{"uri":"teams\/{team}\/members\/{user}","methods":["PUT"],"parameters":["team","user"]},"team-members.destroy":{"uri":"teams\/{team}\/members\/{user}","methods":["DELETE"],"parameters":["team","user"]},"team-invitations.accept":{"uri":"team-invitations\/{invitation}","methods":["GET","HEAD"],"parameters":["invitation"]},"team-invitations.destroy":{"uri":"team-invitations\/{invitation}","methods":["DELETE"],"parameters":["invitation"]},"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"projects.index":{"uri":"projects","methods":["GET","HEAD"]},"projects.store":{"uri":"projects","methods":["POST"]},"projects.show":{"uri":"projects\/{project}","methods":["GET","HEAD"],"parameters":["project"],"bindings":{"project":"id"}},"projects.update":{"uri":"projects\/{project}","methods":["PUT","PATCH"],"parameters":["project"]},"projects.destroy":{"uri":"projects\/{project}","methods":["DELETE"],"parameters":["project"]},"contact.save":{"uri":"api\/contact","methods":["POST"]},"commands.external":{"uri":"api\/external","methods":["GET","HEAD"]},"commands.index":{"uri":"api\/commands","methods":["GET","HEAD"]},"commands.store":{"uri":"api\/commands","methods":["POST"]},"commands.show":{"uri":"api\/commands\/{command}","methods":["GET","HEAD"],"parameters":["command"],"bindings":{"command":"id"}},"commands.update":{"uri":"api\/commands\/{command}","methods":["PUT","PATCH"],"parameters":["command"],"bindings":{"command":"id"}},"commands.destroy":{"uri":"api\/commands\/{command}","methods":["DELETE"],"parameters":["command"],"bindings":{"command":"id"}},"pages.index":{"uri":"api\/pages","methods":["GET","HEAD"]},"pages.store":{"uri":"api\/pages","methods":["POST"]},"pages.show":{"uri":"api\/pages\/{page}","methods":["GET","HEAD"],"parameters":["page"]},"pages.update":{"uri":"api\/pages\/{page}","methods":["PUT","PATCH"],"parameters":["page"]},"pages.destroy":{"uri":"api\/pages\/{page}","methods":["DELETE"],"parameters":["page"]},"links.index":{"uri":"api\/links","methods":["GET","HEAD"]},"links.store":{"uri":"api\/links","methods":["POST"]},"links.show":{"uri":"api\/links\/{link}","methods":["GET","HEAD"],"parameters":["link"]},"links.update":{"uri":"api\/links\/{link}","methods":["PUT","PATCH"],"parameters":["link"]},"links.destroy":{"uri":"api\/links\/{link}","methods":["DELETE"],"parameters":["link"]},"snippets.index":{"uri":"api\/snippets","methods":["GET","HEAD"]},"snippets.store":{"uri":"api\/snippets","methods":["POST"]},"snippets.show":{"uri":"api\/snippets\/{snippet}","methods":["GET","HEAD"],"parameters":["snippet"]},"snippets.update":{"uri":"api\/snippets\/{snippet}","methods":["PUT","PATCH"],"parameters":["snippet"]},"snippets.destroy":{"uri":"api\/snippets\/{snippet}","methods":["DELETE"],"parameters":["snippet"]},"index":{"uri":"documentation","methods":["GET","HEAD"]},"search.show":{"uri":"search","methods":["GET","HEAD"]},"project":{"uri":"project\/{project}","methods":["GET","HEAD"],"parameters":["project"],"bindings":{"project":"id"}},"project.edit":{"uri":"project\/{project}\/edit","methods":["GET","HEAD"],"parameters":["project"],"bindings":{"project":"id"}},"command.edit":{"uri":"command\/{command}\/edit","methods":["GET","HEAD"],"parameters":["command"],"bindings":{"command":"id"}},"admin":{"uri":"admin","methods":["GET","HEAD"]},"projects.create":{"uri":"projects\/create","methods":["GET","HEAD"]},"projects.edit":{"uri":"projects\/{project}\/edit","methods":["GET","HEAD"],"parameters":["project"],"bindings":{"project":"id"}},"auth.google":{"uri":"login\/google","methods":["GET","HEAD"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
