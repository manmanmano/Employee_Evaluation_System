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
function deleteCompany() {
    if (confirm("Are you sure to erase all of the data related to your company?")) {
        location.href = "removeItem.php";
    }
}
