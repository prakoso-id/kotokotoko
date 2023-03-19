importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
importScripts(
    "https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js",
);
// For an optimal experience using Cloud Messaging, also add the Firebase SDK for Analytics.
importScripts(
    "https://www.gstatic.com/firebasejs/8.3.2/firebase-analytics.js",
);

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
    messagingSenderId: "301681348555",
    apiKey: "AIzaSyCK0GX5tpbtSKrqhUXxMO1Br1pB6jsYK9w",
    projectId: "umkm-tng",
    appId: "1:301681348555:web:43fdb709bb5ab4ddda704e",
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    // Customize notification here
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "https://borongsay.tangerangkota.go.id/assets/images/borongsayiconsmall.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});