importScripts('https://www.gstatic.com/firebasejs/10.7.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.7.0/firebase-analytics-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.7.0/firebase-messaging-compat.js');
firebase.initializeApp({
    apiKey: "AIzaSyDER_oTIz6NrwZa0PSiETGPxbWcBPot2Gc",
    authDomain: "api-notif-17386.firebaseapp.com",
    projectId: "api-notif-17386",
    storageBucket: "api-notif-17386.appspot.com",
    messagingSenderId: "225959473026",
    appId: "1:225959473026:web:94b42e90c0366758eb699b",
    measurementId: "G-R4T9FQFG06"
});
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});