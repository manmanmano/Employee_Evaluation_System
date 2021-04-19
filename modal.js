<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: "open sans", sans-serif;}

/* Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.2);
}

/* Modal content */
.modal-content {
  font-family: "open sans", sans-serif;
  position: relative;
  background-color: #f4f7f6;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 35%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/*Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* Close button */
.close {
  color: white;
  float: right;
  font-size: 30px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  font-family: "open sans", sans-serif;
  padding: 2px 16px;
  background-color: #87ff9e;
  color: black;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 5px;
  background-color: #87ff9e;
}
</style>
</head>
<body>

// open modal
<button id="myBtn">Open Modal</button>

<!-- modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3>My Evaluation</h3>
    </div>
    <div class="modal-body">
      <table>
        <tr>
          <th>Performance</th>
          <th>Grade</th>
        </tr>
        <tr>
            <td>Employee shows strong initiative</td>
        </tr>
        <tr>
            <td>Employee works well with others in group-based projects</td>
        </tr>
        <tr>
            <td>Employee takes instructions and follows leaders well</td>
        </tr>
        <tr>
            <td>Employee shows good leadership skills</td>
        </tr>
        <tr>
            <td>Employee stays focused on tasks at hand</td>
        </tr>
        <tr>
            <td>Employee knows how to prioritize tasks</td>
        </tr>
        <tr>
            <td>Employee has good communication with coworkers</td>
        </tr>
        <tr>
            <td>Employee has good communication with superiors</td>
        </tr>
        <tr>
            <td>Employee is dependable</td>
        </tr>
        <tr>
            <td>Employee gets assignments in on time</td>
        </tr>
        <tr>
            <td>Employee arrives on time every day</td>
        </tr>
        <tr>
            <td>Employee's work is of high quality</td>
        </tr>
    </table>

    </div>
    <div class="modal-footer">
      <p></p>
    </div>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>
