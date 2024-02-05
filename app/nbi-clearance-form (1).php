<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBI Clearance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/assets/css/style-nbi-clearance-form.css">
</head>
<body>

<div class="container my-5 nobreak">
    <div class="row">
        <div class="col-3 col-print-3" style="border: 1px solid green">

        </div>
        <div class="col-6 col-print-6" style="border: 1px solid green; text-align: center;">
            <h1>POLICE CLEARANCE FORM</h1>
        </div>
        <div class="col-3 col-print-3" style="border: 1px solid green">

        </div>
    </div>

    <div class="row">
        <div class="col-1 col-print-1" style="border: 1px solid green">

        </div>
        <div class="col-10 p-4 col-print-10" style="border: 1px solid green; text-align: center;">
            <h4>Application Profile</h4>
        </div>
        <div class="col-1 col-print-1" style="border: 1px solid green">

        </div>
    </div>


    <!-- email address -->
    <div class="row">
        <div class="col-1" style="border: 1px solid green">

        </div>
        <div class="col-10 p-2" style="border: 1px solid green;">
            <form>
                <label for="email" class="form-label">Active E-mail Address:</label>
                <input type="email" class="form-control" id="email" placeholder="youremail@gmail.com">
            </form>
        </div>
        <div class="col-1" style="border: 1px solid green">

        </div>
    </div>

    <!-- first name and middle name -->
    <div class="row">
        <div class="col-1" style="border: 1px solid green">

        </div>
            <div class="col-5 p-2" style="border: 1px solid green;">
                <form>
                    <label for="first-name" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="first-name">
                </form>
            </div>
        <div class="col-5 p-2" style="border: 1px solid green;">
                <form>
                    <label for="middle-name" class="form-label">Middle Name:</label>
                    <input type="text" class="form-control" id="middle-name">
                </form>
        </div>
        <div class="col-1" style="border: 1px solid green">

        </div>
    </div>

    <!-- last name and suffix -->
    <div class="row">
        <div class="col-1" style="border: 1px solid green">

        </div>
            <div class="col-6 p-2" style="border: 1px solid green;">
                <form>
                    <label for="last-name" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="last-name">
                </form>
            </div>
        <div class="col-4 p-2" style="border: 1px solid green;">
                <form>
                    <label for="suffix" class="form-label">Suffix:</label>
                    <input type="text" class="form-control" id="suffix" placeholder="Jr./Sr./II/III" style="font-style: italic;">
                </form>
        </div>
        <div class="col-1" style="border: 1px solid green">

        </div>
    </div>

    <!-- Gender options and Civil Status -->
    <div class="row">
        <div class="col-1" style="border: 1px solid green">

        </div>
        <div class="col-5 p-2" style="border: 1px solid green;">
            <label>Gender Options</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radioGender" id="radioMale">
                <label class="form-check-label" for="radioMale">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radioGender" id="radioFemale">
                <label class="form-check-label" for="radioFemale">Female</label>
            </div>
        </div>
        <div class="col-5 p-2" style="border: 1px solid green;">
            <label>Civil Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioStatus" id="radioSingle">
                    <label class="form-check-label" for="radioSingle">Single</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioStatus" id="radioWidow">
                    <label class="form-check-label" for="radioWidow">Widow</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioStatus" id="radioMarried">
                    <label class="form-check-label" for="radioMarried">Married</label>
                </div>
        </div>
        <div class="col-1" style="border: 1px solid green">

        </div>
    </div>

    <!-- birthdate and birthplace -->
    <div class="row">
        <div class="col-1" style="border: 1px solid green">

        </div>
            <div class="col-3 p-2" style="border: 1px solid green;">
                <form>
                    <label for="birthday" class="form-label">Birthday:</label>
                    <input type="date" class="form-control" id="birthday">
                </form>
            </div>
        <div class="col-7 p-2" style="border: 1px solid green;">
                <form>
                    <label for="birthplace" class="form-label">Birth Place:</label>
                    <input type="text" class="form-control" id="birthplace">
                </form>
        </div>
        <div class="col-1" style="border: 1px solid green">

        </div>
    </div>

    <!-- nationality and contact number -->
    <div class="row">
        <div class="col-1" style="border: 1px solid green">

        </div>
            <div class="col-5 p-2" style="border: 1px solid green;">
                <form>
                    <label for="nationality" class="form-label">Nationality:</label>
                    <input type="text" class="form-control" id="nationality">
                </form>
            </div>
        <div class="col-5 p-2" style="border: 1px solid green;">
                <form>
                    <label for="contactNumber" class="form-label">Contact Number:</label>
                    <input type="text" class="form-control" id="contactNumber" placeholder="+63 9XX - XXX - XXXX">
                </form>
        </div>
        <div class="col-1" style="border: 1px solid green">

        </div>
    </div>

    <!-- complete address -->
    <div class="row">
        <div class="col-1" style="border: 1px solid green">

        </div>
        <div class="col-10 p-2" style="border: 1px solid green;">
            <form>
                <label for="completeAddress" class="form-label">Complete Address:</label>
                <textarea class="form-control" id="completeAddress" row="3"></textarea>
            </form>
        </div>
        <div class="col-1" style="border: 1px solid green">

        </div>
    </div>
