
const CNAME = "V1";
const STATICCURLS = ["http://localhost/Gestionnaire-Materiel/","http://localhost/Gestionnaire-Materiel/gestion-materiel.html", "http://localhost/Gestionnaire-Materiel/assets/element/headglobale.html"];

self.addEventListener("install", event => {
    console.log("Service Worker installing.");
    event.waitUntil(
      caches.open(CNAME).then(cache => cache.addAll(STATICCURLS))
    );
  });
  
  self.addEventListener("activate", event => {
    console.log("Service Worker activating.");
  });

  self.addEventListener("fetch", event => {
    // Stratégie Cache-First
    event.respondWith(
      caches
        .match(event.request) // On vérifie si la requête a déjà été mise en cache
        .then(cached => cached || fetch(event.request)) // sinon on requête le réseau
        .then(
          response =>
            cache(event.request, response) // on met à jour le cache
              .then(() => response) // et on résout la promesse avec l'objet Response
        )
    );
  });


  function cache(request, response) {
    if (response.type === "error" || response.type === "opaque") {
      return Promise.resolve(); // do not put in cache network errors
    }
  
    return caches
      .open(CNAME)
      .then(cache => cache.put(request, response.clone()));
  }