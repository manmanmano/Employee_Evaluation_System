function ShowHide(){
//check the radio button if employer or employee
var employee = document.getElementById("employee");
var employer = document.getElementById("employer");
companyGen.style.display = employee.checked ? "none" : "block";
haveToken.style.display = employee.checked ? "block" : "none";
}
//hovering over "?" shows password as plain text
//new password in user credentials
function showPwd(){                                                         
    document.getElementById("newPassword").type ='text';                        
}                                                                           
function hidePwd(){                                                         
    document.getElementById("newPassword").type ='password';                    
}                                                                           
//confirm password in userCredentials
function showcPwd(){                                                    
    document.getElementById("confirmPassword").type ='text';             
}                                                                       
function hidecPwd(){                                                    
    document.getElementById("confirmPassword").type ='password';         
}                                                                       
//old password in userCredentials
function showoPwd(){                                                   
    document.getElementById("oldPassword").type ='text';                 
}                                                                       
function hideoPwd(){                                                    
    document.getElementById("oldPassword").type ='password';             
}
//registration password
function showRegPwd() {
    document.getElementById("regPassword").type = 'text';
}
function hideRegPwd() {
    document.getElementById("regPassword").type = 'password';
}
//registration password confirm
function showRegCPwd() {
    document.getElementById("regCPassword").type = 'text';
}
function hideRegCPwd() {
    document.getElementById("regCPassword").type = 'password';
}

//password in index
function showindexPwd(){                                                         
    document.getElementById("indexPassword").type ='text';                        
}                                                                           
function hideindexPwd(){                                                         
    document.getElementById("indexPassword").type ='password';                    
}
