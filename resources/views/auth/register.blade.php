<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Registration Form</title>
        <link rel="stylesheet" href="css/style.css">
        <link
      rel="stylesheet"
      href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css"
    />
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"> </script> 
        <style type="text/css"> 
          .selectt { 
            color: #000; 
            display: none; 
          }   
          </style> 
        
    </head>
    <body>
        <div class="container">
            <header>Registration Form</header>
            <div class="progress-bar">
                <div class="step">
                    <p>Name</p>
                    <div class="bullet">
                    <span>1</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
                <div class="step">
                    <p>Contact</p>
                    <div class="bullet">
                    <span>2</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
                <div class="step">
                    <p>Birthdate</p>
                    <div class="bullet">
                    <span>3</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                    <p>Account</p>
                    <div class="bullet">
                    <span>4</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
                <div class="step">
                    <p>Submit</p>
                    <div class="bullet">
                    <span>5</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
        </div>
            
            <div class="form-outer">
                <form action="#">
                    <div class="page slidepage">
                        <div class="title">Basic Info:</div>
                        <div class="field">
                            <div class="label">First Name</div>
                            <input type="text">
                        </div>
                        <div class="field">
                            <div class="label">Middle Name</div>
                            <input type="text">
                        </div>
                        <div class="field">
                            <div class="label">Last Name</div>
                            <input type="text">
                        </div>
                        <div class="field nextBtn">
                            <button>Next</button>
                        </div> 
                    </div>


                      <div class="page">
                        <div class="title">Contact Info:</div>
                        <div class="field">
                            <div class="label">Email Address</div>
                            <input type="text">
                        </div>
                        <div class="field">
                            <div class="label">Phone Number</div>
                            <input type="number">
                        </div>
                        <div class="field btns">
                            <button class="prev-1 prev">Previous</button>
                            <button class="next-1 next">Next</button>
                        </div> 
                    </div>

                      <div class="page">
                        <div class="title">Date of Birth:</div>
                        <div class="field">
                            <div class="label">Date</div>
                            <input type="text">
                        </div>
                        <div class="field">
                            <div class="label">Age</div>
                            <input type="text">
                        </div>
                        <div class="field">
                            <div class="label">Gender</div>
                            <select>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                            </div>
                        <div class="field btns">
                            <button class="prev-2 prev">Previous</button>
                            <button class="next-2 next">Next</button>
                        </div>
                    </div>

                      <div class="page">
                        <div class="title">Account Details:</div>
                        <div class="field">
                            <div class="label">Username</div>
                            <input type="text">
                        </div>
                        <div class="field">
                            <div class="label">Password</div>
                            <input type="password">
                        </div>
                        <div class="field">
                            <div class="label">Confirm Password</div>
                            <input type="password">
                        </div>
                        <div class="field btns">
                            <button class="prev-3 prev">Previous</button>
                            <button class="next-3 next">Next</button>
                        </div>
                      </div>
                      <div class="page">
                        <div class="title">User Option:</div>
                        <div class="field">
                        <div class="main-container">
                            <div class="radio-buttons">
                            <label class="custom-radio">
                          <!--<div class="label">Date</div>
                          <input type="text">-->
                            <input type="radio" name="radio" value="Jobseeker"/>
                            <span class="radio-btn">
                                    <i class="las la-check"></i>
                                <div class="hobbies-icon">
                                    <i class="la la-user-plus"></i>
                                        <h3>Jobseeker</h3>
                                </div>
                                </span>
                            </label>
                            <!--<div class="field">-->
                            <label class="custom-radio">
                                <input type="radio" name="radio" value="Backer"/>
                                <span class="radio-btn">
                                    <i class="las la-check"></i>
                                <div class="hobbies-icon">
                                    <i class="la la-users"></i>
                                        <h3>Backer</h3>
                                </div>
                                </span>
                            </label>
                          <!--</div>-->
                        </div>
                        <div class="Jobseeker selectt"> 
                            <strong>Register as Jobseeker</strong>  
                              to create campaigns, post services, and find jobs</div> 
                        <div class="Backer selectt"> 
                            <strong>Register as Backer</strong>  
                            to avail services, donate to campaigns, and many more</div> 
                                <script type="text/javascript"> 
                                    $(document).ready(function() { 
                                        $('input[type="radio"]').click(function() { 
                                            var inputValue = $(this).attr("value"); 
                                            var targetBox = $("." + inputValue); 
                                            $(".selectt").not(targetBox).hide(); 
                                            $(targetBox).show(); 
                                        }); 
                                    }); 
                                </script> 
                        <div class="field btns">
                          <button class="prev-4 prev">Previous</button>
                          <button class="Submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="js/script.js"></script>
    </body>
</html>