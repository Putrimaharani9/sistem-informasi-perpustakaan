<script type="module">
    // Import the functions you need from the SDKs you need
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-app.js";
    import {
        getAnalytics
    } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-analytics.js";
    import {
        getMessaging,
        getToken
    } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-messaging.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyDK2dy-2GKGO3Nb1eIuUCfRhriN2zqEvFQ",
        authDomain: "sip-laravel.firebaseapp.com",
        projectId: "sip-laravel",
        storageBucket: "sip-laravel.firebasestorage.app",
        messagingSenderId: "468162231727",
        appId: "1:468162231727:web:715679ebd55d9aa924835a",
        measurementId: "G-1J9QW5JLNM"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);

    const VAPID_KEY = 'BFF_jkdiWUggi0cCiWBFUpa0CmI-sxTLUHBJU5BW0Nwc2Q5VKK4_7XcwiMz3EVA7royNpm39UoiLK0UuJ6ViksY';

    // Get registration token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.
    const messaging = getMessaging(app);

    navigator.serviceWorker.register('sw.js').then(registration => {
        getToken(messaging, {
            serviceWorkerRegistration: registration,
            vapidKey: VAPID_KEY
        }).then((currentToken) => {
            if (currentToken) {
                // Send the token to your server and update the UI if necessary
                // ...

                document.querySelector('input[name="device_id"]').value = currentToken;

            } else {
                // Show permission request UI
                console.log('No registration token available. Request permission to generate one.');
                // ...
            }
        }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
            // ...
        });
    });
</script>