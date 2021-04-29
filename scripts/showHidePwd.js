// hovering over "?" shows password as plain text
function ShowHide(){
var employee = document.getElementById("employee");
var employer = document.getElementById("employer");
companyGen.style.display = employee.checked ? "none" : "block";
haveToken.style.display = employee.checked ? "block" : "none";
}

function showPwd(){                                                         
    document.getElementById("newPassword").type='text';                        
}                                                                           
function hidePwd(){                                                         
    document.getElementById("newPassword").type='password';                    
}                                                                           
function showcPwd(){                                                    
    document.getElementById("confirmPassword").type='text';             
}                                                                       
function hidecPwd(){                                                    
    document.getElementById("confirmPassword").type='password';         
}                                                                       
function showoPwd(){                                                   
    document.getElementById("oldPassword").type='text';                 
}                                                                       
function hideoPwd(){                                                    
    document.getElementById("oldPassword").type='password';             
}
