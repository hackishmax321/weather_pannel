console.log("Forms Launched!");
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
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
  var firestore = firebase.firestore();

  //Creating Collection
  const refUsers = firestore.collection('user');

  //All Inputs
  const inputStaff = document.querySelector('#staff');
  const inputUsername = document.querySelector('#username');
  const inputName = document.querySelector('#name');
  const inputAddress = document.querySelector('#address');
  const inputContact = document.querySelector('#contact');
  const inputEmail = document.querySelector('#email');
  const inputPassword = document.querySelector('#password');
  const inputCPassword = document.querySelector('#cpassword');

  const register = document.querySelector('#btn_sub');

  const message = document.querySelectorAll('small');
  message.forEach((item)=>{
    item.style.display="none";
  });

  //All error message sects
  const vuname = document.querySelector('#un'); 
  const vname = document.querySelector('#na'); 
  const vaddress = document.querySelector('#ad'); 
  const vcontact = document.querySelector('#co'); 
  const vemail = document.querySelector('#em'); 
  const vpass = document.querySelector('#pa'); 
  const vcpass = document.querySelector('#cp'); 

  const vreguname = document.querySelector('#reguname'); 
  const vregpass = document.querySelector('#regpass'); 


  function validation(){
      console.log("Validation is running!!!");
      if(inputUsername.value.length < 8){
          vuname.style.display="block";
          vuname.innerHTML = "Created Username is too short. Enter Username between 8 and 25 characters!";
          return 0;
      } else {
          vuname.style.display="none";
      }

      if(inputUsername.value.length > 25){
          vuname.style.display="block";
          vuname.innerHTML = "Created Username is too long. Enter Username between 8 and 25 characters!";
          return 0;
      } else {
          vuname.style.display="none";
      }

      if(inputName.value.length == 0){
          vname.style.display="block";
          vname.innerHTML = "Entering Name is necessary so don't keep Name field empty!";
          return 0;
      } else {
          vname.style.display="none";
      }

      if(inputAddress.value.length == 0){
          vaddress.style.display="block";
          vaddress.innerHTML = "Entering Address may helpfuul to this process!";
          return 0;
      } else {
          vaddress.style.display="none";
      }

      if(inputContact.value.length == 0){
          vcontact.style.display="block";
          vcontact.innerHTML = "Entering Contact Number is necessary so don't keep Contact field empty!";
          return 0;
      } else {
          vcontact.style.display = "none"
      } 

      if(!inputContact.value.length == 10){
          vcontact.style.display="block";
          vcontact.innerHTML = "Enter a valid 10 digit Contact Number!";
          return 0;
      } else {
          vcontact.style.display = "none"
      }

      if(!inputEmail.value == ""){
          vemail.style.display="block";
          vemail.innerHTML = "Enter a valid email address!";
          return 0;
      } else {
          vemail.style.display = "none"
      }

      if(inputPassword.value.length == 0){
          vpass.style.display="block";
          vpass.innerHTML = "Can't keep password field empty!";
          return 0;
      } else {
          vpass.style.display = "none"
      }

      if(inputPassword.value.length <= 8){
          vpass.style.display="block";
          vpass.innerHTML = "Password should contain more than 8 characters!";
          return 0;
      } else {
          vpass.style.display = "none"
      }
      

      if(inputPassword.value == inputCPassword.value){
          vcpass.style.display="block";
          vcpass.innerHTML = "Password dosen't match with Confirm password";
          return 0;
      } else {
          vcpass.style.display = "none"
      }
      return 1;

  }
  
  //Registration Process
  if(register!=null){

    var role = "Member";
    register.addEventListener('click', function(){
      if(inputStaff){
        role = "Staff";
      }

      //Validation Process
      if(inputUsername.value.length < 8){
          vuname.style.display="block";
          vuname.innerHTML = "Created Username is too short. Enter Username between 8 and 25 characters!";
          return;
      } else {
          vuname.style.display="none";
      }

      if(inputUsername.value.length > 25){
          vuname.style.display="block";
          vuname.innerHTML = "Created Username is too long. Enter Username between 8 and 25 characters!";
          return;
      } else {
          vuname.style.display="none";
      }

      if(inputName.value.length == 0){
          vname.style.display="block";
          vname.innerHTML = "Entering Name is necessary so don't keep Name field empty!";
          return;
      } else {
          vname.style.display="none";
      }

      if(inputAddress.value.length == 0){
          vaddress.style.display="block";
          vaddress.innerHTML = "Entering Address may helpfuul to this process!";
          return;
      } else {
          vaddress.style.display="none";
      }

      if(inputContact.value.length == 0){
          vcontact.style.display="block";
          vcontact.innerHTML = "Entering Contact Number is necessary so don't keep Contact field empty!";
          return;
      } else {
          vcontact.style.display = "none"
      } 

      if(inputContact.value.length != 10){
          vcontact.style.display="block";
          vcontact.innerHTML = "Enter a valid Number!";
          return;
      } else {
          vcontact.style.display = "none"
      }

      if(inputEmail.value.length == 0){
          vemail.style.display="block";
          vemail.innerHTML = "Enter a valid email address!";
          return;
      } else {
          vemail.style.display = "none"
      }

      if(inputPassword.value.length == 0){
          vpass.style.display="block";
          vpass.innerHTML = "Can't keep password field empty!";
          return;
      } else {
          vpass.style.display = "none"
      }

      if(inputPassword.value.length <= 8){
          vpass.style.display="block";
          vpass.innerHTML = "Password should contain more than 8 characters!";
          return;
      } else {
          vpass.style.display = "none"
      }
      

      if(inputPassword.value != inputCPassword.value){
          vcpass.style.display="block";
          vcpass.innerHTML = "Password dosen't match with Confirm password";
          return;
      } else {
          vcpass.style.display = "none"
      }


      
      const uname = inputUsername.value;
      const name = inputName.value;
      const address = inputAddress.value;
      const contact = inputContact.value;
      const email = inputEmail.value;
      const pass = inputPassword.value;
      const cpass = inputCPassword.value;

    //   refUsers.where("username", "==", uname).get().then((results)=>{
    //     results.forEach(rec=>{
    //         if(results == [object]){
    //             alert("Result is no available"+results);
    //         } else {
    //             alert("have Results");
    //         }

    //         alert("Entered username is already in use. Enter another one!");
    //         return;
    //     });

    //   });
    //   .finally(()=>{
          
    //   })
      
      //Adding data to table/Collection
      refUsers.add({
        username: uname,
        name: name,
        role: role,
        address: address,
        contact: contact,
        email: email,
        password: pass,
        accepted: false
      })
      .then(()=>{
        refUsers.where("username", "==", uname).get().then((results)=>{
            results.forEach((row)=>{
                alert("Profile added"); 
                refUsers.doc(row.id).collection('profile').doc('image').set({
                    icon: "resoures/users/usericon.png"
                });
                alert("Registration Process Complete! Your account is submitted for further validations.");
                window.location.href = "hold_page.html";
            });
        });
      })
      .catch((error)=>{
          console.log("Error"+error);
      })
    //   .finally(()=>{
          
    //   });

    });
  }
  
  
  const login = document.querySelector('#btn_log');
  const login2 = document.querySelector('#btn_log_min');

  if(login!=null){
    login.addEventListener('click', function(){

        const uname = inputUsername.value;
        const pass = inputPassword.value;

        //Validation Process
        if(inputUsername.value.length == 0){
            vreguname.style.display="block";
            vreguname.innerHTML = "Can't keep Password as Empty value!";
            return;
        } else {
            vreguname.style.display="none";
        }

        if(inputPassword.value.length == 0){
            vregpass.style.display="block";
            vregpass.innerHTML = "Can't keep Password as Empty value!";
            return;
        } else {
            vregpass.style.display="none";
        }


      

      console.log("Going to Enter these values");

      var get_pass, role = "Member";
      firestore.collection('user').where("username","==", uname).get().then(function(querySnapshot){
        querySnapshot.forEach(function(doc) {
          // doc.data() is never undefined for query doc snapshots
          get_pass = doc.data().password;
          role = doc.data().role;
          
          if((get_pass==pass)&&(doc.data().accepted==true)){
            console.log("Loging Successful!"+uname +" "+role);

            //PHP sessions
            window.location="../php/session.php?username="+uname+"&role="+role+"";
            
          } else if((get_pass==pass)&&(doc.data().accepted==false)){
            alert("Your account is not Approved Yet!");
            window.location.href = "hold_page.html";
          } else {
            alert("Entered Username or Password is Incorrect. Check again and Retype!");
          }
        });
      }).catch(function(error){
        console.log("Error getting documents: ", error);
        vregpass.style.display="block";
        vregpass.innerHTML = "Check your Username and Password";
      });
      
      
      
    });
  }

  if(login2!=null){
    login2.addEventListener('click', function(){

        const uname = inputUsername.value;
        const pass = inputPassword.value;

        //Validation Process
        if(inputUsername.value.length == 0){
            vreguname.style.display="block";
            vreguname.innerHTML = "Can't keep Password as Empty value!";
            return;
        } else {
            vreguname.style.display="none";
        }

        if(inputPassword.value.length == 0){
            vregpass.style.display="block";
            vregpass.innerHTML = "Can't keep Password as Empty value!";
            return;
        } else {
            vregpass.style.display="none";
        }


      

      console.log("Going to Enter these values");

      var get_pass, role = "Member";
      firestore.collection('user').where("username","==", uname).get().then(function(querySnapshot){
        querySnapshot.forEach(function(doc) {
          // doc.data() is never undefined for query doc snapshots
          get_pass = doc.data().password;
          role = doc.data().role;
          
          if((get_pass==pass)&&(doc.data().accepted==true)){
            console.log("Loging Successful!"+uname +" "+role);

            //PHP sessions
            window.location="php/session.php?username="+uname+"&role="+role+"";
            
          } else if((get_pass==pass)&&(doc.data().accepted==false)){
            alert("Your account is not Approved Yet!");
            window.location.href = "forms/hold_page.html";
          } else {
            alert("Entered Username or Password is Incorrect. Check again and Retype!");
          }
        });
      }).catch(function(error){
        console.log("Error getting documents: ", error);
        vregpass.style.display="block";
        vregpass.innerHTML = "Check your Username and Password";
      });
      
      
      
    });
  }


  function getURL(){
    var url_string = "http://www.example.com/t.html?a=1&b=3&c=m2-m3-m4-m5"; //window.location.href
    var url = new URL(url_string);
    var c = url.searchParams.get("c");
    console.log(c);
  }
  
  

