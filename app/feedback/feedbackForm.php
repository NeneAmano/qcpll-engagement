<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      background-color: #f0f0f0;
      font-family: 'Arial', sans-serif;
    }

    #question-container {
      text-align: center;
      padding: 30px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    #question {
      font-size: 1.8em;
      margin-bottom: 20px;
    }

    .reaction-container {
      display: flex;
      justify-content: space-around;
      gap:0.5em;
    }

    .reaction {
      text-align: center;
    }

    .reaction img {
      width: 100px; /* Adjust the size as needed */
      margin-top: 10px;
    }
    .reaction img:hover{
      transform: translate(0px,-20px);
        transition: ease-in 0.1s;
        cursor: pointer;
    }
    .word {
      font-size: 1.2em;
      margin-top: 10px;
    }
    label{
      font-size: 1em;
    }
</style>
<body>

<form id="regForm" action="" method="POST">
  <!-- One "tab" for each step in the form: -->

  <!-- emoji based answer starts here -->
  <div class="tab">
  
    <div id="question-container">
    <p id="question">❓How was your experience with our services? ❓</p>
    <div class="reaction-container">
        <div class="reaction">
        <img class="img1" src="./images/EMOJI/1.png" alt="Feeling">
        <p class="word">Very Satisfied</p>
        </div>
        <div class="reaction">
        <img class="img2" src="./images/EMOJI/2.png" alt="Feeling">
        <p class="word">Satisfied</p>
        </div>
        <div class="reaction">
        <img class="img3" src="./images/EMOJI/3.png" alt="Feeling">
        <p class="word">Neutral</p>
        </div>
        <div class="reaction">
      <img class="img4" src="./images/EMOJI/4.png" alt="Feeling">
        <p class="word">Dissatisfied</p>
        </div>
        <div class="reaction">
        <img class="img5" src="./images/EMOJI/5.png" alt="Feeling">
        <p class="word">Very Dissatisfied</p>
        </div>
    </div>
    </div>
  </div>
  <div class="tab">
  
    <div id="question-container">
    <p id="question">❓How likely are you to recommend specific services within the E-Government Section to others? ❓</p>
    <div class="reaction-container">
        <div class="reaction">
        <img class="img1" src="./images/EMOJI/1.png" alt="Feeling">
        <p class="word">Very likely to recommend</p>
        </div>
        <div class="reaction">
        <img class="img2" src="./images/EMOJI/2.png" alt="Feeling">
        <p class="word"> Likely to recommend</p>
        </div>
        <div class="reaction">
        <img class="img3" src="./images/EMOJI/3.png" alt="Feeling">
        <p class="word">Neutral</p>
        </div>
        <div class="reaction">
      <img class="img4" src="./images/EMOJI/4.png" alt="Feeling">
        <p class="word">Unlikely to recommend</p>
        </div>
        <div class="reaction">
        <img class="img5" src="./images/EMOJI/5.png" alt="Feeling">
        <p class="word">Very unlikely to recommend</p>
        </div>
    </div>
    </div>
  </div>
  <div class="tab">
  
    <div id="question-container">
    <p id="question">❓How satisfied are you with the response time of the E-Government Section in addressing your queries and concerns? ❓</p>
    <div class="reaction-container">
        <div class="reaction">
        <img class="img1" src="./images/EMOJI/1.png" alt="Feeling">
        <p class="word">Very Satisfied</p>
        </div>
        <div class="reaction">
        <img class="img2" src="./images/EMOJI/2.png" alt="Feeling">
        <p class="word">Satisfied</p>
        </div>
        <div class="reaction">
        <img class="img3" src="./images/EMOJI/3.png" alt="Feeling">
        <p class="word">Neutral</p>
        </div>
        <div class="reaction">
      <img class="img4" src="./images/EMOJI/4.png" alt="Feeling">
        <p class="word">Dissatisfied</p>
        </div>
        <div class="reaction">
        <img class="img5" src="./images/EMOJI/5.png" alt="Feeling">
        <p class="word">Very Dissatisfied</p>
        </div>
    </div>
    </div>
  </div>
  <div class="tab">
  
    <div id="question-container">
    <p id="question">❓Did you find the staff in the E-Government Section helpful and knowledgeable? ❓</p>
    <div class="reaction-container">
        <div class="reaction">
        <img class="img1" src="./images/EMOJI/1.png" alt="Feeling">
        <p class="word">Very Knowledgeable</p>
        </div>
        <div class="reaction">
        <img class="img2" src="./images/EMOJI/2.png" alt="Feeling">
        <p class="word">Knowledgeable</p>
        </div>
        <div class="reaction">
        <img class="img3" src="./images/EMOJI/3.png" alt="Feeling">
        <p class="word">Neutral</p>
        </div>
        <div class="reaction">
      <img class="img4" src="./images/EMOJI/4.png" alt="Feeling">
        <p class="word">Not Very Knowledgeable</p>
        </div>
        <div class="reaction">
        <img class="img5" src="./images/EMOJI/5.png" alt="Feeling">
        <p class="word">Not Helpful and Not Knowledgeable</p>
        </div>
    </div>
    </div>
  </div>
  <div class="tab">
  
    <div id="question-container">
    <p id="question">❓How would you rate the accessibility of the E-Government Section for users with different levels of digital proficiency? ❓</p>
    <div class="reaction-container">
        <div class="reaction">
        <img class="img1" src="./images/EMOJI/1.png" alt="Feeling">
        <p class="word">Highly Accessible</p>
        </div>
        <div class="reaction">
        <img class="img2" src="./images/EMOJI/2.png" alt="Feeling">
        <p class="word">Accessible</p>
        </div>
        <div class="reaction">
        <img class="img3" src="./images/EMOJI/3.png" alt="Feeling">
        <p class="word">Neutral</p>
        </div>
        <div class="reaction">
      <img class="img4" src="./images/EMOJI/4.png" alt="Feeling">
        <p class="word">Somewhat Inaccessible</p>
        </div>
        <div class="reaction">
        <img class="img5" src="./images/EMOJI/5.png" alt="Feeling">
        <p class="word">Not Accessible</p>
        </div>
    </div>
    </div>
  </div>
  <div class="tab">
  
    <div id="question-container">
    <p id="question">❓Did you find the information presented within the E-Government Section to be easily comprehensible? ❓</p>
    <div class="reaction-container">
        <div class="reaction">
        <img class="img1" src="./images/EMOJI/1.png" alt="Feeling">
        <p class="word">Very Comprehensible</p>
        </div>
        <div class="reaction">
        <img class="img2" src="./images/EMOJI/2.png" alt="Feeling">
        <p class="word">Comprehensible</p>
        </div>
        <div class="reaction">
        <img class="img3" src="./images/EMOJI/3.png" alt="Feeling">
        <p class="word">Neutral</p>
        </div>
        <div class="reaction">
      <img class="img4" src="./images/EMOJI/4.png" alt="Feeling">
        <p class="word">Somewhat Incomprehensible</p>
        </div>
        <div class="reaction">
        <img class="img5" src="./images/EMOJI/5.png" alt="Feeling">
        <p class="word">Not Comprehensible</p>
        </div>
    </div>
    </div>
  </div>
  <div class="tab">
  
  <div id="question-container">
  <p id="question">❓Please share your compliments on the service you experienced in E-Government: ❓</p>
  <div class="reaction-container">
      <div class="reaction">
      <img class="img1" src="./images/EMOJI/1.png" alt="Feeling">
      <p class="word">Excellent Service</p>
      </div>
      <div class="reaction">
      <img class="img2" src="./images/EMOJI/2.png" alt="Feeling">
      <p class="word">Good Service</p>
      </div>
      <div class="reaction">
      <img class="img3" src="./images/EMOJI/3.png" alt="Feeling">
      <p class="word">Satisfactory</p>
      </div>
      <div class="reaction">
    <img class="img4" src="./images/EMOJI/4.png" alt="Feeling">
      <p class="word">Average Experience</p>
      </div>
      <div class="reaction">
      <img class="img5" src="./images/EMOJI/5.png" alt="Feeling">
      <p class="word">Needs Improvement</p>
      </div>
  </div>
  </div>
