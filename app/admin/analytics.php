<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<?php
// Include your database configuration file here
require_once('../core/init.php');

// Check if the "Show Daily" button is clicked
if (isset($_POST['showDaily'])) {
    // Get the current date
    $currentDate = date('Y-m-d');

    // Query to get clients created on the current day with age information
    $query = "SELECT age.age_range, client.* FROM client INNER JOIN age ON client.age_id = age.age_id WHERE DATE(client.created_at) = '$currentDate'";
} elseif (isset($_POST['showMonthly'])) {
    // Get the selected month and year from the dropdown
    $selectedMonth = $_POST['selectedMonth'];
    $currentYear = date('Y');

    // Query to get clients created in the selected month of the current year with age information
    $query = "SELECT age.age_range, client.* FROM client INNER JOIN age ON client.age_id = age.age_id WHERE MONTH(client.created_at) = '$selectedMonth' AND YEAR(client.created_at) = '$currentYear'";
} elseif (isset($_POST['showYearly'])) {
    // Get the selected year from the dropdown
    $selectedYear = $_POST['selectedYear'];

    // Query to get clients created in the selected year with age information
    $query = "SELECT age.age_range, client.* FROM client INNER JOIN age ON client.age_id = age.age_id WHERE YEAR(client.created_at) = '$selectedYear'";
} else {
    // Default query to get all clients with age information (you can modify this based on your requirements)
    $query = "SELECT age.age_range, client.* FROM client INNER JOIN age ON client.age_id = age.age_id";
}

// Execute the query and fetch the results
$result = mysqli_query($conn, $query);
?>


<div class="container">
        <?php require_once 'includes/sidebar.php' ?>
        <?php require_once 'includes/header.php' ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Main Content -->
        <main>
        
            <h1>Data Analytics</h1>
            <!-- Analyses -->
            <div>
    <!-- Add your dropdown and buttons for filtering here -->
    <form method="post" class="d-flex gap-2">
        <button type="submit" name="showDaily" class="btn btn-primary btn-sm">Show Daily</button>
        
        <!-- Monthly dropdown for monthly filter -->
        <select name="selectedMonth" class="form-select btn btn-primary btn-sm" style="width: 110px;">
            <!-- Generate options for each month -->
            <?php
            for ($month = 1; $month <= 12; $month++) {
                $monthName = date("F", mktime(0, 0, 0, $month, 1));
                echo '<option value="' . $month . '">' . $monthName . '</option>';
            }
            ?>
        </select>

        <button type="submit" name="showMonthly" class="btn btn-primary btn-sm">Show Monthly</button>
        
        <!-- Year dropdown for yearly filter -->
        <select name="selectedYear" class="form-select btn btn-primary btn-sm" style="width: 90px;">
            <!-- Add options dynamically based on your database data -->
            <?php
            // Assuming your 'client' table has a column named 'created_at'
            $yearsQuery = "SELECT DISTINCT YEAR(`created_at`) AS year FROM `client`";
            $yearsResult = mysqli_query($conn, $yearsQuery);
            
            while ($yearRow = mysqli_fetch_assoc($yearsResult)) {
                echo '<option value="' . $yearRow['year'] . '">' . $yearRow['year'] . '</option>';
            }
            ?>
        </select>

        <button type="submit" name="showYearly" class="btn btn-primary btn-sm">Show Yearly</button>

        <!-- Submit Button -->
        
    </form>
            <!-- start of data analysis of age -->
          <?php
                    $query1 = "SELECT age.age_range AS AGE_RANGE, COUNT(client.client_id) AS client_count
                    FROM age
                    INNER JOIN client ON age.age_id = client.age_id
                    GROUP BY age.age_range;
                    ";
                    $result1 = mysqli_query($conn, $query1);

                    foreach($result1 as $data1){
                      $age_range[] = $data1['AGE_RANGE'];
                      $client_count[] = $data1['client_count'];
                   
                    }
                ?>
                <div class="barchart1">
                    <canvas id="myChart1"></canvas>
                </div>

<script>
        // const labels = Utils.months({count: 7});
        const labels = <?php echo json_encode($age_range); ?>;
        const data = {
        labels: labels,
        datasets: [{
            label: 'TOTAL AGE COUNT PER MONTH',
            data: <?php echo json_encode($client_count); ?>,
            backgroundColor: [
            'rgba(255, 99, 132, 0.7)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
            ],
            borderWidth: 2
        }]
        };

        const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        },
        };

        const myChart = new Chart(
            document.getElementById('myChart1'),
            config
        );
    </script>

<!-- end of data analysis of age -->

<!-- start of data analysis of gender -->
<?php
  $query2 = "SELECT all_genders.gender as genders, COALESCE(COUNT(client.gender), 0) AS gender_count
  FROM (
      SELECT 'Male' AS gender
      UNION
      SELECT 'Female'
      UNION
      SELECT 'Other'
  ) AS all_genders
  LEFT JOIN client ON all_genders.gender = client.gender
  GROUP BY all_genders.gender
  ";
  $result2 = mysqli_query($conn, $query2);

  foreach($result2 as $data2){
    $genders[] = $data2['genders'];
    $gender_count[] = $data2['gender_count'];
  }
?>
<div class="barchart1">
  <canvas id="myChart2"></canvas>
</div>

<script>
// const labels = Utils.months({count: 7});
const labels_gender = <?php echo json_encode($genders); ?>;
const data_gender = {
labels: labels_gender,
datasets: [{
label: 'TOTAL GENDER COUNT PER MONTH',
data: <?php echo json_encode($gender_count); ?>,
backgroundColor: [
'rgba(255, 99, 132, 0.7)',
'rgba(255, 159, 64, 0.2)',
'rgba(255, 205, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(153, 102, 255, 0.2)',
'rgba(201, 203, 207, 0.2)'
],
borderColor: [
'rgb(255, 99, 132)',
'rgb(255, 159, 64)',
'rgb(255, 205, 86)',
'rgb(75, 192, 192)',
'rgb(54, 162, 235)',
'rgb(153, 102, 255)',
'rgb(201, 203, 207)'
],
borderWidth: 2
}]
};

const config_gender = {
type: 'bar',
data: data_gender,
options: {
scales: {
y: {
beginAtZero: true
}
}
},
};

const myChart_gender = new Chart(
document.getElementById('myChart2'),
config_gender
);
</script>

<!-- end of data analysis of gender -->


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
