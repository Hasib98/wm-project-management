/* const inviteForm = document.querySelector(".invite_form");

inviteForm.addEventListener("submit", function (e) {
  e.preventDefault();
  alert(document.querySelector(".email_input").value);
});

*/
/* ======================create Project =========================*/

const createProjectBtn = document.querySelector(".create_project_btn");

createProjectBtn.addEventListener("click", function () {
  let projectInput = document.getElementById("projectInput");
  let addProjectBtn = document.getElementById("addProjectBtn");

  if (!projectInput && !addProjectBtn) {
    projectInput = document.createElement("input");
    projectInput.id = "projectInput";

    addProjectBtn = document.createElement("button");
    addProjectBtn.id = "addProjectBtn";
    addProjectBtn.appendChild(document.createTextNode("Add Project"));

    const ProjectList = document.querySelector(".project_list");
    ProjectList.appendChild(projectInput);
    ProjectList.appendChild(addProjectBtn);
  }

  addProjectBtn.addEventListener("click", async function () {
    const formData = new FormData();
    formData.append("project_name", projectInput.value);
    formData.append("action", "create_project");

    try {
      const response = await fetch(ajax_object.ajax_url, {
        method: "POST",
        body: formData,
      });

      const data = await response.json();

      if (data.success) {
        console.log("Server Response:", data);
      } else {
        alert(data.data.message);
      }
    } catch (error) {
      console.error("Error:", error);
      alert("An error occurred. Please try again.");
    }
  });
});

/* ======================create Team =========================*/

const createTeamBtn = document.querySelector(".create_team_btn");

createTeamBtn.addEventListener("click", function () {
  let teamNameInput = document.getElementById("team_input");
  let addTeamBtn = document.getElementById("add_team_btn");

  if (!teamNameInput && !addTeamBtn) {
    teamNameInput = document.createElement("input");
    teamNameInput.id = "team_input";

    addTeamBtn = document.createElement("button");
    addTeamBtn.id = "add_team_btn";
    addTeamBtn.appendChild(document.createTextNode("Add Team"));

    const teamList = document.querySelector(".team_list");
    teamList.appendChild(teamNameInput);
    teamList.appendChild(addTeamBtn);
  }

  addTeamBtn.addEventListener("click", async function () {
    const formData = new FormData();
    formData.append("team_name", teamNameInput.value);
    formData.append("action", "create_team");

    try {
      const response = await fetch(ajax_object.ajax_url, {
        method: "POST",
        body: formData,
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

const teamMemberForm = document.getElementById("team_member_form");
const inputAddMember = document.getElementById("add_team_member_field");
const addMemberBtn = document.getElementById("add_team_member_btn");
const team_id = document.getElementById("teams");

teamMemberForm.addEventListener("submit", async function (e) {
  e.preventDefault();
  const formData = new FormData();
  formData.append("email", inputAddMember.value);
  formData.append("team_id", team_id.value);
  formData.append("action", "add_team_member");

  try {
    const response = await fetch(ajax_object.ajax_url, {
      method: "POST",
      body: formData,
    });

    const data = await response.json();

    if (data.success) {
      console.log("Server Response:", data);
      alert(data.data.message);
    } else {
      console.log(data.data.message);
      alert(data.data.message);
    }
  } catch (error) {
    console.error("Error:", error);
    alert("An error occurred. Please try again.");
  }
});

// avatar link https://i.pravatar.cc/48

const selectedTeam = document.getElementById("selected_team");

selectedTeam.addEventListener("change", async function () {
  alert("test");
  const team_id = this.value;

  const formData = new FormData();
  formData.append("team_id", team_id);
  formData.append("action", "get_team_member");

  try {
    const response = await fetch(ajax_object.ajax_url, {
      method: "POST",
      body: formData,
    });

    const data = await response.json();

    if (data.success) {
      console.log("Server Response:", data);
      // alert(data.data.message);
      const selectElement = document.getElementById("member");

      // Clear existing options
      // selectElement.innerHTML = "";

      // Add new options from the array
      emails.forEach((email) => {
        const option = document.createElement("option");
        option.value = email;
        option.textContent = email; // Using the same email for the display text
        selectElement.appendChild(option);
      });
    } else {
      console.log(data.data.message);
      // alert(data.data.message);
    }
  } catch (error) {
    console.error("Error:", error);
    alert("An error occurred. Please try again.");
  }
});