</div>



<div class="container my-5">

    <!-- other information -->
    <div class="row">
        <div class="col-1" style="border: solid 1px green">

        </div>
        <div class="col-10 p-4" style="border: solid 1px green; text-align: center;">
        <h4>Other Information</h4>
        </div>
        <div class="col-1" style="border: solid 1px green">

        </div>
    </div>

    <!-- senior and pwd -->
    <div class="row">
        <div class="col-2" style="border: solid 1px green">

        </div>
        <div class="col-4 p-2" style="border: solid 1px green; text-align: center;">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="seniorCitizen" value="">
                <label class="form-check-label" for="seniorCitizen">Senior Citizen:</label>
            </div>
        </div>
        <div class="col-4 p-2" style="border: solid 1px green; text-align: center;">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="pwd" value="">
                <label class="form-check-label" for="pwd">Person with Disability (PWD)</label>
            </div>
        </div>
        <div class="col-2" style="border: solid 1px green">

        </div>
    </div>

    <!-- first time job seeker -->
    <div class="row">
        <div class="col-2" style="border: solid 1px green">

        </div>
        <div class="col-8 p-3" style="border: solid 1px green; text-align: center;">   
        <label>First Time Job Seeker:       </label> 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineRadio1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineRadio2">No</label>
            </div> 
        </div>
        <div class="col-2" style="border: solid 1px green">

        </div>
    </div>


    <!-- height and weight -->
    <div class="row">
        <div class="col-1" style="border: 1px solid green">

        </div>
            <div class="col-5 p-2" style="border: 1px solid green;">
                <form>
                    <label for="height" class="form-label">Height (cm):</label>
                    <input type="text" class="form-control" id="height">
                </form>
            </div>
        <div class="col-5 p-2" style="border: 1px solid green;">
                <form>
                    <label for="weight" class="form-label">Weight (kg):</label>
                    <input type="text" class="form-control" id="weight">
                </form>
        </div>
        <div class="col-1" style="border: 1px solid green">

        </div>
    </div>

    <!-- complexion and religion -->
    <div class="row">
        <div class="col-1" style="border: 1px solid green">

        </div>
            <div class="col-5 p-2" style="border: 1px solid green;">
                <form>
                    <label for="complexion" class="form-label">Complexion:</label>
                    <input type="text" class="form-control" id="complexion">
                </form>
            </div>
        <div class="col-5 p-2" style="border: 1px solid green;">
                <form>
                    <label for="religion" class="form-label">Religion:</label>
                    <input type="text" class="form-control" id="religion">
                </form>
        </div>
        <div class="col-1" style="border: 1px solid green">

        </div>
    </div>

    <!-- educational attainment -->
    <div class="row">
        <div class="col-1" style="border: 1px solid green">

        </div>
        <div class="col-4 p-2" style="border: 1px solid green;">
            <form>
                <label for="bloodType" class="form-label">Blood Type:</label>
                <input type="text" class="form-control" id="bloodType">
            </form>
        </div>
        <div class="col-6 p-2" style="border: 1px solid green;">
        <label for="dropdownOptions" class="label-margin">Educational Attainment:</label>
            <div class="form-group">
                <select class="form-select" id="dropdownOptions" name="dropdownOptions">
                    <option value="" disabled selected>-- Select Educational Attainment --</option>
                    <option value="Elementary Graduate">Elementary Graduate</option>
                    <option value="HighSchool Level">High School Level</option>
                    <option value="HighSchool Graduate">High School Graduate</option>
                    <option value="College Level">College Level</option>
                    <option value="College Graduate">College Graduate</option>
                    <option value="Masters Degree">Master’s Degree</option>
                    <option value="Doctorate Degree">Doctorate Degree</option>
                    <option value="Vocational">Vocational</option>

                </select>
            </div>
        </div>
        <div class="col-1" style="border: 1px solid green">

        </div>
        </div>

    <!-- work -->
    <div class="row">
        <div class="col-3" style="border: 1px solid green">

        </div>
            <div class="col-6 p-2" style="border: 1px solid green;">
                <form>
                    <label for="work" class="form-label">Work:</label>
                    <input type="text" class="form-control" id="work">
                </form>
            </div>
        <div class="col-3" style="border: 1px solid green">

        </div>
    </div>

    <div class="row my-2">
    </div>

    <div class="row">
        <div class="col-1" style="border: solid 1px green">

        </div>
        <div class="col-10 p-4" style="border: solid 1px green; text-align: center;">
        <h4>Family Background</h4>
        </div>
        <div class="col-1" style="border: solid 1px green">

        </div>
    </div>

    <!-- father's name and birthplace -->
    <div class="row">
        <div class="col-1" style="border: solid 1px green">

        </div>
        <div class="col-5 p-2" style="border: solid 1px green;">
            <form>
                <label for="fathersName" class="form-label">Father's Name:</label>
                <input type="text" class="form-control" id="fathersName">
            </form>
        </div>
        <div class="col-5 p-2" style="border: solid 1px green;">
            <form>
                <label for="father-birthplace" class="form-label">Birthplace:</label>
                <input type="text" class="form-control" id="father-birthplace">
            </form>
        </div>
        <div class="col-1" style="border: solid 1px green">

        </div>
    </div>

    <!-- mother's name and birthplace -->
    <div class="row">
        <div class="col-1" style="border: solid 1px green">

        </div>
        <div class="col-5 p-2" style="border: solid 1px green;">
            <form>
                <label for="mothersName" class="form-label">Mother's Maiden Name:</label>
                <input type="text" class="form-control" id="mothersName">
            </form>
        </div>
        <div class="col-5 p-2" style="border: solid 1px green;">
            <form>
                <label for="mother-birthplace" class="form-label">Birthplace:</label>
                <input type="text" class="form-control" id="mother-birthplace">
            </form>
        </div>
        <div class="col-1" style="border: solid 1px green">

        </div>
    </div>


    <!-- spouse -->
    <div class="row">
        <div class="col-3" style="border: 1px solid green">

        </div>
            <div class="col-6 p-2" style="border: 1px solid green;">
                <form>
                    <label for="spouse" class="form-label">Spouse's Name:</label>
                    <input type="text" class="form-control" id="spouse">
                </form>
            </div>
        <div class="col-3" style="border: 1px solid green">

        </div>
    </div>

    <!-- purpose -->
    <div class="row">
        <div class="col-3" style="border: 1px solid green">

        </div>
            <div class="col-6 p-2" style="border: 1px solid green;">
                <form>
                    <label for="purpose" class="form-label">Purpose:</label>
                    <input type="text" class="form-control" id="purpose">
                </form>
            </div>
        <div class="col-3" style="border: 1px solid green">

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
