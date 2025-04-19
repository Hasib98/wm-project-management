const inviteForm = document.querySelector(".invite_form");

inviteForm.addEventListener("submit", function (e) {
  e.preventDefault();
  alert(document.querySelector(".email_input").value);
});
