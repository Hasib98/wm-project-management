document
  .querySelector(".toggle_left_bar_burger_button_container")
  .addEventListener("click", function () {
    const sidebar = document.querySelector(".sidebar");
    sidebar.classList.toggle("open");

    /* 
    const toggleIcon = document.querySelector('.toggle_left_bar_burger_button_container img');

    if (sidebar.classList.contains('open')) {
        toggleIcon.src = "<?php echo plugin_dir_url(__FILE__) . 'assets/images/close-square-svgrepo-com.svg'; ?>";
        
    } else {
        toggleIcon.src = "<?php echo plugin_dir_url(__FILE__) . 'assets/images/burger-menu-left-svgrepo-com.svg'; ?>";
    } */
  });

const createTeamForm = document.querySelector(".create_team_form");
document
  .querySelector(".toggle_team_button")
  .addEventListener("click", function () {
    createTeamForm.classList.toggle("open");
  });

createTeamForm.addEventListener("submit", async function (event) {
  event.preventDefault(); // Prevent the default form submission
  const formData = new FormData(createTeamForm);
  const teamName = formData.get("team_name");
  formData.append("action", "create_team");

  try {
    const response = await fetch(ajax_object.ajax_url, {
      method: "POST",
      body: formData,
    });

    const data = await response.json();

    if (data.success) {
      console.log("Server Response:", data);
      // alert(data.data.message);
      window.location.reload(); // Reload the page to see the new team
    } else {
      alert(data.message);
    }
  } catch (error) {
    console.error("Error:", error);
    alert("An error occurred. Please try again.");
  }
});

let teamId = null; // Declare teamId outside the function`
document.querySelectorAll(".single_team_list").forEach((item) => {
  item.addEventListener("click", async function () {
    if (document.querySelector(".team_modal").classList.contains("open")) {
      document.querySelector(".team_modal").classList.remove("open");
    }
    if (document.querySelector(".right_sidebar").classList.contains("open")) {
      document.querySelector(".right_sidebar").classList.remove("open");
    }
    if (
      document.querySelector(".edit_project_modal").classList.contains("open")
    ) {
      document.querySelector(".edit_project_modal").classList.remove("open");
    }

    teamId = this.getAttribute("value");

    const formData = new FormData();
    formData.append("action", "get_team_member_email");
    formData.append("team_id", teamId);

    try {
      const response = await fetch(ajax_object.ajax_url, {
        method: "POST",
        body: formData,
      });

      const data = await response.json();

      if (data.success) {
        console.log("Server Response:", data.data.message);
        const teamMembers = data.data.message; // Assuming this is an array of team members
        const teamMemberList = document.querySelector(".team_member_list");
        teamMemberList.innerHTML = ""; // Clear previous members
        teamMembers.forEach((member) => {
          const li = document.createElement("li");
          li.classList.add("team_member_list_item");

          // Create the image element
          const img = document.createElement("img");
          img.src =
            "https://i.pravatar.cc/24?u=" +
            Math.floor(Math.random() * 1000) +
            1; // Random image URL for demo purposes
          img.alt = "";

          // const currentgone

          // Append the image to the li
          li.appendChild(img);

          // Add the text content after the image
          li.appendChild(document.createTextNode(member));

          // Add the li to the team member list
          teamMemberList.appendChild(li);
        });
      } else {
        alert(data.data.message);
      }
    } catch (error) {
      console.error("Error:", error);
      alert("An error occurred. Please try again.");
    }

    const teamModal = document.querySelector(".team_modal");
    teamModal.classList.toggle("open");
    const teamName = document.getElementById("team_name");
    teamName.innerHTML = this.textContent;

    const closemodal = document.querySelector(".close_team_modal");
    closemodal.addEventListener("click", function () {
      teamModal.classList.remove("open");
    });
  });
});

invite_member_form = document.getElementById("invite_member_form");
invite_member_form.addEventListener("submit", async function (event) {
  event.preventDefault(); // Prevent the default form submission
  const formData = new FormData(invite_member_form);
  // const email = formData.get("recipient_email");

  formData.append("action", "send_invite");
  formData.append("team_id", teamId);

  try {
    const response = await fetch(ajax_object.ajax_url, {
      method: "POST",
      body: formData,
    });

    const data = await response.json();

    if (data.success) {
      console.log("Server Response:", data);
      const emailField = document.querySelector(".recipient_email");
      emailField.value = ""; // Clear the input field after sending the invite
      const teamMemberList = document.querySelector(".team_member_list");
      teamMemberList.innerHTML = ""; // Clear previous members
      const teamMembers = data.data.message; // Assuming this is an array of team members
      teamMembers.forEach((member) => {
        const li = document.createElement("li");
        li.classList.add("team_member_list_item");

        // Create the image element
        const img = document.createElement("img");
        img.src =
          "https://i.pravatar.cc/24?u=" + Math.floor(Math.random() * 1000) + 1; // Random image URL for demo purposes
        img.alt = "";

        // Append the image to the li
        li.appendChild(img);

        // Add the text content after the image
        li.appendChild(document.createTextNode(member));

        // Add the li to the team member list
        teamMemberList.appendChild(li);
      });
    } else {
      alert(data.data.message);
      const emailField = document.querySelector(".recipient_email");
      emailField.value = ""; // Clear the input field after sending the invite
    }
  } catch (error) {
    console.error("Error:", error);
    alert("An error occurred. Please try again.");
  }
});

