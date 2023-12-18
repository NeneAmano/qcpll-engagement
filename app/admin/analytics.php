<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<div class="container">
        <?php require_once 'includes/sidebar.php' ?>
        <?php require_once 'includes/header.php' ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Main Content -->
        <main>
        
            <h1>Data Analytics</h1>
            <!-- Analyses -->
            <div>

            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal">Daily</button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal">Weekly</button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal">Monthly</button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal">Annually</button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal">Generate Reports</button>
            <!-- start of data analysis of age -->
             <canvas id="age"></canvas>

                  <div class="demographic" style="display: flex;font-style:italic;">
                  <span class="material-icons-sharp active">
                  info
                  </span>
                    <div class="info">
                      <p style="font-size: 15px;"> There were 12 clients in the age range of 0 to 12, 19 clients in the age range of 13 to 21, 3 clients in the age range of 22 to 35, 5 clients in the age range of 36 to 59, and 2 clients who are 60 years old or above.</p>
                </div>

          </div>



<script>
  const age = document.getElementById('age');

  new Chart(age, {
    type: 'bar',
    data: {
      labels: ['0-12', '13-21', '22-35', '36-59', '60-Above'],
      datasets: [{
        label: 'Age Analysis',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- end of data analysis of age -->


<!-- start of data analysis of gender -->
  <canvas id="gender"></canvas>
                  <div class="demographic" style="display: flex;font-style:italic;">
                  <span class="material-icons-sharp active">
                  info
                  </span>
                    <div class="info">
                    <p style="font-size: 15px;">The dataset reveals that there were 12 male clients, 19 female clients, and 3 clients categorized as "others."</p>
                    </div>

  </div>
<script>
  const gender = document.getElementById('gender');

  new Chart(gender, {
    type: 'bar',
    data: {
      labels: ['Male', 'Female', 'Others'],
      datasets: [{
        label: 'Gender Analysis',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- end of data analysis of age -->

<!-- start of data analysis of occupation -->

<canvas id="occupation"></canvas>
                  <div class="demographic" style="display: flex;font-style:italic;">
                  <span class="material-icons-sharp active">
                  info
                  </span>
                    <div class="info">
                    <p style="font-size: 15px;">The breakdown of clients based on their occupational status is as follows: 12 students, 19 unemployed individuals, 3 employed individuals, and 5 retired individuals.</p>
                    </div>

  </div>
<script>
  const occupation = document.getElementById('occupation');

  new Chart(occupation, {
    type: 'bar',
    data: {
      labels: ['Student', 'Unemployed', 'Employed','Retired'],
      datasets: [{
        label: 'Occupation Analysis',
        data: [12, 19, 3, 5],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- end of data analysis of occupation -->

<!-- start of data analysis of educational -->

<canvas id="edu_attainment"></canvas>
                  <div class="demographic" style="display: flex;font-style:italic;">
                  <span class="material-icons-sharp active">
                  info
                  </span>
                    <div class="info">
                    <p style="font-size: 15px;">The data suggests a varied distribution of individuals based on their educational attainment. Specifically, there are 12 individuals who have completed elementary school, 19 at the high school level, 3 high school graduates, 5 individuals at the college level, 12 college graduates, 3 with a Master’s Degree, 17 with a Doctorate Degree, and 12 individuals with vocational training. This analysis provides insights into the educational diversity within the dataset.</p>
                    </div>

  </div>
<script>
  const edu_attainment = document.getElementById('edu_attainment');

  new Chart(edu_attainment, {
    type: 'bar',
    data: {
      labels: ['Elementary Graduate', 'High School Level', 'High School Graduate','College Level','College Graduate','Master’s Degree','Doctorate Degree','Vocational'],
      datasets: [{
        label: 'Educational Attainment Analysis',
        data: [12, 19, 3, 5, 12, 3, 17, 12],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- end of data analysis of educational -->

<!-- start of data analysis of services -->

<canvas id="services"></canvas>
                  <div class="demographic" style="display: flex;font-style:italic;">
                  <span class="material-icons-sharp active">
                  info
                  </span>
                    <div class="info">
                    <p style="font-size: 15px;">The "Services Analysis" dataset reveals that among the individuals surveyed, 5 chose NBI (National Bureau of Investigation) services, 9 preferred Police Clearance, 3 selected both NBI and Police Clearance, and 15 opted for other services. </p>
                    </div>

  </div>
<script>
  const services = document.getElementById('services');

  new Chart(services, {
    type: 'bar',
    data: {
      labels: ['NBI', 'Police Clearance', 'Both','Others'],
      datasets: [{
        label: 'Services Analysis',
        data: [5, 9, 3, 15],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- end of data analysis of occupation -->

<!-- start of data analysis of educational -->

<canvas id="q1"></canvas>
                  <div class="demographic" style="display: flex;font-style:italic;">
                  <span class="material-icons-sharp active">
                  info
                  </span>
                    <div class="info">
                    <p style="font-size: 15px;">The majority of respondents (15) learned about our service through government websites, followed by online searches (12) and printed materials (10). Word of mouth and social media were less prominent, with 4 and 3 respondents, respectively. The data for 'Referral from a friend or Family' and another source is not complete and should be filled in to provide a comprehensive understanding of how participants discovered the service.</p>
                    </div>

  </div>
<script>
  const q1 = document.getElementById('q1');

  new Chart(q1, {
    type: 'bar',
    data: {
      labels: ['Online Search', 'Word of Mouth', 'Social Media','Government Website','Printed Materials','Referral from a friend or Family'],
      datasets: [{
        label: 'How did you learn about our service?',
        data: [12, 4, 3, 15, 10],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- end of data analysis of educational -->


<!-- start of data analysis of educational -->

<canvas id="q2"></canvas>
                  <div class="demographic" style="display: flex;font-style:italic;">
                  <span class="material-icons-sharp active">
                  info
                  </span>
                    <div class="info">
                    <p style="font-size: 15px;">The majority of respondents (15) learned about our service through government websites, followed by online searches (12) and printed materials (10). Word of mouth and social media were less prominent, with 4 and 3 respondents, respectively. The data for 'Referral from a friend or Family' and another source is not complete and should be filled in to provide a comprehensive understanding of how participants discovered the service.</p>
                    </div>

  </div>
<script>
  const q2 = document.getElementById('q2');

  new Chart(q2, {
    type: 'bar',
    data: {
      labels: ['Bad', 'Poor', 'Neutral','Good','Excellent'],
      datasets: [{
        label: 'How was your experience with our services?',
        data: [10, 4, 13, 15, 5],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- end of data analysis of educational -->

        </main>
        <!-- End of Main Content -->

         <!-- Right Section -->
         <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Admin</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./assets/images/profile-1.jpg">
                    </div>
                </div>

            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="./assets/images/qcpl.logo.png">
                    <h2>EngageMate</h2>
                    <p>Web-based KIOSK</p>
                </div>
            </div>
<!-- 
            <div class="reminders">
                <div class="header">
                    <h2>Recommendations</h2>
                    <span class="material-icons-sharp">
                        info
                    </span>
                </div>

                <div class="notification">
                    <div class="content">
                        <div class="info">
                            <h3>
                              <h3>Rating: Very bad!&#x1F627;
                                <br>
                                <br>

                            We appreciate your feedback, User B, and we're sorry to hear about your experience with the smartphone.
                               Your satisfaction is our priority. To address your concerns, we recommend checking out our customer support 
                               for assistance with any troubleshooting or to explore alternative smartphones with improved battery life and
                                faster performance. Your input is valuable, and we'll use it to enhance our product recommendations and 
                                better meet your expectations in the future. If you have any specific preferences or requirements,
                               please let us know so we can tailor our recommendations more accurately.</h3>
                           
                        </div>
                        
                    </div>
                    
                </div> -->

                <!-- predict possible client -->
                <!-- <h4>Predict Possible Client a year!</h4>
<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
var xValues = [];
var yValues = [];
generateData("Math.sin(x)", 0, 10, 0.5);

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      pointRadius: 2,
      borderColor: "rgba(0,0,255,0.5)",
      data: yValues
    }]
  },    
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "y = sin(x)",
      fontSize: 16
    }
  }
});
function generateData(value, i1, i2, step = 1) {
  for (let x = i1; x <= i2; x += step) {
    yValues.push(eval(value));
    xValues.push(x);
  }
}
</script>

            </div> -->

        </div>


    </div>
    
    
    <?php
        require_once 'includes/scripts.php';
    ?>
</body>
</html>