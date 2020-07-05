var firestore;
// export 
function initFirestore(){

    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyD8ip5VifiFdp4U6MQA9rlrOrElPAsvqlI",
        authDomain: "weatheralpha-242b9.firebaseapp.com",
        databaseURL: "https://weatheralpha-242b9.firebaseio.com",
        projectId: "weatheralpha-242b9",
        storageBucket: "weatheralpha-242b9.appspot.com",
        messagingSenderId: "840870070508",
        appId: "1:840870070508:web:956e8aa39a04da96573dc9",
        measurementId: "G-882F4EPZ5Q"
    };
    // Initialize Firebase, FireStore

    //Initialize Firestore
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
    firestore = firebase.firestore();
    
    


    console.log("FireStore Initialized!");

}