/* ===============crate project=================== */

const createProjectForm = document.querySelector(".create_project_form");
document
  .querySelector(".toggle_project_button")
  .addEventListener("click", function () {
    createProjectForm.classList.toggle("open");
  });

createProjectForm.addEventListener("submit", async function (event) {
  event.preventDefault(); // Prevent the default form submission
  const formData = new FormData(createProjectForm);
  const projectName = formData.get("project_name");
  formData.append("action", "create_project");

  formData.append("project_name", projectName);

  try {
    const response = await fetch(ajax_object.ajax_url, {
      method: "POST",
      body: formData,
    });

    const data = await response.json();

    if (data.success) {
      console.log("Server Response:", data);
      // alert(data.data.message);
      window.location.reload(); // Reload the page to see the new project
    } else {
      alert(data.message);
    }
  } catch (error) {
    console.error("Error:", error);
    alert("An error occurred. Please try again.");
  }
});
let projectId = null; // Declare projectId outside the function

document.querySelectorAll(".single_project_list").forEach((project) => {
  project.addEventListener("click", async function () {
    if (document.querySelector(".right_sidebar").classList.contains("open")) {
      document.querySelector(".right_sidebar").classList.remove("open");
    }
    if (
      document.querySelector(".edit_project_modal").classList.contains("open")
    ) {
      document.querySelector(".edit_project_modal").classList.remove("open");
    }
    if (document.querySelector(".team_modal").classList.contains("open")) {
      document.querySelector(".team_modal").classList.remove("open");
    }

    projectId = this.getAttribute("value");

    const formData = new FormData();
    formData.append("action", "get_project_details");
    formData.append("project_id", projectId);

    try {
      const response = await fetch(ajax_object.ajax_url, {
        method: "POST",
        body: formData,
      });

      const data = await response.json();

      if (data.success) {
        document.querySelector(".right_sidebar").classList.toggle("open");
        const projectDetails = data.data.message; // Assuming this is an array of project details
        console.log(projectDetails);

        const projectName = projectDetails.project_name;
        const details = projectDetails.details;
        const dueDate = projectDetails.due_date;
        const priority = projectDetails.priority;
        const status = projectDetails.status;
        const membersArray = projectDetails.members;
        console.log(projectName);
        console.log(details);
        console.log(dueDate);
        console.log(priority);
        console.log(status);
        console.log(membersArray);

        document.querySelector(".project_title").textContent = projectName;
        document.querySelector(".project_description").textContent = details;
        document.querySelector(".project_due_date").textContent = dueDate;
        document.querySelector(".project_priority").textContent = priority;
        document.querySelector(".project_status").textContent = status;
        const projectMemberList = document.querySelector(
          ".project_member_list"
        );
        projectMemberList.innerHTML = ""; // Clear previous members
        membersArray.forEach((member) => {
          const li = document.createElement("li");
          li.innerHTML = `<img src="https://i.pravatar.cc/24?u=${
            Math.floor(Math.random() * 1000) + 1
          }" alt=""> ${member}`; // Add member email to the list
          projectMemberList.appendChild(li);
        });

        const editProjectBtn = document.querySelector(".edit_project_btn");

        if (editProjectBtn) {
          const newEditBtn = editProjectBtn.cloneNode(true);
          editProjectBtn.parentNode.replaceChild(newEditBtn, editProjectBtn);

          newEditBtn.addEventListener("click", function () {
            document
              .querySelector(".edit_project_modal")
              .classList.toggle("open");
          });

          const projectNameInput = document.querySelector(
            ".project_name_input"
          );
          const projectDescriptionInput = document.querySelector(
            ".project_description_input"
          );
          const projectDueDateInput = document.querySelector(
            ".project_due_date_input"
          );
          const projectPriorityInput = document.querySelector(
            ".project_priority_input"
          );

          const projectStatusInput = document.querySelector(
            ".project_status_input"
          );

          projectNameInput.value = projectName;
          projectDescriptionInput.value = details;
          projectDueDateInput.value = dueDate ? dueDate : "2018-07-22"; // Handle null or undefined values
          projectPriorityInput.value = priority;
          projectStatusInput.value = status ? status : "on-hold";
        }

        const closeEditProjectModal = document.querySelector(
          ".close_edit_project_modal"
        );
        if (closeEditProjectModal) {
          closeEditProjectModal.addEventListener("click", function () {
            document
              .querySelector(".edit_project_modal")
              .classList.remove("open");
          });
        }

        const addMemberBtn = document.querySelector(
          ".add_member_to_project_button"
        );

        if (addMemberBtn) {
          const newAddMemberBtn = addMemberBtn.cloneNode(true);
          addMemberBtn.parentNode.replaceChild(newAddMemberBtn, addMemberBtn);
          newAddMemberBtn.addEventListener("click", function () {
            document
              .querySelector(".add_member_to_project_form")
              .classList.toggle("open");
          });
        }
      } else {
        alert(data.data.message);
      }
    } catch (error) {
      console.error("Error:", error);
      alert("An error occurred. Please try again.");
    }
  });
});

