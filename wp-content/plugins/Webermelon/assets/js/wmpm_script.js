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
    } else {
      alert(data.data.message);
    }
  } catch (error) {
    console.error("Error:", error);
    alert("An error occurred. Please try again.");
  }
});

const createProjectForm = document.querySelector(".create_project_form");
document
  .querySelector(".toggle_project_button")
  .addEventListener("click", function () {
    createProjectForm.classList.toggle("open");
  });
