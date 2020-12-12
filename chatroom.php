<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>167 Chatroom
    </title>
</head>
<body>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-database.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyByR0irsMYLtreY5JN3bE5GL71ngcWn14Y",
    authDomain: "hypermart-8793e.firebaseapp.com",
    databaseURL: "https://hypermart-8793e.firebaseio.com",
    projectId: "hypermart-8793e",
    storageBucket: "hypermart-8793e.appspot.com",
    messagingSenderId: "165790668928",
    appId: "1:165790668928:web:3030dd606406586681ae65",
    measurementId: "G-KZQZ034599"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

  var myName = prompt("Enter your Name:");
function sendMessage() {
    var message = document.getElementById("message").value;

    firebase.database().ref("message").push().set({
        "sender": myName,
        "message": message
    });
    return false;
}

  firebase.database().ref("messages").on("child_added", function (snapshot){
      var html = "";
      html +="<li>";
          html += snapshot.val().sender + ": " + snapshot.val().message;
      html +="</li>";
      
      document.getElementById("messages").innerHTML += html;
  });

</script>

<form onsubmit="return sendMessage();">
  <input type="text" id="message" placeholder="Enter Message" autocomplete="off">

  <input type="submit" name="submit">
</form>

<ul id="messages"></ul>
</body>
</html>