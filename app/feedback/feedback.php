<?php 
require_once("./includes/head.php")
?> 
<body>

    <section id="swup" class="transtion-fade">
    <div class="logo">
            <img src="./images/qclogo.jpg" alt="">
            <div class="title">
            <p>Quezon City Public Library</p>
            <p>Quezon City Government</p>
            </div>
            <img src="./images/qcplLogo.png" alt="">
        </div>

        <!-- start of feedback form -->
        <form action="">
        <div class="flex">
        <div class="textBox">
         <p style="font-size: 1.5em;">Please enter your queue number</p>
         <p style="font-size: 1em; font-style:italic;">Mangyaring ilagay sa ibaba inyong queue number</p>
        <input type="text" name="" id="" class="inputnum">
         <br>
         <br>
         <br>
         <p style="font-size: 1.5em;">Client Identifier</p>
         <p style="font-size: 1em; font-style:italic;">Note* This is type box will auto fill when your account exist.</p>
         <p style="font-size: 1em; font-style:italic;">Paalala* Ito ay kusang naglalagay ng pangalan kung kayo ay nakagawa na ng account.</p>
         <input type="text" name="" id="" disabled class="inputnum" style="padding:0px;">

         <button type="button" class="btn btn-success feedbackbtn" data-toggle="modal" data-target="#exampleModalCenter">Submit</button>
         </div>
         <div class="numPan">
            <div class="nums">
               <div class="flex r r1">
                  <div><span>1</span></div>
                  <div><span>2</span></div>
                  <div><span>3</span></div>
               </div>
               <div class="flex r r2">
                  <div><span>4</span></div>
                  <div><span>5</span></div>
                  <div><span>6</span></div>

               </div>
               <div class="flex r r3">
                  <div><span>7</span></div>
                  <div><span>8</span></div>
                  <div><span>9</span></div>

               </div>
               <div class="flex r r4">
                  <div><span>-</span></div>
                  <div><span>0</span></div>
                  <div class="del"><span>Del</span></div>

               </div>
            </div>
         </div>
         </div>
         </form>
    </section>

      
    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Would you like to submit a feedback?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-success"><a href="feedbackForm.php" style="text-decoration:none; color:#fff;">Yes</a></button>
      </div>
    </div>
  </div>
</div>


<script>
   var btn = document.querySelectorAll(".r > div");
   var inpt =document.querySelector(".inputnum");
   var delBtn = document.querySelector(".del");
   btn.forEach(val => {
      val.addEventListener("click", () => {
         if (val.innerText === "Del") {
            inpt.value = inpt.value.slice(0, -1); // Remove the last character
         } else {
            inpt.value += val.innerText;
         }
      });
   });

</script>
    
    <script src="https://unpkg.com/swup@4"></script>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>