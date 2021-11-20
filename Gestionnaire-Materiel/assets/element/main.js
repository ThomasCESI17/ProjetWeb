if ("serviceWorker" in navigator) {
    navigator.serviceWorker
      .register("//localhost/Gestionnaire-Materiel/sw.js")
      .then(serviceWorker => {
        console.log("Service Worker registered: ", serviceWorker);
      })
      .catch(error => {
        console.error("Error registering the Service Worker: ", error);
      });
  }