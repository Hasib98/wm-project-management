document.querySelector('.toggle_left_bar_burger_button_container').addEventListener('click', function() {

    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('open');

    /* 
    const toggleIcon = document.querySelector('.toggle_left_bar_burger_button_container img');

    if (sidebar.classList.contains('open')) {
        toggleIcon.src = "<?php echo plugin_dir_url(__FILE__) . 'assets/images/close-square-svgrepo-com.svg'; ?>";
        
    } else {
        toggleIcon.src = "<?php echo plugin_dir_url(__FILE__) . 'assets/images/burger-menu-left-svgrepo-com.svg'; ?>";
    } */
   
});


const createTeamForm = document.querySelector('.create_team_form');
document.querySelector('.toggle_team_button').addEventListener('click', function() {
      createTeamForm.classList.toggle('open');
});

createTeamForm.addEventListener('submit', async function(event) {
  event.preventDefault(); // Prevent the default form submission
  const formData = new FormData(createTeamForm);
  const teamName = formData.get('team_name');
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

document.querySelectorAll(".single_team_list").forEach(item => {
  item.addEventListener("click", function() {
  
    const teamId = this.getAttribute('value');
    const teamModal = document.querySelector('.team_modal');  
    teamModal.classList.toggle('open');
    const teamName =document.getElementById('team_name');
    teamName.innerHTML = this.textContent;

    const closemodal = document.querySelector('.close_team_modal');
    closemodal.addEventListener('click', function() {
      teamModal.classList.remove('open');
    });
    
  }); 
});

invite_member_form = document.getElementById('invite_member_form');
invite_member_form.addEventListener('submit', async function(event) {
  event.preventDefault(); // Prevent the default form submission
  const formData = new FormData(invite_member_form);
  const recipientEmail = formData.get('recipient_email');
  formData.append("action", "send_invite");

  
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