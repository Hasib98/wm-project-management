/* const inviteForm = document.querySelector(".invite_form");

inviteForm.addEventListener("submit", function (e) {
  e.preventDefault();
  alert(document.querySelector(".email_input").value);
});

 */


const createTeamBtn = document.querySelector('.create_team_btn');

  createTeamBtn.addEventListener('click', function () {
    const teamNameInput = document.createElement('input');
    teamNameInput.id = "team_input";

    const addTeamBtn = document.createElement('button');
    addTeamBtn.id = "add_team_btn";
    addTeamBtn.appendChild(document.createTextNode("Add Team"));

    const teamList = document.querySelector('.list');
    teamList.appendChild(teamNameInput);
    teamList.appendChild(addTeamBtn);


    addTeamBtn.addEventListener('click',  async function () {

      const formData = new FormData();
      formData.append("team_name", input.value);
      formData.append("action", "add_team"); 

      try {
        const response = await fetch(ajax_object.ajax_url, {
            method: "POST",
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            console.log("Server Response:", data);

        } else {
            alert(data.message);
        }
        } catch (error) {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        }
    });
  });







// avatar link https://i.pravatar.cc/48