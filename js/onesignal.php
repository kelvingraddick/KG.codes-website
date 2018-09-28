<link rel="manifest" href="manifest.json" />
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js"></script>
<script>
  var OneSignal = window.OneSignal || [];
  console.error(OneSignal);
  OneSignal.push(function() {
    OneSignal.init({
      appId: "appId",
    });
  });
</script>