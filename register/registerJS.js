function ShowHide(){
var employee = document.getElementById("employee");
var employer = document.getElementById("employer");
companyGen.style.display = employee.checked ? "none" : "block";
haveToken.style.display = employee.checked ? "block" : "none";
}

function showPwd(){
    document.getElementById("password").type='text';
  }

function hidePwd(){
    document.getElementById("password").type='password';
  }

function showcPwd(){
    document.getElementById("cPassword").type='text';
  }

function hidecPwd(){
    document.getElementById("cPassword").type='password';
  }
