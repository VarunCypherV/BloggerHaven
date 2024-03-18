document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    var form = event.target;
    var formData = new FormData(form);
    fetch(form.action, {
      method: form.method,
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert(data.message);
        // Setting userId in session storage
    sessionStorage.setItem('userId', data.userId);

// Retrieving userId from session storage


        window.location.href = "Landing.html?userId=" + data.userId;

      } else {
        alert(data.message);
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });



  function logout() {
    // Clear session storage
    sessionStorage.clear();
    if (window.parent !== window) {
        window.parent.location.href = "../index.html";
    }
}
