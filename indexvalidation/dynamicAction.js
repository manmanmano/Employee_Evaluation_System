function changeAction()
{
  if(document.loginForm.title[0].checked == true)
  {
    document.loginForm.action = "employer/employer.php";
  }
  else
  if(document.loginForm.title[1].checked == true)
  {
    document.loginForm.action ="employee/employee.php";
  }
  return true;
}
