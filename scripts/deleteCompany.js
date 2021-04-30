function deleteCompany() {
    //if the employer presses the destroy company button than he is prompted a confirm box
    if (confirm('Are you sure you want to destroy all of the data related to your company?')) {
        //if the answer is yes than redirect and execute the script to destroy the company
        location.href = "../employer/removeItem.php";
    }
}
