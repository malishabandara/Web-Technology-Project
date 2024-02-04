<?php
include('../includes/connection.php');
session_start();
if(!isset($_SESSION['regNo']))
{
	header("Location: ../home.php");
}
$regNo = $_SESSION["regNo"];
$department = $_SESSION["department"];

$sql = "SELECT regNumber, nameInitial FROM $department WHERE regNumber = '$regNo';";
$result = mysqli_query($conn, $sql);
$noRows = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

$_SESSION['regNo'] = $row['regNumber'];
$_SESSION['name'] = $row['nameInitial'];

$currentDate = date('Y-m-d');
                                    
$query = "SELECT * FROM bookings WHERE reg_no = '$regNo' AND date = '$currentDate'";
$result = mysqli_query($conn, $query);
$noRows = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Center</title>
    <link rel="stylesheet" href="main.css?=<?php echo time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

</head>
<body>
    <div class="container" style="position: relative;" id="blur">
        <div class="navigation">
            <ul>
               <li>
                <div class="logo">
                    <a href="#">
                       <span class="icon"><img src="images_1/uoj_logo.png" alt=""></span>
                        <span class="title"></span>
                        <span class="icon"></span>
                    </a>
                </div>
               </li> 


               <li>
                <a href="index.php">
                    <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                    <span class="title"></span>
                    <span class="icon">Dashboard</span>
                </a>
               </li> 


               <li>
               <a href="../user.php">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <span class="title"></span>
                    <span class="icon">User Profile</span>
                </a>
               </li>
               
               <li>
               <a href="../cancelBooking.php">
                    <span class="icon"><ion-icon name="time-outline"></ion-icon></span>
                    <span class="title"></span>
                    <span class="icon">Appoinment</span>
                </a>
               </li> 

               <li>
               <a href="../viewBooking.php">
                    <span class="icon"><i class="fa-regular fa-calendar-check"></i></span>
                    <span class="title"></span>
                    <span class="icon">Bookings</span>
                </a>
               </li> 


               <li>
                <a href="../remarks.php">
                    <span class="icon"><ion-icon name="chatbubble-outline"></ion-icon></span>
                    <span class="title"></span>
                    <span class="icon">Remarks</span>
                </a>
               </li> 


               <li>
                <a href="../includes/logout.php">
                    <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                    <span class="title"></span>
                    <span class="icon">Sign Out</span>
                </a>
               </li> 


            </ul>
        </div>


    

        <!-- main -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <!-- search -->
                    <h1 class="welcome"> Welcome <span class="wel_us"><?=$_SESSION['name']?></span></h1>
                    <!-- <h1 class="welcome"><span class="wel_us"><?=$_SESSION['regNo']?></span></h1> -->
                 <!-- user Image -->
                 <div class="user">
                    <img src="images_1/user.jpg" alt="">
                 </div>

            </div>
            <!--  manin ends -->
           <div class="dashboard" id="dashboard"  style="min-height: 100vh;">
                <!-- Dashboard start -->
                <!-- cards -->
                <div class="cardBox">
                    <div class="card1">
                        <div>
                            <div class="numbers"><?php echo $noRows;?></div>
                            <div class="cardName">Appoinments</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="happy-outline"></ion-icon>
                        </div>
                    </div>
    
    
                    <div class="card2">
                        <div>
                            <div class="numbers" >Active</div>
                            <div class="cardName">Status</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="accessibility-outline"></ion-icon>
                        </div>
                    </div>
    
    
                    <div class="card3" id="date">
                        <div>
                            <div class="numbers" ><?php echo date('d');?><sup class="sup">th</sup><span ><?php echo date("F", strtotime($currentDate));?></div>
                            <div class="cardName">Today</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="calendar-outline"></ion-icon>
                        </div>
                    </div>
    
    
                   
                    
                </div>
    
                <!-- Appoinment details --> 
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Recent Appoinment</h2>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <td data-label ="registration number">Registration Number</td>
                                    <td>Name</td>
                                    <td>Date</td>
                                    <td>Time</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
    
                            <tbody>
                                <tr>
                                <?php
                                    
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['reg_no']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['timeslot']; ?></td>
                                            <td><a href="../includes/removeStudentBooking.php?id=<?php echo $row['id'] ?>" class="status">Cancel</a></td>
                                        </tr>
                                    <?php
                                    }
                                ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
               
                
           </div>
            <!-- Dashboard ends -->         

        </div>

    </div>



  




    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>

console.log("Script executed");

      //add hovered class in selected list item  
      let list = document.querySelectorAll('.navigation li');
      function activeLink(){
        list.forEach((item) =>
        item.classList.remove('hovered'));
        this.classList.add('hovered');
      }
      list.forEach((item) =>
      item.addEventListener('mouseover',activeLink));


    //menu toggle

    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('main');

    toggle.onclick = function(){
        navigation.classList.toggle('active');
        main.classList.toggle('active');
    }


    // // for change status color


    document.addEventListener("DOMContentLoaded",function(){
        const card2 = document.querySelector('.card2');
        const statusElement = card2.querySelector('.numbers');
        const status = statusElement.textContent.toLocaleLowerCase();
        

        if(status === 'active'){
            card2.classList.add('active');
            card2.style.backgroundColor = "rgb(95, 255, 164)";
            
        }else{
            card2.classList.add('deactive');
            card2.style.backgroundColor = "rgb(255, 95, 95";
        }

    
    });


    
//    for diabling date




$(function(){
    var arrayOfDates = ["25-08-2023","29-08-2023"];

    $("input.datePicker").datepicker({
        beforeShowDay: function(date){
            var string = $.datepicker.formatDate("dd-mm-yy", date);  
            return [arrayOfDates.indexOf(string) === -1]; 
        }
    });
});


//popup login
    function viewPopup(){
        var blur = document.getElementById('blur');
        blur.classList.toggle('active');
        var popup = document.getElementById('popup');
        popup.classList.toggle('active');
    }

    function closeviewPopup(){
        var blur = document.getElementById('blur');
        blur.classList.remove('active');
        var popup = document.getElementById('popup');
        popup.classList.remove('active');
    }


//blur 



    </script>
</body>
</html>