if (document.querySelector(".right_sidebar")) {
  const closeRightSidebar = document.querySelector(".close_right_sidebar");
  closeRightSidebar.addEventListener("click", function () {
    document.querySelector(".right_sidebar").classList.remove("open");
  });
}

if (document.getElementById("team_list")) {
  const teamList = document.getElementById("team_list");
  teamList.addEventListener("change", async function () {
    const selectedTeamId = this.value;
    console.log("Selected Team ID:", selectedTeamId);
    const formData = new FormData();
    formData.append("action", "get_team_member_email");
    formData.append("team_id", selectedTeamId);
    try {
      const response = await fetch(ajax_object.ajax_url, {
        method: "POST",
        body: formData,
      });
      const data = await response.json();
      if (data.success) {
        console.log("Server Response:", data.data.message);
        const teamMembers = data.data.message; // Assuming this is an array of team members

        document.querySelector(".team_member_email").innerHTML = ""; // Clear previous members
        if (teamMembers) {
          teamMembers.forEach((member) => {
            const option = document.createElement("option");
            option.value = member;
            option.textContent = member;
            document.querySelector(".team_member_email").appendChild(option);
          });
        }
      } else {
        alert(data.data.message);
      }
    } catch (error) {
      console.error("Error:", error);
      alert("An error occurred. Please try again.");
    }
  });
}

document
  .querySelector(".add_member_to_project_form")
  .addEventListener("submit", async function (event) {
    event.preventDefault(); // Prevent the default form submission
    const formData = new FormData(this);

    formData.append("action", "add_member_to_project");
    formData.append("project_id", projectId);

    try {
      const response = await fetch(ajax_object.ajax_url, {
        method: "POST",
        body: formData,
      });

      const data = await response.json();

      if (data.success) {
        console.log("Server Response:", data);
        document.querySelector(".project_member_list").innerHTML = ""; // Clear previous members
        const projectMembers = data.data.message; // Assuming this is an array of project members
        projectMembers.forEach((member) => {
          const li = document.createElement("li");
          li.classList.add("project_member_list_item");

          // Create the image element
          const img = document.createElement("img");
          img.src =
            "https://i.pravatar.cc/24?u=" +
            Math.floor(Math.random() * 1000) +
            1; // Random image URL for demo purposes
          img.alt = "";

          // Append the image to the li
          li.appendChild(img);

          // Add the text content after the image
          li.appendChild(document.createTextNode(member));

          // Add the li to the project member list
          document.querySelector(".project_member_list").appendChild(li);
        });
        document
          .querySelector(".add_member_to_project_form")
          .classList.remove("open");
      } else {
        alert(data.data.message);
      }
    } catch (error) {
      console.error("Error:", error);
      alert("An error occurred. Please try again.");
    }
  });

document
  .getElementById("edit_project_form")
  .addEventListener("submit", async function (event) {
    event.preventDefault(); // Prevent the default form submission
    const formData = new FormData(this);

    formData.append("action", "update_project");
    formData.append("project_id", projectId);

    try {
      const response = await fetch(ajax_object.ajax_url, {
        method: "POST",
        body: formData,
      });

      const data = await response.json();

      if (data.success) {
        console.log("Server Response:", data);
        // alert(data.data.message);
        document.querySelector(".edit_project_modal").classList.remove("open");
        document.querySelector(".right_sidebar").classList.remove("open");

        window.location.reload(); // Reload the page to see the updated project
      } else {
        alert(data.message);
      }
    } catch (error) {
      console.error("Error:", error);
      alert("An error occurred. Please try again.");
    }
  });
