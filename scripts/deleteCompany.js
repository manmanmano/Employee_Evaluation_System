function deleteCompany() {
    if (confirm('Are you sure you want to destroy all of the data related to your company?')) {
        location.href = "../employer/removeItem.php";
    }
}