</div>
  <!-- emoji based answer ends here -->

<!-- checkbox based answer design starts here -->
<style>
  .tab {
    margin-top: 20px;
  }

  .question-container {
    text-align: center;
  }

  #question {
    font-size: 25px;
    color: #333;
    font-weight: 600;
    text-transform: uppercase;
  }

  .reaction-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
  }

  .reaction {
    margin: 10px;
  }

  .checkbox-label {
    display: flex;
    align-items: center;
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .checkbox-label:hover {
    background-color: #e0e0e0;
  }

  input[type="checkbox"] {
    margin-right: 10px;
    display: none;
  }

  .custom-checkbox {
    width: 20px;
    height: 20px;
    border: 2px solid #555;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    background-color: #fff;
  }

  input[type="checkbox"]:checked + .custom-checkbox {
    background-color: #4CAF50;
    border-color: #4CAF50;
  }

  @media screen and (max-width: 600px) {
    .reaction-container {
      flex-direction: column;
      align-items: stretch;
    }

    .checkbox-label {
      width: 100%;
      margin-bottom: 10px;
    }
  }
</style>
<!-- checkbox based answer design ends here -->


<!-- checkbox based answer form start here -->
<div class="tab">
  <div class="question-container">
    <p id="question">❓ How did you learn about our service? ❓</p>
    <div class="reaction-container">
      <div class="reaction">
        <label for="checkbox1" class="checkbox-label">
          <input type="checkbox" name="checkbox1" id="checkbox1">
          <div class="custom-checkbox"></div>
          Online Search [ Sa Internet ]
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox2" class="checkbox-label">
          <input type="checkbox" name="checkbox2" id="checkbox2">
          <div class="custom-checkbox"></div>
          Word of Mouth [ Kwento ng Iba ]
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox3" class="checkbox-label">
          <input type="checkbox" name="checkbox3" id="checkbox3">
          <div class="custom-checkbox"></div>
          Social Media [ Facebook, Twitter, Instagram, etc. ]
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox4" class="checkbox-label">
          <input type="checkbox" name="checkbox4" id="checkbox4">
          <div class="custom-checkbox"></div>
          Government Website [ Sa website ng pamahalaan ]
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox5" class="checkbox-label">
          <input type="checkbox" name="checkbox5" id="checkbox5">
          <div class="custom-checkbox"></div>
          Printed Materials (Flyers, Brochures) [ Naka-print na Materyales ]
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox6" class="checkbox-label">
          <input type="checkbox" name="checkbox6" id="checkbox6">
          <div class="custom-checkbox"></div>
          Referral from a Friend or Family [ Sa payo ng kaibigan o kamag-anak ]
        </label>
      </div>
    </div>
  </div>
</div>
<div class="tab">
  <div class="question-container">
    <p id="question">❓  In what areas do you think we can make improvements? ❓</p>
    <div class="reaction-container">
      <div class="reaction">
        <label for="checkbox7" class="checkbox-label">
          <input type="checkbox" name="checkbox7" id="checkbox7">
          <div class="custom-checkbox"></div>
          Customer Service
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox8" class="checkbox-label">
          <input type="checkbox" name="checkbox9" id="checkbox8">
          <div class="custom-checkbox"></div>
          Service Variety
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox9" class="checkbox-label">
          <input type="checkbox" name="checkbox9" id="checkbox9">
          <div class="custom-checkbox"></div>
          Facility Cleanliness and Organization
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox10" class="checkbox-label">
          <input type="checkbox" name="checkbox10" id="checkbox10">
          <div class="custom-checkbox"></div>
          Timeliness of Service
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox11" class="checkbox-label">
          <input type="checkbox" name="checkbox11" id="checkbox11">
          <div class="custom-checkbox"></div>
          Service Accessibility
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox12" class="checkbox-label">
          <input type="checkbox" name="checkbox12" id="checkbox12">
          <div class="custom-checkbox"></div>
          Staff Knowledge and Training
        </label>
      </div>
    </div>
  </div>
</div>
<div class="tab">
  <div class="question-container">
    <p id="question">❓  Please select in which area would you like to provide a comment.  ❓</p>
    <div class="reaction-container">
      <div class="reaction">
        <label for="checkbox13" class="checkbox-label">
          <input type="checkbox" name="checkbox13" id="checkbox13">
          <div class="custom-checkbox"></div>
          Concerns or Issues Faced
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox14" class="checkbox-label">
          <input type="checkbox" name="checkbox14" id="checkbox14">
          <div class="custom-checkbox"></div>
          Compliments on Excellent Service
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox15" class="checkbox-label">
          <input type="checkbox" name="checkbox15" id="checkbox15">
          <div class="custom-checkbox"></div>
          Comments on Overall Experience
        </label>
      </div>
    </div>
  </div>
</div>
<div class="tab">
  <div class="question-container">
    <p id="question">❓ Category of concerns or issues faced: ❓</p>
    <div class="reaction-container">
      <div class="reaction">
        <label for="checkbox16" class="checkbox-label">
          <input type="checkbox" name="checkbox16" id="checkbox16">
          <div class="custom-checkbox"></div>
          Customer Service
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox17" class="checkbox-label">
          <input type="checkbox" name="checkbox17" id="checkbox17">
          <div class="custom-checkbox"></div>
          Service Variety
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox18" class="checkbox-label">
          <input type="checkbox" name="checkbox18" id="checkbox18">
          <div class="custom-checkbox"></div>
          Facility Cleanliness and Organization
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox19" class="checkbox-label">
          <input type="checkbox" name="checkbox19" id="checkbox19">
          <div class="custom-checkbox"></div>
          Timeliness of Service
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox20" class="checkbox-label">
          <input type="checkbox" name="checkbox20" id="checkbox20">
          <div class="custom-checkbox"></div>
          Service Accessibility
        </label>
      </div>

      <div class="reaction">
        <label for="checkbox21" class="checkbox-label">
          <input type="checkbox" name="checkbox21" id="checkbox21">
          <div class="custom-checkbox"></div>
          Staff Knowledge and Training
        </label>
      </div>
    </div>
  </div>
</div>
<!-- checkbox based answer form ends here -->



  
  <div style="overflow:auto;">
    <div style="float:right; margin-top:12px;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>

  </div>
</form>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

</body>
</html>
