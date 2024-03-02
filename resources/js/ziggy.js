const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"l5-swagger.default.api":{"uri":"api\/documentation","methods":["GET","HEAD"]},"l5-swagger.default.docs":{"uri":"docs\/{jsonFile?}","methods":["GET","HEAD"],"parameters":["jsonFile"]},"l5-swagger.default.asset":{"uri":"docs\/asset\/{asset}","methods":["GET","HEAD"],"parameters":["asset"]},"l5-swagger.default.oauth2_callback":{"uri":"api\/oauth2-callback","methods":["GET","HEAD"]},"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"mytest.index":{"uri":"mytest","methods":["GET","HEAD"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
